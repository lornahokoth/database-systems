<?php 
//includes
include './DBController.php';
$salt = "m1n1Cl0ud$";
$return;
//This is used to route requests to login.php to the correct function.
//If no function found then a redirect to a function ot found page is performed
if(function_exists($_POST['func'])) {
    $_POST['func']();
    echo json_encode($return);
    return 0;
} else {
    //return 404 not found;
    echo "function not found " . $_POST['func'];
    return 1;
}

function login() {
    global $salt;
    global $return;
    $return = array();
    if(empty($_POST['username']) || empty($_POST['password'])) {
        $return['code'] = 401;
        $return['message'] = "Username and/or password not provided";
        return;
    }
    $username = $_POST['username'];
    $password = md5(md5($_POST['password']) . $salt);
    $conn = dbconnect();
    if($conn == false) {
        $return['code'] = 401;
        $return['message'] = "Failed to connect to DB";
        closedb($conn);
        return;
    }

    $sql = "SELECT * FROM dwekesa1.Users WHERE username = \"" . $username . "\" AND pswd = \"" . $password . "\"";
    $results = $conn->query($sql);
    if($results->num_rows == 1) {
        $return['code'] = 200;
        $return['message'] = "Successfully logged in";
        $user_info = $results->fetch_assoc();
        $history_sql = "INSERT INTO dwekesa1.login_history (login_status, login_timestamp, ip_address, user_id) VALUES (" .
                       "1, \"" . date("Y-m-d H:i:s") . "\", \"" . $_SERVER['REMOTE_ADDR'] . "\", " . $user_info['user_id'] . ")";
        $results = mysqli_query($conn, $history_sql);
        clearCookies();
        setcookie('user_id', $user_info['user_id'], 0, '/');
    } else {
        $return['code'] = 401;
        $return['message'] = "Invalid username/password provided.";
        $sql = "SELECT * FROM dwekesa1.Users WHERE username = \"" . $username . "\"";
        $results = $conn->query($sql);
        if($results->num_rows == 1) {
            $user_info = $results->fetch_assoc();
            $history_sql = "INSERT INTO dwekesa1.login_history (login_status, login_timestamp, ip_address, user_id) VALUES (" .
                        "2, \"" . date("Y-m-d H:i:s") . "\", \"" . $_SERVER['REMOTE_ADDR'] . "\", " . $user_info['user_id'] . ")";
            $results = mysqli_query($conn, $history_sql);
        }
    }

    closedb($conn);

    return;
}

function signup() {
    global $salt;
    global $return;

    if(empty($_POST['email']) || empty($_POST['password']) || 
       empty($_POST['confirmPassword']) || empty($_POST['fname']) || 
       empty($_POST['lname']) || empty($_POST['username']) || 
       empty($_POST['dob'])) {
        $return['code'] = 401;
        $return['message'] = "Invalid Data";
        return;
    }

    if($_POST['confirmPassword'] != $_POST['password']) {
        $return['code'] = 401;
        $return['message'] = "Passwords do not match";
        return;
    }

    $username = $_POST['username'];
    $password = md5(md5($_POST['password']) . $salt);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];

    $conn = dbconnect();
    if($conn == false) {
        $return['code'] = 401;
        $return['message'] = "Failed to connect to db";
        closedb($conn);
        return;
    }

    $sql = "SELECT * FROM dwekesa1.Users WHERE username = \"" . $username . "\"";
    $results = mysqli_query($conn, $sql);
    if($results->num_rows > 0) {
        $return['code'] = 401;
        $return['message'] = "Username already exists";
        closedb($conn);
        return;
    }

    mysqli_autocommit($conn, false);
    $user_sql = "INSERT INTO dwekesa1.Users (username, pswd, account_status) VALUES (\"" . $username . "\", \"" . $password . 
           "\", 1)";
    if(mysqli_query($conn, $user_sql) === TRUE) {
        $user_id = mysqli_insert_id($conn);
        $customer_sql = "INSERT INTO dwekesa1.Customer (fname, lname, email, dob, user_id) VALUES (\"" . 
        $fname . "\", \"" . $lname . "\", \"" . $email . "\", \"" . $dob . "\", " . $user_id . ")";
        if(mysqli_query($conn, $customer_sql) === TRUE) {
            $customer_id = mysqli_insert_id($conn);
            $subscription_sql = "INSERT INTO dwekesa1.Sub (active, substatus, auto_renewal, customer_id, sub_tier_id) VALUES (\"" .
            date("Y-m-d") . "\", 1, 1, " . $customer_id . ", 1)";
            if(mysqli_query($conn, $subscription_sql) === TRUE) {
                if(!mysqli_commit($conn)) {
                    $message = "Failed to commit";
                    $insert = false;
                } else {
                    $insert = true;
                }
            } else {
                $message = "Failed add Sub";
                $insert = false;
            }
        } else {
            $message = "Failed to add Customer";
            $insert = false;
        }
    } else {
        $message = "Failed to add User";
        $insert = false;
    }
    if($insert) {
        $return['code'] = 200;
        $return['message'] = "New user created successfully";
        clearCookies();
        setcookie('username', $user_id, 0, '/');
    } else {
        $return['code'] = 401;
        $return['message'] = $message;
    }

    closedb($conn);
    return;
}

//clears all cookies
function clearCookies() {
    foreach ($_COOKIE as $key => $value) {
        setcookie($key, false, 0, "/");
    }
}
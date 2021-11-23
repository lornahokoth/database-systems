<?php 
//includes
include './DBController.php';
$salt = "m1n1Cl0ud$";
$return;
//This is used to route requests to login.php to the correct function.
//If no function found then a redirect to a function ot found page is performed
if(function_exists($_POST['func'])) {
    $_POST['func']($_POST);
    echo json_encode($return);
    return 0;
} else {
    //return 404 not found;
    echo "function not found";
    return 1;
}

function login($post) {
    global $salt;
    global $return;
    $return = array();
    if(empty($_POST['email']) || empty($_POST['password'])) {
        $return['code'] = 401;
        $return['message'] = "Username and/or password not provided";
        return;
    }
    $email = $post['email'];
    $password = md5(md5($post['password']) . $salt);
    $conn = dbconnect();
    if($conn == false) {
        $return['code'] = 401;
        $return['message'] = "Failed to connect to DB";
        closedb($conn);
        return;
    }

    $sql = "SELECT * FROM dwekesa1.Users WHERE username = \"" . $email . "\" AND pswd = \"" . $password . "\"";
    $results = $conn->query($sql);
    if($results->num_rows == 1) {
        $return['code'] = 200;
        $return['message'] = "Successfully logged in";
    } else {
        $return['code'] = 401;
        $return['message'] = "Invalid username/password provided.";
    }

    closedb($conn);

    return;
}

function signup() {
    global $salt;
    clearCookies();
    setcookie("func", "signup", 0, "/");

    if(empty($_POST['email']) || empty($_POST['password']) || 
       empty($_POST['confirmPasswd']) || empty($_POST['fname']) || 
       empty($_POST['lname'])) {
        setcookie("message", "Invalid Data", 0, "/");
        setcookie("status", "failure", 0, "/");
        header("Location: ../html/login.php");
        return;
    }

    if($_POST['confirmPasswd'] != $_POST['password']) {
        setcookie("username", $_POST['newuser'], 0, "/");
        setcookie("message", "Passwords do not match", 0, "/");
        setcookie("status", "failure", 0, "/");
        header("Location: ../views/homepage.php");
        return;
    }

    $email = $_POST['email'];
    $password = md5(md5($_POST['password']) . $salt);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    $conn = dbconnect();
    if($conn == false) {
        setcookie("message", "Failed to connect to db", 0, "/");
        setcookie("status", "failure", 0, "/");
        header("Location: ../html/login.php");
        closedb($conn);
        return;
    }

    $sql = "SELECT * FROM users WHERE user = " . $email;
    $results = $conn->query($sql);
    if($results->num_rows > 0) {
        setcookie("message", "Username already exists", 0, "/");
        setcookie("status", "failure", 0, "/");
        header("Location: ../html/login.php");
        closedb($conn);
        return;
    }

    $sql = "INSERT INTO users (username, password, first_name, last_name) VALUES (" . $email . ", " . $password . 
           ", " . $fname . ", " . $lname;
    $results = $conn->query($sql);
    if($conn->affected_rows == 0) {
        setcookie("message", "Could not add user", 0, "/");
        setcookie("status", "failure", 0, "/");
        header("Location: ../html/login.php");
        closedb($conn);
        return;
    }
    closedb($conn);

    setcookie("message", "Connected to DB Successfully", 0, "/");
}

function clearCookies() {
    foreach ($_COOKIE as $key => $value) {
        setcookie($key, false, 0, "/");
    }
}

function logout() {    
    clearCookies();
    header("Location: ../html/login.php");
}
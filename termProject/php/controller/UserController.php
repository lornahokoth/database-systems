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

function getUserInfo() {
    global $return;
    
    if(!empty($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
        $conn = dbconnect();
        $user_sql = "SELECT * FROM dwekesa1.Users WHERE user_id = " . $user_id;
        $results = mysqli_query($conn, $user_sql);
        if($results->num_rows == 0) {
            $return['code'] = 401;
            $return['message'] = "Could not find user " . $user_sql;
            closedb($conn);
            return;
        } else {
            $user_info = $results->fetch_assoc();
            $return['code'] = 200;
            $return['username'] = $user_info['username'];
            closedb($conn);
            return;
        }
    } else {
        $return['code'] = 401;
        $return['message'] = "User is not logged in";
        return;
    }
    return;
}

function logout() {
    foreach ($_COOKIE as $key => $value) {
        setcookie($key, false, 0, "/");
    }
}
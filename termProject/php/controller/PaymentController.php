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

function makePayment() {
    global $return;
    if(empty($_POST['type']) || empty($_POST['card_name']) || 
       empty($_POST['card_number']) || empty($_POST['exp_date']) || 
       empty($_POST['cvv']) || empty($_POST['street_addr']) || 
       empty($_POST['city']) || empty($_POST['state']) ||
       empty($_POST['zipcode'])) {
        $return['code'] = 401;
        $return['message'] = "Invalid Data";
        return;
    }
    $type = $_POST['type'];
    $card_name = $_POST['card_name'];
    $card_number = $_POST['card_number'];
    $exp_date = $_POST['exp_date'];
    $cvv = $_POST['cvv'];
    $street_addr = $_POST['street_addr'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    $address = $street_addr . " " . $city . ", " . $state . " " . $zipcode;
    $conn = dbconnect();
    if($conn == false) {
        $return['code'] = 401;
        $return['message'] = "Failed to connect to DB";
        closedb($conn);
        return;
    }

    if(!empty($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    } else {
        $return['code'] = 401;
        $return['message'] = "User is not logged in";
        closedb($conn);
        return;
    }

    $customer_sql = "SELECT * FROM dwekesa1.Customer WHERE user_id = " . $user_id;
    $results = mysqli_query($conn, $customer_sql);
    if($results->num_rows == 0) {
        $return['code'] = 401;
        $return['message'] = "Could not find customer";
        closedb($conn);
        return;
    }

    $customer_info = $results->fetch_assoc();
    $sub_id = createSub($type, $customer_info['customer_id']);

    if($sub_id == -1) {
        $return['code'] = 401;
        $return['message'] = "Failed to create subscription";
        closedb($conn);
        return;
    }
    $payment_sql = "INSERT INTO dwekesa1.Payment_info (pay_date, address, card_name, exp_date, card_num, customer_id, sub_id) VALUES (\"" .
                    date("Y-m-d H:i:s") . "\", \"" . $address . "\", \"" . $card_name . "\", \"" . $exp_date . 
                    "\", \"" . $card_number . "\"," . $customer_info['customer_id'] . ", " . $sub_id  . ")";
    if(mysqli_query($conn, $payment_sql) === TRUE) {
        $return['code'] = 200;
        $return['message'] = "Payment successful";
    } else {
        $return['code'] = 401;
        $return['message'] = "Payment failed " . $payment_sql;
    }
    closedb($conn);
    return;
}

function createSub($type, $customer_id) {
    $conn = dbconnect();
    if($conn == false) {
        $return['code'] = 401;
        $return['message'] = "Failed to connect to DB";
        closedb($conn);
        return;
    }

    $sub_tier_sql = "SELECT * FROM dwekesa1.Sub_tier WHERE name = \"" . $type . "\"";
    $results = mysqli_query($conn, $sub_tier_sql);
    if($results->num_rows == 0) {
        return -1;
    }

    $stier_info = $results->fetch_assoc();
    mysqli_autocommit($conn, false);
    $sub_sql = "UPDATE dwekesa1.Sub SET substatus = 0 WHERE substatus = 1 AND customer_id = " . $customer_id;
    if(mysqli_query($conn, $sub_sql) === TRUE) {
        $sub_sql = "INSERT INTO dwekesa1.Sub (active, substatus, auto_renewal, customer_id, sub_tier_id) VALUES (\"" .
        date("Y-m-d") . "\", 1, 1, " . $customer_id . ", " . $stier_info['stier_id'] . ")";
        if(mysqli_query($conn, $sub_sql) === TRUE) {
            $sub_id = mysqli_insert_id($conn);
            if(!mysqli_commit($conn)) {
                return -1;
            } else {
                return $sub_id;
            }
        } else {
            return -1;
        }
    } else {
        return -1;
    }
}
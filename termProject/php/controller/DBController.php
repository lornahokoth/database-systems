<?php

function dbconnect() {
    $servername = "localhost";
    $username = "dwekesa1";
    $password = "dwekesa1";
    $conn = new mysqli($servername, $username, $password);

    if($conn->connect_error) {
        return false;
    } else {
        return $conn;
    }
}

function closedb($conn) {
    mysqli_close($conn);
}
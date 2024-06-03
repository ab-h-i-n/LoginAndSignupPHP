<?php

require ("../connect/connect.php");

if (isset($_GET['submit'])) {
    $email = $_GET['email'];
    $password = $_GET['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

    $result = $dbcon->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        setcookie("id", $row['id'], time() + (86400 * 30), "/");
        header("Location: ../home.php");
        
        exit();
    } else {
        echo "0 results";
    }
}
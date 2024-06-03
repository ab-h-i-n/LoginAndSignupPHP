<?php

require ("./connect/connect.php");

session_start();

if (isset($_COOKIE['id'])) {

    $id = $_COOKIE['id'];
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = $dbcon->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['name'];
        $_SESSION['email'] = $row['email'];
    } else {
        header("Location: ../index.php");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}


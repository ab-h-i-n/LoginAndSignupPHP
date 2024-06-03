<?php
require ("../connect/connect.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($dbcon->query($sql) === TRUE) {
        echo "<script> 
                  window.localStorage.setItem('isSignedUp', 'true'); 
                  window.location.href = '../index.php';
              </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $dbcon->error;
    }
}
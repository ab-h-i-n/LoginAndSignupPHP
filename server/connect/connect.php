<?php

$dbcon = mysqli_connect("localhost", "root", "", "mydb");

if ($dbcon->connect_error) {
    echo json_encode(['status' => 500, 'message' => 'Database connection failed']);
    die();
}

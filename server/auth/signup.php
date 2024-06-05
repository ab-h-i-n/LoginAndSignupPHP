<?php

require ("../connect/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $request = file_get_contents('php://input');
    $body = json_decode($request, true);

    $name = $body['name'];
    $email = $body['email'];
    $password = $body['password'];

    $checkUserExsit = "SELECT * FROM users WHERE email = '$email'";

    $result = $dbcon->query($checkUserExsit);

    if ($result->num_rows > 0) {
        echo json_encode(['status' => 404, 'message' => 'Email already registered']);
        exit();
    }

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($dbcon->query($sql) === TRUE) {
        echo json_encode(['status' => 200, 'message' => 'User created']);
    } else {
        echo json_encode(['status' => 404, 'message' => 'User creation failed']);
    }

} else {
    echo json_encode(['status' => 500, 'message' => 'Invalid request method']);
}

$dbcon->close();
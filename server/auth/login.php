<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require ("../connect/connect.php");

    $request = file_get_contents('php://input');
    $body = json_decode($request, true);

    $email = $body['email'];
    $password = $body['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

    $result = $dbcon->query($sql);

    if ($result->num_rows > 0) {

        $allData = mysqli_fetch_assoc($result);

        echo json_encode(['status' => 200, 'message' => 'User found', 'data' => ['id' => $allData['id']]]);
    } else {
        echo json_encode(['status' => 404, 'message' => 'User not found']);
    }

    $dbcon->close();

} else {
    echo json_encode(['status' => 500, 'message' => 'Invalid request method']);
}


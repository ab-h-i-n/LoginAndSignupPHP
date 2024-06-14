<?php

require ("../connect/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $request = file_get_contents('php://input');
    $body = json_decode($request, true);

    $id = $body['user_id'];
    $descritpion = $body['desc'];

    $sql = "INSERT INTO `tasks`(`user_id`, `description`, `status`) VALUES ($id,'$descritpion',0)";

    if ($dbcon->query($sql) === TRUE) {
        echo json_encode(['status' => 200, 'message' => 'Task added successfully']);
    } else {
        echo json_encode(['status' => 500, 'message' => 'Failed to add task']);
    }

} else {
    echo json_encode(['status' => 500, 'message' => 'Invalid request method']);
}
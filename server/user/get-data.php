<?php

require ("../connect/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $headers = getallheaders();

    $id = $headers['Authorization'] ? $headers['Authorization'] : null;

    if ($id) {
        $request = file_get_contents('php://input');
        $body = json_decode($request, true);

        $sql = "SELECT * FROM users WHERE id = $id";

        $result = $dbcon->query($sql);

        if ($result->num_rows > 0) {

            $allData = mysqli_fetch_assoc($result);
            $data = [
                'name' => $allData['name'],
                'email' => $allData['email']
            ];

            echo json_encode(['status' => 200, 'message' => 'User found', 'data' => $data]);
        } else {
            echo json_encode(['status' => 404, 'message' => 'User not found']);
        }
    } else {
        echo json_encode(['status' => 404, 'message' => 'Authorization header not found']);
    }

} else {
    echo json_encode(['status' => 500, 'message' => 'Invalid request method']);
}



$dbcon->close();
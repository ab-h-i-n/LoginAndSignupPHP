<?php
require ("../connect/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $headers = getallheaders();

    $id = $headers['Authorization'] ? $headers['Authorization'] : null;

    if ($id) {
        $request = file_get_contents('php://input');
        $body = json_decode($request, true);

        $sql = "SELECT * FROM tasks WHERE user_id = $id";

        $result = $dbcon->query($sql);

        if ($result->num_rows > 0) {

            $data = [];

            while ($allData = mysqli_fetch_assoc($result)) {
                $data[] = [
                    'id'=> $allData['task_id'],
                    'title' => $allData['title'],
                    'description' => $allData['description'],
                    'status' => $allData['status'],
                ];
            }


            echo json_encode(['status' => 200, 'message' => 'Tasks found', 'data' => $data]);
        } else {
            echo json_encode(['status' => 404, 'message' => 'Tasks not found']);
        }
    } else {
        echo json_encode(['status' => 404, 'message' => 'Authorization header not found']);
    }

} else {
    echo json_encode(['status' => 500, 'message' => 'Invalid request method']);
}



$dbcon->close();
<?php

header("Access-Control-Allow-Origin: *");
ini_set("display_errors", 1);
header("Access-Control-Allow-Methods: GET");

require_once("../config/database.php");
require_once("../classes/student.php");

$db = new Database();
$con = $db->connect();
$student = new Student($con);

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $data = $student -> get_data();
    if ($data -> num_rows) {
        $students['records'] = [];
        while($row = $data -> fetch_assoc()) {
            // echo "<pre>";
            //     print_r($row);
            // echo "</pre>";
            array_push($students['records'], [
                "id" => $row['id'],
                "name" => $row['name'],
                "email" => $row['email'],
                "mobile" => $row['mobile'],
                "status" => $row['status'],
                "created_at" => date("y-m-d", strtotime($row['created_at']))
            ]);
        }
        http_response_code(200);
        echo json_encode([
            "status" => 1,
            "message" => $students['records']
        ]);
    }
} else {
    http_response_code(503);
    echo json_encode([
        "status" => 0,
        "message" => "Accses Denied"
    ]);
}

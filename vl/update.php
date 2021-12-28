<?php

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset: UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once("../config/database.php");
require_once("../classes/student.php");

$db = new Database();
$con = $db -> connect();
$student = new Student($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $data = json_decode(file_get_contents("php://input"));
    if (!empty($data->name) && !empty($data->mobile) && !empty($data->email) && !empty($data->id)) {
        $student->name = $data->name;
        $student->email = $data->email;
        $student->mobile = $data->mobile;
        $student->id = $data->id;
        if ($student -> update_student()) {
            http_response_code(200);
            echo json_encode([
                "status" => 0,
                "message" => "Updated"
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                "status" => 0,
                "message" => "Faild to update data"
            ]);
        }
    }
} else {
    http_response_code(503);
    echo json_encode([
        "status" => 0,
        "message" => "Accsess denied"
    ]);
}
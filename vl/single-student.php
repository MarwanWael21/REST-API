<?php
// ini_set("display_errors", 1);
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset: UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once("../config/database.php");
require_once("../classes/student.php");

$db = new Database();
$con = $db->connect();
$student = new Student($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $params = json_decode(file_get_contents("php://input"));
    if(!empty($params -> id)) {
        $student -> id = $params -> id;
        $student_data = $student -> get_student();
        if (!empty($student_data)) {
            http_response_code(200);
            echo json_encode([
                "status" => 1,
                "data" => $student_data
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                "status" => 0,
                "data" => "Can't Found"
            ]);
        }
    }
} else {
    http_response_code(503);
    echo json_encode([
        "status" => 0,
        "message" => "Accsess Denied"
    ]);
}

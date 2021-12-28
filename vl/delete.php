<?php
// ini_set("display_errors", 1);
header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Methods: GET");

require_once("../config/database.php");
require_once("../classes/student.php");

$db = new Database();
$con = $db->connect();
$student = new Student($con);

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $student_id = isset($_GET['id']) ? intval($_GET['id']) : null;
    if (!empty($student_id)) {
        $student -> id = $student_id;
        if ($student -> delete_student()) {
            http_response_code(404);
            echo json_encode([
                "status" => 1,
                "message" => "Perfecto"
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                "status" => 0,
                "message" => "Faild to delete"
            ]);
        }
    } else {
        http_response_code(404);
        echo json_encode([
            "status" => 0,
            "message" => "Data not found"
        ]);
    }
} else {
    http_response_code(503);
    echo json_encode([
        "status" => 0,
        "message" => "Accsess denied"
    ]);
}
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
    if (!empty($data->name) && !empty($data->mobile) && !empty($data->email)) {
    $student -> name = $data -> name;
    $student -> email = $data -> email;
    $student -> mobile = $data -> mobile;
    if($student -> create_data()) {
        http_response_code(200);
        echo json_encode([
            "status" => 1,
            "message" => "Student has been added"
        ]);
    } else {
            http_response_code(500);
            echo json_encode([
                "status" => 0,
                "message" => "Failed to insert data"
            ]);
    } 
    }
} else {
    http_response_code(504);
    echo json_encode([
        "status" => 0,
        "message" => "Accsess denied"
    ]);
}
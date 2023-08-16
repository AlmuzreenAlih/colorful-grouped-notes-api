<?php
// header('Access-Control-Allow-Origin: httpx://localhost:3456/login');
header('Access-Control-Allow-Origin: *');
header("Content-Type: text/plain");
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: *");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');
    header('Content-Length: 0');
    header('Content-Type: text/plain');
    die();
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
header("Content-type:application/json");

include('../connection/config.php');
session_start();

$data = json_decode(file_get_contents("php://input"));
$id = $data->id;
$title = $data->title;
$backgroundColor = $data->backgroundColor;
$content = $data->content;

VarDump($content);

?>
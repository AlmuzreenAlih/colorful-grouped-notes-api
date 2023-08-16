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
$token = trim($data->token);
VarDump($token);

if ($token == "") {
    echo "false";
}
else {
    $stmt = $conn->prepare("SELECT * FROM sessions_table WHERE token=?");
    $stmt->execute([$token]);

    if ($stmt->rowCount() === 1) {
        $_SESSION['logged_id'] = 1;
        echo "true";
    }
    else {
        echo "false";
//         ob_start();
// $stmt->debugDumpParams();
//         echo $stmt->rowCount().ob_get_clean().$stmt->inputParams;
    }
}
// if cookieSet then session
// if (1) {
	
// 	$email = "admin@gmail.com";
// 	$password = "admin";

//     $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
//     $stmt->execute([$email]);

//     if ($stmt->rowCount() === 1) {
//         $user = $stmt->fetch();     

//         if ($email === $user['email']) {
//             if (password_verify($password, $user['password'])) {
//                 echo "true";

//             }else {
//                 echo "false";
//             }
//         }else {
//             echo "false";
//             // header("Location: login.php?error=Incorect User name or password&email=$email");
//         }
//     }else {
//         echo "false";
//     }
// }
// ?>
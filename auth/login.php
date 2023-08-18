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
// echo "true";
session_start();

$data = json_decode(file_get_contents("php://input"));
$email = $data->email;
$password = $data->password;

function generate_token($length) {
    return bin2hex(random_bytes($length/2));
  }
  
if (isset($email) && isset($password)) {
    $stmt = $conn->prepare("SELECT * FROM users 
                            WHERE email=?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch();     

        if ($email === $user['email']) {
            if (password_verify($password, $user['password'])) {
                $Token = generate_token(30);
                $insert_stmt = $conn->prepare("INSERT INTO sessions_table (user_id,token,expiration) VALUES(?,?,?)");
                $insert_stmt->execute([$user['id'], $Token,30]);
                // $myfile = fopen("varDump.txt", "w") or die("Unable to open file!");
                // fwrite($myfile, $_COOKIE['token']);
                // fclose($myfile);
                echo $Token;
            }else {
                echo "false";
            }
        }else {
            echo "false";
            // header("Location: login.php?error=Incorect User name or password&email=$email");
        }
    }else {
        echo "false";
    }
}
else {

}
?>
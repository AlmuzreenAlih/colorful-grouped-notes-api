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
$token = $data              -> token;
$id = $data                 -> id;
$title = $data              -> title;
$backgroundColor = $data    -> backgroundColor;
$content = $data            -> content;

VarDump($content." ".$token."haha");

function validateTokenAndGetUserId($conn, $token) {
    $stmt = $conn->prepare("SELECT user_id FROM sessions_table WHERE token = ? AND (NOW() - INTERVAL 30 DAY) < created_at");
    $stmt->execute([$token]);

    $outputRow = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($outputRow !== false && count($outputRow) > 0) {
        return $outputRow['user_id'];
    } else {
        return false; // Use null instead of none
    }
}

function checkUserOwnership($conn,$noteId, $userId) {
    $stmt = $conn->prepare("SELECT * FROM notes_table WHERE id = ?");
    $stmt->execute([$noteId]);
    $outputRow = $stmt->fetch(PDO::FETCH_ASSOC);
    VarDump("Row:".print_r($outputRow, true));
    if ($outputRow !== false && $outputRow['user_id'] == $userId) {
        return true;
    } else {
        return false; // Use null instead of none
    }
}

// Verify token and retrieve user_id
$validToken = validateTokenAndGetUserId($conn,$token); // Implement your token validation function

if ($validToken) {
    // Check if the user has permission to update the note
    $userOwnsNote = checkUserOwnership($conn,$id, $validToken); // Implement your user ownership check function
    if ($userOwnsNote) {
        // Update the note in the database
        $stmt = $conn->prepare("UPDATE notes_table 
                                SET title = ?, backgroundColor = ?, content = ? 
                                WHERE id = ?");
        $stmt->bindValue(1, $title, PDO::PARAM_STR);
        $stmt->bindValue(2, $backgroundColor, PDO::PARAM_STR);
        $stmt->bindValue(3, $content, PDO::PARAM_STR);
        $stmt->bindValue(4, $id, PDO::PARAM_INT);
        $stmt->execute();
        // Return a success response
        echo "true";
    } else {
        // Return an error response for unauthorized access
        // http_response_code(403); // Forbidden
        // echo json_encode(["error" => "Unauthorized access"]);
        echo "false1";
    }
} else {
    // Return an error response for invalid token
    // http_response_code(401); // Unauthorized
    // echo json_encode(["error" => "Invalid token"]);
    echo "token Unautorized"; //Should have log out probably
}

VarDump("----------------------------------------------------------------------------------------------------------");
?>
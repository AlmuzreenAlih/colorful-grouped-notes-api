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
$_SESSION['logged_id'] = 1;
if ($_SESSION['logged_id'] == 1) {
    $stmt = $conn->prepare("SELECT * FROM notes_table WHERE user_id=?");
    $stmt->execute([$_SESSION['logged_id']]);

    $notes = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $note = array(
            'id' => $row['id'],
            'group' => $row['note_group'],
            'title' => $row['title'],
            'backgroundColor' => $row['backgroundColor'],
            'content' => $row['content']
        );
        array_push($notes, $note);
    }
    $notes_json = json_encode($notes);

    $stmt = $conn->prepare("SELECT * FROM groups_table WHERE user_id=?");
    $stmt->execute([$_SESSION['logged_id']]);

    $groups = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $group = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'backgroundColor' => $row['backgroundColor']
        );
        array_push($groups, $group);
    }    
    $groups_json = json_encode($groups);

    $All = array();
    array_push($All, array('groups' => $groups, 'notes'=> $notes));
    $All_json = json_encode($All);
    echo $All_json;
}
else {
    echo "not set";
    echo $_SESSION['logged_id'];
}
?>
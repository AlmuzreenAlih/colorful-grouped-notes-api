<?php
// header('Access-Control-Allow-Origin: httpx://localhost:3456/login');
header('Access-Control-Allow-Origin: *');
header("Content-Type: text/plain");

include('../connection/config.php');
if (1) {
	
	$email = "admin@gmail.com";
	$password = "admin";

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch();     

        // $user_id = $user['id'];
        // $user_email = $user['email'];
        // $user_password = $user['password'];
        // $user_full_name = $user['full_name'];

        if ($email === $user['email']) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['logged_id'] = $user['id'];
                $_SESSION['logged_email'] = $user['email'];
                $_SESSION['logged_full_name'] = $user['full_name'];
                
                $myObj = new StdClass;
                $myObj->id = $user['id'];
                $myObj->email = $user['email'];
                $myObj->full_name = $user['full_name'];
                
                $myJSON = json_encode($myObj);
                echo $myJSON;

            }else {
                echo password_hash("admin", PASSWORD_DEFAULT);
                // header("Location: login.php?error=Incorect User name or password&email=$email");
            }
        }else {
            echo "what1";
            // header("Location: login.php?error=Incorect User name or password&email=$email");
        }
    }else {
        echo "false";
    }
}
?>
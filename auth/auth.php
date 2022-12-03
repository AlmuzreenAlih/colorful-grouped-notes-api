<?php
// header('Access-Control-Allow-Origin: httpx://localhost:3456/login');
header('Access-Control-Allow-Origin: *');
header("Content-Type: text/plain");

include('../connection/config.php');

if (isset($_SESSION['logged_in'])) {
    
}

if ($_SESSION['logged_in'] = "true") {
    echo "true";
}
else {
    echo "false";
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
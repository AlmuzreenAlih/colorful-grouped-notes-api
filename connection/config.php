<?php 

$sName = "localhost";
$uName = "root";
$pass = "handlepc12";
$db_name = "cgnotesdatabase";

try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", 
                    $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed : ". $e->getMessage();
}

function VarDump($token) {
  $current_time = time();
  // file_put_contents('file.txt', $text, FILE_APPEND);
  
  $myfile = fopen("../connection/varDump.txt", "a") or die("Unable to open file!");
  fwrite($myfile, date('g:i  A', $current_time)." - ".$token.PHP_EOL);
  fclose($myfile);
}

?>

<?php

// // Database configuration
// define('DB_HOST', 'localhost');
// define('DB_USERNAME', 'username');
// define('DB_PASSWORD', 'password');
// define('DB_NAME', 'database_name');

// // Application configuration
// define('APP_NAME', 'My App');
// define('APP_URL', 'https://my-app.com');

// // Email configuration
// define('EMAIL_FROM', 'noreply@my-app.com');
// define('EMAIL_FROM_NAME', 'My App');
// define('EMAIL_SMTP_HOST', 'smtp.mailgun.org');
// define('EMAIL_SMTP_USERNAME', 'username');
// define('EMAIL_SMTP_PASSWORD', 'password');

// // Other settings
// define('DEBUG', true);
// define('MAX_FILE_UPLOAD_SIZE', 5000000); // 5 MB

// <?php

// // Include the config file
// include 'config.php';

// // Connect to the database
// $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// // Send an email using the email settings defined in the config file
// mail('recipient@example.com', 'Subject', 'Message', "From: " . EMAIL_FROM . "\r\n");

// // Check the debug setting
// if (DEBUG) {
//   // Do something in debug mode
// }

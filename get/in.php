<?php

session_start();

$_SESSION['logged_id'] = 1;
echo $_SESSION['logged_id'];

?>
<?php 
session_start();
$_SESSION['loggedin'] = "";
$_SESSION['session_username'] = "";
$_SESSION['session_role'] = "";
session_destroy();

header("location:index.php");
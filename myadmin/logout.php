<?php
session_start();
ob_start();

unset($_SESSION["admin_logged_in"]);
session_destroy();
header("location: index.php");

ob_flush();
?>
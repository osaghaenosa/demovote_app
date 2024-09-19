<?php
ob_start();
session_start();
unset($_SESSION["myemail"]);
unset($_SESSION["mypassword"]);
unset($_SESSION["firstname"]);
unset($_SESSION["surname"]);
unset($_SESSION["id"]);
unset($_SESSION["phone"]);
unset($_SESSION["vote_life"]);
unset($_SESSION["gender"]);
session_destroy();
echo "success";
header("location: index.php");
$_SESSION["ttr"]=1;
ob_flush();
?>
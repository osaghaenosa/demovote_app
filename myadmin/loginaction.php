<?php
ob_start();
session_start();



//header("location: account.php");

/*
// To set the cookie so that the user can only login through
//thesame device

if(!isset($_COOKIE["myname"]) && $_COOKIE["myname"]!=$_POST["uname"]){
$_SESSION["nologin"]="You cannot login with this device";
header("location: login.php");

}
else{
$_SESSION["nologin"]="";
}
*/




if(isset($_POST["email"])){
if(isset($_POST["passcode"]) && isset($_POST["email"])){
	if($_POST["passcode"]=="" || $_POST["email"]==""){
		$_SESSION["aderrl"]="Please Input Something";
		
		
		
		//header("location: top_popup.php");
		header("location: login.php");
		$_SESSION["aderrl"]="";
			
			 
	}

else{

if($_POST["email"]=="1234"&& $_POST["passcode"]=="1234" ){
	
         header("location: index.php");
         $_SESSION["admin_logged_in"]="true";
}

	else{
		$_SESSION["aderrl"]="Invalid Account Info"; 
		//header("location: top_popup.php");
	header("location: login.php");
	}
    



}
}
}

ob_flush();
?>

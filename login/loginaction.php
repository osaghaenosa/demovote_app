<?php
ob_start();
session_start();


$_SESSION["homelink"]="login";

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
		$_SESSION["errl"]="Please Input Something";
		
		
		
		//header("location: top_popup.php");
		header("location: index.php");
		
	}

else{

$db=fopen("../db/db.db", "a+");
$in=0;
$line=[];
$lpos=0;
while (!feof($db)) {
	$in++;
	$line[]=fgets($db);
	
	
	
	//$idpos=strpos($line[$in],"nosa,1234");
	
}



for ($i=0; $i < $in; $i++) { 
$linedata=explode(",", $line[$i]);
$linedataee=explode(",", $line[$i]);
$linedatarefer=explode(",", $line[$i]);
for ($j=0; $j <= 10; $j++) { 
	if($linedata[$j]==$_POST["email"]&& $linedataee[$j+1]==$_POST["passcode"] ){

		//echo " ".$linedata[$j+2];
		$_SESSION["myemail"]=$linedata[$j];
		$_SESSION["mypassword"]=$linedata[$j+1];
		$_SESSION["firstname"]=$linedata[0];
        $_SESSION["surname"]=$linedata[1];
        $_SESSION["phone"]=$linedata[4];
        $_SESSION["gender"]=$linedata[5];
        $_SESSION["state"]=$linedata[6];
        $_SESSION["id"]=$linedata[7];
        $_SESSION["vote_life"]=$linedata[8];
        $_SESSION["verify_request"]=$linedata[9];
		#working
		//echo "  ".$_SESSION["myaccstate"];
		
		$_SESSION["lnumber"]=$j;
		$_SESSION["cnumber"]=$i;
		#working
		//echo $i;
			$_SESSION["errl"]="";
			
			 $_SESSION["login_success"]="ss";
         header("location: ../account.php");
         $_SESSION["logged_in"]="true";
		
	}
}
$linedata=explode(",", $line[$_SESSION["cnumber"]]);
	//echo($linedata[0]);
	//echo " ".$i;
	/*if($linedata[$i]=="nosa"){
		echo($linedata[$i]);
	}*/
	}
	if($linedata[3]!=$_POST["passcode"]){
		$_SESSION["errl"]="Invalid Account Info"; 
		//header("location: top_popup.php");
	header("location: ../login/index.php");
	}
    else{
          $_SESSION["upgrade"]=$linedata[4];
         if(isset($_SESSION["referinfo"])){
         fwrite($db,"\n".$_SESSION["referinfo"]);
          $_SESSION["referinfo"]="";
         $_SESSION["uname"]=$_POST["uname"];
$_SESSION["passw"]=$_POST["passw"];
          header("location: ../account.php");
         }
    }



fclose($db);

}
}
}

ob_flush();
?>

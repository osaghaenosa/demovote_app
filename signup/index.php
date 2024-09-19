<?php

session_start();
ob_start();
$_SESSION["errl"]="";
/*if(isset($_SESSION["login_success"])){
	header("location: index.php");
}
*/

if(isset($_SESSION["logged_in"])){
    if($_SESSION["logged_in"]!=""){
        header("location:../account.php");
    }
}
include("../widgets/alert.widget");
if(isset($_SESSION["firstname"]) && isset($_SESSION["surname"]) && isset($_SESSION["passcode"])){
$firstname=$_POST["firstname"];
$surname=$_POST["surname"];
$email=$_POST["email"];
$password=$_POST["passcode"];
}

if(isset($_POST["firstname"]) ||isset($_POST["surname"]) ||isset($_POST["passcode"]) ||isset($_POST["email"])){
    
if($_POST["email"]==""||$_POST["passcode"]==""||$_POST["firstname"]==""||$_POST["surname"]==""){
	
$evalue="Please input something";
showAlert($evalue);
}

else{
	if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false){
		$evalue="Email Not valid!";
		showAlert($evalue);
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


if(isset($in)){
for ($i=0; $i < $in; $i++) { 
$linedata=explode(",", $line[$i]);

for ($j=0; $j <= 7; $j++) { 
	if(isset($linedata[$j]))
	if($linedata[$j]==$_POST["email"]){

		//echo " ".$linedata[$j+2];
		#working
		//echo "  ".$_SESSION["myaccstate"];
    $_SESSION["firstname"]=$linedata[0];
    
         
		
		$_SESSION["luu"]=$j;
		$_SESSION["cuu"]=$i;
		#working
		//echo $i;
			

         
		
	}

}

if(isset($_SESSION["cuu"])){
$linedata=explode(",", $line[$_SESSION["cuu"]]);}
	//echo($linedata[0]);
	//echo " ".$i;
	/*if($linedata[$i]=="nosa"){
		echo($linedata[$i]);
	}*/

	}
}


if(isset($_SESSION["cuu"])){
$linedata=explode(",", $line[$_SESSION["cuu"]]);}

if($linedata[2]==$_POST["email"]){

$evalue="This Email [$linedata[2]] has been used ";
showAlert($evalue);
}
else{

	if(1){

if($linedata[$j]!=$_POST["email"]){
for ($i=0; $i < $in; $i++) { 
$linedatarefer=explode(",", $line[$i]);
for ($j=0; $j <= 8; $j++) { 
	if($linedatarefer[0]==$_SESSION["refid"]){
      $_SESSION["ai"]=$i;
}
}
$linedatarefera=explode(",", $line[$_SESSION["ai"]]);
}

        $infos=$_POST["firstname"].",".$_POST["surname"].",".$_POST["email"].",".$_POST["passcode"].",,, civilian,".time().",0,request_nochange";
        fwrite($db,"\n".$infos);
        mkdir("../users/".time());
        mkdir("../users/".time()."/images");

        //$image_location="../users/".time()."/images/avatar.jpg";
        fopen("../users/".time()."/images/avatar.jpg","w");
        copy("../images/1622396557731.png", "../users/".time()."/images/avatar.jpg");
         
        $hos=fopen("../users/".time()."/notiitem.txt","w");
        $hoi=fopen("../users/".time()."/noti_new.txt","w");
        $hloc=fopen("../users/".time()."/location.loc","w");
		$my_noti_item="../users/".time()."/notiitem.txt";
		$my_noti="../users/".time()."/noti.txt";
		$my_noti_file=file_get_contents("$my_noti");

		$wmsg="<div class=\"msg_box\">
            <p>You Have Successfully Created an Account<br>Please Verify your account in other to participate in any event.</p>
                            
        </div>
        "; 
        file_put_contents("../users/".time()."/noti_new.txt", 1);
        fwrite($hos, $wmsg);

         $_SESSION["errl"]="Account Creation Success"; 
         showAlert($_SESSION["errl"]);


/*
//i'm not doing referral yet

$increase=$accounts++;
file_put_contents("account.txt",$increase);

         if($linedatarefera[0]==$_SESSION["refid"] && $linedatarefera[0]!=""){
             $linedata[4]=10;
              $linedatarefera[3]+=1;
             $linedatarefera[4]+=30;
              $arrtostring2=$_POST["uname"].",".$_POST["passw"].",".$_POST["email"].","."0,$linedata[4],$linedata[5],$linedata[6],$linedata[7]";
                
               $arrtostring3=implode(",",$linedatarefera);
               $_SESSION["referinfo"] =$arrtostring3;
              fwrite($db,"\n".$arrtostring2);
              //fwrite($db,"\n".$arrtostring3);
           }
         */

          header("location: ../login/index.php");
}
}
}
	
}
}
}



ob_flush();
?>


<!Doctype html>
<html>
<head>
<title>Create Your Account</title>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/icons.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="../images/logo_colored.png">

<script src="js/script.js">
</script>
</head>
<body>
<div class="contents">
<div class="login-form-box">
<h1>Create a Free Account</h1>
<div class="button-container">
	<a href="../login/index.php">
    <button>Login</button>
	</a>
</div>
<br>
<div class="button-container">
	<a href="../index.php">
    <button>Home</button>
	</a>
</div>

<br>
<div class="login-avatar_icon" id="login-avatar-fa-fas"></div>

<form method="post" action="#" class="ifr">

<div class="form-input">
	<div class="input-fa-fas">
		<div class="avatar_input_icon"></div>
		<input type="text"  placeholder="First Name" name="firstname">
	</div>

	<div class="input-fa-fas">
		<div class="avatar_input_icon"></div>
		<input type="text"  placeholder="Surname" name="surname">
	</div>

	<div class="input-fa-fas">
		<div class="email_input_icon"></div>
		<input type="text"  placeholder="E-Mail or Phone" name="email">
	</div>
	
	<div class="input-fa-fas">
		<div class="password_input_icon"></div>
		<input type="text"  placeholder="Password" name="passcode">
	</div>
</div>
</form>
<div class="cast-vote-container">
<a  onclick="verify()">
    <button class="login_t">Create Account <img class="loading_image" src="../images/loader/load.gif"></button>
</a>
</div>
<br>
<label class="form_decision_link">Already have an account?, <a href="../login/index.php">Login now</a>.</label>
<div class="hidden"></div>

</div>
</div>
<div class="foot">
<footer>Copyright© 2023 - Voting System<br><u>All Rights Reserved</u></footer>
</div>
</body>
<script type="text/javascript">
	var form_input=document.querySelectorAll(".form-input .input-fa-fas input");
	var form_input_box=document.querySelectorAll(".input-fa-fas");


	
		form_input[0].onfocus=function(){
			form_input_box[0].style.border="solid 2px rgb(0,112,224)";
			form_input_box[1].style.border="none";
			form_input_box[2].style.border="none";
			form_input_box[3].style.border="none";
		}
		
		form_input[1].onfocus=function(){
			form_input_box[1].style.border="solid 2px rgb(0,112,224)";
			form_input_box[0].style.border="none";
			form_input_box[2].style.border="none";
			form_input_box[3].style.border="none";
		}

		form_input[2].onfocus=function(){
			form_input_box[2].style.border="solid 2px rgb(0,112,224)";
			form_input_box[1].style.border="none";
			form_input_box[0].style.border="none";
			form_input_box[3].style.border="none";
		}

		form_input[3].onfocus=function(){
			form_input_box[3].style.border="solid 2px rgb(0,112,224)";
			form_input_box[1].style.border="none";
			form_input_box[2].style.border="none";
			form_input_box[0].style.border="none";
		}
	

	var form = document.querySelector(".ifr");
		var login_t= document.querySelector(".login_t");
		var loading_image=document.querySelector(".loading_image");
		var x=0,t=0;
		function verify(){
		    t=1;
		    login_t.disabled="true";
		    login_t.style.background="skyblue";
		    loading_image.style.display="block";
		    
		}
		setInterval(function(){
		    if(t==1){
		        x+=1;
		    }
		    if(x>=70){
		        form.submit();
		        
					        
					x=0;
		        t=0;
				
		        
		    }
		},10);

</script>
</html>
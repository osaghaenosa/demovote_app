<?php
session_start();
ob_start();
include("../widgets/alert.widget");
if(isset($_SESSION["admin_logged_in"])){
    if($_SESSION["admin_logged_in"]!=""){
    header("location:index.php");
    }
}



if(isset($_SESSION["aderrl"])){
	if($_SESSION["aderrl"]!=""){
		showAlert($_SESSION["aderrl"]);
		$_SESSION["aderrl"]="";
	}
}

ob_flush();
?>
<!Doctype html>
<html>
<head>
<title>Login to your Account</title>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/icons.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="../images/logo_colored.png">


</head>
<body>
<div class="contents">
<div class="login-form-box">

<h1>Login To Your Admin Account</h1>


<br>
<div class="login-avatar_icon" id="login-avatar-fa-fas"></div>
<form method="post" action="loginaction.php" class="ifr">
	<p style="font-family: sans-serif;font-weight: bold; color: grey;font-size: 10px;text-align: center;"><?php if(isset($_SESSION["aderrl"])){echo $_SESSION["aderrl"];}  ?></p>
<div class="form-input">
	<div class="input-fa-fas">
		<div class="email_input_icon"></div>
		<input type="text"  placeholder="E-Mail or Phone" name="email">
	</div>
	
	<div class="input-fa-fas">
		<div class="password_input_icon"></div>
		<input type="password"  placeholder="Password" name="passcode">
	</div>
</div>
</form>
<div class="cast-vote-container">
<a onclick="verify()">
    <button class="login_t">Login <img class="loading_image" src="../images/loader/load.gif"></button>
    </a>
</div>
<br>

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
		}
		
		form_input[1].onfocus=function(){
			form_input_box[0].style.border="none";
			form_input_box[1].style.border="solid 2px rgb(0,112,224)";
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
		    if(x>=50){
		        form.submit();
		        x=0;
		        t=0;
		    }
		},10);
	
</script>
</html>
<?php
session_start();
ob_start();

$next=0;

if(!isset($_SESSION["logged_in"])){
    if($_SESSION["logged_in"]!=""){
        header("location:login/index.php");
    }
    header("location:login/index.php");
}
include("widgets/alert.widget");

if($_SESSION["vote_life"]!=1){
    $_SESSION["msgp"]=1;
    header("location: account.php");
    
}

ob_flush();
?>
<!DOCTYPE html>
<html>
<head>
<title>Cast A Vote</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/icons.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="images/logo_colored.png">


</head>
<body>
<div class="contents">
<div class="login-form-box" style="overflow: hidden;">

<h1>Cast A Vote</h1>


<br>
<div class="biometric_icon" id="login-avatar-fa-fas"></div>





<?php

if(isset($_REQUEST["pg"])){
        if($_REQUEST["pg"]!="" && $_REQUEST["pg"]!="Voting Programmes"){
            $next=1;
        }
        
        
        
    }
    else{
        $next=0;
    }


    
$voting_life=0;
    //reads the vote history csv of the user
//checks for the vote history file, if its not there, create new one
$v_filename_user="users/".$_SESSION["id"]."/votes/vote_history.csv";
if(!file_exists($v_filename_user)){
    mkdir("users/".$_SESSION["id"]."/votes/");
    fopen($v_filename_user,"w");

}
            $vote_history_user=file_get_contents("users/".$_SESSION["id"]."/votes/vote_history.csv");

    //convert to array
            $v_array=explode(",", $vote_history_user);
            $v_search=0;
            //check
            if(isset($_REQUEST["pg"])){
                //loop through the array
                for($v_c=0;$v_c<count($v_array);$v_c++){
                    //search for $_REQUEST["pg"] and if not found, then user can vote
                    if($v_array[$v_c]==$_REQUEST["pg"]){
                        $v_search=$v_c;
                        
                        
                    }
                    
                }
                if($v_array[$v_search]==$_REQUEST["pg"]){
                    $voting_life=1;
                }
                else{
                    $voting_life=0;
                }
            }
           


if(isset($_REQUEST["pg"])){
    $_SESSION["pg"]=$_REQUEST["pg"];
}

    if(isset($_GET["candidate"]) && isset($_GET["passcode"])){
        if($_GET["candidate"]!=""){

        if($_GET["passcode"] == $_SESSION["mypassword"]){
            
            
            $votes=fopen("candidates/votes/".$_SESSION["pg"]."/".$_GET["candidate"].".votes", "a+");
            $voters=fopen("candidates/votes/".$_SESSION["pg"]."/".$_GET["candidate"].".voters", "a+");

            //write on the voter and vote file
           $vn_file=file_get_contents("candidates/votes/".$_SESSION["pg"]."/".$_GET["candidate"].".voters");
            $v_file=file_get_contents("candidates/votes/".$_SESSION["pg"]."/".$_GET["candidate"].".votes");
            $increament=$v_file+1;

            file_put_contents("candidates/votes/".$_SESSION["pg"]."/".$_GET["candidate"].".votes", $increament);

            //$cdate=date("h:i");
            $date=date("h:i A",time())." - ".date("d/m/y");

            $votersname=$_SESSION["firstname"]." ".$_SESSION["surname"];
            $id=$_SESSION["id"];
            $image_location="users/".$id."/images/avatar.jpg";

            $profile="<hr>
             <a style='text-decoration:none' href='?id=$id' class=\"lessprofile\">
                <img src=\"$image_location\">
                <div class=\"name-c\">
                    <h2>$votersname</h2>
                    <b>$date</b>
                </div>
            </a>";
             
            file_put_contents("candidates/votes/".$_SESSION["pg"]."/".$_GET["candidate"].".voters", $profile.$vn_file);
            include("vote_success");

            $filew="db/db.db";
            
            /*$infob=$_SESSION["firstname"].",".$_SESSION["surname"].",".$_SESSION["myemail"].",".$_SESSION["mypassword"].",".$_SESSION["phone"].",".$_SESSION["gender"].",".$_SESSION["state"].",".$_SESSION["id"].",0";
            $infosup=$_SESSION["firstname"].",".$_SESSION["surname"].",".$_SESSION["myemail"].",".$_SESSION["mypassword"].",".$_SESSION["phone"].",".$_SESSION["gender"].",".$_SESSION["state"].",".$_SESSION["id"].",1";
            
            $infos= file_get_contents("db/db.db");
            $updated=str_replace($infob,"",$infos);

            file_put_contents($filew,$updated."\n".$infosup);*/

            //$_SESSION["vote_life"]=1;



            //reads the vote history csv of the user
            fopen("users/".$id."/votes/vote_history.csv","a+");
            $vote_history_user=file_get_contents("users/".$id."/votes/vote_history.csv");
            //write to the file
            if($vote_history_user!=""){
                file_put_contents("users/".$id."/votes/vote_history.csv",$vote_history_user.",".$_SESSION["pg"]);
            }
            else{
                file_put_contents("users/".$id."/votes/vote_history.csv",$_SESSION["pg"].",".$vote_history_user);
            }
            
            


    }
}
else{
showAlert("You didn't Pick any Candidate, please pick one");
include("vote_page.php");
}
    }
    else{
        if($voting_life==1){
            include("vote_success");
            include("user_vote_script.js");
        }
        else if($next==0){
            
            include("user_voting_program.php");

            
        }
        else if($next==1){
            include("vote_page.php");
            include("user_vote_script.js");
        }
    }

    


    ?>

<br>
<div class="cast-vote-container">

<?php
if(!isset($_GET["candidate"]) && !isset($_GET["passcode"])){
    if($voting_life!=1){
        if($next==0){
            echo "<a onclick=\"submit_next()\">
    <button id=\"p\" class=\"login_t\"> Next <big>&gt</big></button>
    </a>
    ";
        }
        if($next==1){
            echo "<a onclick=\"prev()\">
    <button id=\"p\" class=\"login_t\"><big>&#60</big> Previous</button>
    </a>
<a onclick=\"next()\">
    <button id=\"n\" class=\"login_t\">Next <big>&gt</big></button>
    </a>
    </a>";
        }
   
    }
    else{
        echo "<a href='index.php' onclick=\"done()\">
    <button id=\"d\" class=\"login_t\">Done</button>
    </a>";
    }
    
    }
    else {
echo "<a href='index.php' onclick=\"done()\">
    <button id=\"d\" class=\"login_t\">Done</button>
    </a>";
    }
    ?>
</div>
<br>
<label class="form_decision_link"> <a href="help/index.php">Need Help?</a></label>

</div>
</div>
<div class="foot">
<footer>Copyright© 2023 - Voting System<br><u>All Rights Reserved</u></footer>
</div>
</body>
<style>
.slide_1{
    transition:all 0.4s ease-out;
}
.slide_2{
    transition:all 0.4s ease-out;
}
.slide_3{
    transition:all 0.4s ease-out;
    display:block;
}
.form-input{
    width:240px;
}
</style>


</html>
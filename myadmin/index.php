<?php
session_start();
ob_start();

if(isset($_SESSION["admin_logged_in"])){
    if($_SESSION["admin_logged_in"]==""){
    header("location: login.php");
    }
}
else{
    header("location: login.php");
}

ob_flush();
?>
<!Doctype html>
<html>
<head>
<title>Administrator Page</title>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/icons.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="../images/logo_colored.png">


</head>
<body>
<div class="contents">
<div class="login-form-box" style="overflow: hidden;width: 80vw">

<h1>Admin Account</h1>
<br>


<div class="button-container">
    <a href="../index.php">
    <button>Home</button>
    </a>
</div>
<br>
<div class="button-container">
    <a href="?newpoll=true">
    <button>Create New Poll</button>
    </a>
</div>
<br>
<br>
<div class="button-container">
    <a href="logout.php">
    <button>Log Out</button>
    </a>
</div>

    <br>
    <div class="slide_1" style="display: flex;flex-direction: row; flex-wrap: wrap;align-items: flex-start;justify-content: center;position:relative;margin:10px 10px 10px 10px">
        <!--<center>
        <div class="account-avatar-fa-fas">
            <img src="../images/1622396557731.png">
        </div>
        </center> --><br>

       <div class="users_div">
        <div>
            <div class="account_div">
            <img src="../images/1622396557731.png">
            
            <h1>Users (<?php echo $_SESSION["user_num"]; ?>)</h1>
            <br>


        </div>
        <center>
            <input type="search" name="search_users" placeholder="search users by ID" class="default_textbox"><button class="small_button">Search</button>
            <br>
        </center>
        <br>
        <div class="users_container">
            
            <?php 
            include("user_info.php");
            ?>
            

            <?php
            if(isset($_REQUEST["new_message"])){
                include("new_message.php");
                file_put_contents("noti/".$_REQUEST["new_message"]."_noti.txt", "0");
            }
            if(isset($_REQUEST["newpoll"])){
                include("cpoll_popup.php");
            }

            if(isset($_REQUEST["cand_info"])){
                include("cand_info.php");
            }

            if(isset($_REQUEST["verify_user"])){
                include("verify_user.php");
            }
            
             ?>

            

        </div>
        </div>
       </div>

       <div class="users_div">
        <div>
            <div class="account_div">
            <div class="biometric_icon"></div>
            <h1>Polls Created</h1>


        </div>
        
        <?php include("poll_list.php"); ?>
        

            

        </div>
       </div>
        
    </div>





<br>

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
}
</style>


</html>
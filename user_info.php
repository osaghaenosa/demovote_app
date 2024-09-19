<?php
session_start();
ob_start();

$idb=$_GET["id"];
    $idf=$idb-1;
    $id=$idf+1;
    //read the user info file;
$file=fopen("db/db.db","r");
$line=[];
$line_number=0;
$name="0";
$state="0";

while(!feof($file)){
    $line[]=fgets($file);
    $line_number++;
}

for($i=0; $i < $line_number; $i++) { 
$linedata=explode(",", $line[$i]);

for ($j=0; $j <= 7; $j++) { 
    if(isset($linedata[$j])){
    	if($linedata[$j]==$id ){

    		//echo " ".$linedata[$j+2];
    		$firstname=$linedata[0];
    		$surname=$linedata[1];
    		$state=$linedata[$j-1];
    		$email=$linedata[2];
        $phone=$linedata[4];
        $gender=$linedata[5];
        $id=$id;
        $location="";
    		
        	}
        }
    }
	}
$image_location="users/".$id."/images/avatar.jpg";

ob_flush();
?>

<div style="z-index:1000000; position:fixed;left:0;top:0;width:100%;height:100%;overflow:scroll; background:rgba(0,0,0,0.3)">
<head>
<title>User - <?php echo $firstname." ".$surname; ?></title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/icons.css">
<meta name="viewport" content="width=device-width, initial-scale=1">



</head>
<div>
<div class="contents">
<div class="login-form-box" style="overflow: hidden;">

<h1>User</h1>
<br>

<div class="button-container">
    <a href="index.php">
    <button>Home</button>
    </a>
</div>
<br>

    <br>
    <div class="slide_1">
        <center>
        <div class="account-avatar-fa-fas">
            <img src="<?php echo $image_location; ?>">
        </div>

        <h1><?php echo $firstname." ".$surname; ?></h1>
        </center>

        <!--<div class="user_details">
        <div class="email_input_icon"></div>
        <a href="mailto:<?php echo $email; ?>"> <?php echo $email; ?> </a>
        </div>
        
        <div class="user_details">
        <div class="phone_icon"></div>
        <a href="#"> <?php echo $phone; ?> </a>
        </div> -->
        
        <div class="user_details">
        <div class="avatar_input_icon"></div>
        <a href="#"> <?php echo $gender; ?> </a>
        </div>
        
        <div class="user_details">
        <div class="avatar_input_icon"></div>
        <a href="#"> <?php echo $state; ?> </a>
        </div>
        
        <div class="user_details">
        <div class="location_icon"></div>
        <a href="#"> <?php echo $location; ?> </a>
        </div>
        
        <div class="user_details">
        <div class="avatar_input_icon"></div>
        <a href="#"> ID- <?php echo $id; ?> </a>
        </div>
        
        
        
    </div>



<br>
<small style="font-family: sans-serif;font-size: 10px">For security reasons, we would not display any personal info of this user.</small>



<br>

<br>
<label class="form_decision_link"> <a href="help/index.php">Need Help?</a></label>

</div>
</div>
<div class="foot">
<footer>Copyright© 2023 - Voting System<br><u>All Rights Reserved</u></footer>
</div>
</div>
<style>
.slide_1{
    transition:all 0.4s ease-out;
}

</style>
<script type="text/javascript">
    var slide_a=document.querySelector(".slide_1");

</script>

</div>
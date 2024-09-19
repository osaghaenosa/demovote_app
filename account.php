<?php
session_start();
ob_start();
$firstname=$_SESSION["firstname"];
$surname=$_SESSION["surname"];
$email=$_SESSION["myemail"];
$phone=$_SESSION["phone"];
$gender=$_SESSION["gender"];
$state=$_SESSION["state"];
$id=$_SESSION["id"];
$location_file="users/".$id."/location.loc";
$location="";

if(file_exists($location_file)){
    $location=file_get_contents("users/".$id."/location.loc");
}
else{
    fopen($location_file,"w");
    $location=file_get_contents("users/".$id."/location.loc");
}

$image_location="users/".$id."/images/avatar.jpg";
$verify="verified (Can vote)";

if(!isset($_SESSION["logged_in"])){
    header("location:login/index.php");
}

include("widgets/alert.widget");

if( isset($_POST["firstname"]) && isset($_POST["surname"]) ){
        $filew="db/db.db";
        //for the image upload section
        if(isset($_FILES["image"])){
            $image_filename=$_FILES["image"]["name"];
            $image_size=$_FILES["image"]["size"];
            $mimage_location=$_FILES["image"]["tmp_name"];

            if($image_size>20000000){
                echo "File size must not be more than 2mb";
                showAlert("File size must not be more than 2mb!");
            }
            else{
                $new_filename="users/".$id."/images/avatar.jpg";
                move_uploaded_file($mimage_location, $image_location);
            }
           
        }
        
    
        //admin is the only one that can verify the account.

        if(!empty($_POST["firstname"]) && !empty($_POST["surname"]) && !empty($_SESSION["myemail"]) && !empty($_POST["gender"]) && !empty($_POST["state"])){
            $infosup=$_POST["firstname"].",".$_POST["surname"].",".$_SESSION["myemail"].",".$_SESSION["mypassword"].",".$_POST["phone"].",".$_POST["gender"].",".$_POST["state"].",".$_SESSION["id"].",".$_SESSION["vote_life"].",request_change";

            //request for alert to the admin 
    if(is_file("myadmin/noti/".$_SESSION["id"]."_noti.txt")){
        $noti_p=file_get_contents("myadmin/noti/".$_SESSION["id"]."_noti.txt");
        file_put_contents("myadmin/noti/".$_SESSION["id"]."_noti.txt", "1");
    }
    else{
        fopen("myadmin/noti/".$_SESSION["id"]."_noti.txt", "w");
        file_put_contents("myadmin/noti/".$_SESSION["id"]."_noti.txt", "1");
    }

    //send message to admin
    $me_noti_file="users/".$_SESSION["id"]."/notiitem.txt";
    $msg="<div class=\"msg_box\">
            <p>Dear Admin <br> I want to request for a verification of my account.<br>Please Check my details to see if it is correct</p>
                            
        </div>
        ";
    if(file_exists($me_noti_file)){
        file_put_contents($me_noti_file, $msg);
    }

        }
        else{
            $infosup=$_POST["firstname"].",".$_POST["surname"].",".$_SESSION["myemail"].",".$_SESSION["mypassword"].",".$_POST["phone"].",".$_POST["gender"].",".$_POST["state"].",".$_SESSION["id"].",".$_SESSION["vote_life"].",".$_SESSION["verify_request"];
        }

        
        
        $infob=$_SESSION["firstname"].",".$_SESSION["surname"].",".$_SESSION["myemail"].",".$_SESSION["mypassword"].",".$phone.",".$gender.",".$state.",".$id.",".$_SESSION["vote_life"].",".$_SESSION["verify_request"];
        
        $infos= file_get_contents("db/db.db");
        $updated=str_replace($infob,"",$infos);

        file_put_contents($filew,$updated."\n".$infosup);

        $_SESSION["myemail"]=$email;
        $_SESSION["mypassword"]=$_SESSION["mypassword"];
        $_SESSION["firstname"]=$_POST["firstname"];
        $_SESSION["surname"]=$_POST["surname"];
        $_SESSION["phone"]=$_POST["phone"];
        $_SESSION["gender"]=$_POST["gender"];
        $_SESSION["state"]=$_POST["state"];
        $_SESSION["id"]=$_SESSION["id"];
        $_SESSION["vote_life"]=$_SESSION["vote_life"];
        $_SESSION["verify_request"]="request_change";
        //header("location:account.php");
        showAlert("Info has been successfilly updated!");

        file_put_contents($location_file,$_POST["location"]);
        
}

if(isset($_GET["logout"])){
    include("widgets/alert.widget");
}

if(isset($_SESSION["msgp"])){
    showAlert("You cannot Vote!!!<br>You have not verified your account yet");
    unset($_SESSION["msgp"]);
}

//user verify
$ver="";
if($_SESSION["vote_life"]==1){
    $ver="Verified";
}
else{
    $ver="Not Verified";
}


ob_flush();
?>
<!DOCTYPE html>
<html>
<head>
<title>My Account - <?php echo $_SESSION["firstname"]." ".$_SESSION["surname"]; ?></title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/icons.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="images/logo_colored.png">


</head>
<body>
<div class="contents">
<div class="login-form-box" style="overflow: hidden;">

<h1>My Account</h1>
<br>

<div class="" style="display:flex;flex-direction:row;width: 100%;">
    <a href="?noti=show">
    <div class="message_icon" style="background: grey; width: 30px; height: 30px;margin-left: 20px;margin-top: 50px"></div> <?php
    $noti_new="users/".$_SESSION["id"]."/noti_new.txt";
    if(!file_exists($noti_new)){
        $h_noti=fopen($noti_new,"w"); 
    } 
    else{
        $nf=file_get_contents($noti_new);
        if($nf==1){
            echo "<div class=\"sdot\" style=\"width: 10px; height: 10px;background: red;border-radius: 50%;border:solid 1px whitesmoke;position: relative;top: -30px;left: 50px\"></div>";
        }
        else{
            echo"";
        }
    }
    ?>
    
    </a>
</div>

<div class="button-container">
    <?php
     if($_SESSION["vote_life"]==1){
        echo "<a href=\"vote.php\">
    <button>Vote</button>
    </a>";
     }
     else{
        echo "<a >
    <button style='background-color:grey'>Cannot Vote</button>
    </a>";
     }
    ?>
    
</div>
<br>
<div class="button-container">
    <a href="index.php">
    <button>Home</button>
    </a>
</div>
<br>
<div class="button-container">
    <a href="logout.php">
    <button>Log Out</button>
    </a>
</div>
    <br>
    <div class="slide_1">
        <center>
        <div class="account-avatar-fa-fas">
            <img src="<?php echo $image_location; ?>" >
        </div>

        <h1><?php echo $firstname." ".$surname; ?></h1>
        </center>

        <div class="user_details">
        <div class="email_input_icon"></div>
        <a href="mailto:<?php echo $email; ?>"> <?php echo $email; ?> </a>
        </div>
        
        <div class="user_details">
        <div class="phone_icon"></div>
        <a href="#"> <?php echo $phone; ?> </a>
        </div>
        
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
        
        <div class="user_details">
        <div class="avatar_input_icon"></div>
        <a href="#"> • <?php echo $ver; ?> </a>
        </div>
        
    </div>


<div class="slide_2">
    <form class="save_info_form" method="post" action="account.php" enctype="multipart/form-data">
    <center>
    <div class="account-avatar-fa-fas">
            <img class="image_avatar" src="<?php echo $image_location; ?>">
        </div>
        <div class="button-container">
    <a>
    <button style="overflow:hidden">Change Image<input class="upload_image" type="file" accept="image/*" name="image" style="position: absolute;margin-left:-150px; opacity:0"></button>
    </a>
</div>
    </center>

        <div class="user_details">
        <div class="avatar_input_icon"></div>
        <a href="#"> <input type="text" value="<?php echo $firstname; ?>" name="firstname" placeholder="First Name"> </a>
        </div>

        <div class="user_details">
        <div class="avatar_input_icon"></div>
        <a href="#"> <input type="text" value="<?php echo $surname; ?>" name="surname" placeholder="Surname"> </a>
        </div>

        <div class="user_details">
        <div class="password_input_icon"></div>
        <a href="#"> <?php echo $email; ?> </a>
        </div>
        
        <div class="user_details">
        <div class="phone_icon"></div>
        <a href="#"> <input type="number" value="<?php echo $phone; ?>" name="phone" placeholder="Phone Number"> </a>
        </div>
        
        <div class="user_details">
        <div class="avatar_input_icon"></div>
        <a href="#"> <select name="gender" ><option <?php if($gender=="Male"){echo "selected=true";} ?>>Male</option><option <?php if($gender=="Female"){echo "selected=true";} ?>>Female</option></select> </a>
        </div>
        
        <div class="user_details">
        <div class="avatar_input_icon"></div>
        <a href="#"> <select name="state" value=<?php echo $state; ?>><option>None</option><option <?php if($state=="Civillian"){echo "selected=true";} ?> >Civillian</option><option <?php if($state=="Politician"){echo "selected=true";} ?>>Politician</option></select> </a>
        </div>
        
        <div class="user_details">
        <div class="location_icon"></div>
        <a href="#"> <?php echo "--"; ?>
        
        <select name="location" >
        <?php $s_country=file_get_contents("country/nigeria.country");
        $s_country_array=explode(",",$s_country);
        for($i=0;$i<count($s_country_array);$i++){
            $sel="";
            if($location==$s_country_array[$i]){
                $sel="selected=true";
            }
            $d_name="<option $sel >$s_country_array[$i]</option>";
            echo $d_name;
        }
        
         ?>
         </select>
        </a>
        </div>
        
        <div class="user_details">
        <div class="password_input_icon"></div>
        <a href="#"> ID- <?php echo $id; ?> </a>
        </div>
        
        <div class="user_details">
        <div class="password_input_icon"></div>
        <a href="#"> • <?php echo $verify; ?> </a>
        </div>
    </form>
    </div>


<?php
if(isset($_GET["noti"])){
    include("user_message.php");
}
?>


<br>
<div class="cast-vote-container">
    
    <a onclick="edit()">
        <button id="e" class="login_t">Edit  <big>&#9998</big></button>
    </a>
    <a onclick="save()">
        <button id="s" class="login_t">Save</button>
    </a>
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
}
</style>
<script type="text/javascript">
    var slide_a=document.querySelector(".slide_1");
    var slide_b=document.querySelector(".slide_2");
    
 var e=document.querySelector("#e");
 var s=document.querySelector("#s");
 var save_info_form=document.querySelector(".save_info_form");
 
    
    var slides=1;
    
    setInterval(function(){
    if(slides==1){
        slide_a.style.display="block";
        slide_b.style.display="none";
        
        s.style.display="none";
        e.style.display="block";
        
    }
    else if(slides==2){
        slide_b.style.display="block";
        slide_a.style.display="none";
        
        e.style.display="none";
        s.style.display="block";
        
    }
    else if(slides==3){
        
        slide_b.style.display="none";
        slide_a.style.display="none";
        
        
    }
    });

    //working on the image Uploading aspect
    var upload_image=document.querySelector(".upload_image");
    var image_avatar=document.querySelector(".image_avatar");

    upload_image.onchange=function(){
        var url=URL.createObjectURL(upload_image.files[0]);
        image_avatar.src=url;
        image_avatar.style.width="100px";
        image_avatar.style.height="initial";

    }
    
    function edit(){
        
        slides=2;
        
       // alert(slides);
    }
    function save(){
        save_info_form.submit();
    }

    
    
</script>

</html>
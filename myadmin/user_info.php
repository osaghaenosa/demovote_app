<?php


$id=0;

    //read the user info file;
$file=fopen("../db/db.db","a+");
$line=[];
$line_number=0;
$name="0";
$state="0";
$lx=0;
$location="";

while(!feof($file)){
    $line[]=fgets($file);
    $line_number++;
}


for($i=0; $i < $line_number; $i++) { 
$linedata=explode(",", $line[$i]);
if(isset($linedata[1])){
$lx++;
user_info($linedata[7],$linedata[0],$linedata[1],$linedata[4],$linedata[2],$linedata[6],$linedata[8],$linedata[5],$linedata[9]);
}


    }
    $_SESSION["user_num"]=$lx;

function user_info($id,$fname,$sname,$phone,$email,$state,$voted,$gender,$v_request){
    $st="";$ver_op="";
    $verified="";
    if($voted==1){
        $st="yes";
        $verified="Verified";
    }
    else{
        $st="no";
        $verified="Not verified";
        
    }
    if($st=="no"){
        $ver_op="<a href=\"?verify_user=$id\">
                        <button class=\"small_button\">Verify</button>
                        </a>";

        
    }
    //user location
    $u_loc="../users/".$id."/location.loc";
    if(is_file($u_loc)){
        $location=file_get_contents($u_loc);
    }
    else{
        $location="";
    }

    //red noti dot
    $noti_dot="";
    if(is_file("noti/".$id."_noti.txt")){
        $noti_p=file_get_contents("noti/".$id."_noti.txt");
        if($noti_p == "1"){
            $noti_dot="<div class=\"sdot\" style=\"width: 10px; height: 10px;background: red;border-radius: 50%;border:solid 1px whitesmoke;position: relative;top: -30px;left: 20px\"></div>";
        }
        
    }
    else{
        fopen("noti/".$id."_noti.txt", "w");
        file_put_contents("noti/".$id."_noti.txt", "0");
        $noti_dot="";
    }




    
    $image_location="../users/".$id."/images/avatar.jpg";

            $info="<div class=\"user\" id=\"a".$id."_info\">
                <div class=\"info\">
                    <div class=\"image\">
                        <img src=\"$image_location\">
                    </div>
                    <div class=\"user_name\">
                        <h2>$fname $sname</h2>
                        <p>$id</p>
                    </div>
                    <div class=\"action_buttons\">
                        <a href=\"?new_message=".$id."\"><div class=\"message_icon\" title=\"notification\" style=\"width: 30px; height:30px\"></div> $noti_dot</a>
                        <div class=\"delete_icon\" title=\"delete user\"></div>

                        
                    </div>
                    <div class=\"action_buttons\">
                        <div id=\"open_".$id."_info\" class=\"down_arrow_icon\" title=\"Open\"></div>
                        <div id=\"close_".$id."_info\" class=\"up_arrow_icon\" title=\"Close\" style=\"display: none;\"></div>
                    </div>
                </div>
                <div id='content".$id."s' class=\"content\" style=\"display: flex;flex-direction: column;align-items: flex-start;\">
                    <div class=\"user_details\">
                    <div class=\"email_input_icon\"></div>
                    <a href=\"mailto:$email\"> $email </a>
                    </div>
                    
                    <div class=\"user_details\">
                    <div class=\"phone_icon\"></div>
                    <a href=\"tel:$phone\">$phone </a>
                    </div>
                    
                    <div class=\"user_details\">
                    <div class=\"avatar_input_icon\"></div>
                    <a href=\"#\"> $gender </a>
                    </div>
                    
                    <div class=\"user_details\">
                    <div class=\"avatar_input_icon\"></div>
                    <a href=\"#\"> $state </a>
                    </div>
                    
                    <div class=\"user_details\">
                    <div class=\"location_icon\"></div>
                    <a href=\"#\"> $location</a>
                    </div>
                    
                    <div class=\"user_details\">
                    <div class=\"avatar_input_icon\"></div>
                    <a href=\"#\"> ID- $id </a>
                    </div>
                    <div class=\"user_details\">
                    <div class=\"biometric_icon\"></div>
                    <a > - $verified </a> 
                        $ver_op

                    

                    </div>

                    

                </div>
            </div>
            <script>
            var open_".$id."_info=document.querySelector(\"#open_".$id."_info\");
    var close_".$id."_info=document.querySelector(\"#close_".$id."_info\");
    var a".$id."_info=document.querySelector(\"#a".$id."_info\");
    var content".$id."s=document.querySelector(\"#content".$id."s\");
    content".$id."s.style.display=\"none\";

    open_".$id."_info.onclick=function(){
        a".$id."_info.style.height=\"400px\";
        close_".$id."_info.style.display=\"block\";
        open_".$id."_info.style.display=\"none\";
        content".$id."s.style.display=\"flex\";
        
    }
    close_".$id."_info.onclick=function(){
        a".$id."_info.style.height=\"50px\";
        close_".$id."_info.style.display=\"none\";
        open_".$id."_info.style.display=\"block\";
        content".$id."s.style.display=\"none\";
        
    }
    </script>
            ";
        echo $info;
}


?>
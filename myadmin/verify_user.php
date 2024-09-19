<?php
$uid=$_REQUEST["verify_user"];
$file=fopen("../db/db.db","a+");
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

    for($j=0; $j<=9; $j++){
        if(isset($linedata[$j])){
            if($linedata[$j]==$uid){
                $mfname=$linedata[0];
                $msname=$linedata[1];
                $email=$linedata[2];
                $password=$linedata[3];
                $phone=$linedata[4];
                $gender=$linedata[5];
                $state=$linedata[6];
                $id=$linedata[7];
                $vote_life=$linedata[8];
                $rchange=$linedata[9];
            }
        }

    }

    }
if(isset($_REQUEST["verify"])){
	$filew="../db/db.db";
	$infob=$mfname.",".$msname.",".$email.",".$password.",".$phone.",".$gender.",".$state.",".$id.",".$vote_life.",".$rchange;
	$infosup=$mfname.",".$msname.",".$email.",".$password.",".$phone.",".$gender.",".$state.",".$id.",1,".$rchange;
	$infos= file_get_contents($filew);

	$updated=str_replace($infob,"",$infos);

        file_put_contents($filew,$infosup."\n".$updated);
        header("location: ?verify_user=$uid&success");
}
?>
<div class="message_popup_bg">
    <div class="message_popup" style="height: 280px">
        <div class="close"><a class="x_button">x</a></div>
        <br>
        <br>
        
	    <?php
	    if(isset($_REQUEST["success"])){
	    	echo "<div class=\"slide2\" >
	    	<center><img src=\"../images/20230309_082919.png\" style=\"width: 100px;height: initial;border: none;\">
	        <h1>$mfname $msname's Account has been Successfully Verified</h1>
	        <br>
	        <a href=index.php><button  class=\"small_button\" style=\"width: 200px; padding-top: 20px; padding-bottom:30px;font-size: 16px\">Close</button></a>
	        </center>
	    </div>";
	    }
	    else{
	    	echo "<div class=\"slide1\">
        	<center>
	        <h1>Verify $mfname $msname's Account?</h1>
	        <br>
	        <a href=?verify_user=$uid&verify ><button  class=\"small_button\" style=\"width: 200px; padding-top: 20px; padding-bottom:30px;font-size: 16px\">Verify</button></a>
	        </center>
	    </div>";
	    }
	    ?>
	    
    </div>
</div>
<script>
	var close=document.querySelector(".close");
                var message_popup_bg=document.querySelector(".message_popup_bg");
close.onclick=function(){
                    message_popup_bg.style.display="none";
                }
</script>
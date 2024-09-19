<form class="vote_form" method="get" action="">
    <div class="slide_1">
        <br>
        <h1 style="font-size: 10px"><?php echo $_REQUEST["pg"]; ?></h1>
<h1>Choose A Candidate</h1>
<?php
function candidate_info($idf){
    $ida=$idf+1;
    $id=$ida-1;
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
            $name=$linedata[0]." ".$linedata[1];
            $state=$linedata[$j-1];
            
            }
        }
    }
    }
    
    $image_location="users/".$id."/images/avatar.jpg";
$vote_number= file_get_contents("candidates/votes/".$_REQUEST["pg"]."/".$id.".votes");
$candidate_color= file_get_contents("candidates/color/".$_REQUEST["pg"]."/".$id.".color");

$output="<hr>
    <a class=\"candidate_option\">
    
        <input type=\"radio\" name=\"candidate\" id=\"candidate$id\" value=$id >
      <label class=\"candidate-profile\" for=\"candidate$id\">
        <img src=\"$image_location\" style=\"border-color:$candidate_color\">
        <div class=\"name-c\">
            <h2>$name</h2>
            <b>Demo Candidate • $state</b>
            <b>$vote_number votes</b>
        </div>
     </label>
     <img class=\"party_logo\" src=\"images/c_logos/apc.png\">  
    </a>

    <br>";

echo $output;

}

$cand_poll_file=file_get_contents("candidates/".$_REQUEST["pg"].".l");
        $cand_poll_array=explode(",", $cand_poll_file);
        

        for ($cpol=0; $cpol<count($cand_poll_array); $cpol++) {
            
            candidate_info($cand_poll_array[$cpol]);
            
        }

?>


    
    
</div>


<div class="slide_2">
<h1>Confirm Your Password</h1>

    <hr>
    <br>
    <div class="form-input">
    <div class="input-fa-fas">
        <div class="password_input_icon"></div>
        <input class="ppw" type="password"  placeholder="Password" name="passcode">
    </div>
</div>
<br>
<p style="text-align:center; font-family:sans-serif;font-size:10px">Password is only used in the demo version, the live version would use biometric or fingerprint system</p>
</div>
</form>
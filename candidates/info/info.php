<div class="candidate-info">
<?php

$idb=$_GET["candidate_id"];
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
    		$name=$linedata[0]." ".$linedata[1];
    		$state=$linedata[$j-1];
    		
        	}
        }
    }
	}
	
$vote_number= file_get_contents("candidates/votes/".$_REQUEST["pg"]."/".$id.".votes");
$candidate_color= file_get_contents("candidates/color/".$_REQUEST["pg"]."/".$id.".color");

?>

<h2>Candidate Info<hr></h2>
<div class="s-details">
    <div class="profile" >
        <img style="border-color:<?php echo $candidate_color; ?>" src="images/1622396557731.png">
        <div class="name-c">
            <h2><?php echo $name; ?></h2>
            <b>Demo Candidate <small>•<?php echo $state; ?></small></b>
        </div>
     </div>
        <div class="info" style="border-color:<?php echo $candidate_color; ?>">
        <h2><big><?php echo $vote_number; ?> </big> Votes</h2>
        <br>
        <p>Votes Casted by</p><br>
        <?php 
        include("candidates/votes/voter_script.php");

        $voters_id_file=file_get_contents("candidates/votes/".$_REQUEST["pg"]."/".$id.".voters");
        if($voters_id_file != ""){
            echo $voters_id_file;
        }
        else{
            echo "<b style='font-weight:bold;font-family:Brinnan;fony-size:30px;color:grey'>No Voters Yet !!!</b>";
        }
            
            //show_voter($id);
            
        
        
        ?>
        
        
         
     
        </div>
        
</div>

</div>
</div>
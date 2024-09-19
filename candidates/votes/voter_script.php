<?php

ob_start();

function show_voter($idf){
	$ida=$idf-1;
	$id=$ida+1;
    //read the user info file;
$file=fopen("db/db.db","r");
$line=[];
$line_number=0;
$name="0";
$state="0";
$votersname="";
$votersstate="";

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
			$votersname=$linedata[0]." ".$linedata[1];
			
			$votersstate=$linedata[$j-1];
			
	    	}
	    }
	}
	}
	$date=date("h:m")." - ".date("d/i/y");

	$profile="<hr>
        <a style='text-decoration:none' href='?id=$id' class=\"lessprofile\">
            <img src=\"images/1622396557731.png\">
            <div class=\"name-c\">
                <h2>$votersname</h2>
                <b>$date</b>
            </div>
         </a>";
    echo $profile;
}

ob_flush();
?>
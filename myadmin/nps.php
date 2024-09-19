<?php

ob_start();
if(isset($_GET["poll_name"]) && !empty($_GET["poll_name"]) && !empty($_GET["r_users"]) && !empty($_GET["durationstart"]) && !empty($_GET["durationend"])){

	if(!is_file("../candidates/".$_GET["poll_name"].".l")){

		$poll_name=$_GET["poll_name"];

$users=$_GET["r_users"];

$start_date=$_GET["durationstart"];

$end_date=$_GET["durationend"];

echo "Poll Name: ".$poll_name."<br>Users: ".$users."<br>Start Date: ".$start_date."<br>End Date: ".$end_date."<br>___";



$poll_file_name="../candidates/".$poll_name.".l";

$poll_file_list="../candidates/poll_list.pl";

$poll_file_date="../candidates/dates/".$poll_name.".d";



$user_votes="../candidates/votes/";

$user_color="../candidates/color/";

fopen($poll_file_name,"w");

file_put_contents($poll_file_name, $users);



//poll list 

$plst=file_get_contents($poll_file_list);

file_put_contents($poll_file_list, $poll_name.",".$plst);



//dates start and end 

fopen($poll_file_date,"w");

file_put_contents($poll_file_date, $start_date.",".$end_date);



//the votes and voters file

//convert the users string to array

$cand_arr=explode(",", $users);

mkdir($user_votes."/".$poll_name);

mkdir($user_color."/".$poll_name);







for ($a=0; $a<count($cand_arr); $a++) {



	fopen($user_votes."/".$poll_name."/".$cand_arr[$a].".votes", "w");

	file_put_contents($user_votes."/".$poll_name."/".$cand_arr[$a].".votes", 0);

	fopen($user_votes."/".$poll_name."/".$cand_arr[$a].".voters", "w");

	//file_put_contents($user_votes."/".$poll_name."/".$cand_arr[$a].".voters", "");



	//for the candidate colors, it would be random

	fopen($user_color."/".$poll_name."/".$cand_arr[$a].".color", "w");

	file_put_contents($user_color."/".$poll_name."/".$cand_arr[$a].".color", "rgb(".random_int(0, 255).",".random_int(0, 255).",".random_int(0, 255).")");



//send a notification to the users

	 $noti_file="../users/".$cand_arr[$a]."/notiitem.txt";

if(!file_exists($noti_file)){

                            fopen($noti_file, "w");

                        }

$noti_new="../users/".$cand_arr[$a]."/noti_new.txt";

if(!file_exists($noti_new)){

	$hoi=fopen($noti_new,"w");	

}

$msg="<div class=\"msg_box\">

            <p>You have been selected to be among those Who will participate for the election of ".$poll_name.",<br> Good Luck in getting people to vote for you.<br><small><b>NOTE</b> This Election is ment to be free and fair, if any illegal processes is discovered, you can be forfeited or even banned from voting for life.</small></p>

                            

        </div>

        ";

        $msg_before=file_get_contents($noti_file);



        file_put_contents($noti_file, $msg."\r\n".$msg_before);

        file_put_contents($noti_new, 1);

header("location: index.php?newpoll=true&&successpoll");

}

echo "<br><br>Success...";







	}

	else{

		echo "The Poll Name Already Exists";

	}

	

}

else{

	echo "Please complete the details";

}


ob_flush();
?>
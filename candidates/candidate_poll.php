<?php



ob_start();



function candidate_poll($id,$height){

	

	$ca=file_get_contents('candidates/votes/'.$_REQUEST["pg"]."/".$id.'.votes');
	

	

	$votes=file_get_contents("candidates/votes/".$_REQUEST["pg"]."/"."$id.votes");

	$candidate_color= file_get_contents("candidates/color/".$_REQUEST["pg"]."/".$id.".color");
$pimg="users/$id/images/avatar.jpg";

	$pg=$_REQUEST["pg"];
		if(isset($_REQUEST["candidate_id"])){
			
			$profile="<a href=\"?candidate_id=$id&pg=$pg\" class=\"poll-content\" style=\"background: ".$candidate_color."; height:".$height."px;top:calc(300px - ".$height."px)\">

				<h3 class=\"count\"> ".$votes."</h3>

    			<img src=\"$pimg\">

    			<div class=\"others\">

        

    			</div>

			</a>";
		
		
		}
	

    echo $profile;


}



ob_flush();

?>
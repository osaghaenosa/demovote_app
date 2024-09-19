<?php
session_start();
ob_start();
if(!isset($_SESSION["start"])){
    include("widgets/tips.widget");
    showTips("Click on any candidate on the graph to see who voted for them");
    $_SESSION["start"]=0;
}
include("widgets/alert.widget");
if(isset($_SESSION["ttr"])){
    showAlert("You have successfully Logged out");
    unset($_SESSION["ttr"]);
}
ob_flush();
?>
<!Doctype html>
<html>
<head>
<title>Live Voting System</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/icons.css">
<link rel="stylesheet" href="css/poll-style.css">
<link rel="icon" type="image/png" href="images/logo_colored.png">

<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="js/poll-script.js">
</script>
</head>
<body>
<div class="contents">

<?php
if(isset($_SESSION["logged_in"])){
    if($_SESSION["logged_in"]!=""){
        include("widgets/avatar.widget");
    }
}

if(isset($_GET["id"])){
    include("user_info.php");
}

?>

<div class="voting-box">
<h1>Live Voting System</h1>
<div class="button-container">
    <a href="vote.php">
    <button>Cast Vote</button>
    </a>
</div>
<hr>
<hr>
<div class="center_div">
    <br>
    <br>
    
    <?php

    //session for splash screen
    
    ?>
    <form class="dform" method="get" action=<?php echo ""; ?> >
        <input style="display: none" name="candidate_id" value=<?php if(isset($_REQUEST["candidate_id"])){echo $_REQUEST["candidate_id"];} ?> >
        <?php if(!isset($_GET["pg"])){
            include("voting_p_list.php");
        }
        else{

        }
        ?>
        
    </form>
    <br>
    <?php 
    if(isset($_GET["pg"])){ 
        $date_file="candidates/dates/".$_REQUEST["pg"].".d";
        $date_file_arr=explode(",", file_get_contents($date_file));
        $v_start=$date_file_arr[0];
        $v_end=$date_file_arr[1];

     echo "<h1 style=width:200px;word-wrap:break-word>".$_REQUEST["pg"]."</h1><p style=\"font-size: 10px; font-weight: normal; font-family: sans-serif;margin-top: -5px\">Voting started: $v_start. ending $v_end.</p>";}else{echo "<h1 style=font-size:12px>Please Selcet a Programme</h1>";}  ?>
    
<div class="live-poll">
<div class="graph">

    <?php
    if(isset($_REQUEST["pg"])){
        if($_REQUEST["pg"]!=""){
        $pg=$_REQUEST["pg"];
    include("candidates/candidate_poll.php");

    $cand_poll_file=file_get_contents("candidates/$pg.l");
        $cand_poll_array=explode(",", $cand_poll_file);
        
$ca=[];
$max=0;

 for ($cpola=0; $cpola<count($cand_poll_array); $cpola++){
    $ca[]=file_get_contents('candidates/votes/'.$_REQUEST["pg"]."/".$cand_poll_array[$cpola].'.votes');


}
$max=max($ca);

        for ($cpol=0; $cpol<count($cand_poll_array); $cpol++) {
            
            
            //$max=max($maxa);
           //echo $max;
           if($max<=0){
            $height=20;
           }
           else{
                $height=($ca[$cpol]/($max*1.2))*300;
           }
           
            

            candidate_poll($cand_poll_array[$cpol],$height);
            
        }
        }

        }
else{
    echo "<div style='display:flex;align-items:center;justify-content:center;width:100%;height:300px'><p style='font-weight:bold;font-family:sans-serif;font-size20px;opacity:0.5' >Nothing to show !!!</p></div>";
}

    //candidate_poll(201);
    ?>

</div>
</div>
<br>
<?php
if(isset($_GET["candidate_id"])){
    //$id=200;
    if($_GET["candidate_id"]!=""){
        include("candidates/info/info.php");
    }
    


}
?>

<div class="cast-vote-container">
<a href="vote.php">
    <button>Cast Vote</button>
</a>
</div>

</div>
</div>
<br>
<div class="foot">
<br>
<footer>Copyright© 2023 - Voting System<br><u>All Rights Reserved</u></footer>
</div>
</body>

<script type="text/javascript">
    var select_box=document.querySelector(".select_box");
    var dform=document.querySelector(".dform");
    select_box.onchange=function(){
        dform.submit();
    }
</script>
</html>
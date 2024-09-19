<?php
///////sample
// get the file of the poll list from the candidates file
$poll_list_file="../candidates/poll_list.pl";
//get the contents of the file
$poll_list_content=file_get_contents("$poll_list_file");
//convert to array
$poll_list_array=explode(",", $poll_list_content);
//loop through the file and assign the contents;
for ($p=0; $p<count($poll_list_array); $p++) {

    
    create_poll($poll_list_array[$p], $p);
    
}

/*function cfg($name_array){
        for($im=0;$im<count($name_array);$im++){
            $l_candidate="<div class=\"user_details\">
                    <div class=\"avatar_icon\"></div>
                    <a href=\"?candidate=1\"> ".$name_array[$im]." </a>
                </div>";
                echo $l_candidate;
        }
    }
    */




function user_c(){
    $poll_list_fileu="../candidates/poll_list.pl";
//get the contents of the file
$poll_list_contentu=file_get_contents("$poll_list_fileu");
//convert to array
$poll_list_arrayu=explode(",", $poll_list_contentu);
    for ($u=0; $u<count($poll_list_arrayu); $u++) {
$nameu_content=file_get_contents("../candidates/".$poll_list_arrayu[$u].".l");
    $nameu_array=explode(",", $nameu_content);
    
    for($im=0;$im<count($nameu_array);$im++){
        $l_candidate="<div class=\"user_details\">
                    <div class=\"avatar_icon\"></div>
                    <a href=\"?candidate=1\"> ".$name[$im]." </a>
                </div>";
                echo $l_candidate;
        
    }
    
    
}
}


function create_poll($name,$id){
    $name_content=file_get_contents("../candidates/".$name.".l");
    $name_array=explode(",", $name_content);
    //$ff=cfg($name_array);
    
    
    
    $output1="<div class=\"poll_small_container\">
            <div class=\"top\">
            <div class=\"biometric_icon\"></div>
            <a href=\"#\" class=\"p_container\">
                <label>".$name."</label>
                <div class=\"min_date\">12/03/2023 - 10:20 AM</div>
                
                </a>
                <div class=\"action_buttons\">
                        <div id=\"open_".$id."_poll\" class=\"down_arrow_icon\" title=\"Open\"></div>
                        <div id=\"close_".$id."_poll\" class=\"up_arrow_icon\" title=\"Close\" style=\"display: none;\"></div>
                    </div>

                </div>

                    <div id='poll_content".$id."s' class=\"content\" style=\"display: flex;flex-direction: column;align-items: flex-start;transition: all 0.5s ease-out\">
                        <h2 style=\"font-size: 10px; font-family: 'Brinnan';padding-left: 30px;padding-top: 20px\">List of Candidates</h2>
                        
                        ";

    //$output2=$l_candidate;
    $output3="
                    </div>
                        
                   

            </div>
            <script type=\"text/javascript\">
                var poll_content".$id."s=document.querySelector(\"#poll_content".$id."s\");
                var open_".$id."_poll=document.querySelector(\"#open_".$id."_poll\");
                var close_".$id."_poll=document.querySelector(\"#close_".$id."_poll\");
                poll_content".$id."s.style.display=\"none\";
                poll_content".$id."s.style.opacity=\"0\";

                open_".$id."_poll.onclick=function(){
                    poll_content".$id."s.style.display=\"block\";
                    open_".$id."_poll.style.display=\"none\";
                    close_".$id."_poll.style.display=\"block\";
                    poll_content".$id."s.style.opacity=\"1\";
                }
                close_".$id."_poll.onclick=function(){
                    poll_content".$id."s.style.display=\"none\";
                    open_".$id."_poll.style.display=\"block\";
                    close_".$id."_poll.style.display=\"none\";
                    poll_content".$id."s.style.opacity=\"0\";
                }
            </script>";

    echo $output1;
    for($im=0;$im<count($name_array);$im++){
        $cand_votes=file_get_contents("../candidates/votes/".$name."/".$name_array[$im].".votes");
        $l_candidate="<div class=\"user_details\">
                    <div class=\"avatar_icon\"></div>
                    <a href=\"?cand_info=".$name_array[$im]."\"> ".$name_array[$im]." </a>
                    <div style='width:100px;display:flex;flex-direction:row-reverse;background:none'><p style=color:grey;font-size:10px;font-family:Brinnan>".$cand_votes." votes</p></div>
                </div>";
                echo $l_candidate;
    }
    echo $output3;

}

    

?>

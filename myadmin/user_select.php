<?php


$id=0;

    //read the user info file;
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
if(isset($linedata[1])){

user_select($linedata[7],$linedata[0],$linedata[1],$linedata[5],$linedata[6]);
}


    }

function user_select($id,$fname,$sname,$state,$gender){

    $image_location="../users/".$id."/images/avatar.jpg";
    $name=$fname." ".$sname;
    

    $output="<hr>
        <a class=\"candidate_option\">
        
            <input type=\"checkbox\"  id=\"user$id\" value=$id >
          <label class=\"candidate-profile\" for=\"user$id\">
            <img src=\"$image_location\" style=\"border-color:green\">
            <div class=\"name-c\">
                <h2>$name</h2>
                <b>$gender • $state</b>
                
            </div>
         </label>
         <img class=\"party_logo\" src=\"../images/c_logos/apc.png\">  
        </a>

        <br>

        <script>
        var user_list_input=document.querySelector(\".user_list_input\");
        var user$id=document.querySelector(\"#user$id\");
        var arr_user=Array(0);
        var u_id;
        user$id.onchange=function(){
            if(user$id.checked ==true){
                u_id=$id;
            arr_user.push(u_id);
            user_list_input.value=arr_user.join();
                
            }
            else{
                 u_id=$id;
                 var i=0;
                 var index=arr_user.indexOf(u_id);
                 if(index>-1){
                    arr_user.splice(index,1);
                 }
            user_list_input.value=arr_user.join();
            
            }
            
            
            
            
        }
        </script>

        ";

    echo $output;
}


?>
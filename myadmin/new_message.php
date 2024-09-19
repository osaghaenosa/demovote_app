<?php


$id=0;

    //read the user info file;
$file=fopen("../db/db.db","a+");
$line=[];
$line_number=0;
$name="0";
$state="0";
$id=$_REQUEST["new_message"];


while(!feof($file)){
    $line[]=fgets($file);
    $line_number++;
}

for($i=0; $i < $line_number; $i++) { 
$linedata=explode(",", $line[$i]);

    for($j=0; $j<=9; $j++){
        if(isset($linedata[$j])){
            if($linedata[$j]==$id){
                $mfname=$linedata[0];
                $msname=$linedata[1];
            }
        }

    }

    }

    $noti_file="../users/".$_REQUEST["new_message"]."/notiitem.txt";
if(!file_exists($noti_file)){
                            fopen($noti_file, "w");
                        }
    if(isset($_POST["message_text"]) && $_POST["message_text"]!=""){
        //Send Message to the user
        //Your picture doesnt have a face in it, please update your picture before you get verified to vote.Thanks for your understanding

        

        $msg="<div class=\"msg_box\">
            <p>".$_POST["message_text"].".</p>
                            
        </div>
        ";
        $msg_before=file_get_contents($noti_file);

        file_put_contents($noti_file, $msg."\r\n".$msg_before);
        $noti_new="../users/".$_REQUEST["new_message"]."/noti_new.txt";
if(!file_exists($noti_new)){
    $hoi=fopen($noti_new,"w");  
}
file_put_contents($noti_new, 1);
    }
?>
<div class="message_popup_bg">
                <div class="message_popup" style="height: 400px">
                    <div class="close"><a class="x_button">x</a></div>
                    <br>
                    <br>
                    <h1>Send A Message to <?php echo $mfname." ".$msname; ?></h1>
                    <br>
                    <div class="message_area" style="height: 100px;overflow-y: scroll;">
                        <?php
                        include($noti_file);
                        ?>
                    </div>

                    <form method="post" id="form_message" autocomplete="true" action="?new_message=<?php echo $id; ?>&&send_msg=true">
                        <div class="form-input" style="animation: none">
                        <div class="input-fa-fas" style="animation: none; border:solid 1px rgb(0,112,224);width: 250px;height: 100px;overflow: hidden;">
                        <textarea type="text" name="message_text" placeholder="type message" style="animation: none;outline: none;max-width: 250px;max-height: 100px;min-width: 250px;min-height: 100px"></textarea>
                        <!--<button class="small_button" style="background: black;padding: 10px 10px 10px;padding-bottom: 20px;width: initial;" >New Button</button>-->
                        </div><br>
                        </div>
                    </form>
                    <!--<button class="small_button" style="width: 100px;height:30px;font-size: 10px;background: black;text-align: center;">Add Button &#2000</button>
                    <br>-->

                    <button  class="small_button" style="width: 200px; height:40px;font-size: 13px;display: flex;align-items: center;justify-content: center;" id="s_message">Send Message <a style="width:10px"></a> <div class="send_icon" style="background:white"></div></button>
                </div>

            </div>
            <style type="text/css">
                @keyframes pop{
                    0%{
                        transform: scale(1,1);
                        margin-left: -20px;
                    }
                    50%{
                        transform: scale(0,0);
                        margin-left: 20px;
                    }
                    100%{
                        transform: scale(1,1);
                        margin-left: 0px;
                    }
                }
                .m_box{
                    position: relative;
                    background: white;
                    width: 25px;
                    height: 25px;
                    margin-left: -10px;
                    margin-top: -5px;
                }
                #s_message .m_box:nth-child(1){

                    animation: pop 0.5s linear infinite;
                }
                #s_message .m_box:nth-child(2){

                    animation: pop 0.55s linear infinite;
                }
                #s_message .m_box:nth-child(3){

                    animation: pop 0.6s linear infinite;
                }
                #s_message .m_box:nth-child(4){

                    animation: pop 0.65s linear infinite;
                }
                #s_message .m_box:nth-child(5){

                    animation: pop 0.7s linear infinite;
                }
                .message_popup{
                    flex-direction: row-reverse;
                }
            </style>
            <script type="text/javascript">
                var close=document.querySelector(".close");
                var message_popup_bg=document.querySelector(".message_popup_bg");
                var s_message=document.querySelector("#s_message");
                var form_message=document.querySelector("#form_message");

                close.onclick=function(){
                    message_popup_bg.style.display="none";
                }

                var l_timer=0,t_range=0;
                setInterval(function(){
                    if(l_timer==1){

                        t_range+=1;
                        if(t_range==100){
                        form_message.submit();
                        t_range=100;
                        console.log("a");
                    }
                    }
                    
                },10);


                s_message.onclick=function(){
                    //create a div in the button
                    s_message.innerHTML="";
                for(var aa=0;aa<3;aa++){
                    let box=document.createElement("div");
                    
                s_message.appendChild(box);
                box.className="m_box";
                }
                l_timer=1;
                    
                }
                
            </script>
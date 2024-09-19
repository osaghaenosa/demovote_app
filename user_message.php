 <div class="message_popup_bg" style="display: block">
                <div class="message_popup" style="width: 250px">
                    <div class="close"><a class="x_button">x</a></div>
                    <br>
                    <br>
                    <h1>Notifications</h1>
                    <br>
                    <div class="message_area">
                        <?php
                        $noti_new="users/".$_SESSION["id"]."/noti_new.txt";
                        if(!file_exists($noti_new)){
                            fopen($noti_new, "w");
                        }                        
                        $noti_file="users/".$_SESSION["id"]."/notiitem.txt";
                        if(!file_exists($noti_file)){
                            fopen($noti_file, "w");
                        }
                        include($noti_file);
                        file_put_contents($noti_new, 0);
                        ?>
                        
                        
                        
                    </div>
                    <form>
                        <br>
                    <br>
                    
                    </form>

                </div>

            </div>

<script type="text/javascript">
    var close=document.querySelector(".close");
                var message_popup_bg=document.querySelector(".message_popup_bg");
                
                close.onclick=function(){
                    message_popup_bg.style.display="none";
                }
</script>
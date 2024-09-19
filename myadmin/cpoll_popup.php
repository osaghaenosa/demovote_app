<div class="poll_popup_bg">
                <div class="poll_popup">
                    <div class="close"><a class="x_button">x</a></div>
                    <br>
                    <br>
                    <h1 style="text-decoration: underline;margin-top: -10px">Create New Poll</h1>
                    <br>
                    <form class="in_form" method="get" action="nps.php">
                        <div class="create_poll_a">
                            <div class="form-input" style="animation: none">
                                <h1 style="font-size: 1rem;color: grey">Name Of Poll</h1>
                                <div class="input-fa-fas" style="animation: none; border:solid 1px rgb(0,112,224);">

                                    <input type="text" name="poll_name" placeholder="Name of Poll" style="animation: none">
                                </div><br>
                                    <ul class="name_suggest_list" style="display: none">
                                        <p>*Suggested Names</p>
                                        <li>
                                            SUG Presedental Election
                                        </li>
                                        <li>
                                            SUG DOS Election
                                        </li>
                                        <li>
                                            SUG DOI Election
                                        </li>
                                    </ul><br>
                            </div>
                        </div>
                        <div class="create_poll_b" style="display: none">
                            <div class="form-input" style="animation: none">
                                <h1 style="font-size: 1rem;color: grey">Select Candidates</h1>
                                <input type="text" name="r_users" class="user_list_input" style="display: none">
                                <?php include("user_select.php"); ?>

                                <br>
                            </div>
                        </div>
                        
                        <div class="create_poll_c" >
                            <div class="form-input" style="animation: none">
                                <h1 style="font-size: 1rem;color: grey; width: 200px">Duration</h1>
                                
                                <br>
                                <div class="input-fa-fas" style="animation: none; border:solid 1px rgb(0,112,224);">

                                    <a style="font-size: 9px;position: relative;margin-top: -29px; font-family: sans-serif;font-weight: bold;">start date</a>

                                    <input type="date" name="durationstart"  placeholder="" id="mdatea" value="<?php $dt=date('Y/m/d'); echo $dt; ?>" style="animation: none"> 
                                </div>
                                <div class="input-fa-fas" style="animation: none; border:solid 1px rgb(0,112,224);">

                                    <a style="font-size: 9px;position: relative;margin-top: -29px; font-family: sans-serif;font-weight: bold;">end date</a>

                                    <input type="date" name="durationend" placeholder="Duration" id=mdateb style="animation: none">
                                </div>
                                <p class="out_put"></p>
                                <br>
                            </div>
                            <script type="text/javascript">
                                var mdatea=document.querySelector("#mdatea");
                                var mdateb=document.querySelector("#mdateb");

                                
                                var out=document.querySelector(".out_put");
                                var drm=0,drma=0,daya=0,dayb=0,yeara=0,yearb=0,montha=0,monthb=0;
                                mdateb.onclick=function(){
                                    drm=Array.from(mdateb.value);
                                    drma=Array.from(mdatea.value);
                                    daya=drm[8]+""+drm[9];
                                    dayb=drma[8]+""+drma[9];
                                    yeara=drm[0]+""+drm[1]+""+drm[2]+""+drm[3];
                                    yearb=drma[0]+""+drma[1]+""+drma[2]+""+drma[3];
                                    monthb=drma[5]+""+drma[6];
                                    montha=drm[5]+""+drm[6];
                                    var tdate=daya-dayb;
                                    var tyear=yearb-yeara;
                                    var tmonth=montha-monthb;

                                    if(tmonth>=1){
                                        out.innerHTML=tmonth+" months "+tdate+" days to go";

                                    }
                                    else if(tmonth<1){
                                        out.innerHTML=tdate+" days to go";
                                    }


                                    
                                }
                                
                            </script>
                        </div>

                        <div class="create_poll_d" >
                            <div class="form-input" style="animation: none">
                                <center><h1 style="font-size: 1.5rem;color: green; width: 200px">Success</h1><img src="../images/20230309_082919.png" style="width: 100px;height: initial;border: none;"></center>
                                <h1 style="font-size: 1rem;color: grey; width: 200px">Selected Candidates Are Expected to note that this campaign is to be FREE and FAIR</h1>
                                
                                <br>
                            </div>
                        </div>
                        
                    </form>
                    <button  class="small_button" id="next_button_trigger" style="width: 200px; padding-top: 20px; padding-bottom:30px;font-size: 16px">Next ></button>
                    <button  class="small_button" id="create_poll_trigger" style="width: 200px; padding-top: 20px; padding-bottom:30px;font-size: 16px;display: none">Create Poll</button>
                    <button  class="small_button" id="close_poll_trigger" style="width: 200px; padding-top: 20px; padding-bottom:30px;font-size: 16px;display: none">Close</button>
                </div>

            </div>

            <script type="text/javascript">
    var slide_a=document.querySelector(".slide_1");
    var poll_slides=0;

    var create_poll_a=document.querySelector(".create_poll_a");
    var create_poll_b=document.querySelector(".create_poll_b");
    var create_poll_c=document.querySelector(".create_poll_c");
    var create_poll_d=document.querySelector(".create_poll_d");
    var next_button_trigger=document.querySelector("#next_button_trigger");
    var create_poll_trigger=document.querySelector("#create_poll_trigger");
    var close_poll_trigger=document.querySelector("#close_poll_trigger");
    var close=document.querySelector(".close");
    var in_form=document.querySelector(".in_form");
    var poll_popup_bg=document.querySelector(".poll_popup_bg");

    setInterval(function(){
        if(poll_slides==0){
        create_poll_a.style.display="block";
        create_poll_b.style.display="none";
        create_poll_c.style.display="none";
        create_poll_d.style.display="none";
        create_poll_trigger.style.display="none";
        next_button_trigger.style.display="block";
        close_poll_trigger.style.display="none";
    }
    if(poll_slides==1){
        create_poll_a.style.display="none";
        create_poll_b.style.display="block";
        create_poll_c.style.display="none";
        create_poll_d.style.display="none";
        create_poll_trigger.style.display="none";
        next_button_trigger.style.display="block";
        close_poll_trigger.style.display="none";
    }
    if(poll_slides==2){
        create_poll_a.style.display="none";
        create_poll_b.style.display="none";
        create_poll_c.style.display="block";
        create_poll_d.style.display="none";
        create_poll_trigger.style.display="block";
        next_button_trigger.style.display="none";
        close_poll_trigger.style.display="none";
    }
    if(poll_slides==3){
        create_poll_a.style.display="none";
        create_poll_b.style.display="none";
        create_poll_c.style.display="none";
        create_poll_d.style.display="block";
        create_poll_trigger.style.display="none";
        next_button_trigger.style.display="none";
        close_poll_trigger.style.display="block";
    }

},10);
    
    next_button_trigger.onclick=function(){
        poll_slides++;
    }

    create_poll_trigger.onclick=function(){
        //poll_slides=3;
        in_form.submit();
    }
    <?php
    if(isset($_REQUEST["successpoll"])){
        echo "poll_slides=3;";
    }
    ?>

    close.onclick=function(){
        poll_popup_bg.style.display="none";
    }
    close_poll_trigger.onclick=function(){
        poll_popup_bg.style.display="none";
    }
    



</script>
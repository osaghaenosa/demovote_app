<script type="text/javascript">
    var slide_a=document.querySelector(".slide_1");
    var slide_b=document.querySelector(".slide_2");

 var p=document.querySelector("#p");
 var n=document.querySelector("#n");
   vote_form=document.querySelector(".vote_form");
   var ppw=document.querySelector(".ppw");
   var passcode="<?php echo $_SESSION['mypassword']; ?>";
    
    var slides=1;
    
    setInterval(function(){
        if(slides==1){
        slide_a.style.display="block";
        slide_b.style.display="none";
        
        p.style.background="skyblue";
        p.style.display="none";
        
        n.style.background="rgb(0,112,224)";
    }
    else if(slides==2){
        slide_b.style.display="block";
        slide_a.style.display="none";
        
        p.style.background="rgb(0,112,224)";
        p.style.display="block";
               n.style.background="rgb(0,112,224)";
    }
    
    });
    
    
    function next(){
        
        slides+=1;
        if(slides>=3){
            slides=3;
        }
       // alert(slides);

       if(slides>2){
            if(ppw.value == passcode){
               vote_form.submit();
            }
            else{
                alert("Password not Correct");
            }
       }
    }

    function prev(){
        slides--;
        if(slides<=1){
            slides=1;
        }
    }
    function done(){
        //window.open("index.php");
    }
    
</script>
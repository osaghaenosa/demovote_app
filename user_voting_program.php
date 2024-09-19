<form class="dform" method="get" action=<?php echo ""; ?> >
	<br>
        <h1 style="color: grey">Select Voting Programme </h1>
        <select name="pg" class="select_box">
            <option>Voting Programmes</option>
            <?php
            $lf="candidates/poll_list.pl";
            $lfg=file_get_contents($lf);
            $lfg_arr=explode(",", $lfg);
            for($i=0;$i<count($lfg_arr); $i++){
                echo "<option>".$lfg_arr[$i]."</option>";
            }
            
            ?>
        </select>
    </form>
    <script type="text/javascript">
    	var dnx_form=document.querySelector(".dform");
    	function submit_next(){
    		dnx_form.submit();
    	}
    </script>
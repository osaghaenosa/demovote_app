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
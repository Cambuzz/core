<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php
	if(isset($_POST['load']))
	{
		$current_user = $_SESSION["username"];
		$filter_query = "SELECT * FROM users WHERE username = '{$current_user}' LIMIT 1";
	    $filter_result = mysqli_query($conn, $filter_query);
	    confirm_query($filter_result);
	    $filter_array = mysqli_fetch_assoc($filter_result);
		$load=$_POST['load']*3;
		$query = "SELECT * FROM notify ORDER BY id DESC LIMIT $load,3";
	    $result = mysqli_query($conn, $query);
	    confirm_query($result);

  
                            while($notification = mysqli_fetch_assoc($result)) 
                            {       
                                $arbranch = $notification['branch'];
                                $arclub = $notification['club'];
                                $ar1 = array("$arbranch $arclub");
                                $sent2 = implode(" ", $ar1);
                                $ar2branch = $filter_array['filter_branch'];
                                $ar2club = $filter_array['filter_club'];
                                $ar2 = array("$ar2branch $ar2club");
                                $sent1 = implode(" ", $ar2);
                                $out = explode(" ", $sent1);
                                $size_array = sizeof($out);
                                for ($m=0; $m < $size_array; $m++) { 
                                    $sry = array("$out[$m] $sent2 ");
                                    $temp = $out[$m];
                                    $n2 = strlen($temp);
                                    $s = implode(" ", $sry);
                                    $n = strlen($s);
                                    $Z = new SplFixedArray($n);
                                    $Z[0] = $n;
                                    $L = 0;
                                    $R = 0;
                                    for ($i= 1; $i < $n; $i++) { 
                                        if ($i> $R) {
                                            $L = $R = $i;
                                            while ($R < $n && $s[$R-$L+$i]==$s[$R-$L]) {
                                                $R++;
                                            }
                                            $Z[$i] = $R-$L;
                                            $R--;           
                                        } else {
                                            $k = $i-$L;
                                            if ($Z[$k]<$R-$i+1) {
                                                $Z[$k] = $Z[$i];
                                            } else {
                                                $L = $i;
                                                while ($R < $n && $s[$R-$L+$i]==$s[$R-$L]) {
                                                    $R++;
                                                }
                                                $Z[$i] = $R-$L;
                                                $R--;
                                            }
                                        }
                                    } 
                                    $flag=0;    
                                    for ($i=1; $i < $n ; $i++) { 
                                        if ($Z[$i]>$n2) {                                              
                                            if ($notification['poset']==0) { 
                                                $buzz_user = $notification["buzz_username"];
                                                $name_print_query = "SELECT * FROM users WHERE username = '{$buzz_user}' LIMIT 1";
                                                $name_print_result = mysqli_query($conn, $name_print_query);
                                                confirm_query($name_print_result);
                                                $name_print_title = mysqli_fetch_assoc($name_print_result);
                                                if ($buzz_user==$current_user) { ?>
                                                    <article class="story">
                                                    <aside class="user-thumb">
                                                    <?php
                                if ($name_print_title["proset"]==0) { 
                            ?>
                                    <img src="assets/images/nopic.png" height="44px" width="44px" alt="" class="img-circle" />
                            <?php
                                } elseif ($name_print_title["proset"]==1) {
                                        $imageid=$name_print_title['id'];
                                        $dpcounter=$name_print_title['dpcounter'];

                                        //echo '<img src="data:image/jpeg;base64,' . base64_encode($name_title['data_propic']) . '" class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>'; 
                                           if($dpcounter>0)
                                        echo '<img src="images/' . $imageid."_".$dpcounter . '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                        else
                                        echo '<img src="images/' . $imageid. '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                }
                            ?>
                                                    </aside>
                                                    <div class="story-content">
                                                    <header>
                                                    <div style="float: right; margin-top: 2px;">
                                                           <a style="font-size: 14px;" class="entypo-trash" href="delete_event.php?id=<?php echo urlencode($notification["id"]); ?>" onclick="return confirm('Are you sure?');"></a>
                                                           
                                                    </div>
                                                    <div class="publisher" style="color: #303641; font-family: 'Montserrat', sans-serif;">
                                                    <span style="font-weight: bold;"><?php echo ucfirst($name_print_title["sname"]); ?></span><span style="color: #9b9fa6;">&nbsp;posted a buzz!</span>
                                                    <em style="color: #9b9fa6;">
                                                        <?php 
                                                            $post_time = strtotime($notification['buzz_time']);
                                                            echo date("d M, y | h:i a", $post_time);
                                                         ?>
                                                    </em>
                                                    </div>
                                                    </header>
                                                    <div class="story-main-content">
                                                    <p style="font-size: 30px; font-family: 'Montserrat', serif; font-weight: bold; line-height: 1.3; color: black;"><?php echo ucfirst($notification["title"]); ?></p>
                                                    <p><?php 
                                                       $pattern = '#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si';
                                                        $str =ucfirst(ucfirst($notification["content"]));
                                                        $num_found = preg_match_all($pattern, $str, $out);
                                                        $str1=serialize($out);
                                                        $start=0;
                                                        for($i=0;$i<$num_found;$i++)
                                                        {
                                                            $flag=0;
                                                            $s=strpos($str1,'http',$start);
                                                            if(!$s)
                                                            {
                                                                $s=strpos($str1,'www',$start);
                                                                $flag++;
                                                            }
                                                            $s1=strpos($str1,';',$s);
                                                            $s1=$s1-2;
                                                            //echo $s." ".$s1." <br />";
                                                            $start=$s1;
                                                            $link=substr($str1,$s,$s1-$s+1);

                                                            if($flag==1)
                                                            {
                                                                $link1="https://".$link;
                                                            }
                                                            else
                                                            $link1=$link;
                                                            //echo $link."<br />";
                                                            $str=str_replace($link,"<a href='$link1'>$link1</a>",$str);
                                                        }
                                                    echo nl2br($str). " "; 
                                                    ?>                                                                 
                                                    </p>                                                
                                                    <b style="margin-top: 10px; display: block; margin-left: auto; margin-right: auto; font-family:'Montserrat', sans-serif">
                                                    <?php
                                                    $timestamp_start = strtotime($notification["start_date_time"]);
                                                    $timestamp_end = strtotime($notification["end_date_time"]); ?>
                                                    <span class="startingdate">
                                                    Starting on: <?php echo date("l, d M, y | h:i a", $timestamp_start); ?>
                                                    </span>
                                                    <span class="endingdate">
                                                    Ending on: <?php echo date("l, d M, y | h:i a", $timestamp_end); ?>
                                                    </span>
                                                      </b>                                
                                                    </div>            
                                                    </div>                                                                                                   
                                                    </article>
                                                    <hr>
                                        <?php   } else { ?>
                                                    <article class="story">
                                                    <aside class="user-thumb">
                                                    <?php
                                if ($name_print_title["proset"]==0) { 
                            ?>
                                    <img src="assets/images/nopic.png" height="44px" width="44px" alt="" class="img-circle" />
                            <?php
                                } elseif ($name_print_title["proset"]==1) {
                                        $imageid=$name_print_title['id'];
                                        $dpcounter=$name_print_title['dpcounter'];
                                        //echo '<img src="data:image/jpeg;base64,' . base64_encode($name_title['data_propic']) . '" class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>'; 
                                        
                                         if($dpcounter>0)
                                        echo '<img src="images/' . $imageid."_".$dpcounter . '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                        else
                                        echo '<img src="images/' . $imageid. '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                }
                            ?>
                                                    </aside>
                                                    <div class="story-content">
                                                    <header>
                                                    <div class="publisher" style="color: #303641; font-family: 'Montserrat', sans-serif;">
                                                    <span style="font-weight: bold;"><?php echo ucfirst($name_print_title["sname"]); ?></span><span style="color: #9b9fa6;">&nbsp;posted a buzz!</span>
                                                    <em style="color: #9b9fa6;">
                                                        <?php 
                                                            $post_time = strtotime($notification['buzz_time']);
                                                            echo date("d M, y | h:i a", $post_time);
                                                         ?>
                                                    </em>
                                                    </div>
                                                    </header>
                                                    <div class="story-main-content">
                                                    <p style="font-size: 30px; font-family: 'Montserrat', serif; font-weight: bold; line-height: 1.3; color: black;"><?php echo ucfirst($notification["title"]); ?></p>
                                                    <p><?php 
                                                       $pattern = '#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si';
                                                        $str =ucfirst(ucfirst($notification["content"]));
                                                        $num_found = preg_match_all($pattern, $str, $out);
                                                        $str1=serialize($out);
                                                        $start=0;
                                                        for($i=0;$i<$num_found;$i++)
                                                        {
                                                            $flag=0;
                                                            $s=strpos($str1,'http',$start);
                                                            if(!$s)
                                                            {
                                                                $s=strpos($str1,'www',$start);
                                                                $flag++;
                                                            }
                                                            $s1=strpos($str1,';',$s);
                                                            $s1=$s1-2;
                                                            //echo $s." ".$s1." <br />";
                                                            $start=$s1;
                                                            $link=substr($str1,$s,$s1-$s+1);
                                                            if($flag==1)
                                                            {
                                                                $link1="https://".$link;
                                                            }
                                                            else
                                                            $link1=$link;
                                                            //echo $link."<br />";
                                                            $str=str_replace($link,"<a href='$link1'>$link1</a>",$str);
                                                        }
                                                    echo nl2br($str). " "; 
                                                            ?>                                                
                                                    </p>                                                
                                                    <b style="margin-top: 10px; display: block; margin-left: auto; margin-right: auto; font-family:'Montserrat', sans-serif">
                                                    <?php
                                                    $timestamp_start = strtotime($notification["start_date_time"]);
                                                    $timestamp_end = strtotime($notification["end_date_time"]); ?>
                                                    <span class="startingdate">
                                                    Starting on: <?php echo date("l, d M, y | h:i a", $timestamp_start); ?>
                                                    </span>
                                                    <span class="endingdate">
                                                    Ending on: <?php echo date("l, d M, y | h:i a", $timestamp_end); ?>
                                                    </span>
                                                      </b>                                
                                                    </div>            
                                                    </div>                                                
                                                    </article>
                                                    <hr> <?php
                                                }
                                                
                                            } elseif ($notification['poset']==1) { 
                                                $buzz_user = $notification["buzz_username"];
                                                $name_print_query = "SELECT * FROM users WHERE username = '{$buzz_user}' LIMIT 1";
                                                $name_print_result = mysqli_query($conn, $name_print_query);
                                                confirm_query($name_print_result);
                                                $name_print_title = mysqli_fetch_assoc($name_print_result);
                                                if ($buzz_user==$current_user) { ?>
                                                    <article class="story">
                                                    <aside class="user-thumb">
                                                    <?php
                                if ($name_print_title["proset"]==0) { 
                            ?>
                                    <img src="assets/images/nopic.png" height="44px" width="44px" alt="" class="img-circle" />
                            <?php
                                } elseif ($name_print_title["proset"]==1) {
                                         $imageid=$name_print_title['id'];
                                        $dpcounter=$name_print_title['dpcounter'];
                                        //echo '<img src="data:image/jpeg;base64,' . base64_encode($name_title['data_propic']) . '" class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>'; 
                                        
                                           if($dpcounter>0)
                                        echo '<img src="images/' . $imageid."_".$dpcounter . '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                        else
                                        echo '<img src="images/' . $imageid. '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                }
                            ?>
                                                    </aside>
                                                    <div class="story-content">
                                                    <header>
                                                    <div style="float: right; margin-top: 2px;">
                                                           <a style="font-size: 14px;" class="entypo-trash" href="delete_event.php?id=<?php echo urlencode($notification["id"]); ?>" onclick="return confirm('Are you sure?');"></a>
                                                           
                                                    </div>
                                                    <div class="publisher" style="color: #303641; font-family: 'Montserrat', sans-serif;">
                                                    <span style="font-weight: bold;"><?php echo ucfirst($name_print_title["sname"]); ?></span><span style="color: #9b9fa6;">&nbsp;posted a buzz!</span>
                                                    <em style="color: #9b9fa6;">
                                                        <?php 
                                                            $post_time = strtotime($notification['buzz_time']);
                                                            echo date("d M, y | h:i a", $post_time);
                                                         ?>
                                                    </em>
                                                    </div>
                                                    </header>
                                                    <div class="story-main-content">
                                                    <p style="font-size: 30px; font-family: 'Montserrat', serif; font-weight: bold; line-height: 1.3; color: black;"><?php echo ucfirst($notification["title"]); ?></p>
                                                    <p><?php 
                                                       $pattern = '#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si';
                                                        $str =ucfirst(ucfirst($notification["content"]));
                                                        $num_found = preg_match_all($pattern, $str, $out);
                                                        $str1=serialize($out);
                                                        $start=0;
                                                        for($i=0;$i<$num_found;$i++)
                                                        {
                                                            $flag=0;
                                                            $s=strpos($str1,'http',$start);
                                                            if(!$s)
                                                            {
                                                                $s=strpos($str1,'www',$start);
                                                                $flag++;
                                                            }
                                                            $s1=strpos($str1,';',$s);
                                                            $s1=$s1-2;
                                                            //echo $s." ".$s1." <br />";
                                                            $start=$s1;
                                                            $link=substr($str1,$s,$s1-$s+1);
                                                            if($flag==1)
                                                            {
                                                                $link1="https://".$link;
                                                            }
                                                            else
                                                            $link1=$link;
                                                            //echo $link."<br />";
                                                            $str=str_replace($link,"<a href='$link1'>$link1</a>",$str);
                                                        }
                                                    echo nl2br($str). " "; 
                                                            ?>
                                                    
                                                    </p>
                                                    <?php
                                                    $poster_time = strtotime($notification['buzz_time']);                                                    
                                                    $posterid=$notification['buzz_username'].date("Y-m-d H-i-s", $poster_time); 
                                                                                          
                                                    echo '<img src="images/posters/' . $posterid . '.jpg "class="img-responsive">'; ?>
                                                    <b style="margin-top: 10px; display: block; margin-left: auto; margin-right: auto; font-family:'Montserrat', sans-serif">
                                                    <?php 
                                                    $timestamp_start = strtotime($notification["start_date_time"]);
                                                    $timestamp_end = strtotime($notification["end_date_time"]); ?>
                                                    <span class="startingdate">
                                                    Starting on: <?php echo date("l, d M, y  |  h:i a", $timestamp_start); ?>
                                                    </span>
                                                    <span class="endingdate">
                                                    Ending on: <?php echo date("l, d M, y  |  h:i a", $timestamp_end); ?>
                                                    </span>                                                
                                                    </b>
                                                    </div>
                                                    </div>                                                    
                                                    </article>
                                                    
                                                    <hr> <?php
                                                } else { ?>
                                                    <article class="story">
                                                    <aside class="user-thumb">
                                                    <?php
                                if ($name_print_title["proset"]==0) { 
                            ?>
                                    <img src="assets/images/nopic.png" height="44px" width="44px" alt="" class="img-circle" />
                            <?php
                                } elseif ($name_print_title["proset"]==1) {
                                        $imageid=$name_print_title['id'];
                                        $dpcounter=$name_print_title['dpcounter'];
                                        //echo '<img src="data:image/jpeg;base64,' . base64_encode($name_title['data_propic']) . '" class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>'; 
                                        
                                           if($dpcounter>0)
                                        echo '<img src="images/' . $imageid."_".$dpcounter . '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                        else
                                        echo '<img src="images/' . $imageid. '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                }
                            ?>
                                                    </aside>
                                                    <div class="story-content">
                                                    <header>
                                                    
                                                    <div class="publisher" style="color: #303641; font-family: 'Montserrat', sans-serif;">
                                                    <span style="font-weight: bold;"><?php echo ucfirst($name_print_title["sname"]); ?></span><span style="color: #9b9fa6;">&nbsp;posted a buzz!</span>
                                                    <em style="color: #9b9fa6;">
                                                        <?php 
                                                            $post_time = strtotime($notification['buzz_time']);
                                                            echo date("d M, y | h:i a", $post_time);
                                                         ?>
                                                    </em>
                                                    </div>
                                                    </header>
                                                    <div class="story-main-content">
                                                    <p style="font-size: 30px; font-family: 'Montserrat', serif; font-weight: bold; line-height: 1.3; color: black;"><?php echo ucfirst($notification["title"]); ?></p>
                                                    <p><?php 
                                                       $pattern = '#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si';
                                                        $str =ucfirst(ucfirst($notification["content"]));
                                                        $num_found = preg_match_all($pattern, $str, $out);
                                                        $str1=serialize($out);
                                                        $start=0;
                                                        for($i=0;$i<$num_found;$i++)
                                                        {
                                                            $flag=0;
                                                            $s=strpos($str1,'http',$start);
                                                            if(!$s)
                                                            {
                                                                $s=strpos($str1,'www',$start);
                                                                $flag++;
                                                            }
                                                            $s1=strpos($str1,';',$s);
                                                            $s1=$s1-2;
                                                            //echo $s." ".$s1." <br />";
                                                            $start=$s1;
                                                            $link=substr($str1,$s,$s1-$s+1);
                                                            if($flag==1)
                                                            {
                                                                $link1="https://".$link;
                                                            }
                                                            else
                                                            $link1=$link;
                                                            //echo $link."<br />";
                                                            $str=str_replace($link,"<a href='$link1'>$link1</a>",$str);
                                                        }
                                                    echo nl2br($str). " "; 
                                                            ?>
                                                    
                                                    </p>
                                                    <?php
                                                    $poster_time = strtotime($notification['buzz_time']);                                                    
                                                    $posterid=$notification['buzz_username'].date("Y-m-d H-i-s", $poster_time); 
                                                                                          
                                                    echo '<img src="images/posters/' . $posterid . '.jpg "class="img-responsive">'; ?>
                                                    <b style="margin-top: 10px; display: block; margin-left: auto; margin-right: auto; font-family:'Montserrat', sans-serif">
                                                    <?php 
                                                    $timestamp_start = strtotime($notification["start_date_time"]);
                                                    $timestamp_end = strtotime($notification["end_date_time"]); ?>
                                                    <span class="startingdate">
                                                    Starting on: <?php echo date("l, d M, y  |  h:i a", $timestamp_start); ?>
                                                    </span>
                                                    <span class="endingdate">
                                                    Ending on: <?php echo date("l, d M, y  |  h:i a", $timestamp_end); ?>
                                                    </span>                                                
                                                    </b>
                                                    </div>
                                                    </div>

                                                    </article>
                                                    <hr> <?php
                                                }                   
                                            } 
                                            $flag=1;
                                            break;
                                        }// if 
                                    }// for
                                    if($flag==1)
                                    	break;        
                                } //for m   
                            }
                            } // while
                        ?>  

<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php $comment_set = find_all_comments(); ?>
<?php
    if (isset($_SESSION["username"])) {
        $current_user = $_SESSION["username"];
        $name_query = "SELECT * FROM users WHERE username = '{$current_user}' LIMIT 1";
        $name_result = mysqli_query($conn, $name_query);
        confirm_query($name_result);
        $name_title = mysqli_fetch_assoc($name_result);
        $first_name = explode(" ", $name_title['sname']);
        $current_id = $name_title['id'];
        $view = " "; 
    } else {
        $current_user = "";
        $current_id = "";
        $name_title['id'] = "";
        $first_name = "";
        $name_title = "";
        $view = "style='display: none;'";
    }   
?>
<?php
$arab = find_arab_by_id($_GET["id"]);
if (!$arab) {
    redirect_to("arab.php");
}

$id = $arab["id"];
$query = "SELECT * FROM arab WHERE id = {$id}";
$result = mysqli_query($conn, $query);
$view_post = mysqli_fetch_assoc($result);
$query_post_comment = "SELECT * FROM arabcomments WHERE pid = {$id}";
$result_post_comment = mysqli_query($conn, $query_post_comment); 
?>
<?php   
if ((isset($_POST['submit']))&&(isset($_POST['comment']))) {    
    $pid = $arab["id"];
    $comment = mysqli_real_escape_string($conn, htmlspecialchars($_POST['comment']));
    $commentor = $current_user;
    date_default_timezone_set('Asia/Calcutta');
    $comment_time = date("Y-m-d\TH:i:s");
    if($current_user!=$view_post["post_user"]) {
        $counter = $view_post['comment_counter'];
        $comment_counter = $counter+1;    
        $query_counter = "UPDATE arab SET comment_counter = {$comment_counter} WHERE id = {$id}";
        $result_counter = mysqli_query($conn, $query_counter);
    }
    $query_comment = "INSERT INTO arabcomments (pid, comment, commentor, comment_time) VALUES ({$pid}, '{$comment}', '{$commentor}', '{$comment_time}')";
    $result_comment = mysqli_query($conn, $query_comment);
    if ($result_comment && mysqli_affected_rows($conn) == 1) {
        redirect_to("arab_comments.php?id=$id");
    }   
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Login or Signup on Cambuzz. Buzz new events, Track your teacher or ask a question.">
    <meta name="keywords" content="Buzz, Events, Cambuzz, Track, Teacher, question, Campus, Centralized information system">
    <meta name="author" content="Team Cambuzz">
    <title>Comments</title>
    <link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
     <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    
    <link rel="stylesheet" type="text/css" href="assets/css/buttoncreatebuzz.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style-core.css">
    <link rel="stylesheet" href="assets/css/style-theme.css">
    <link rel="stylesheet" href="assets/css/style-forms.css">
    <link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css" />
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <script>
    $.noConflict();
    </script>
    
</head>

<body class="page-body page-left-in" style="font-family: 'Montserrat';">
<?php include_once("analyticstracking.php") ?>
    <div class="page-container">
        <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
        <div class="sidebar-menu">
            <div class="sidebar-menu-inner">
                <header class="logo-env">
                    <!-- logo -->
                    <div class="logo">
                        <a href="buzz.php">
                            <h1 style="font-family: 'Pacifico', sans-serif; font-weight: 200px; color: white; margin-top: -2px; font-size:25px;">vitcc cambuzz</h1>
                        </a>
                    </div>
                    <!-- logo collapse icon -->
                    <div class="sidebar-collapse">
                        <a href="#" class="sidebar-collapse-icon">
                            <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                            <i class="entypo-menu"></i>
                        </a>
                    </div>
                    <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                    <div class="sidebar-mobile-menu visible-xs">
                        <a href="#" class="with-animation">
                            <!-- add class "with-animation" to support animation -->
                            <i class="entypo-menu"></i>
                        </a>
                    </div>
                </header>
                <div class="sidebar-user-info">
                    <div class="sui-normal">
                        <div class="user-link">
                             <?php /*
                            
                                if ($name_title["proset"]==0) { 
                            ?>
                                    <img src="assets/images/nopic.png" class="img-circle" height="100px" width="100px" style="border-radius: 100%; min-width: 100px; min-height: 100px;" />
                            <?php
                                } elseif ($name_title["proset"]==1) {
                                        $imageid=$name_title['id'];
                                        $dpcounter=$name_title['dpcounter'];
                                        //echo '<img src="data:image/jpeg;base64,' . base64_encode($name_title['data_propic']) . '" class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>'; 
                                          if($dpcounter>0)
                                        echo '<img src="images/' . $imageid."_".$dpcounter. '.jpg "class="img-circle" height="200px" width="100px"  style="border-radius: 100%;  min-height: 100px; min-width: 100px;"/>';
                                        else
                                        echo '<img src="images/' . $imageid. '.jpg "class="img-circle" height="200px" width="100px"  style="border-radius: 100%;  min-height: 100px; min-width: 100px;"/>';
                                }
                           */ ?>
                            <span>Welcome</span>
                            <strong><?php //echo ucfirst($first_name[0]); ?></strong>
                        </div>
                    </div> 
                    <div class="sui-hover inline-links animate-in">
                        <a href="settings.php">
                            <i class="entypo-pencil"></i> Account Settings
                        </a>
                        <span class="close-sui-popup">&times;</span>
                       
                    </div>
                </div>
                <ul id="main-menu" class="main-menu">
                    <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                    <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                    <li>
                        <a href="buzz.php">
                            <i class="entypo-megaphone"></i>
                            <span class="title">Buzz</span>
                        </a>
                    </li>
                    <li>
                        <a href="track_teacher.php">
                            <i class="entypo-graduation-cap"></i>
                            <span class="title">Track Teacher</span>
                        </a>
                    </li>
                    <li>
                        <a href="quora.php">
                            <i class="entypo-publish"></i>
                            <span class="title">Ask a question</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <div class="row">
                <!-- Raw Links -->
                <div class="col-md-6 col-sm-4 clearfix hidden-xs" style="float: right;">
                    <ul class="list-inline links-list pull-right">
                        <!-- Language Selector -->
                        <li>
                            <a href="settings.php">
                            Settings <i class="entypo-cog right"></i>
                        </a>
                        </li>
                        <li>
                            <a href="logout.php">
                            Log Out <i class="entypo-logout right"></i>
                        </a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr />
            <!-- main content starts here -->
            <div class="row">
                <div class="profile-env">
                    <section class="profile-feed">
                        <!-- ask question -->
                        <div class="profile-stories">
                            <article class="story">
                                <aside class="user-thumb">
                                    <a href="#">
                                        <?php
                                        $pic_query = "SELECT * FROM users WHERE username = '{$view_post['post_user']}' LIMIT 1";
                                        $pic_result = mysqli_query($conn, $pic_query);
                                        confirm_query($pic_result);
                                        $pic = mysqli_fetch_assoc($pic_result);
                                        
                               
                                if ($pic["proset"]==0) { 
                            ?>
                                    <img src="assets/images/nopic.png" height="44px" width="44px" alt="" class="img-circle" />
                            <?php
                                } elseif ($pic["proset"]==1) {
                                        $imageid=$pic['id'];
                                        $dpcounter=$pic['dpcounter'];
                                        //echo '<img src="data:image/jpeg;base64,' . base64_encode($name_title['data_propic']) . '" class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>'; 
                                        if($dpcounter>0)
                                        echo '<img src="images/' . $imageid."_".$dpcounter . '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                        else
                                        echo '<img src="images/' . $imageid. '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                }
                            ?>
                                    </a>
                                </aside>
                                <div class="story-content">
                                    <!-- story header -->
                                    <header>
                                        <div class="publisher">
                                            <a href="#"><?php echo ucfirst($pic['sname']); ?>
                                            posted a question
                                            <em>
                                            <?php 
                                                $post_time = strtotime($view_post['post_time']);
                                                echo date("d M, y | h:i a", $post_time);
                                            ?>
                                            </em>                                                                                
                                        </div>
                                    </header>
                                    <div class="story-main-content">
                                        <p style="font-size: 20px; line-height: 1.3; sans-serif; font-weight:bold; color: black;">
                                        <?php 



                                                               $str=$view_post['content'];
                                                                $comment = $str;
                                                                $st=$comment;
                                                                $sz=strlen($st);
                                                                $disp="";
                                                                $store="";
                                                                $flag=0;
                                                                for($i=0; $i<$sz; $i++)
                                                                {
                                                                    if($st[$i]=='#')
                                                                    {
                                                                        $ind=$i;
                                                                        while($st[$ind]=='#')
                                                                        {
                                                                            if($ind+1<$sz)
                                                                            {
                                                                                if($st[$ind+1]!='#' && $st[$ind+1]!=' ')
                                                                                {
                                                                                    $c=$ind+1;
                                                                                    $var="#";
                                                                                    while($st[$c]!='#' && $st[$c]!=' ')
                                                                                    {
                                                                                        $var=$var.$st[$c];
                                                                                        $c++;
                                                                                        if($c>=$sz)break;
                                                                                    }
                                                                                    //echo $var."<br>";
                                                                                    $disp=$disp."<a href='search_tag.php?word=".urlencode($var)."'>";

                                                                                }
                                                                            }
                                                                            $disp=$disp.$st[$ind];
                                                                            $ind++;
                                                                            if($ind>=$sz)break;
                                                                        }
                                                                        if($ind>=$sz)break;
                                                                        if($st[$ind]==' ')
                                                                        {
                                                                            $i=$ind;
                                                                            $disp=$disp.$st[$ind];
                                                                            continue;
                                                                        }
                                                                        while($st[$ind]!=' '&& $st[$ind]!='#')
                                                                        {
                                                                            $disp=$disp.$st[$ind];
                                                                            $ind++;
                                                                            if($ind>=$sz)
                                                                                {
                                                                                    $disp=$disp."</a>";
                                                                                    break;
                                                                                }
                                                                        }
                                                                        if($ind<$sz)
                                                                        {
                                                                            $disp=$disp."</a>";
                                                                        }
                                                                        $i=$ind-1;
                                                                    }
                                                                    else $disp=$disp.$st[$i];
                                                                }



                                            //echo ucfirst($view_post['postion']);
                                            $pattern = '#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si';
                                                        $str =ucfirst(ucfirst($disp));
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
                                        ?></p>
                                    </div>
                                    <?php
                                    if ($view_post['picset']==1) {
                                        $poster_time = strtotime($view_post['post_time']);
                                        $posterid=$view_post['post_user'].date("Y-m-d H-i-s", $poster_time);
                                        echo '<img src="images/' . $posterid . '.jpg "class="img-responsive">';
                                    }
                                    ?>
                                    <h1></h1>
                                    <!-- story like and comment link -->
                                    <footer>
                                        <!-- <a href="#" class="liked">
                                            <i class="entypo-heart"></i> Liked <span>(8)</span>
                                        </a> -->
                                        
                                            <i class="entypo-comment"></i> Comment <span>(
                                            <?php
                                            $count_query = "SELECT COUNT(*) FROM arabcomments WHERE pid = {$id}";
                                            $count_result = mysqli_query($conn, $count_query);
                                            confirm_query($count_result);
                                            $row = mysqli_fetch_array($count_result);
                                            $total = $row[0];
                                            echo $total;
                                            ?>
                                            )</span>
                                       
                                        <!-- story comments -->
                                        <ul class="comments">
                                        <?php
                                        while ($view_comment = mysqli_fetch_assoc($result_post_comment)) { ?>
                                            <div id=<?php echo $view_comment["id"]?> >
                                            <li> <!-- coment post begin -->
                                                <div class="user-comment-thumb">
                                                <?php if ($view_comment['commentor']==$current_user) {
                                                            $poster_pic_query = "SELECT * FROM users WHERE username = '{$view_comment['commentor']}' LIMIT 1";
                                                            $poster_pic_result = mysqli_query($conn, $poster_pic_query);
                                                            confirm_query($poster_pic_result);
                                                            $poster_pic = mysqli_fetch_assoc($poster_pic_result);
                                                            
                                
                                if ($poster_pic["proset"]==0) { 
                            ?>
                                    <img src="assets/images/nopic.png" height="44px" width="44px" alt="" class="img-circle" />
                            <?php
                                } elseif ($poster_pic["proset"]==1) {
                                       $imageid=$poster_pic['id'];
                                        $dpcounter=$poster_pic['dpcounter'];
                                        //echo '<img src="data:image/jpeg;base64,' . base64_encode($name_title['data_propic']) . '" class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>'; 
                                        if($dpcounter>0)
                                             echo '<img src="images/' . $imageid."_".$dpcounter . '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                         else   
                                            echo '<img src="images/' . $imageid . '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                }
                            ?>
                                                </div>
                                                <div class="user-comment-content" style="color: black;">
                                                    <div class="user-comment-name">
                                                        <?php echo ucfirst($poster_pic['sname']); ?>
                                                    </div>
                                                    <?php 
                                                        //echo ucfirst($view_comment['answer']); 
                                                        $pattern = '#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si';
                                                        $str =ucfirst(ucfirst($view_comment['comment']));
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
                                                    <div class="user-comment-meta">
                                                        <a href="#" class="comment-date">
                                                        <?php 
                                                            $post_time = strtotime($view_comment['comment_time']);
                                                            echo date("d M, y | h:i a", $post_time);
                                                            $comment_id=$view_comment['id'];
                                                         ?>
                                                        </a> 
                                                        <!-- <a href="#">
                                                            <i class="entypo-heart"></i> Like <span>(2)</span>
                                                        </a> -->
                                                        
                                                        <!-- <a href="#">
                                                            <i class="entypo-comment"></i> Reply
                                                        </a> -->
                                                    </div>
                                                </div>
                                                
                                            </li></div> <?php
                                                } else {
                                                    $poster_pic_query = "SELECT * FROM users WHERE username = '{$view_comment['commentor']}' LIMIT 1";
                                                    $poster_pic_result = mysqli_query($conn, $poster_pic_query);
                                                    confirm_query($poster_pic_result);
                                                    $poster_pic = mysqli_fetch_assoc($poster_pic_result);
                                                    
                                if ($poster_pic["proset"]==0) { 
                            ?>
                                    <img src="assets/images/nopic.png" height="44px" width="44px" alt="" class="img-circle" />
                            <?php
                                } elseif ($poster_pic["proset"]==1) {
                                         $imageid=$poster_pic['id'];
                                        $dpcounter=$poster_pic['dpcounter'];
                                        //echo '<img src="data:image/jpeg;base64,' . base64_encode($name_title['data_propic']) . '" class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>'; 
                                        if($dpcounter>0)
                                             echo '<img src="images/' . $imageid."_".$dpcounter . '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                         else   
                                            echo '<img src="images/' . $imageid . '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                }
                            ?>
                                                </div>
                                                <div class="user-comment-content" style="color: black;">
                                                    <div class="user-comment-name">
                                                        <?php echo ucfirst($poster_pic['sname']); ?>
                                                    </div>
                                                    <?php 
                                                        //echo ucfirst($view_comment['answer']); 
                                                        $pattern = '#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si';
                                                        $str =ucfirst(ucfirst($view_comment['comment']));
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
                                                    <div class="user-comment-meta">
                                                        <a href="#" class="comment-date">
                                                        <?php 
                                                            $post_time = strtotime($view_comment['comment_time']);
                                                            echo date("d M, y | h:i a", $post_time);
                                                         ?>
                                                        </a> 
                                                        <!-- <a href="#">
                                                            <i class="entypo-heart"></i> Like <span>(2)</span>
                                                        </a> -->
                                                        
                                                        <!-- <a href="#">
                                                            <i class="entypo-comment"></i> Reply
                                                        </a> -->
                                                    </div>
                                                </div>
                                            </li> </div><?php
                                                }
                                                    
                                   } ?>    <!-- coment post end -->
                                   <div <?php echo $view; ?> >
                                            <li class="comment-form">
                                                <div class="user-comment-thumb">
                                                    <?php
                                if ($name_title["proset"]==0) { 
                            ?>
                                    <img src="assets/images/nopic.png" height="44px" width="44px" alt="" class="img-circle" />
                            <?php
                                } elseif ($name_title["proset"]==1) {
                                       $imageid=$name_title['id'];
                                        $dpcounter=$name_title['dpcounter'];
                                        //echo '<img src="data:image/jpeg;base64,' . base64_encode($name_title['data_propic']) . '" class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>'; 
                                          if($dpcounter>0)
                                        echo '<img src="images/' . $imageid."_".$dpcounter . '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                        else
                                        echo '<img src="images/' . $imageid. '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                }
                            ?>
                                                </div>
                                                <div class="user-comment-content" style="color: black;">
                                                <form method="post" action="arab_comments.php?id=<?php echo urlencode($_GET["id"]); ?>">
                                                    <textarea style="padding-right: 70px;" class="form-control autogrow" name="comment" value="" required placeholder="Write a comment..."></textarea>
                                                    <input type="submit" name="submit" class="btn btn-info" style="background-color: #333; color: white; margin-top: 2px;"> 
                                                </div> </div>
                                            </li>
                                        </ul>
                                    </footer>
                                    <!-- separator -->
                                    <hr />
                                </div>
                            </article>
                        </div>
                    </section>
                </div>
            </div>
            <footer>
            </footer>
        </div>
    </div>
    <script src="assets/js/modernizr.custom.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/TweenMax.min.js"></script>
    <script src="assets/js/style-demo.js"></script>
    <script src="assets/js/style-custom.js"></script>
    <script src="assets/js/style-api.js"></script>    
    <script src="assets/js/joinable.js"></script>
    <script src="assets/js/resizeable.js"></script>
    

     <script type="text/javascript">
        
        
        $(document).ready(function(){
           //alert("hello");
            $('.answerdelete').on('click',function()
            {
                var username=$(this).children(".deleteregn").val();
                var confirm1=confirm("Are you sure?");
                if(confirm1==1)
               {
                $.ajax({
                    method: "POST",
                    url: "delete_comment.php",
                    data: {username:username}
                    })
                    .done(function(data){
                        //alert(data);
                        $("#"+username).hide(100);
                    });
                }

                return false;

                
            });
            
        });
        
    </script> 
</body>

</html>
<?php
    
    if (isset ($conn)){
            mysqli_close($conn);
    }
?>

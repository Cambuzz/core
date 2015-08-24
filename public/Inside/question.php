<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php $answer_set = find_all_answers(); ?>
<?php
    $current_user = $_SESSION["username"];
    $name_query = "SELECT * FROM users WHERE username = '{$current_user}' LIMIT 1";
    $name_result = mysqli_query($conn, $name_query);
    confirm_query($name_result);
    $name_title = mysqli_fetch_assoc($name_result);
    $first_name = explode(" ", $name_title['sname']);
    $current_id = $name_title['id'];
    $slang_query = "SELECT * FROM slangs";
    $slang_result = mysqli_query($conn, $slang_query);
    confirm_query($slang_result);  
?>
<?php
$current_user = $_SESSION["username"];
$name_query = "SELECT * FROM users WHERE username = '{$current_user}' LIMIT 1";
$name_result = mysqli_query($conn, $name_query);
confirm_query($name_result);
$name_title = mysqli_fetch_assoc($name_result);
?>
<?php
$question = find_question_by_id($_GET["id"]);
if (!$question) {
    redirect_to("quora.php");
}

$id = $question["id"];
$query = "SELECT * FROM quora WHERE id = {$id} LIMIT 1";
$result = mysqli_query($conn, $query);
$view_quest = mysqli_fetch_assoc($result);
if($current_user==$view_quest["quest_user"] &&  $view_quest['comment_counter']>0)
{
    $counter = $view_quest['comment_counter'];
    $comment_counter = $counter-1;    
        
    $query_counter = "UPDATE quora SET comment_counter = {$comment_counter} WHERE id = {$id}";
    $result_counter = mysqli_query($conn, $query_counter);    
}
$query_post_answer = "SELECT * FROM answers WHERE qid = {$id}";
$result_post_answer = mysqli_query($conn, $query_post_answer); ?>
<?php   
if ((isset($_POST['submit']))&&(isset($_POST['answer']))) {
    $flag=1;    
    while ($slang_list = mysqli_fetch_assoc($slang_result)) {
        $s1 = $slang_list['COL 1'];
        $s2 = $_POST['answer'];
        $s=$s1." ".$s2;
        //echo $s;echo "<br>";
        $n= strlen($s);
        $m = strlen($s1);    
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
        $flag=1;    
        for ($i=1; $i < $n ; $i++) { 
            if ($Z[$i]>=$m) {
                //echo "no abuse";echo "<br>";
                $flag=0;
                break;
            }
        }
        if($flag==0)break;                               
    }
    if ($flag==1) {
        $qid = $question["id"];
        $answer = mysqli_real_escape_string($conn, $_POST["answer"]);
        $answer_poster = $current_user;
        date_default_timezone_set('Asia/Calcutta');
        $answer_time = date("Y-m-d\TH:i:s");
        if($current_user!=$view_quest["quest_user"])
        {
            $counter = $view_quest['comment_counter'];
            $comment_counter = $counter+1;    
            $query_counter = "UPDATE quora SET comment_counter = {$comment_counter} WHERE id = {$id}";
            $result_counter = mysqli_query($conn, $query_counter);
        }
        $query_answer = "INSERT INTO answers (qid, answer, answer_poster, answer_time) VALUES ('{$qid}', '{$answer}', '{$answer_poster}', '{$answer_time}')";
        $result_answer = mysqli_query($conn, $query_answer);

        if ($result_answer && mysqli_affected_rows($conn) == 1) {
            redirect_to("question.php?id=$id");
        }       
    }
}
       

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Cambuzz" />
    <meta name="author" content="" />
    <title>Cambuzz</title>
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
                            <?php
                                if ($name_title["proset"]==0) { 
                            ?>
                                    <img src="assets/images/nopic.png" class="img-circle" height="200px" width="100px" style="border-radius: 100%;" />
                            <?php
                                } elseif ($name_title["proset"]==1) {
                                        $imageid=$name_title['id'];

                                        //echo '<img src="data:image/jpeg;base64,' . base64_encode($name_title['data_propic']) . '" class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>'; 
                                        
                                        echo '<img src="images/' . $imageid . '.jpg "class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>';
                                }
                            ?>
                            <span>Welcome,</span>
                            <strong><?php echo ucfirst($first_name[0]); ?></strong>
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
                                        $pic_query = "SELECT * FROM users WHERE username = '{$view_quest['quest_user']}' LIMIT 1";
                                        $pic_result = mysqli_query($conn, $pic_query);
                                        confirm_query($pic_result);
                                        $pic = mysqli_fetch_assoc($pic_result);
                                        
                               
                                if ($pic["proset"]==0) { 
                            ?>
                                    <img src="assets/images/nopic.png" height="44px" width="44px" alt="" class="img-circle" />
                            <?php
                                } elseif ($pic["proset"]==1) {
                                        $imageid=$pic['id'];

                                        //echo '<img src="data:image/jpeg;base64,' . base64_encode($name_title['data_propic']) . '" class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>'; 
                                        
                                        echo '<img src="images/' . $imageid . '.jpg "height="44px" width="44px" alt="" class="img-circle">';
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
                                                $post_time = strtotime($view_quest['quest_time']);
                                                echo date("d M, y | h:i a", $post_time);
                                            ?>
                                            </em>                                                                                
                                        </div>
                                    </header>
                                    <div class="story-main-content">
                                        <p style="font-size: 20px; line-height: 1.3; sans-serif; font-weight:bold; color: black;"><?php echo ucfirst($view_quest['question']); ?></p>
                                    </div>
                                    <h1></h1>
                                    <!-- story like and comment link -->
                                    <footer>
                                        <!-- <a href="#" class="liked">
                                            <i class="entypo-heart"></i> Liked <span>(8)</span>
                                        </a> -->
                                        <a href="question.php">
                                            <i class="entypo-comment"></i> Comment <span>(
                                            <?php
                                            $count_query = "SELECT COUNT(*) FROM answers WHERE qid = {$id}";
                                            $count_result = mysqli_query($conn, $count_query);
                                            confirm_query($count_result);
                                            $row = mysqli_fetch_array($count_result);
                                            $total = $row[0];
                                            echo $total;
                                            ?>
                                            )</span>
                                        </a>
                                        <!-- story comments -->
                                        <ul class="comments">
                                        <?php
                                        while ($view_answer = mysqli_fetch_assoc($result_post_answer)) { ?>
                                            <div id=<?php echo $view_answer["id"]?> >
                                            <li> <!-- coment post begin -->
                                                <div class="user-comment-thumb">
                                                <?php if ($view_answer['answer_poster']==$current_user) {
                                                            $poster_pic_query = "SELECT * FROM users WHERE username = '{$view_answer['answer_poster']}' LIMIT 1";
                                                            $poster_pic_result = mysqli_query($conn, $poster_pic_query);
                                                            confirm_query($poster_pic_result);
                                                            $poster_pic = mysqli_fetch_assoc($poster_pic_result);
                                                            
                                
                                if ($poster_pic["proset"]==0) { 
                            ?>
                                    <img src="assets/images/nopic.png" height="44px" width="44px" alt="" class="img-circle" />
                            <?php
                                } elseif ($poster_pic["proset"]==1) {
                                        $imageid=$poster_pic['id'];

                                        //echo '<img src="data:image/jpeg;base64,' . base64_encode($name_title['data_propic']) . '" class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>'; 
                                        
                                        echo '<img src="images/' . $imageid . '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                }
                            ?>
                                                </div>
                                                <div class="user-comment-content">
                                                    <div class="user-comment-name">
                                                        <?php echo ucfirst($poster_pic['sname']); ?>
                                                    </div>
                                                    <?php echo ucfirst($view_answer['answer']); ?>
                                                    <div class="user-comment-meta">
                                                        <a href="#" class="comment-date">
                                                        <?php 
                                                            $post_time = strtotime($view_answer['answer_time']);
                                                            echo date("d M, y | h:i a", $post_time);
                                                            $answer_id=$view_answer['id'];
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
                                               <form class="answerdelete"><input type="text" class="deleteregn" style="display:none" value=<?php echo $answer_id?> ><a href="#" class="deletelink" id="$answer_id"  >Delete</a></form>
                                            </li></div> <?php
                                                } else {
                                                    $poster_pic_query = "SELECT * FROM users WHERE username = '{$view_answer['answer_poster']}' LIMIT 1";
                                                    $poster_pic_result = mysqli_query($conn, $poster_pic_query);
                                                    confirm_query($poster_pic_result);
                                                    $poster_pic = mysqli_fetch_assoc($poster_pic_result);
                                                    
                                if ($poster_pic["proset"]==0) { 
                            ?>
                                    <img src="assets/images/nopic.png" height="44px" width="44px" alt="" class="img-circle" />
                            <?php
                                } elseif ($poster_pic["proset"]==1) {
                                        $imageid=$poster_pic['id'];

                                        //echo '<img src="data:image/jpeg;base64,' . base64_encode($name_title['data_propic']) . '" class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>'; 
                                        
                                        echo '<img src="images/' . $imageid . '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                }
                            ?>
                                                </div>
                                                <div class="user-comment-content">
                                                    <div class="user-comment-name">
                                                        <?php echo ucfirst($poster_pic['sname']); ?>
                                                    </div>
                                                    <?php echo ucfirst($view_answer['answer']); ?>
                                                    <div class="user-comment-meta">
                                                        <a href="#" class="comment-date">
                                                        <?php 
                                                            $post_time = strtotime($view_answer['answer_time']);
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
                                            <li class="comment-form">
                                                <div class="user-comment-thumb">
                                                    <?php
                                if ($name_title["proset"]==0) { 
                            ?>
                                    <img src="assets/images/nopic.png" height="44px" width="44px" alt="" class="img-circle" />
                            <?php
                                } elseif ($name_title["proset"]==1) {
                                        $imageid=$name_title['id'];

                                        //echo '<img src="data:image/jpeg;base64,' . base64_encode($name_title['data_propic']) . '" class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>'; 
                                        
                                        echo '<img src="images/' . $imageid . '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                }
                            ?>
                                                </div>
                                                <div class="user-comment-content">
                                                <form method="post" action="question.php?id=<?php echo urlencode($_GET["id"]); ?>">
                                                    <textarea style="padding-right: 70px;" class="form-control autogrow" name="answer" value="" required placeholder="Write a comment..."></textarea>
                                                    <input type="submit" name="submit" class="btn btn-info" style="background-color: #333; color: white; margin-top: 2px;"> 
                                                </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="assets/js/style-demo.js"></script>
    <script src="assets/js/style-custom.js"></script>
    <script src="assets/js/style-api.js"></script>    
    <script src="assets/js/modernizr.custom.js"></script>    
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/TweenMax.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>


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
                    url: "delete_answer.php",
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
    mysqli_free_result($name_result);
    if (isset ($conn)){
            mysqli_close($conn);
    }
?>

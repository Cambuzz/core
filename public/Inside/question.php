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

$query_post_answer = "SELECT * FROM answers WHERE qid = {$id}";
$result_post_answer = mysqli_query($conn, $query_post_answer); ?>
<?php   
if ((isset($_POST['submit']))&&(isset($_POST['answer']))) {
    
        $qid = $question["id"];
        $answer = $_POST['answer'];
        $answer_poster = $current_user;
        date_default_timezone_set('Asia/Calcutta');
        $answer_time = date("Y-m-d\TH:i:s");
        $query_answer = "INSERT INTO answers (qid, answer, answer_poster, answer_time) VALUES ('{$qid}', '{$answer}', '{$answer_poster}', '{$answer_time}')";
        $result_answer = mysqli_query($conn, $query_answer);

        if ($result_answer && mysqli_affected_rows($conn) == 1) {
            redirect_to("question.php?id=$id");
        } else {
            $_SESSION["message"] = "Answer posting failed.";
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
     
    <link rel="stylesheet" type="text/css" href="assets/css/buttoncreatebuzz.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style-core.css">
    <link rel="stylesheet" href="assets/css/style-theme.css">
    <link rel="stylesheet" href="assets/css/style-forms.css">
    <link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css" />
    <script>
    $.noConflict();
    </script>
    
</head>

<body class="page-body page-fade-only">
    <div class="page-container">
        <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
        <div class="sidebar-menu">
            <div class="sidebar-menu-inner">
                <header class="logo-env">
                    <!-- logo -->
                    <div class="logo">
                        <a href="index.html">
                            <h1 style="font-family: 'Pacifico', sans-serif; font-weight: 200px; color: white; margin-top: -2px; font-size:25px;">vitcc campbuzz</h1>
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
                                if (empty($name_title["data_propic"])) { 
                            ?>
                                    <img src="assets/images/nopic.png" class="img-circle" height="200px" width="100px" style="border-radius: 100%;" />
                            <?php
                                } elseif (isset($name_title["data_propic"])) {
                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($name_title['data_propic']) . '" class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>';        
                                }
                            ?>
                            <span>Welcome,</span>
                            <strong><?php echo htmlentities($first_name[0]); ?></strong>
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
                                        if (empty($pic["data_propic"])) { 
                                        ?>
                                            <img src="assets/images/nopic.png" class="img-circle" height="44px" width="44px" />
                                        <?php
                                        } elseif (isset($pic["data_propic"])) {
                                            echo '<img src="data:image/jpeg;base64,' . base64_encode($pic['data_propic']) . '" class="img-circle" height="44px" width="44px" />';        
                                        }
                                        ?>
                                    </a>
                                </aside>
                                <div class="story-content">
                                    <!-- story header -->
                                    <header>
                                        <div class="publisher">
                                            <a href="#"><?php echo $pic['sname']; ?>
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
                                        <p style="font-size: 40px; line-height: 1; font-family:'Montserrat', sans-serif; font-weight:bold; color: black;"><?php echo $view_quest['question']; ?></p>
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
                                            <li> <!-- coment post begin -->
                                                <div class="user-comment-thumb">
                                                <?php if ($view_answer['answer_poster']==$current_user) {
                                                            $poster_pic_query = "SELECT * FROM users WHERE username = '{$view_answer['answer_poster']}' LIMIT 1";
                                                            $poster_pic_result = mysqli_query($conn, $poster_pic_query);
                                                            confirm_query($poster_pic_result);
                                                            $poster_pic = mysqli_fetch_assoc($poster_pic_result);
                                                            if (empty($poster_pic["data_propic"])) { 
                                                            ?>
                                                                <img src="assets/images/nopic.png" class="img-circle" height="44px" width="44px" />
                                                            <?php
                                                            } elseif (isset($poster_pic["data_propic"])) {
                                                                echo '<img src="data:image/jpeg;base64,' . base64_encode($poster_pic['data_propic']) . '" class="img-circle" height="44px" width="44px" />';        
                                                            }
                                                            ?>
                                                </div>
                                                <div class="user-comment-content">
                                                    <div class="user-comment-name">
                                                        <?php echo $poster_pic['sname']; ?>
                                                    </div>
                                                    <?php echo $view_answer['answer']; ?>
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
                                                <a href="delete_answer.php?id=<?php echo urlencode($view_answer["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a>
                                            </li> <?php
                                                } else {
                                                    $poster_pic_query = "SELECT * FROM users WHERE username = '{$view_answer['answer_poster']}' LIMIT 1";
                                                    $poster_pic_result = mysqli_query($conn, $poster_pic_query);
                                                    confirm_query($poster_pic_result);
                                                    $poster_pic = mysqli_fetch_assoc($poster_pic_result);
                                                    if (empty($poster_pic["data_propic"])) { 
                                                    ?>
                                                        <img src="assets/images/nopic.png" class="img-circle" height="44px" width="44px" />
                                                    <?php
                                                    } elseif (isset($poster_pic["data_propic"])) {
                                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($poster_pic['data_propic']) . '" class="img-circle" height="44px" width="44px" />';        
                                                    }
                                                    ?>
                                                </div>
                                                <div class="user-comment-content">
                                                    <div class="user-comment-name">
                                                        <?php echo $poster_pic['sname']; ?>
                                                    </div>
                                                    <?php echo $view_answer['answer']; ?>
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
                                            </li> <?php
                                                }
                                                    
                                   } ?>    <!-- coment post end -->
                                            <li class="comment-form">
                                                <div class="user-comment-thumb">
                                                    <?php
                                                        if (empty($name_title["data_propic"])) { 
                                                    ?>
                                                            <img src="assets/images/nopic.png" class="img-circle" height="44px" width="44px" />
                                                    <?php
                                                        } elseif (isset($name_title["data_propic"])) {
                                                                echo '<img src="data:image/jpeg;base64,' . base64_encode($name_title['data_propic']) . '" class="img-circle" height="44px" width="44px" />';        
                                                        }
                                                    ?>
                                                </div>
                                                <div class="user-comment-content">
                                                <form method="post" action="question.php?id=<?php echo urlencode($_GET["id"]); ?>">
                                                    <textarea class="form-control autogrow" name="answer" value="" required placeholder="Write a comment..."></textarea>
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
        <!-- <div class="col-sm-3">
                    <div class="tile-progress tile-red">
                        <div class="tile-header">
                            <h3>Page Views</h3>
                            <span>so far in our blog, and our website.</span>
                        </div>
                        <div class="tile-progressbar">
                            <span data-fill="35.5%"></span>
                        </div>
                        <div class="tile-footer">
                            <h4>
                            <span class="pct-counter">0</span>% increase
                        </h4>
                            <span>so far in our blog and our website</span>
                        </div>
                    </div>
                    <div class="tile-progress tile-green">
                        <div class="tile-header">
                            <h3>Unique Users</h3>
                            <span>so far in our blog, and our website.</span>
                        </div>
                        <div class="tile-progressbar">
                            <span data-fill="51.2%"></span>
                        </div>
                        <div class="tile-footer">
                            <h4>
                            <span class="pct-counter">0</span>% increase
                        </h4>
                            <span>so far in our blog and our website</span>
                        </div>
                    </div>
                    <div class="tile-progress tile-aqua">
                        <div class="tile-header">
                            <h3>Bounce Rate</h3>
                            <span>so far in our blog, and our website.</span>
                        </div>
                        <div class="tile-progressbar">
                            <span data-fill="69.9%"></span>
                        </div>
                        <div class="tile-footer">
                            <h4>
                            <span class="pct-counter">0</span>% increase
                        </h4>
                            <span>so far in our blog and our website</span>
                        </div>
                    </div>
                </div> -->
        <!-- Footer -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="assets/js/style-demo.js"></script>
    <script src="assets/js/style-custom.js"></script>
    <script src="assets/js/style-api.js"></script>    
    <script src="assets/js/modernizr.custom.js"></script>    
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/TweenMax.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
<?php
    mysqli_free_result($name_result);
    if (isset ($conn)){
            mysqli_close($conn);
    }
?>

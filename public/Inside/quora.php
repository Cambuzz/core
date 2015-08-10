<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php $question_set = find_all_questions(); ?>
<?php
    $current_user = $_SESSION["username"];
    $name_query = "SELECT * FROM users WHERE username = '{$current_user}' LIMIT 1";
    $name_result = mysqli_query($conn, $name_query);
    confirm_query($name_result);
    $name_title = mysqli_fetch_assoc($name_result);
    $first_name = explode(" ", $name_title['sname']);
    
?>
<?php
    if (isset($_POST['submit'])) {
        if (isset($_POST['question'])) {
            
                $question = $_POST['question'];
                $quest_user = $current_user;
                date_default_timezone_set('Asia/Calcutta');
                $quest_time = date("Y-m-d\TH:i:s");
                $query = "INSERT INTO quora (question, quest_user, quest_time) VALUES ('{$question}', '{$quest_user}', '{$quest_time}')";
                $sql = mysqli_query($conn, $query);
                redirect_to("quora.php"); 
                        
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
   <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style-core.css">
    <link rel="stylesheet" href="assets/css/style-theme.css">
    <link rel="stylesheet" href="assets/css/style-forms.css">
    
    <!-- Buzz button -->
    <link rel="stylesheet" type="text/css" href="assets/css/buttoncreatebuzz.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/normalize.css" />
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">

    <script>
    $.noConflict();
    </script>
    </head>

<body class="page-body">
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
                <div class="col-md-5 col-sm-4 clearfix hidden-xs" style="float: right;">
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
                            <!-- Search search form -->
					<form method="post" class="search-bar" action="quora.php" enctype="application/x-www-form-urlencoded">
						
						<div class="input-group" style="margin-bottom: 40px;">
							<input type="text" class="form-control input-lg" name="search" required placeholder="Search for any question ...">
							
							<div class="input-group-btn">
								<input type="submit" name="submit_search" value="Search" class="btn btn-lg btn-success btn-icon"><i class="entypo-search"></i>
								
							</div>
						</div>
					</form>
                    <div>
                    <?php
if (isset($_POST['submit_search'])) {
    $search = $_POST['search'];
    $search_query = "SELECT * FROM quora";
    $search_result = mysqli_query($conn, $search_query);
    confirm_query($search_result);

    while ($search_title = mysqli_fetch_assoc($search_result)) { 
        $sent1 = strtolower($search);
        $sent2 = strtolower($search_title['question']);

        $out = explode(" ", $sent1);
        $size_array = sizeof($out);
        for ($m=0; $m < $size_array; $m++) { 
            $sry = array("$out[$m] $sent2");
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
            if ($Z[$i]>=$n2) { ?>

                <?php
                $pic_query = "SELECT * FROM users WHERE username = '{$search_title['quest_user']}' LIMIT 1";
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
                <a href="question.php?id=<?php echo urlencode($search_title["id"]); ?>"><?php echo $search_title['question'];echo "</a>"; ?>
                <?php
                $flag = 1;
            }
            if ($flag==1) {
                break;
            }
        }
    }
    }
}   ?> </div>
                        <form class="profile-post-form" method="post" action="quora.php">
                            <textarea class="form-control autogrow" name="question" placeholder="What do you want to know today?" required style="font-size:15px;"></textarea>
                            <div class="form-options">
                                <div class="post-submit">
                                    <input type="submit" name="submit" value="Ask Question" class="btn btn-success">
                                </div>
                            </div>
                        </form>
                        <!-- ask question -->
                        <div class="profile-stories">
                                                                        
                                            <?php   
                                                while($quest_list = mysqli_fetch_assoc($question_set)) { ?> 
                                                    <article class="story">
                                                        <aside class="user-thumb">
                                                        <a href="#">
                                                        <?php if ($quest_list['quest_user']==$current_user) { ?>
                                                                <?php
                                                                    $pic_query = "SELECT * FROM users WHERE username = '{$quest_list['quest_user']}' LIMIT 1";
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
                                                                        <a href="#"><?php echo $pic['sname'];  ?></a> posted a question
                                                                        <em>
                                                                            <?php 
                                                                                $post_time = strtotime($quest_list['quest_time']);
                                                                                echo date("d M, y | h:i a", $post_time);
                                                                            ?>
                                                                        </em>
                                                                        </div>
                                                                </header>
                                                        <div class="story-main-content">
                                                            <a href="question.php?id=<?php echo urlencode($quest_list["id"]); ?>"><?php echo $quest_list['question'];echo "</a>"; ?></a>
                                                        </div>
                                                        <div class="dropdown" style="float: right;">
                                                            <i class="entypo-pencil"id="dLabel" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <!-- <span class="caret"></span> -->
                                                          </i>
                                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                                <li><a id="edit">Edit</a></li>
                                                                <li><a href="delete_question.php?id=<?php echo urlencode($quest_list["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <footer> <?php
                                                                } else {

                                                                    $pic_query = "SELECT * FROM users WHERE username = '{$quest_list['quest_user']}' LIMIT 1";
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
                                                                        <a href="#"><?php echo $pic['sname'];  ?></a> posted a question
                                                                        <em>
                                                                            <?php 
                                                                                $post_time = strtotime($quest_list['quest_time']);
                                                                                echo date("d M, y | h:i a", $post_time);
                                                                            ?>
                                                                        </em> 
                                                                        </div>
                                                                </header>
                                                        <div class="story-main-content">
                                                            <a href="question.php?id=<?php echo urlencode($quest_list["id"]); ?>"><?php echo $quest_list['question'];echo "</a>"; ?>
                                                        </div>
                                                        <footer>
                                                            <?php    } ?>
                                                            
                                        <!-- <a href="#" class="liked">
                                            <i class="entypo-heart"></i> Liked <span>(8)</span>
                                        </a> -->
                                        <a id="fuck">
                                            <a href="question.php?id=<?php echo urlencode($quest_list["id"]); ?>"><i class="entypo-comment"></i>Comment <span>(
                                            <?php
                                            $count_query = "SELECT COUNT(*) FROM answers WHERE qid = {$quest_list["id"]}";
                                            $count_result = mysqli_query($conn, $count_query);
                                            confirm_query($count_result);
                                            $row = mysqli_fetch_array($count_result);
                                            $total = $row[0];
                                            echo $total;
                                            ?>
                                            )</span></a>
                                        </a>
                                    </footer>
                                    <div id="show-edit" style="display: none;">
                                     Hello
                                    </div> 
                                    <!-- separator -->
                                </div>
                            </article>
                                            <?php
                                                }   
                                            ?>                                   
                                    
                                    <!-- story like and comment link -->
                                    
                        </div>
                    </section>
                </div>
            </div>
            <footer>
            </footer>
        </div>
    </div>
    <script src="assets/js/modernizr.custom.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="assets/js/fileinput.js"></script>
    <script src="assets/js/style-custom.js"></script>
    <script src="assets/js/style-demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/classie/1.0.1/classie.min.js"></script>

    <!-- Bottom scripts (common) -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/TweenMax.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="assets/js/joinable.js"></script>
    <script src="assets/js/resizeable.js"></script>
    <script src="assets/js/uiMorphingButton_fixed.js"></script>
    <script src="assets/js/style-api.js"></script>
    <script>
    $("#edit").click(function() {
        $("#show-edit").slideToggle("slow");
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
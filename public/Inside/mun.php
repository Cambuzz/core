<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php $post_set = find_all_posts(); ?>
<?php
    if (isset($_SESSION["username"])) {
        $current_user = $_SESSION["username"];
        $name_query = "SELECT * FROM users WHERE username = '{$current_user}' LIMIT 1";
        $name_result = mysqli_query($conn, $name_query);
        confirm_query($name_result);
        $name_title = mysqli_fetch_assoc($name_result);
        $first_name = explode(" ", $name_title['sname']);
        $current_id = $name_title['id']; 
    } else {
        $current_user = "";
        $current_id = "";
    }    
    date_default_timezone_set('Asia/Calcutta');
    $id_time = date("Y-m-d H-i-s");
    $picture_id = $current_user.$id_time;    
?>
<?php
if (($current_user=="12BEC1096")||($current_user=="cambuzz")) {
    $view = " ";
} else {
    $view = "style='display: none;'";
}
?>
<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['content'])) {
        $content = $_POST['content'];
    } else {
        $content = "";
    }
    //$pix = $_FILES['picture']['name'];       
    if (!empty($_FILES['picture']['name'])) {  
        $picset=1;      
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);                
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["picture"]["tmp_name"],"images/$picture_id.jpg");          
    } else {
        $picset = 0;
    }            
    $post_user = $current_user;
    date_default_timezone_set('Asia/Calcutta');
    $post_time = date("Y-m-d\TH:i:s");
    $query = "INSERT INTO mun (content, picset, post_user, post_time, council) VALUES ('{$content}', {$picset}, '{$post_user}', '{$post_time}', "mun")";
    $sql = mysqli_query($conn, $query);
    $main_query = "INSERT INTO app (content, picset, post_user, post_time, council) VALUES ('{$content}', {$picset}, '{$post_user}', '{$post_time}', "mun")";      
    $main_sql = mysqli_query($conn, $main_query);     
}
$query = "SELECT * FROM mun ORDER BY id DESC";
$result = mysqli_query($conn, $query);
confirm_query($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Login or Signup on Cambuzz. Buzz new events, Track your teacher or ask a question.">
    <meta name="keywords" content="Buzz, Events, Cambuzz, Track, Teacher, Question, Campus, Centralized information system">
    <meta name="author" content="Team Cambuzz">
    <title>Ask a Question</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style-core.css">
    <link rel="stylesheet" href="assets/css/style-theme.css">
    <link rel="stylesheet" href="assets/css/style-forms.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
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
    <style>
    .nav-tabs > li,
    .nav-pills > li {
        float: none;
        display: inline-block;
        /* ie7 fix */
        zoom: 1;
        /* hasLayout ie7 trigger */
    }
    
    .nav-tabs,
    .nav-pills {
        text-align: center;
    }
     html, body {
    max-width: 100%;
    overflow-x: hidden;
    }
    </style>
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
                            <span>Welcome</span>
                            <strong></strong>
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
                <div class="container" style="width: 970px !important;">
                    <div class="row" style="display: flex; align-items: center; justify-content: center;">
                        <div class="col-md-6">
                            <form method="get" class="search-bar" action="" enctype="application/x-www-form-urlencoded">
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg" name="search" placeholder="Hashtag Search">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-lg btn-success btn-icon">
                                            Search
                                            <i class="entypo-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="container" style="width: 970px !important;"> 
                    <div class="col-md-12">
                        <ul class="nav nav-tabs ">
                            <li class="active">
                                <a href="#intra-vitcmun" data-toggle="tab" style="display: none;">
                                    <span class="visible-xs"><i class="entypo-home"></i></span>
                                    <a href="mun.php"><span class="hidden-xs">Intra&nbsp;VITCMUN</span></a>
                                </a>
                            </li>
                            <li>
                                <a href="#unga-ess" data-toggle="tab">
                                    <span class="visible-xs"><i class="entypo-home"></i></span>
                                    <a href="ess.php"><span class="hidden-xs">UNGA&nbsp;ESS</span></a>
                                </a>
                            </li>
                            <li>
                                <a href="#unoosa" data-toggle="tab">
                                    <span class="visible-xs"><i class="entypo-user"></i></span>
                                    <a href="oosa.php"><span class="hidden-xs">UNOOSA</span></a>
                                </a>
                            </li>
                            <li>
                                <a href="#unhrc" data-toggle="tab">
                                    <span class="visible-xs"><i class="entypo-mail"></i></span>
                                    <a href="hrc.php"><span class="hidden-xs">UNHRC</span></a>
                                </a>
                            </li>
                            <li>
                                <a href="#arab-league" data-toggle="tab">
                                    <span class="visible-xs"><i class="entypo-cog"></i></span>
                                    <a href="arab.php"><span class="hidden-xs">Arab&nbsp;League</span></a>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="intra-vitcmun">
                                <div class="profile-env">
                                    <section class="profile-feed">
                                        <!-- profile post form -->
                                        <div <?php echo $view; ?> >
                                        <form class="profile-post-form" method="post" action="mun.php" enctype="multipart/form-data">
                                            <textarea class="form-control autogrow" name="content" placeholder="Intra VITCMUN Post"></textarea>
                                            <div class="form-options">
                                                <div class="post-type">
                                                    <a href="#" class="tooltip-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Upload a Picture">
                                                    <input type="file" name="picture" accept=".jpeg, .jpg, .bmp, .png" id="picture" >
                                                        <i class="entypo-camera"></i>
                                                    </a>
                                                    <a href="#" class="tooltip-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Attach a file">
                                                        <i class="entypo-attach"></i>
                                                    </a>
                                                </div>
                                                <div class="post-submit">
                                                    <input type="submit" name="submit" value="Post" class="btn btn-success">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                        <!-- profile stories -->
                                        <div class="profile-stories">
                                            <article class="story">                                                
                                                <div class="story-content">
                                                    <!-- story header -->

                                                <?php                                                
                                                    while ($mun_list = mysqli_fetch_assoc($result)) { ?>
                                                        <article class="story">
                                                        <aside class="user-thumb">
                                                        <a href="#">
                                                        <?php 
                                                        $pic_query = "SELECT * FROM users WHERE username = '{$mun_list['post_user']}' LIMIT 1";
                                                        $pic_result = mysqli_query($conn, $pic_query);
                                                        confirm_query($pic_result);
                                                        $pic = mysqli_fetch_assoc($pic_result); 
                                                        if ($pic["proset"]==0) { ?>
                                                            <img src="assets/images/nopic.png" height="44px" width="44px" alt="" class="img-circle" />
                                                        <?php
                                                        } elseif ($pic["proset"]==1) {
                                                            $imageid=$pic['id'];
                                                            $dpcounter=$pic['dpcounter'];                                         
                                                            if($dpcounter>0)
                                                                echo '<img src="images/' . $imageid."_".$dpcounter . '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                                            else
                                                                echo '<img src="images/' . $imageid. '.jpg "height="44px" width="44px" alt="" class="img-circle">';
                                                        } ?>
                                                        </a>
                                                        </aside>
                                                        <div class="story-content">
                                        <!-- story header -->
                                                            <header>
                                                                <div class="publisher">
                                                                    <a href="#"><?php echo ucfirst(ucfirst($pic['sname']));  ?></a> posted a buzz
                                                                    <em>
                                                                        <?php 
                                                                            $post_time = strtotime($mun_list['post_time']);
                                                                            echo date("d M, y | h:i a", $post_time);
                                                                        ?>
                                                                    </em>
                                                                </div>
                                                                <div <?php echo $view; ?> >
                                                            <div class="dropdown" style="float: right;">
                                                            <i class="entypo-pencil"id="dLabel" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <!-- <span class="caret"></span> -->
                                                          </i>
                                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                                <li><a href="javascript:;" onclick="modalshow(<?php echo $mun_list['id'];?>);">Edit</a></li>
                                                                <li><a href="delete_content.php?id=<?php echo urlencode($mun_list["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                            </header>

                                                        <div class="story-main-content">
                                                        <p>                                                            
                                                            <?php           
                                                                $str=$mun_list['content'];
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
                                                                                                                 
                                                                echo ucfirst($disp);  
                                                                if ($mun_list['picset']==1) {                                                                                                                             
                                                                    $poster_time = strtotime($mun_list['post_time']);                                                    
                                                                    $posterid=$mun_list['post_user'].date("Y-m-d H-i-s", $poster_time);                                                                                                      
                                                                    echo '<img src="images/' . $posterid . '.jpg "class="img-responsive">';                                                                
                                                                } 
                                                            ?>
                                                        </p>
                                                        </div>                                                        
                                                        <footer>
                                                        <a href="mun_comment.php?id=<?php echo urlencode($mun_list["id"]); ?>">
                                                        <i class="entypo-comment"></i>
                                                        <?php                                                                
                                                            echo "Comment <span> (";
                                                            $count_query = "SELECT COUNT(*) FROM comments WHERE pid = {$mun_list["id"]}";
                                                            $count_result = mysqli_query($conn, $count_query);
                                                            confirm_query($count_result);
                                                            $row = mysqli_fetch_array($count_result);
                                                            $total = $row[0];
                                                            echo $total;
                                                            echo ")</span>";
                                                            echo "</a>";
                                                        ?>
                                                    </footer>                                                    
                                                    <hr/>                                                    
                                                    </div>                                                    
                                            </article>
                                            <?php                                                
                                                }
                                            ?>                                                           
                                        </div>
                                    </section>
                                </div>
                            </div>                                                    
                            <div class="tab-pane" id="unga-ess">
                               <div class="profile-env">
                                    <section class="profile-feed">
                                        <!-- profile post form -->
                                        <div <?php echo $view; ?> >
                                        <form class="profile-post-form" method="post">
                                            <textarea class="form-control autogrow" placeholder="UNGA-ESS"></textarea>
                                            <div class="form-options">
                                                <div class="post-type">
                                                    <a href="#" class="tooltip-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Upload a Picture">
                                                        <i class="entypo-camera"></i>
                                                    </a>
                                                    <a href="#" class="tooltip-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Attach a file">
                                                        <i class="entypo-attach"></i>
                                                    </a>
                                                </div>
                                                <div class="post-submit">
                                                    <button type="button" class="btn btn-success">POST</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                        <!-- profile stories -->
                                        <div class="profile-stories">
                                            <article class="story">
                                                <aside class="user-thumb">
                                                    <a href="#">
                                                        <img src="assets/images/thumb-1.png" alt="" class="img-circle" />
                                                    </a>
                                                </aside>
                                                <div class="story-content">
                                                    <!-- story header -->
                                                    <header>
                                                        <div class="publisher">
                                                            <a href="#">Prashant Kumar Bhardwaj</a> posted a status update
                                                            <em>3 hours ago</em>
                                                        </div>
                                                    </header>
                                                    <div class="story-main-content">
                                                        <p>Hello </p>
                                                    </div>
                                                    <!-- story like and comment link -->
                                                    <footer>
                                                        <a href="#">
                                                            <i class="entypo-comment"></i> Comment <span>(12)</span>
                                                        </a>
                                                        <!-- story comments -->
                                                    </footer>
                                                    <!-- separator -->
                                                    <hr />
                                                </div>
                                            </article>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <div class="tab-pane" id="unoosa">
                                <div class="profile-env">
                                    <section class="profile-feed">
                                        <!-- profile post form -->
                                        <div <?php echo $view; ?> >
                                        <form class="profile-post-form" method="post">
                                            <textarea class="form-control autogrow" placeholder="UNOOSA"></textarea>
                                            <div class="form-options">
                                                <div class="post-type">
                                                    <a href="#" class="tooltip-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Upload a Picture">
                                                        <i class="entypo-camera"></i>
                                                    </a>
                                                    <a href="#" class="tooltip-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Attach a file">
                                                        <i class="entypo-attach"></i>
                                                    </a>
                                                </div>
                                                <div class="post-submit">
                                                    <button type="button" class="btn btn-success">POST</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                        <!-- profile stories -->
                                        <div class="profile-stories">
                                            <article class="story">
                                                <aside class="user-thumb">
                                                    <a href="#">
                                                        <img src="assets/images/thumb-1.png" alt="" class="img-circle" />
                                                    </a>
                                                </aside>
                                                <div class="story-content">
                                                    <!-- story header -->
                                                    <header>
                                                        <div class="publisher">
                                                            <a href="#">Prashant Kumar Bhardwaj</a> posted a status update
                                                            <em>3 hours ago</em>
                                                        </div>
                                                    </header>
                                                    <div class="story-main-content">
                                                        <p>Hello </p>
                                                    </div>
                                                    <!-- story like and comment link -->
                                                    <footer>
                                                        <a href="#">
                                                            <i class="entypo-comment"></i> Comment <span>(12)</span>
                                                        </a>
                                                        <!-- story comments -->
                                                    </footer>
                                                    <!-- separator -->
                                                    <hr />
                                                </div>
                                            </article>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <div class="tab-pane" id="unhrc">
                                <div class="profile-env">
                                    <section class="profile-feed">
                                        <!-- profile post form -->
                                        <div <?php echo $view; ?> >
                                        <form class="profile-post-form" method="post">
                                            <textarea class="form-control autogrow" placeholder="UNHRC"></textarea>
                                            <div class="form-options">
                                                <div class="post-type">
                                                    <a href="#" class="tooltip-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Upload a Picture">
                                                        <i class="entypo-camera"></i>
                                                    </a>
                                                    <a href="#" class="tooltip-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Attach a file">
                                                        <i class="entypo-attach"></i>
                                                    </a>
                                                </div>
                                                <div class="post-submit">
                                                    <button type="button" class="btn btn-success">POST</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                        <!-- profile stories -->
                                        <div class="profile-stories">
                                            <article class="story">
                                                <aside class="user-thumb">
                                                    <a href="#">
                                                        <img src="assets/images/thumb-1.png" alt="" class="img-circle" />
                                                    </a>
                                                </aside>
                                                <div class="story-content">
                                                    <!-- story header -->
                                                    <header>
                                                        <div class="publisher">
                                                            <a href="#">Prashant Kumar Bhardwaj</a> posted a status update
                                                            <em>3 hours ago</em>
                                                        </div>
                                                    </header>
                                                    <div class="story-main-content">
                                                        <p>Hello </p>
                                                    </div>
                                                    <!-- story like and comment link -->
                                                    <footer>
                                                        <a href="#">
                                                            <i class="entypo-comment"></i> Comment <span>(12)</span>
                                                        </a>
                                                        <!-- story comments -->
                                                    </footer>
                                                    <!-- separator -->
                                                    <hr />
                                                </div>
                                            </article>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <div class="tab-pane" id="arab-league">
                                <div class="profile-env">
                                    <section class="profile-feed">
                                        <!-- profile post form -->
                                        <div <?php echo $view; ?> >
                                        <form class="profile-post-form" method="post">
                                            <textarea class="form-control autogrow" placeholder="Arab League"></textarea>
                                            <div class="form-options">
                                                <div class="post-type">
                                                    <a href="#" class="tooltip-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Upload a Picture">
                                                        <i class="entypo-camera"></i>
                                                    </a>
                                                    <a href="#" class="tooltip-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Attach a file">
                                                        <i class="entypo-attach"></i>
                                                    </a>
                                                </div>
                                                <div class="post-submit">
                                                    <button type="button" class="btn btn-success">POST</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                        <!-- profile stories -->
                                        <div class="profile-stories">
                                            <article class="story">
                                                <aside class="user-thumb">
                                                    <a href="#">
                                                        <img src="assets/images/thumb-1.png" alt="" class="img-circle" />
                                                    </a>
                                                </aside>
                                                <div class="story-content">
                                                    <!-- story header -->
                                                    <header>
                                                        <div class="publisher">
                                                            <a href="#">Prashant Kumar Bhardwaj</a> posted a status update
                                                            <em>3 hours ago</em>
                                                        </div>
                                                    </header>
                                                    <div class="story-main-content">
                                                        <p>Hello </p>
                                                    </div>
                                                    <!-- story like and comment link -->
                                                    <footer>
                                                        <a href="#">
                                                            <i class="entypo-comment"></i> Comment <span>(12)</span>
                                                        </a>
                                                        <!-- story comments -->
                                                    </footer>
                                                    <!-- separator -->
                                                    <hr />
                                                </div>
                                            </article>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-env">
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
    <div class="modal" id="modal-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit question</h4>
                </div>
                <div class="modal-body">
                    <form class="modalform">
                        <textarea class="form-control autogrow" name="question" placeholder="What do you want to know today?" required style="font-size:15px;" class="questioncontent"></textarea>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                    <button type="submit" class="btn btn-info">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Search Results</h4>
                </div>
                <div class="modal-body">
                    Question-1
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    var file = document.getElementById('picture');

    file.onchange = function(e){
        var ext = this.value.match(/\.([^\.]+)$/)[1];
        switch(ext)
        {
            case 'jpg':
            case 'jpeg':
            case 'bmp':
            case 'png':
            case 'tif':
            case 'JPG':
            case 'JPEG':
            case 'BMP':
            case 'PNG':
            case 'TIF':
            
            break;
            default:
            alert('File type not supported, please select an image file.');
            this.value='';
        }
    };
    </script>
</body>
</html>
<?php
    //mysqli_free_result($name_result);
    if (isset ($conn)){
        mysqli_close($conn);
    }
?>
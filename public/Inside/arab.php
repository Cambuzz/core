<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php $arab = find_all_arabs(); ?>
<?php
    if (isset($_SESSION["username"])) {
        $current_user = $_SESSION["username"];
        $name_query = "SELECT * FROM users WHERE username = '{$current_user}' LIMIT 1";
        $name_result = mysqli_query($conn, $name_query);
        confirm_query($name_result);
        $name_title = mysqli_fetch_assoc($name_result);
        $first_name = explode(" ", $name_title['sname']);
        $current_id = $name_title['id']; 
        $viewlog = " ";
        $viewlog1 = "style='display:none;'";
    } else {
        $current_user = "";
        $current_id = "";
        $viewlog = "style='display:none;'";
        $viewlog1 = " ";
    }    
    date_default_timezone_set('Asia/Calcutta');
    $id_time = date("Y-m-d H-i-s");
    $picture_id = $current_user.$id_time;
    $id_year = date("Y-m-d");
    $id_hour = date("H-i-s");
    $full_time = $id_year."%20".$id_hour;
    $full = $current_user.$full_time;     
?>
<?php
if (($current_user=="12BEC1096")||($current_user=="cambuzz")||($current_user=="VITCMUN")||($current_user=="UNGAESS")||($current_user=="UNOOSA")||($current_user=="UNHRC")||($current_user=="ARABLEAGUE")||($current_user=="EB-VITCMUN")||($current_user=="EB-UNGAESS")||($current_user=="EB-UNOOSA")||($current_user=="EB-UNHRC")||($current_user=="EB-ARABLEAGUE")||($current_user=="13BEE1163")||($current_user=="13BEC1028")) {
    $view = " ";
} else {
    $view = "style='display: none;'";
}


if(($current_user=="cambuzz")||($current_user=="VITCMUN")||($current_user=="ARABLEAGUE"))
{
    $view1=" ";
}
else
{
    $view1 = "style='display: none;'";
}
?>
<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['content'])) {
        $content = mysqli_real_escape_string($conn,htmlspecialchars($_POST['content']));
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
        $po_url = "http://cambuzz.co.in/public/Inside/images/".$full.".jpg";         
    } else {
        $picset = 0;
        $po_url = "";
    }
    if ($name_title["proset"]==0) { 
        $dp_url = "http://cambuzz.co.in/public/Inside/assets/images/nopic.png";
    } elseif ($name_title["proset"]==1) {
        $imageid=$name_title['id'];
        $dpcounter=$name_title['dpcounter'];
        if($dpcounter>0)
            $dp_url = "http://cambuzz.co.in/public/Inside/images/".$imageid."_".$dpcounter.".jpg";
        else
            $dp_url = "http://cambuzz.co.in/public/Inside/images/".$imageid.".jpg";
        }            
    $post_user = $current_user;
    date_default_timezone_set('Asia/Calcutta');
    $post_time = date("Y-m-d\TH:i:s");
    $query = "INSERT INTO arab (content, picset, post_user, post_time) VALUES ('{$content}', {$picset}, '{$post_user}', '{$post_time}')";
    $sql = mysqli_query($conn, $query);
    $council = "Arab League";
    $main_query = "INSERT INTO app (content, picset, post_user, post_time, council, po_url, dp_url) VALUES ('{$content}', {$picset}, '{$post_user}', '{$post_time}', '{$council}', '{$po_url}', '{$dp_url}')";      
    $main_sql = mysqli_query($conn, $main_query);
}

if((isset($_POST['searchsubmit']))&&(isset($_POST['search'])))
{
    $str1=mysqli_real_escape_string($conn,htmlspecialchars($_POST['search']));
    $str="search_tag.php?word=".urlencode($str1)."";
    redirect_to($str);
}

$query = "SELECT * FROM arab ORDER BY id DESC";
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
    <title>Arab League | Intra MUN</title>
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
    @media (max-width: 767px){
        #phone-logout{
            display: block !important;
        }

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
                    <li>
                            <div <?php echo $viewlog; ?>>
                                <a href="logout.php" class="visible-xs" id="phone-logout">
                                    <i class="entypo-logout"></i>
                                    <span class="title">Logout</span>
                                </a>
                            </div >
                            
                            <div <?php echo $viewlog1; ?>>
                                <a href="index.php" class="visible-xs" id="phone-login">
                                    <i class="entypo-login"></i>
                                    <span class="title">Login</span>
                                </a>
                            </div>
                    </li>

                </ul>
            </div>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-md-5 col-sm-4 clearfix hidden-xs" style="float: right;">
                    <ul class="list-inline links-list pull-right">
                        <!-- Language Selector -->
                        <div <?php echo $viewlog; ?> style="display: flex;">
                            <li>
                                <a href="settings.php" style="margin: 10px;">
                                Settings <i class="entypo-cog right"></i>
                            </a>
                            </li>
                            <li>
                                <a href="logout.php">
                                Log Out <i class="entypo-logout right"></i>
                            </a>
                            </li>
                        </div>                      
                    </ul>
                    <ul class="list-inline links-list pull-right">
                        <div <?php echo $viewlog1; ?> >
                            <li>
                                <a href="../../index.php">
                                Login <i class="entypo-login right"></i>
                            </a>
                            </li>
                           
                        </div> 
                    </ul>

                </div>
            </div>
            <hr />
            <!-- main content starts here -->
            <div class="row">
                <div class="container">
                    <div class="row" style="display: flex; align-items: center; justify-content: center;">
                        <div class="col-md-6">
                            <form method="post" class="search-bar" action="arab.php" enctype="application/x-www-form-urlencoded">
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg" name="search" placeholder="Hashtag Search">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-lg btn-success btn-icon" name="searchsubmit">
                                            Search
                                            <i class="entypo-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="col-md-12">
                         <ul class="nav nav-tabs ">
                            <li >
                                    <a href="mun.php"><span>Intra&nbsp;VITCMUN</span></a>
                            </li>
                            <li>
                                    <a href="ess.php"><span>UNGA&nbsp;ESS</span></a>
                            </li>
                            <li>
                                    <a href="oosa.php"><span>UNOOSA</span></a>
                            </li>
                            <li >
                                    <a href="hrc.php"><span>UNHRC</span></a>
                            </li>
                            <li class="active">
                                    <a href="arab.php"><span>Arab&nbsp;League</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="arab-league">
                                <div class="profile-env">
                                    <section class="profile-feed">
                                        <!-- profile post form -->
                                        <div <?php echo $view; ?> >
                                        <form class="profile-post-form" method="post" action="arab.php" enctype="multipart/form-data">
                                            <textarea class="form-control autogrow" name="content" placeholder="Arab League Post"></textarea>
                                            <div class="form-options">
                                                <div class="post-type">
                                                    <a href="#" class="tooltip-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Upload a Picture">
                                                    <input type="file" class="upload-picture"name="picture" accept=".jpeg, .jpg, .bmp, .png, .gif" id="picture"  style="display: none;">
                                                        <i class="entypo-camera" style="font-size: 20px;"></i>
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

                                                                <div <?php echo $view1; ?> >                                                            

                                                                   <div  class="hidden-xs" style="float: right; margin-top: 2px;">
                                                                        <a style="font-size: 14px;" class="entypo-trash" href="deletemunpost.php?id=<?php echo urlencode($mun_list["id"]); ?>&council=arab" onclick="return confirm('Are you sure?');"></a>
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
                                                        <a href="arab_comments.php?id=<?php echo urlencode($mun_list["id"]); ?>">
                                                        <i class="entypo-comment"></i>
                                                        <?php                                                                
                                                            echo "Comment <span> (";
                                                            $count_query = "SELECT COUNT(*) FROM arabcomments WHERE pid = {$mun_list["id"]}";
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
        <script>
                     $('.entypo-camera').click(function()
            {
            
                    $(".upload-picture").click();             
            });

    </script>

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
            case 'GIF':
            case 'gif':
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

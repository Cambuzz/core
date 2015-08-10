<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
    $current_user = $_SESSION["username"];
    $name_query = "SELECT * FROM users WHERE username = '{$current_user}' LIMIT 1";
    $name_result = mysqli_query($conn, $name_query);
    confirm_query($name_result);
    $name_title = mysqli_fetch_assoc($name_result);
    $first_name = explode(" ", $name_title['sname'])
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
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style-core.css">
    <link rel="stylesheet" href="assets/css/style-theme.css">
    <link rel="stylesheet" href="assets/css/style-forms.css">
    <link rel="stylesheet" href="assets/css/search.css">
   
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>

    <!-- styleinput -->
    <link rel="stylesheet" type="text/css" href="assets/css/normalize.css" />
    <script src="assets/js/search/prefixfree.min.js"></script>
    <script>
    $.noConflict();
    </script>
</head>

<body class="page-body  page-left-in">
    <div class="page-container">
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
                 <div class="col-md-6 col-sm-8 clearfix">
                    <ul class="user-info pull-left pull-right-xs pull-none-xsm">
            
                        <!--  Notifications -->
                        <li class="notifications dropdown">
            
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="entypo-attention"></i>
                                <span class="badge badge-info">2</span>
                            </a>
            
                            <ul class="dropdown-menu">
                                <li class="top">
                                    <p class="small">
                                        <a href="#" class="pull-right">Mark all Read</a>
                                        You have <strong>2</strong> new notifications.
                                    </p>
                                </li>
                                
                                <li>
                                    <ul class="dropdown-menu-list scroller">
                                        <li class="unread notification-success">
                                            <a href="#">
                                                <i class="entypo-user-add pull-right"></i>
                                                
                                                <span class="line">
                                                    <strong>Sharad Sharad</strong>
                                                </span>
                                                
                                                <span class="line small">
                                                    30 seconds ago
                                                </span>
                                            </a>
                                        </li>
                                        
                                        <li class="unread notification-secondary">
                                            <a href="#">
                                                <i class="entypo-heart pull-right"></i>
                                                
                                                <span class="line">
                                                    <strong>You gotta answer</strong>
                                                </span>
                                                
                                                <span class="line small">
                                                    2 minutes ago
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                
                                <li class="external">
                                    <a href="#">View all notifications</a>
                                </li>
                            </ul>
            
                        </li>       
                    </ul>
                </div>
                <div class="col-md-6 col-sm-4 clearfix hidden-xs" style="float: right;">
                    <ul class="list-inline links-list pull-right">
                        <!-- Language Selector -->
                        <li>
                            <a href="settings.php">
                            Settings <i class="entypo-cog right"></i>
                        </a>
                            <li>
                                <a href="logout.php">
                            Log Out <i class="entypo-logout right"></i>
                        </a>
                            </li>
                    </ul>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-sm-12">
                    <h2 style="text-align: center; margin-top: 10%;">Start Searching! Get working!</h2>
                    <form action="track_teacher.php" method="post">
                    <div class="search">
                        <svg version="1.1" viewBox="0 0 142.358 24.582">
                            <path id="search-path" fill="none" d="M131.597,14.529c-1.487,1.487-3.542,2.407-5.811,2.407
        c-4.539,0-8.218-3.679-8.218-8.218s3.679-8.218,8.218-8.218c4.539,0,8.218,3.679,8.218,8.218
        C134.004,10.987,133.084,13.042,131.597,14.529c0,0,9.554,9.554,9.554,9.554H0" />
                        </svg>
                        <label for="search" class="search-label"></label>
                        <input type="search" id="search" autocomplete="on" name="search_name" class="input-search" />
                    </div>
                    </form>   
                </div>
            </div>
                   <div class="a-st" style="font-size: 20px; display:flex;justify-content:center;align-items:center; margin-top: 200px;">  
                    <?php
                           if (isset($_POST['search_name'])) {
                               $search_name = $_POST['search_name'];
                               $search_query = "SELECT * FROM teacher WHERE name = '{$search_name}' LIMIT 1";
                               $search_result = mysqli_query($conn, $search_query);
                               confirm_query($search_result);
                               $search_title = mysqli_fetch_assoc($search_result);
                               if (!$search_title['name']) {
                                   echo "Not in database";
                               } else {
                                   $outarr = $search_title['period'];
                               $out = explode(" ", $outarr);
                               $matrix = zeros(5, 13);
                               $c = 0;
                               for ($i=0; $i < 5; $i++) { 
                                   for ($j=0; $j < 13; $j++) { 
                                       $matrix[$i][$j] = $out[$c++];                                    
                                   }                
                               }
                               date_default_timezone_set("Asia/Kolkata");
                               $day = date("l");
                               $hour = date("H");
                               $minute = date("i");
                               
                               $timarr=zeros(13,2);
                               $timarr[0][0]=8;
                               $timarr[0][1]=50;
                               $timarr[1][0]=9;
                               $timarr[1][1]=45;
                               $timarr[2][0]=10;
                               $timarr[2][1]=40;
                               $timarr[3][0]=11;
                               $timarr[3][1]=35;
                               $timarr[4][0]=12;
                               $timarr[4][1]=30;
                               $timarr[5][0]=13;
                               $timarr[5][1]=20;
                               $timarr[6][0]=14;
                               $timarr[6][1]=5;
                               $timarr[7][0]=14;
                               $timarr[7][1]=55;
                               $timarr[8][0]=15;
                               $timarr[8][1]=50;
                               $timarr[9][0]=16;
                               $timarr[9][1]=45;
                               $timarr[10][0]=17;
                               $timarr[10][1]=40;
                               $timarr[11][0]=18;
                               $timarr[11][1]=35;
                               $timarr[12][0]=19;
                               $timarr[12][1]=30;
                               $r=10;
                               if ($day=="Monday") $r=0;
                               elseif ($day=="Tuesday") $r=1;
                               elseif ($day=="Wednesday") $r=2;
                               elseif ($day=="Thursday") $r=3;
                               elseif ($day=="Friday") $r=4;
                               if($r==10) {
                                   echo "Today is a holiday";
                               }
                               elseif($hour<6 || $hour>22) {
                                   echo "Your teacher is sleeping now";echo "<br>";
                                   if($hour>22 && $r==4) {
                                       echo "Tommorow is a holiday";echo "<br>";
                                       echo "Monday:";echo "<br>";
                                       $r=0;
                                   }
                                   $flag=0;
                                   for ($j=0; $j < 13; $j++) { 
                                       if($matrix[$r][$j]==1) {
                                           if($flag==0) {
                                               echo "You can meet your teacher between :";
                                               echo "<br>";
                                           }
                                           if($j!=0) {
                                               echo $timarr[$j-1][0].":".$timarr[$j-1][1]."-".$timarr[$j][0].":".$timarr[$j][1];
                                               echo "<br>";
                                           } else {
                                               echo "8:00-".$timarr[$j][0].":".$timarr[$j][1];
                                               echo "<br>";
                                           }
                                           $flag=1;
                                       }
                                   }        
                               } elseif ($hour>19 || ($hour==19 && $minute>30)) {
                                   echo "Its too late. Your teacher might have left the college";
                                   echo "&nbsp;";
                               } else {
                                   $flag=0;
                                   $ind=0;
                                   for ($i=0; $i <13 ; $i++) { 
                                       if($hour<=$timarr[$i][0]) {
                                           if( $minute<=$timarr[$i][1]) {
                                               if($matrix[$r][$i]==1) {
                                                   echo "Free Till";
                                                   echo "&nbsp;";
                                                   $k=$i;
                                                   while ($matrix[$r][$k]==1 ) {
                                                       $k++;
                                                       if($k==13)break;
                                                   }
                                                   echo $timarr[$k-1][0].":".$timarr[$k-1][1];echo "<br>";
                                                   for ($j=$k+1; $j < 13; $j++) { 
                                                       if($matrix[$r][$j]==1) {
                                                           if($flag==0) {
                                                               echo "You can also meet your teacher between : ";
                                                               echo "<br>";
                                                            }
                                                           if($j!=0) {
                                                               echo $timarr[$j-1][0].":".$timarr[$j-1][1]."-".$timarr[$j][0].":".$timarr[$j][1];
                                                               echo "&nbsp;";
                                                           } else {
                                                               echo "8:00-".$timarr[$j][0].":".$timarr[$j][1];
                                                               echo "&nbsp;";
                                                           }
                                                           $flag=1;
                                                       }
                                                   }
                                               } elseif ($matrix[$r][$i]==0) {
                                                   echo "Class";echo "&nbsp;";
                                                   for ($j=$i+1; $j < 13; $j++) {                         
                                                       if($matrix[$r][$j]==1) {
                                                           if($flag==0) {echo "You can meet your teacher between :";echo "<br>";}
                                                           if($j!=0) {
                                                               echo " ".$timarr[$j-1][0].":".$timarr[$j-1][1]."-".$timarr[$j][0].":".$timarr[$j][1];echo "<br>";
                                                           } else {echo "8:00-".$timarr[$j][0].":".$timarr[$j][1];echo "<br>";}
                                                           $flag=1;
                                                       }
                                                   }
                                                   if($flag==0)echo "Srry! Faculty isn't free today";
                                               } else {
                                                   echo "Lunch";echo "&nbsp;";
                                                   for ($j=$i+1; $j < 13; $j++) {                         
                                                       if($matrix[$r][$j]==1) {
                                                           if($flag==0) {
                                                           echo "You can meet your teacher between : ";echo "<br>";
                                                           if($j!=0) {
                                                               echo $timarr[$j-1][0].":".$timarr[$j-1][1]."-".$timarr[$j][0].":".$timarr[$j][1];
                                                               echo "&nbsp;";
                                                           } else {
                                                               echo "8:00-".$timarr[$j][0].":".$timarr[$j][1];
                                                               echo "&nbsp;";
                                                           }
                                                           $flag=1;
                                                       }
                                                   }
                                               }                    
                                           }                    
                                           if($flag==0)echo "Srry! Faculty isn't free today";
                                           break;
                                       }
                                   }
                               }
                           }
                               }                            
                           }
                       ?></div>
        </div>        
        <footer>
        </footer>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="assets/js/search/index.js"></script>
    <script src="assets/js/gsap/main-gsap.js"></script>
    <!-- Imported scripts on this page --> 
    <script src="assets/js/style-custom.js"></script>
    <script src="assets/js/style-api.js"></script>
    
   
</body>

</html>
<?php
    mysqli_free_result($name_result);
    if (isset ($conn)){
            mysqli_close($conn);
    }
?>

<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>

<?php
$event_set = find_all_events();
?>
<?php
    $query = "SELECT * FROM notify ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    confirm_query($result);
        
    $work = "DELETE  FROM notify WHERE end_date_time < '{$delete_time}'";
    mysqli_query($conn, $work);
?>
<?php
date_default_timezone_set('Asia/Calcutta');
$id_time = date("Y-m-d H-i-s");
$buzz_id = $current_user.$id_time;
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
    <link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style-core.css">
    <link rel="stylesheet" href="assets/css/style-theme.css">
    <link rel="stylesheet" href="assets/css/style-forms.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <script src="assets/js/datelock.js"></script>
    <!-- <link rel="stylesheet" href="assets/css/datepicker.css"> -->
    <!-- button -->
    <link rel="stylesheet" type="text/css" href="assets/css/buttoncreatebuzz.css" />
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,900' rel='stylesheet' type='text/css'>
    <!-- styleinput -->
    <link rel="stylesheet" type="text/css" href="assets/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/stylingtextinput.css" />
    <script src="assets/js/modernizr.custom.js"></script>
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/modernizr.custom.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
    $.noConflict();
    </script>
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
            
    
     .startingdate{
        padding: 5px; 
        font-size: 12px; 
        background-color: #00a651; 
        color: white; 
        border-radius: 5px; 
        float: left;

    }

     .endingdate{
        padding: 5px; 
        font-size: 12px; 
        background-color: #e85657; 
        color: white; 
        border-radius: 5px; 
        float: right;

     }
    @media screen and (max-width: 789px) {
     .startingdate{
       float: none;
       display: block;
       margin-left: auto;
       margin-right: auto;
       text-align: center;
       }

    .endingdate{
       margin-top: 10px;
       float: none;
       display: block;
       margin-left: auto;
       margin-right: auto;
       text-align: center;
       }
    
    .user-thumb{
        display: none;
       }

    .story{
        display: flex;
        justify-content: center;
        align-items: center;
       }

    }    
    </style>

    

</head>

<body >
    <div class="page-container">
        <div class="main-content">
            <!-- main content starts here -->
              <div class="profile-env">
                    <section class="profile-feed">
                        <div class="profile-stories">
                            <?php
                            while($notification = mysqli_fetch_assoc($result)) {       
                                                                              
                                            if ($notification['poset']==0) { 
                                                $buzz_user = $notification["buzz_username"];
                                                $name_print_query = "SELECT * FROM users WHERE username = '{$buzz_user}' LIMIT 1";
                                                $name_print_result = mysqli_query($conn, $name_print_query);
                                                confirm_query($name_print_result);
                                                $name_print_title = mysqli_fetch_assoc($name_print_result);
                                                 ?>
                                                    <article class="story">
                                                    <div class="story-content">
                                                    <header>
                                                    <div class="publisher" style="color: #303641; font-family: 'Montserrat', sans-serif;">
                                                    <span style="font-weight: bold;"><?php echo $name_print_title["sname"]; ?></span><span style="color: #9b9fa6;">&nbsp;posted a buzz!</span>
                                                    <em style="color: #9b9fa6;">
                                                        <?php 
                                                            $post_time = strtotime($notification['buzz_time']);
                                                            echo date("d M, y | h:i a", $post_time);
                                                         ?>
                                                    </em>
                                                    </div>
                                                    </header>
                                                    <div class="story-main-content">
                                                    <p style="font-size: 30px; font-family: 'Playfair Display', serif; font-weight: bold; line-height: 1.3; color: black;"><?php echo $notification["title"]; ?></p>
                                                    <p><?php echo $notification["content"]. " "; ?>                                                
                                                    </p>                                                
                                                    <b style="margin-top: 10px; display: block; margin-left: auto; margin-right: auto; font-family:'Montserrat', sans-serif">
                                                    <?php
                                                    $timestamp_start = strtotime($notification["start_date_time"]);
                                                    $timestamp_end = strtotime($notification["end_date_time"]); ?>
                                                    <span style="padding: 5px; font-size: 12px; background-color: #00a651; color: white; border-radius: 5px; float: left;">
                                                    Starting on: <?php echo date("l, d M, y | h:i a", $timestamp_start); ?>
                                                    </span>
                                                    <span style="padding: 5px; font-size: 12px; background-color: #e85657; color: white; border-radius: 5px; float: right;">
                                                    Ending on: <?php echo date("l, d M, y | h:i a", $timestamp_end); ?>
                                                    </span>
                                                      </b>                                
                                                    </div>            
                                                    </div>                                                                                                   
                                                    </article>
                                                    
                                                    <hr> <?php                                     
                                                
                                            } elseif ($notification['poset']==1) { 
                                                $buzz_user = $notification["buzz_username"];
                                                $name_print_query = "SELECT * FROM users WHERE username = '{$buzz_user}' LIMIT 1";
                                                $name_print_result = mysqli_query($conn, $name_print_query);
                                                confirm_query($name_print_result);
                                                $name_print_title = mysqli_fetch_assoc($name_print_result);
                                                ?>
                                                    <article class="story">
                                                    
                                                    <div class="story-content">
                                                    <header>
                                                    <div class="publisher" style="color: #303641; font-family: 'Montserrat', sans-serif;">
                                                    <span style="font-weight: bold;"><?php echo $name_print_title["sname"]; ?></span><span style="color: #9b9fa6;">&nbsp;posted a buzz!</span>
                                                    <em style="color: #9b9fa6;">
                                                        <?php 
                                                            $post_time = strtotime($notification['buzz_time']);
                                                            echo date("d M, y | h:i a", $post_time);
                                                         ?>
                                                    </em>
                                                    </div>
                                                    </header>
                                                    <div class="story-main-content">
                                                    <p style="font-size: 30px; font-family: 'Playfair Display', serif; font-weight: bold; line-height: 1.3; color: black;"><?php echo $notification["title"]; ?></p>
                                                    <p><?php echo $notification["content"]. " "; ?>
                                                    
                                                    </p>
                                                    <?php
                                                    $poster_time = strtotime($notification['buzz_time']);                                                    
                                                    $posterid=$notification['buzz_username'].date("Y-m-d H-i-s", $poster_time); 
                                                    echo $posterid;                                       
                                                    echo '<img src="images/posters/' . $posterid . '.jpg "class="img-responsive">'; ?>
                                                    <b style="margin-top: 10px; display: block; margin-left: auto; margin-right: auto; font-family:'Montserrat', sans-serif">
                                                    <?php 
                                                    $timestamp_start = strtotime($notification["start_date_time"]);
                                                    $timestamp_end = strtotime($notification["end_date_time"]); ?>
                                                    <span style="padding: 5px; font-size: 12px; background-color: #00a651; color: white; border-radius: 5px; float: left;">
                                                    Starting on: <?php echo date("l, d M, y  |  h:i a", $timestamp_start); ?>
                                                    </span>
                                                    <span style="padding: 5px; font-size: 12px; background-color: #e85657; color: white; border-radius: 5px; float: right;">
                                                    Ending on: <?php echo date("l, d M, y  |  h:i a", $timestamp_end); ?>
                                                    </span>                                                
                                                    </b>
                                                    </div>
                                                    </div>                                                    
                                                    </article>
                                                    
                                                    <hr> 
                                                 <?php
                                                }                   
                                            } 
                        ?>   
                        </div>
                    </section>
                </div>
        </div>
            <footer>
            </footer>
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
   
  
</body>

</html>
<?php
    
    if (isset ($conn)){
            mysqli_close($conn);
    }
?>
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
</head>

<body >
    <div class="page-container">
        <div class="main-content">
            <!-- main content starts here -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="morph-button morph-button-overlay morph-button-fixed">
                        <button type="button">News Feed</button>
                    </div>
                </div>
                <hr>
                <div class="profile-env">
                    <section class="profile-feed">
                        <div class="profile-stories">
                            <?php
                            while($notification = mysqli_fetch_assoc($result)) {       
                                                                              
                                            if (empty($notification['data'])) { 
                                                $buzz_user = $notification["buzz_username"];
                                                $name_print_query = "SELECT * FROM users WHERE username = '{$buzz_user}' LIMIT 1";
                                                $name_print_result = mysqli_query($conn, $name_print_query);
                                                confirm_query($name_print_result);
                                                $name_print_title = mysqli_fetch_assoc($name_print_result);
                                                 ?>
                                                    <article class="story">
                                                    <aside class="user-thumb">
                                                    <?php                
                                                    if (empty($name_print_title["data_propic"])) { ?>
                                                        <img src="assets/images/nopic.png" height="44px" width="44px" alt="" class="img-circle">
                                                        <?php
                                                    } elseif (isset($name_print_title["data_propic"])) {
                                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($name_print_title['data_propic']) . '" height="44px" width="44px" alt="" class="img-circle">';         
                                                    }
                                                    ?>
                                                    </aside>
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
                                                
                                            } elseif (isset($notification['data'])) { 
                                                $buzz_user = $notification["buzz_username"];
                                                $name_print_query = "SELECT * FROM users WHERE username = '{$buzz_user}' LIMIT 1";
                                                $name_print_result = mysqli_query($conn, $name_print_query);
                                                confirm_query($name_print_result);
                                                $name_print_title = mysqli_fetch_assoc($name_print_result);
                                                ?>
                                                    <article class="story">
                                                    <aside class="user-thumb">
                                                    <?php
                                                    if (empty($name_print_title["data_propic"])) { ?>
                                                        <img src="assets/images/nopic.png" height="44px" width="44px" alt="" class="img-circle">
                                                        <?php 
                                                    } elseif (isset($name_print_title["data_propic"])) {
                                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($name_print_title['data_propic']) . '" height="44px" width="44px" alt="" class="img-circle">';      
                                                    }
                                                    ?>
                                                    </aside>
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
                                                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($notification['data']) . '" class="img-responsive" ">'; ?>
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
                                                    <a href="delete_event.php?id=<?php echo urlencode($notification["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a>
                                                    <hr> 
                                                 <?php
                                                }                   
                                            } 
                                                    
                                 //for m   
                             // while
                        ?>   
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
    <!--  -->
    <!-- Imported styles on this page -->
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css">
    <link rel="stylesheet" href="assets/js/select2/select2.css">
    <link rel="stylesheet" href="assets/js/selectboxit/jquery.selectBoxIt.css">
    <link rel="stylesheet" href="assets/js/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="assets/js/icheck/skins/minimal/_all.css">
    <link rel="stylesheet" href="assets/js/icheck/skins/square/_all.css">
    <link rel="stylesheet" href="assets/js/icheck/skins/flat/_all.css">
    <link rel="stylesheet" href="assets/js/icheck/skins/futurico/futurico.css">
    <link rel="stylesheet" href="assets/js/icheck/skins/polaris/polaris.css">
    <!-- Bottom scripts (common) -->
    <script src="assets/js/gsap/main-gsap.js"></script>
    <script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/joinable.js"></script>
    <script src="assets/js/resizeable.js"></script>
    <script src="assets/js/style-api.js"></script>
    <script src="assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/js/uiMorphingButton_fixed.js"></script>
    <script src="assets/js/style-demo.js"></script>
    <!-- Imported scripts on this page -->
    <script src="assets/js/wysihtml5/bootstrap-wysihtml5.js"></script>
    <script src="assets/js/jquery.multi-select.js"></script>
    <script src="assets/js/fileinput.js"></script>
    <script src="assets/js/bootstrap-datepicker.js"></script>
    <script src="assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
    <script src="assets/js/bootstrap-tagsinput.min.js"></script>
    <script src="assets/js/style-chat.js"></script>
    <script src="assets/js/select2/select2.min.js"></script>
    <script src="assets/js/bootstrap-tagsinput.min.js"></script>
    <script src="assets/js/typeahead.min.js"></script>
    <script src="assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
    <script src="assets/js/bootstrap-datepicker.js"></script>
    <script src="assets/js/bootstrap-timepicker.min.js"></script>
    <script src="assets/js/bootstrap-colorpicker.min.js"></script>
    <script src="assets/js/daterangepicker/moment.min.js"></script>
    <script src="assets/js/daterangepicker/daterangepicker.js"></script>
    <script src="assets/js/jquery.multi-select.js"></script>
    <script src="assets/js/icheck/icheck.min.js"></script>
    <script src="assets/js/style-chat.js"></script>
    <!-- JavaScripts initializations and stuff -->
    <script src="assets/js/style-custom.js"></script>
    <!-- Demo Settings -->
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/jquery.fittext.js"></script>
    <script src="assets/js/classie.js"></script>
    <script src="assets/js/wow.min.js"></script>
    
   
  
</body>

</html>
<?php
    
    if (isset ($conn)){
            mysqli_close($conn);
    }
?>
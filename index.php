<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/validation_functions.php"); ?>
<?php
if (logged_in()) {
    redirect_to ("public/Inside/buzz.php");
}
?>
<?php
$username = "";
if (isset($_POST['submit'])) {

    $required_fields = array("username", "password");
    validate_presence($required_fields);
    
    if (empty($errors)) {

        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $query_email = "SELECT * FROM users WHERE username = '{$username}'";
        $result_email = mysqli_query($conn, $query_email);
        //while ($row=mysqli_fetch_assoc($result_email)) {
          //  $db_confirmed = $row['confirmed'];
        }
        $found_user = attempt_login($username, $password);

        if ($found_user) {

           // if ($db_confirmed==1) {
                $_SESSION["user_id"] = $found_user["id"];
                $_SESSION["username"] = $found_user["username"];
                redirect_to("public/Inside/buzz.php");
            //} else {
              //  echo "Account not confirmed";
            //}
        } else {
            $_SESSION["message"] = "Username/password not found.";
        }
    //}
} 
?>
<?php
if (isset($_POST['submit_up'])) {
    $query_ucheck = "SELECT username FROM users WHERE username = '{$_POST['username']}'";
    $result_ucheck = mysqli_query($conn, $query_ucheck);
    if (mysqli_num_rows($result_ucheck) !=0) {
        echo "Username already exists";
    } else {
        $required_fields = array("username", "password");
        validate_presence($required_fields);
    
        $fields_with_max_lengths = array("username" => 30);
        validate_max_lengths($fields_with_max_lengths);

        if (empty($errors)) {

            $sname = $_POST['sname'];
            $username = mysql_prep($_POST["username"]);
            $email = $_POST['email'];
            $hashed_password = password_encrypt($_POST["password"]); 
            $confirmcode = rand(); 
            $query = "INSERT INTO users (sname, username, email, hashed_password)";
            $query .= " VALUES ('{$sname}', '{$username}', '{$email}', '{$hashed_password}')";
            $result = mysqli_query($conn, $query);         

            if ($result) {
                $password = $_POST["password"];
                $found_user = attempt_login($username, $password);

                if ($found_user) {

                    //$message = "Confirm your email by clicking the link http://52.74.246.227/emailconfirm.php?username=$username&code=$confirmcode";
                    //mail($email, "Confirm your email", $message, "From: prashant_bhardwaj@52.74.246.227");
                    //echo "Registration complete, confirm your email";
                  $_SESSION["user_id"]=$found_user["id"];
                  $_SESSION["username"]=$found_user["username"];    
                  redirect_to("public/Inside/buzz.php");
                } else {
                    $_SESSION["message"] = "Username/password not found.";
                }
            } else {
                $_SESSION["message"] = "Profile creation failed.";
            }
        }
    }     
}
?>
<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cambuzz</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-icons/entypo/css/entypo.css">
    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400' rel='stylesheet' type='text/css'>
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css" type="text/css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/creative.css" type="text/css">
    <link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css" />
    <link rel="stylesheet" type="text/css" href="css/background.css" />
    <link rel="stylesheet" type="text/css" href="css/buttoncreatebuzz.css">
    <script src="js/modernizr.custom.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    
</head>

<body id="page-top">
    <ul class="cb-slideshow">
        <li><span>Image 01</span>
        </li>
        <li><span>Image 02</span>
        </li>
        <li><span>Image 03</span>
        </li>
        <li><span>Image 04</span>
        </li>
        <li><span>Image 05</span>
        </li>
        <li><span>Image 06</span>
        </li>
    </ul>
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-inverse" style="background-color: black; opacity: .4;">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a href="">Developers</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <div class="heading-text animated fadeInUp">cambu<span class="animated tada">zz</span></div>
                <p class="animated fadeInUp"><span style="font-size: 20px;">&#35; </span>VITC Chapter</p>
            </div>
        </div>
        <div class="mockup-content">
            <div class="morph-button morph-button-modal morph-button-modal-2 morph-button-fixed login">
                <button type="button" style="background-color: white;">Login</button>
                <div class="morph-content" style="background-color: white;">
                    <div>
                        <div class="content-style-form content-style-form-1">
                            <span class="icon icon-close">Close the dialog</span>
                            <h2>Login</h2>
                            <form method="post" action="index.php">
                                <p>
                                    <label>Registration Number</label>
                                    <input type="text" name="username" value="" />
                                </p>
                                <p>
                                    <label>Password</label>
                                    <input type="password" name="password" value="" />
                                </p>
                                <p>
                                    <input type="submit" class="btn btn-danger" name="submit" value="Login" style="text-align: center;">
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sign Up Button -->
            <div class="morph-button morph-button-overlay morph-button-fixed signup">
                <button type="button">SignUp</button>
                <div class="morph-content">
                    <div>
                        <div class="content-style-overlay">
                            <div class="heading-button-buzz">
                                <span class="icon icon-close">Close the overlay</span>
                                <h2>Signup</h2>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default" data-collapsed="0">
                                            <div class="panel-body">
                                                <form role="form" class="form-horizontal form-groups-bordered" method="post" action="index.php" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="field-1" class="col-sm-3 control-label">Name</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" class="form-control" id="field-1" name="sname" value="" required />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="field-1" class="col-sm-3 control-label">Registration Number</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" class="form-control" id="field-1" name="username" value="" required />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="field-1" class="col-sm-3 control-label">VIT Email</label>
                                                        <div class="col-sm-5">
                                                            <input type="email" class="form-control" id="field-1" name="email" value="  @vit.ac.in" required />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="field-3" class="col-sm-3 control-label">Password</label>
                                                        <div class="col-sm-5">
                                                            <input type="password" class="form-control" id="txtNewPassword" name="password" value="" required />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="field-3" class="col-sm-3 control-label">Retype Password</label>
                                                        <div class="col-sm-5">
                                                            <input type="password" class="form-control" id="txtConfirmPassword" value="" required />
                                                        </div>
                                                        <div class="registrationFormAlert" id="divCheckPasswordMatch" style="margin-left: 160px;"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-3 col-sm-5">
                                                            <input type="submit" name="submit_up" value="Sign in" class="btn btn-success">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- morph-button -->
        </div>
    </header>
    
    
     <script src="https://cdnjs.cloudflare.com/ajax/libs/classie/1.0.1/classie.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="js/uiMorphingButton_fixed.js"></script>
    
    <script>
    (function() {
        var docElem = window.document.documentElement,
            didScroll, scrollPosition;

        // trick to prevent scrolling when opening/closing button
        function noScrollFn() {
            window.scrollTo(scrollPosition ? scrollPosition.x : 0, scrollPosition ? scrollPosition.y : 0);
        }

        function noScroll() {
            window.removeEventListener('scroll', scrollHandler);
            window.addEventListener('scroll', noScrollFn);
        }

        function scrollFn() {
            window.addEventListener('scroll', scrollHandler);
        }

        function canScroll() {
            window.removeEventListener('scroll', noScrollFn);
            scrollFn();
        }

        function scrollHandler() {
            if (!didScroll) {
                didScroll = true;
                setTimeout(function() {
                    scrollPage();
                }, 60);
            }
        };

        function scrollPage() {
            scrollPosition = {
                x: window.pageXOffset || docElem.scrollLeft,
                y: window.pageYOffset || docElem.scrollTop
            };
            didScroll = false;
        };

        scrollFn();

        [].slice.call(document.querySelectorAll('.login')).forEach(function(bttn) {
            new UIMorphingButton(bttn, {
                closeEl: '.icon-close',
                onBeforeOpen: function() {
                    // don't allow to scroll
                    noScroll();
                },
                onAfterOpen: function() {
                    // can scroll again
                    canScroll();
                },
                onBeforeClose: function() {
                    // don't allow to scroll
                    noScroll();
                },
                onAfterClose: function() {
                    // can scroll again
                    canScroll();
                }
            });
        });

        // for demo purposes only
        [].slice.call(document.querySelectorAll('form button')).forEach(function(bttn) {
            bttn.addEventListener('click', function(ev) {
                ev.preventDefault();
            });
        });
    })();
    </script>
    <script>
    (function() {
        var docElem = window.document.documentElement,
            didScroll, scrollPosition;

        // trick to prevent scrolling when opening/closing button
        function noScrollFn() {
            window.scrollTo(scrollPosition ? scrollPosition.x : 0, scrollPosition ? scrollPosition.y : 0);
        }

        function noScroll() {
            window.removeEventListener('scroll', scrollHandler);
            window.addEventListener('scroll', noScrollFn);
        }

        function scrollFn() {
            window.addEventListener('scroll', scrollHandler);
        }

        function canScroll() {
            window.removeEventListener('scroll', noScrollFn);
            scrollFn();
        }

        function scrollHandler() {
            if (!didScroll) {
                didScroll = true;
                setTimeout(function() {
                    scrollPage();
                }, 60);
            }
        };

        function scrollPage() {
            scrollPosition = {
                x: window.pageXOffset || docElem.scrollLeft,
                y: window.pageYOffset || docElem.scrollTop
            };
            didScroll = false;
        };

        scrollFn();

        var el = document.querySelector('.signup');

        new UIMorphingButton(el, {
            closeEl: '.icon-close',
            onBeforeOpen: function() {
                // don't allow to scroll
                noScroll();
            },
            onAfterOpen: function() {
                // can scroll again
                canScroll();
                // add class "noscroll" to body
                classie.addClass(document.body, 'noscroll');
                // add scroll class to main el
                classie.addClass(el, 'scroll');
            },
            onBeforeClose: function() {
                // remove class "noscroll" to body
                classie.removeClass(document.body, 'noscroll');
                // remove scroll class from main el
                classie.removeClass(el, 'scroll');
                // don't allow to scroll
                noScroll();
            },
            onAfterClose: function() {
                // can scroll again
                canScroll();
            }
        });
    })();
    </script>
    <script type="text/javascript">
        $(function() {
            $("#txtConfirmPassword").keyup(function() {
                var password = $("#txtNewPassword").val();
                $("#divCheckPasswordMatch").html(password == $(this).val() ? "Passwords match." : "Passwords do not match!");
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

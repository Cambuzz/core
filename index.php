<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/validation_functions.php"); ?>
<?php
if (logged_in()) {
    redirect_to ("public/Inside/buzz.php");
}
?>


<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Login or Signup on Cambuzz. Buzz new events, Track your teacher or ask a question.">
    <meta name="keywords" content="Buzz, Events, Cambuzz, Track, Teacher, Question, Campus, Centralized information system">
    <meta name="author" content="Team Cambuzz">
    <title>Cambuzz</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css" type="text/css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/creative.css" type="text/css">
    <link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css" />
    <link rel="stylesheet" type="text/css" href="css/backgroundmun.css" />
    <link rel="stylesheet" type="text/css" href="css/buttoncreatebuzz.css">
    
</head>

<body id="page-top">
<?php include_once("public/Inside/analyticstracking.php") ?>
    <ul class="cb-slideshow">
        <li><span>Image 01</span>
        </li>
    </ul>
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-inverse" style="background-color: rgba(0,0,0,0.6); border-color: rgba(0,0,0,0) !important;  ">
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
                <ul class="nav navbar-nav navbar-right" style="font-family: 'Montserrat', sans-serif;">
                    <li>
                        <a class="page-scroll" href="aboutus/index.php">About</a>
                    </li>
                    <li>
                        <a href="aboutus/index.php#contact">Contact Us</a>
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
            <a href="public/Inside/mun/mun.php" style="color: white; background-color: black; font-family: 'Montserrat', sans-serif;" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-comment"></span> VITC Intra MUN</a>
            </div>
        </div>
        <div class="mockup-content">
            <div class="morph-button morph-button-modal morph-button-modal-2 morph-button-fixed login">
                <button type="button" style="background-color: white;">Login</button>
                <div class="morph-content" style="background-color: white;">
                    <div>
                       <div class="content-style-form content-style-form-1" id="logindiv1">
                            <span id="closelogin" class="icon icon-close">Close the dialog</span>
                            <h2>Login</h2>
                            <form class="loginform">
                                <p>
                                    <label>Registration Number</label>
                                    <input type="text" class="regno" required name="username" value="" />
                                </p>
                                <p>
                                    <label>Password</label>
                                    <input type="password" class="passwor" required name="password" value="" />
                                </p>

                                 <div id="tempdiv"><p><a href="#" id="loginatag">Forgot Password</a></p></div>
                                <p>
                                    <input type="submit" class="btn btn-danger" name="submit" value="Login" style="text-align: center;">
                                </p>
                            </form>
                        </div>
                        <div class="content-style-form content-style-form-1" id="logindiv2" style="display:none;">
                            <span id="closeforgot" class="icon icon-close">Close the dialog</span>
                            <h2 style="font-size:25px;">Forgot Password?</h2>
                            <form id="loginform1">
                                <p>
                                    <label>Registration Number</label>
                                    <input type="text" id="regno1" required name="username" value="" />
                                </p>
                                <!-- <p>
                                    <label>Password</label>
                                    <input type="password" class="passwor" required name="password" value="" />
                                </p> 
                                 <div id="tempdiv"></div>-->
                                 <p>

                                 <div id="tempdiv1"><p><a href="#" id="loginatag1">Go Back</a></p></div>
                                 <div id="tempdiv2"></div>
                                 </p>
                                
                                <p>
                                    <input type="submit" class="btn btn-danger" name="submit" value="Change Password" style="text-align: center;">
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
                                                <form role="form" class="form-horizontal form-groups-bordered" id="signupform" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="field-1" class="col-sm-3 control-label">Name</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" class="form-control" id="field1" name="sname" value="" required />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="field-1" class="col-sm-3 control-label">Registration Number</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" class="form-control" id="field2" name="username" value="" required />
                                                        </div>
                                                        <div class="registrationFormAlert" id="usernamematching" style="margin-left: 160px;"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="field-1" class="col-sm-3 control-label">VIT Email</label>
                                                        <div class="col-sm-5">
                                                            <input type="email" class="form-control" id="field3" name="email" value="  @vit.ac.in" required />
                                                        </div>
                                                        <div class="registrationFormAlert" id="emailchecking" style="margin-left: 160px;"></div>
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
                                                    <div id="accountchecking"></div>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-3 col-sm-5">
                                                            <input type="submit" name="submit_up" value="Submit" class="btn btn-success">
                                                            <!-- <a href="javascript:;" onclick="jQuery('#modal-1').modal('show');" class="btn btn-default">Show Me</a> -->
                                                        <div class="modal fade" id="modal-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <h4 class="modal-title">Signup Verification</h4>
                                                                    </div>
                                                                    
                                                                    <div class="modal-body" id="modalcontent">
                                                                        
                                                                    </div>
                                                                    
                                                                    <div class="modal-footer">
                                                                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        <button type="button" class="btn btn-info">Save changes</button> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                       </div> 
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
    
    <script src="js/modernizr.custom.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
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

    
    <script type="text/javascript">
        
        
        $(document).ready(function(){
           
            $('.loginform').on('submit',function()
            {

                var registration_no_login=$(".regno").val();
                var password_login=$(".passwor").val();
                
               
               var msg;
                
                $.ajax({
                    method: "POST",
                    url: "login_verify.php",
                    data: { username:registration_no_login,password:password_login }
                    })
                    .done(function( msg ) {
                        if(msg!="loggedin")
                        {
                            $('#tempdiv').html(msg);
                        }
                        hello(msg);
                    });
                    

                return false;

                
            });



            $('#loginform1').on('submit',function()
            {

                var registration_no_login=$("#regno1").val();
                var msg;
                
                $.ajax({
                    method: "POST",
                    url: "forgotpassword.php",
                    data: {username:registration_no_login}
                    })
                    .done(function( msg ) {
                        if(msg=="Registration Number Not Found")
                        {
                            $('#tempdiv2').html(msg);

                        }
                        else if(msg=="Account is not confirmed")
                        {
                            $('#tempdiv2').html(msg);

                        }
                        else
                        {
                          $('#tempdiv2').html(msg);
                        }
                        
                       
                    });
                    

                return false;

                
            });

            $('#loginatag').click(function()
            {

            
                    $("#logindiv1").hide();
                    $("#logindiv2").show();
            });


            $('#loginatag1').click(function()
            {

            
                    $("#logindiv2").hide();
                    $("#logindiv1").show();             
            });

             $('#closeforgot').click(function()
            {
            
                    $("#closelogin").click();             
            });


            
            $('#signupform').on('submit',function()
            {
                if($("#txtNewPassword").val()==$("#txtConfirmPassword").val())
                {
                var name=$("#field1").val();
               var register=$("#field2").val();
               var email=$("#field3").val();
               var password=$("#txtNewPassword").val();
               //alert('hello');
               var msg;
                
                $.ajax({
                    method: "POST",
                    url: "signup_verify.php",
                    data: { name:name,register:register,email:email,password:password}
                    })
                    .done(function( msg ) {
                        if(msg=="Username already exists")
                        {
                            $('#usernamematching').html(msg);
                        }
                        else if(msg=="Only VIT email is recognised")
                        {
                            $('#emailchecking').html(msg);
                        }
                         else if(msg=="Email already exists")
                        {
                            $('#emailchecking').html(msg);
                        }
                        else
                        {
                             
                            $('#modalcontent').html(msg);
                            $('#modal-1').modal('show');
                        }
                    });
                    
                }
                return false;

                
            });
            
            function hello(msg)
            {
                if(msg=="loggedin")
                {
                    window.location.href="public/Inside/buzz.php";
                }
            }
            
        });
        
    </script> 

</body>

</html>
<?php
if (isset ($conn)){
    mysqli_close($conn);
}
?>

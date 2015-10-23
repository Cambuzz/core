
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Buzz</title>
    <!-- Add to homescreen for Chrome on Android -->
    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Cambuzz">
    <!-- Base Styles -->
    <link rel="stylesheet" href="assets/css/material.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- Datepicker -->
    <link rel="stylesheet" href="assets/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Buzz Modal styling -->
    <link rel="stylesheet" href="assets/css/morph-btn/style.css">
    <!-- Resource style -->
    <link rel="stylesheet" href="assets/css/dropzone.css">
    <script src="assets/js/morph-btn/jquery-2.1.1.js"></script>
    <script src="assets/js/dropzone.js"></script>
    <script src="assets/js/morph-btn/modernizr.js"></script>
</head>

<body>
    <div class="layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
        <header class="header mdl-layout__header mdl-color--white mdl-color--grey-100 mdl-color-text--grey-600" id="top-nav-bar">
            <div class="mdl-layout__header-row">
                <span class="mdl-layout-title">Buzz</span>
                <div class="mdl-layout-spacer"></div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
                    <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
                        <i class="material-icons">search</i>
                    </label>
                    <div class="mdl-textfield__expandable-holder">
                        <input class="mdl-textfield__input" type="text" id="search" />
                        <label class="mdl-textfield__label" for="search">Hashtag Search...</label>
                    </div>
                </div>
                <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
                    <i class="material-icons">more_vert</i>
                </button>
                <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
                    <li class="mdl-menu__item">About</li>
                    <li class="mdl-menu__item">Contact</li>
                    <a href="settings" style="text-decoration:none;"><li class="mdl-menu__item">Settings</li></a>
                    <a href="logout" style="text-decoration:none;"><li class="mdl-menu__item">Logout</li></a>
                </ul>
            </div>
        </header>
        <div class="drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50" id="side-bar-nav">
            <header class="drawer-header">
                 @if(Session::get('user')->dpstamp==0)
                    <img src="assets/images/user.jpg" class="avatar">
                @else
                    <img src="../../images/profile/{{Session::get('user')->id.'_'.Session::get('user')->dpstamp.'.jpg'}} " class="avatar">
                @endif
                <div class="avatar-dropdown">
                    <span>Welcome {{ Session::get('user')->sname}}</span>
                    <div class="mdl-layout-spacer"></div>
                    <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                        <i class="material-icons" role="presentation">arrow_drop_down</i>
                        <span class="visuallyhidden">Accounts</span>
                    </button>
                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
                        <li class="mdl-menu__item"><i class="material-icons">add</i>Change Profile Picture</li>
                    </ul>
                </div>
            </header>
            <nav class="navigation mdl-navigation mdl-color--white-grey-800">
                <a class="mdl-navigation__link" href="buzz"><i class="material-icons">notifications_active</i>Buzz</a>
                <a class="mdl-navigation__link" href="track"><i class="mdl-color-text--white-grey-400 material-icons" role="presentation">school</i>Track Faculty</a>
                <a class="mdl-navigation__link" href="QA"><i class="mdl-color-text--white-grey-400 material-icons" role="presentation">forum</i>Ask a Question</a>
                <div class="mdl-layout-spacer"></div>
                <a class="mdl-navigation__link" href=""><i class="mdl-color-text--white-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
            </nav>
        </div>
        <main class="mdl-layout__content mdl-color--grey-100" id="buzz">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10">
                        <section class="cd-section" style="z-index: 20000000;">
                            <div class="cd-modal-action">
                                <a href="#0" class="btn" id="buzz-btn" data-type="modal-trigger">CREATE A BUZZ</a>
                                <span class="cd-modal-bg"></span>
                            </div>
                           
                            <!-- cd-modal-action -->
                            <div class="cd-modal">
                                <div class="cd-modal-content">
                                    <h2 style="color: white;" align="center">Create a notification for all!</h2>
                                    <div class="mdl-grid content">
                                    {!! Form::open( array(
                                        'url' => 'buzzcreate',
                                        'method' => 'post',
                                        'class' => 'dropzone',
                                        'files' => 'true',
                                        ) ) !!}
                                        <div class="section__text mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid--no-spacing">
                                        
                                            <div class="section__text mdl-cell mdl-cell--12-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone flex-dis-col buzz-upper">
                                               
                                                    <div class="mdl-textfield mdl-js-textfield buzz_title">
                                                        <label class="mdl-textfield__label buzz_title_label" for="sample5">Title...</label>
                                                        <textarea class="mdl-textfield__input" type="text" name="title" rows="1" id="sample5" required></textarea>
                                                    </div>
                                                    <div class="mdl-textfield mdl-js-textfield buzz_des">
                                                        <label class="mdl-textfield__label buzz_des_label" for="sample5">Description...</label>
                                                        <textarea class="mdl-textfield__input" type="text" name="description" rows="4" id="sample5"></textarea>
                                                    </div>
                                                
                                            </div>
                                            <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone mycenter">
                                                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone flex-dis-col" id="dates-group">
                                                    <div class="form-group">
                                                        <h4>Starting Date</h4>
                                                        <div class='input-group date' id='datetimepicker1'>
                                                            <input type='text' name="startingdate" class="form-control" required/>
                                                            <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                            </span>
                                                        </div>
                                                        <h4>Starting Time</h4>
                                                        <div class="form-group">
                                                            <div class='input-group date'  id='datetimepicker3'>
                                                                <input type='text' name="startingtime" class="form-control" required/>
                                                                <span class="input-group-addon">
                                                              <span class="glyphicon glyphicon-time"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="section__text mdl-cell mdl-cell--4-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone flex-dis-col padding-20 buzz_end">
                                                    <div class="form-group">
                                                        <h4>Ending Date</h4>
                                                        <div class='input-group date' id='datetimepicker2'>
                                                            <input type='text' name="endingdate" class="form-control" required/>
                                                            <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                            </span>
                                                        </div>
                                                        <h4>Ending Time</h4>
                                                        <div class="form-group">
                                                            <div class='input-group date' id='datetimepicker4'>
                                                                <input type='text' name="endingtime" class="form-control" required/>
                                                                <span class="input-group-addon">
                                                              <span class="glyphicon glyphicon-time"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="section__text mdl-cell mdl-cell--4-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone padding-20 flex-dis-col" id="poster_buzz" >
                                                    <!-- <div action="/file-upload" class="dropzone" id="my"></div> -->
                                                    <input type='file' id="imgInp" name="file" />
                                                    <img id="imgPrev" src="#" height="200px" />
                                                    <i class="material-icons " id="upload_img"><a class="mycenter">camera_enhance</a></i>
                                                    <h5 class="mycenter" id="buzz_img_label">Upload a Poster</h5>
                                                    <a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect" id="remove_picture">Remove Picture</a> 
                                                </div>
                                            </div>
                                            <div class="section__text mdl-cell mdl-cell--12-col mdl-grid--no-spacing mycenter">
                                                <div class="section__text mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--3-col-phone mdl-cell--middle flex-dis-col">
                                                    <input type="submit" value="Submit" id="buzzsubmit" class="mdl-button mdl-js-button mdl-js-ripple-effect submitbutton" style="background: #009587; text-decoration: none; color: white; width: 200px;">
                                                </div>
                                            </div>
                                             {!! Form::close() !!}
                                        </div>
                                       
                                    </div>
                                </div>
                                <!-- cd-modal-content -->
                            </div>
                            <!-- cd-modal -->
                            <a href="#0" class="cd-modal-close">Close</a>
                        </section>
                    </div>
                </div>
            </div>
            <div class="mdl-grid content" id="main-content">
                @yield('post')
               <!-- <div class="section__text mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--8-col  mdl-grid--no-spacing">
                    <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone flex-dis-col">
                        <header class="author__header">
                            <img src="assets/images/user.jpg" class="comment__avatar">
                            <div class="author__bio">
                                <strong>Divyang Duhan</strong>
                                <span>2 days ago</span>
                            </div>
                            <button id="menu-speed" class="mdl-button mdl-js-button mdl-button--icon edit_delete">
                                <i class="material-icons">more_vert</i>
                            </button>
                            <ul class="mdl-menu mdl-js-menu" for="menu-speed">
                                <li class="mdl-menu__item">Fast</li>
                                <li class="mdl-menu__item">Medium</li>
                                <li class="mdl-menu__item">Slow</li>
                            </ul>
                        </header>
                    </div>
                    <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                        <h2>Cambuzz Design V2</h2> Join us for a night of sorcery and magic as we take a trip back through the world of Harry Potter. Don your robes, ready your wands and mount your Firebolts for the time has come to show off your Potter-mania!
                    </div>
                    <div class="mdl-card__media mdl-card__title mdl-cell--12-col buzz_image">
                        <img src="" width="100%" height="100%" border="0" alt="">
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <div class="mdl-color-text--cyan-600 buzz_date buzz_start_date">Starting Date</div>
                        <div class="mdl-color-text--red-600 buzz_date buzz_end_date">Ending Date</div>
                    </div>
                </div>-->
                <div class="cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-cell--hide-phone mdl-grid mdl-grid--no-spacing" style="z-index: 0;">
                    <div class="updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
                        <div class="mdl-card__title mdl-card--expand mdl-color--cyan-300">
                            <h2 class="mdl-card__title-text">Trending</h2>
                        </div>
                        <div class="mdl-card__supporting-text mdl-color-text--grey-600">
                            The question that gets most upvotes.
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect">Comment</a>
                        </div>
                    </div>
                    <div class="separator mdl-cell--1-col"></div>
                    <div class="demo-card-wide mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title mdl-color--cyan-300">
                            <h2 class="mdl-card__title-text">Question</h2>
                        </div>
                        <div class="mdl-card__supporting-text mdl-color-text--grey-600">
                            Top voted comment
                            <br>goes here
                            <br>:)
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect">Know More</a>
                        </div>
                        <div class="mdl-card__menu">
                            <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" id="sharetop">
                                <i class="material-icons">share</i>
                            </button>
                            <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="sharetop">
                                <li class="mdl-menu__item">Facebook</li>
                                <li class="mdl-menu__item">Twitter</li>
                                <li class="mdl-menu__item">LinkedIn</li>
                            </ul>
                        </div>
                    </div>
                    <div class="separator mdl-cell--1-col"></div>
                </div>
            </div>
        </main>
    </div>
    <script src="assets/js/morph-btn/velocity.min.js"></script>
    <script src="assets/js/morph-btn/main.js"></script>
    <script src="assets/js/material.min.js"></script>
    <script type="text/javascript" src="assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="assets/bower_components/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="assets/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/myjs.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script type="text/javascript">
         $(document).ready(function(){
         //    $("#buzzsubmit").on('click',function(){
               
         //        $(".dropzone").submit();
         //         $('.buzzform1').submit();
         //    });
           
          });

     $("#buzz-btn").click(function() {
     $('#side-bar-nav').fadeOut();
     $("#top-nav-bar").fadeOut();
     // $("#main-content").fadeOut();
     $("#buzz").css('margin-left', '0');
 });

 $(".cd-modal-close").click(function() {
     $("#top-nav-bar").fadeIn();
     $('#side-bar-nav').fadeIn();
     // $("#main-content").fadeIn();
     $("#buzz").css('margin-left', '240px');

 });

    </script>
     <script>
    $("#remove_picture").hide();
    $("#imgPrev").hide();
    $("#imgInp").hide();
    $("#upload_img").click(function() {
        $("#imgInp").click();
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imgPrev').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
        $("#upload_img").fadeOut();
        $("#buzz_img_label").fadeOut();
        $("#imgPrev").show().fadeIn();
        $("#remove_picture").fadeIn();
    });

    $("#remove_picture").click(function() {
        $("#imgInp").val('');
        $("#imgPrev").css("display", "none").fadeOut().attr('src', 'blank');
        $('#remove_picture').fadeOut();
        $("#upload_img").fadeIn();
        $("#buzz_img_label").fadeIn();

    });
    </script>
</body>

</html>

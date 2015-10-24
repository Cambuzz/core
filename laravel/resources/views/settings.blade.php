<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="">
    <title>Settings</title>
    <!-- Add to homescreen for Chrome on Android -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/material.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/styles-question.css">
</head>

<body>
    <div class="layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
        <header class="header mdl-layout__header mdl-color--white mdl-color--grey-100 mdl-color-text--grey-600">
            <div class="mdl-layout__header-row">
                <span class="mdl-layout-title">Settings</span>
                <div class="mdl-layout-spacer"></div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
                    <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
                        <i class="material-icons">search</i>
                    </label>
                    <div class="mdl-textfield__expandable-holder">
                        <input class="mdl-textfield__input" type="text" id="search" />
                        <label class="mdl-textfield__label" for="search">Enter your query...</label>
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
        <div class="drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
            <header class="drawer-header">
                 @if(Session::get('user')->dpstamp==0)
                    <img src="assets/images/user.jpg" class="avatar">
                @else
                    <img src="../../newimages/profile/{{Session::get('user')->id.'_'.Session::get('user')->dpstamp.'.jpg'}} " class="avatar">
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
        <main class="mdl-layout__content mdl-color--grey-100">
         {!! Form::open( array(
                                    'url' => "settings",
                                    'method' => 'post',
                                    'class' => 'settingsform',
                                    'files' => 'true',
                        ) ) !!}
            <div class="mdl-grid content">
                <div class="section__text mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid--no-spacing">
                    <div class="mdl-card__actions mdl-card--border" style="border-bottom: 1px solid rgba(0, 0, 0, .1);">
                        <div class="mdl-button mdl-js-button mdl-js-ripple-effect question_comments">Profile Picture</div>
                    </div>
                    <div class="mycenter">
                        <div class="section__text mdl-cell mdl-cell--5-col-desktop mdl-cell--12-col-tablet mdl-cell--3-col-phone padding-20 flex-dis-col" id="poster_buzz">
                            <!-- <div action="/file-upload" class="dropzone" id="my"></div> -->
                            <input type='file' id="imgInp" name="file" class="file"/>
                            <img id="imgPrev" src="#" height="200px" />
                            <i class="material-icons " id="upload_img"><a class="mycenter">camera_enhance</a></i>
                            <h5 class="mycenter" id="buzz_img_label">Change Profile Picture</h5>
                            <a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect" id="remove_picture">Remove Picture</a>
                        </div>
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <div class="mdl-button mdl-js-button mdl-js-ripple-effect question_comments">Password</div>
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ask_question" style="margin-left: 20px; width: 500px;">
                                <input class="mdl-textfield__input" type="text" id="sample2" class="file" name="op" value="{{Input::get('op')}}"/>
                                <label class="mdl-textfield__label" for="sample2">Old Password</label>
                                @if($errors['opass'])
                                <div>{{ $errors['opass'] }}</div>
                                @endif
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ask_question" style="margin-left: 20px; width: 500px;">
                                <input class="mdl-textfield__input" type="text" id="sample3" name="np" value="{{Input::get('np')}}"/>
                                <label class="mdl-textfield__label" for="sample3">New Password</label>
                                @if($errors['passlen'])
                                <div>{{ $errors['passlen'] }}</div>
                                @endif
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ask_question" style="margin-left: 20px; width: 500px;">
                                <input class="mdl-textfield__input" type="text" id="sample4" name="cp" value="{{Input::get('cp')}}"/>
                                <label class="mdl-textfield__label" for="sample4">Confirm Password</label>
                                <div id="divCheckPasswordMatch"></div>
                            </div>

                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <div class="mdl-button mdl-js-button mdl-js-ripple-effect question_comments">Registration Number</div>
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ask_question" style="margin-left: 20px; width: 500px;">
                                <input class="mdl-textfield__input" type="text" id="sample5" class="register" name="registerno" value="{{Input::get('registerno')}}"/>
                                <label class="mdl-textfield__label" for="sample5">New Registration Number</label>
                                @if($errors['register'])
                                <div>{{ $errors['register'] }}</div>
                                @endif
                            </div>
                    </div>
                    <div class="mdl-card__actions  submit_question">
                        <input type="submit" id="submit" value="SAVE CHANGES" class="mdl-button mdl-js-button mdl-js-ripple-effect submitbutton" style="background: #009587; text-decoration: none; color: white; width: 200px;">
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </main>
    </div>
    <script src="assets/js/material.min.js"></script>
    <script type="text/javascript" src="assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#sample4").keyup(function() {
                var password = $("#sample3").val();
                $("#divCheckPasswordMatch").html(password == $(this).val() ? "Passwords match." : "Passwords do not match!");
            });

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

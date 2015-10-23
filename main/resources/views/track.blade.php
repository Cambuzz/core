<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Track Teacher</title>
    <!-- Add to homescreen for Chrome on Android -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/material.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/search.css">
    <script src="assets/js/search/prefixfree.min.js"></script>
</head>

<body>
    <div class="layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
        <header class="header mdl-layout__header mdl-color--white mdl-color--grey-100 mdl-color-text--grey-600">
            <div class="mdl-layout__header-row">
                <span class="mdl-layout-title">Track your Faculty</span>
                <div class="mdl-layout-spacer"></div>
                <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
                    <i class="material-icons">more_vert</i>
                </button>
                <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
                    <li class="mdl-menu__item">About</li>
                    <li class="mdl-menu__item">Contact</li>
                    <li class="mdl-menu__item">Legal information</li>
                    <a href="logout" style="text-decoration:none;"><li class="mdl-menu__item">Logout</li></a>
                </ul>
            </div>
        </header>
        <div class="drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
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
        <main class="mdl-layout__content mdl-color--grey-100">
            <div class="mdl-grid content">
                <div class="section__text mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid--no-spacing mycenter" id="search_desktop">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-cell--hide-desktop">
                        <label class="mdl-button mdl-js-button mdl-button--icon" for="search1">
                            <i class="material-icons">search</i>
                        </label>
                        <div class="mdl-textfield__expandable-holder">
                            <input class="mdl-textfield__input" type="text" id="search1" />
                            <label class="mdl-textfield__label" for="search1">Enter Faculty Name...</label>
                        </div>
                    </div>
                    <div class="row search_main">
                        <div class="col-lg-12 col-sm-2 mdl-cell--hide-phone">
                            <h2>Enter Faculty's Name:</h2>
                            {!! Form::open( array(
                                        'url' => 'trackteacher',
                                        'method' => 'post',
                            ) ) !!}
                                <div class="search">
                                    <svg version="1.1" viewBox="0 0 142.358 24.582">
                                        <path id="search-path" fill="none" d="M131.597,14.529c-1.487,1.487-3.542,2.407-5.811,2.407
                                        c-4.539,0-8.218-3.679-8.218-8.218s3.679-8.218,8.218-8.218c4.539,0,8.218,3.679,8.218,8.218
                                        C134.004,10.987,133.084,13.042,131.597,14.529c0,0,9.554,9.554,9.554,9.554H0" />
                                    </svg>
                                    <label for="search" class="search-label"></label>
                                    <input type="search" id="search" class="input-search" name="facultyname"/>
                                </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-lg-12 col-sm-2 mdl-cell--hide-phone">

                            @if($teacher&&$teacher['day']==Null&&$teacher['cabin']==Null&&$teacher['slots']==Null)
                                <div >  
                                    Not found in database
                                </div>
                            @endif
                            @if($teacher)
                                <div >  
                                    {{ $teacher['name'] }}<br>
                                    @if($teacher['cabin']!=Null){{ $teacher['cabin'] }}@endif<br> 
                                    @if($teacher['day']!=Null){{ $teacher['day'] }}@endif<br>
                                    @if($teacher['slots']!=Null)
                                        @foreach($teacher['slots'] as $slot)
                                            {{ $slot }}<br> 
                                        @endforeach 
                                    @endif
                                </div>
                                
                            @endif

                            
                            
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="assets/js/typeahead.js"></script>
    <script src="assets/js/material.min.js"></script>
    <script src="assets/js/search/index.js"></script>
</body>
</html>

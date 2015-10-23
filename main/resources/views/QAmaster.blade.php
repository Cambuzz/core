<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="">
    <title>Q/A Forum</title>
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
                <span class="mdl-layout-title">Q/A Forum</span>
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
                <div class="section__text mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid--no-spacing">
                {!! Form::open( array(
                                    'url' => 'Qpost',
                                    'method' => 'post',
                                    'class' => 'questionform',
                        ) ) !!}
                    <div class="section__text mdl-cell mdl-cell--12-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone flex-dis-col">
                        
                            <div class="mdl-textfield mdl-js-textfield ask_question">
                                <label class="mdl-textfield__label" for="sample5">Write your question here...</label>
                                <textarea class="mdl-textfield__input" type="text" name="question" rows="5" id="sample5"></textarea>
                            </div>
                        
                    </div>
                    <div class="mdl-card__actions mdl-card--border submit_question">
                        <input type="submit" value="Submit" class="mdl-button mdl-js-button mdl-js-ripple-effect submitbutton" style="background: #009587; text-decoration: none; color: white; width: 200px;">
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
         @foreach($questions as $question)
            <div class="mdl-grid content">
                <div class="section__text mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid--no-spacing">
                    <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone flex-dis-col">
                        <header class="author__header">
                            <span style="display:none;">
                                {{ $dpstamp=DB::table('users')->whereUsername($question->quest_user)->pluck('dpstamp')}}
                                 {{ $id=DB::table('users')->whereUsername($question->quest_user)->pluck('id')}}
                                 {{ $url =$id.'_'.$dpstamp.'.jpg'}}
                            </span>
                            
                            @if( $dpstamp==0 )
                                <img src="assets/images/user.jpg" class="avatar">
                            @else

                                <img src="../../images/profile/{{$url}} " class="avatar">
                            @endif
                            <div class="author__bio">
                                <strong><span>{{ DB::table('users')->whereUsername($question->quest_user)->pluck('sname') }}</span> <span style="font-weight:300;">posted a question</span></strong>
                                <span>{{ date("d M, y | h:i a",strtotime($question->quest_time)) }}</span>
                            </div>
                        </header>
                    </div>
                    <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                        {{ $question->question }}
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a href="comments/{{$question->id}}" class="mdl-button mdl-js-button mdl-js-ripple-effect question_comments">Comments ({{ DB::table('answers')->whereQid($question->id)->count() }})</a>
                    </div>
                </div>
            </div>
        @endforeach
        </main>
    </div>
    <script src="assets/js/material.min.js"></script>
</body>

</html>
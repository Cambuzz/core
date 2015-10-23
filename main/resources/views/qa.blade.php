@extends('QAmaster')





@section('form')
<div class="mdl-grid content">
        <div class="section__text mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid--no-spacing">
        		{!! Form::open( array(
                                    'url' => 'QAshow',
                                    'method' => 'post',
                                    'class' => 'questionform',
                        ) ) !!}
                <div class="section__text mdl-cell mdl-cell--12-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone" style="display: flex; flex-direction: column; align-items: stretch;">
						
                        
                            <div class="mdl-textfield mdl-js-textfield" style="width: 1000px; max-width: 125%;">
                                <label class="mdl-textfield__label" for="sample5" style="top: 24px;">Write your question here...</label>
                                <textarea class="mdl-textfield__input question" type="text" name="question"  rows="5" id="sample5"></textarea>
                            </div>
                         
                </div>
                    <div class="mdl-card__actions mdl-card--border" style="background: #F3F3F3; display: inline-block; text-align: 	right;">
                       
                        <input type="submit" value="Submit" class="mdl-button mdl-js-button mdl-js-ripple-effect submitbutton" style="background: #009587; text-decoration: none; color: white; width: 200px;">
                    </div>
                {!! Form::close() !!}

        </div>
</div>

    

@endsection

@section('questions')
    
    @foreach($questions as $question)
        
        <div class="mdl-grid content">
                <div class="section__text mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid--no-spacing">
                    <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone" style="display: flex; flex-direction: column; align-items: stretch;">
                        <header class="author__header" style="display: flex; flex-direction: row; align-items: center; margin-bottom: 16px;">
                            <img src="assets/images/user.jpg" class="comment__avatar" style="width: 48px; height: 48px; border-radius: 24px;  margin-right: 16px;">
                            <div class="author__bio" style=" flex-grow: 1; display: flex; flex-direction: column;">
                                <strong><span>{{ DB::table('users')->whereUsername($question->quest_user)->pluck('sname') }}</span> <span style="font-weight:300;">posted a question</span></strong>
                                <span>{{ date("d M, y | h:i a",strtotime($question->quest_time)) }}</span>
                            </div>
                            @if(Session::get('username')==$question->quest_user)
                                <div class="share-btn">
                                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="{{$question->id}}">
                                        <i class="material-icons">more_vert</i>
                                    </button>
                                    <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="{{$question->id}}">
                                        <li class="mdl-menu__item">Share</li>
                                    </ul>
                                </div>
                            @endif
                        </header>
                    </div>
                    <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                        {{ $question->question }}
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <div class="mdl-color-text--cyan-600" style="margin-top: 10px; height: 36px; min-width: 64px; padding: 0 8px; display: inline-block; font-size: 14px; font-weight: 500; text-transform: uppercase; letter-spacing: 0;
    overflow: hidden; float: left;">Starting Date</div>
                        <div class="mdl-color-text--red-600" style="margin-top: 10px; height: 36px; min-width: 64px; padding: 0 8px; display: inline-block; font-size: 14px; font-weight: 500; text-transform: uppercase; letter-spacing: 0;
    overflow: hidden; float: right;">Ending Date</div>
                    </div>
                </div>
            </div>

    @endforeach
    
@endsection




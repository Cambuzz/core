@extends('BUZZmaster')

@section('post')
 	@foreach($posts as $post)
      <div class="section__text mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--8-col  mdl-grid--no-spacing">
                    <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone flex-dis-col">
                        <header class="author__header">
                            <span style="display:none;">
                                {{ $dpstamp=DB::table('users')->whereUsername($post->buzz_username)->pluck('dpstamp')}}
                                 {{ $id=DB::table('users')->whereUsername($post->buzz_username)->pluck('id')}}
                                 {{ $url =$id.'_'.$dpstamp.'.jpg'}}
                            </span>
                            
                            @if( $dpstamp==0 )
                                <img src="assets/images/user.jpg" class="avatar">
                            @else

                                <img src="../../images/profile/{{$url}} " class="avatar">
                            @endif
                            <div class="author__bio">
                                <strong>{{ DB::table('users')->whereUsername($post->buzz_username)->pluck('sname') }}</strong>
                                <span>{{ date("d M, y | h:i a",strtotime($post->buzz_time)) }}</span>
                            </div>
                            <!-- <button id="menu-speed" class="mdl-button mdl-js-button mdl-button--icon edit_delete">
                                <i class="material-icons">more_vert</i>
                            </button>
                            <ul class="mdl-menu mdl-js-menu" for="menu-speed">
                                <li class="mdl-menu__item">Fast</li>
                                <li class="mdl-menu__item">Medium</li>
                                <li class="mdl-menu__item">Slow</li>
                            </ul> -->
                        </header>
                    </div>
                    <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                        <h2>{{ $post->title }}</h2> 
                        {{ $post->content }}
                    </div>
                    @if($post->poset==1)
                    <div class="mdl-card__media mdl-card__title mdl-cell--12-col buzz_image">
                        <img src="../../images/{{ $post->id.'.jpg' }}" width="100%" height="100%" border="0" alt="">
                    </div>
                  	@endif
                    <div class="mdl-card__actions mdl-card--border">
                        <div class="mdl-color-text--cyan-600 buzz_date buzz_start_date">{{ date("d M, y | h:i a",strtotime($post->start_date_time)) }}</div>
                        <div class="mdl-color-text--red-600 buzz_date buzz_end_date">{{ date("d M, y | h:i a",strtotime($post->end_date_time)) }}</div>
                    </div>
                </div>

    @endforeach
@endsection
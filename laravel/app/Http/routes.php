<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route to display the index page.
Route::get('/', function()
{
	if(Session::has('username'))
         return redirect('buzz');
    
	return View::make('index');
});


//Routes for the buzz
//index buzz route
Route::get('buzz', function()
{
	if(!Session::has('username'))
         return redirect('/');

    $posts=App\buzz::orderby('id','desc')->get();
	return View::make('BUZZmaster')->with('posts',$posts);
});
//route for creating a buzz
Route::post('buzzcreate','BuzzController@buzzcreate');





//Routes for QA Forum
//Index route for QA
Route::get('QA', function()
{
	if(!Session::has('username'))
         return redirect('/');

	$questions=App\QA::orderby('id','desc')->get();
	return View::make('QAmaster')->with('questions',$questions);
});
//Route to save the question asked by the current user.
Route::post('Qpost', function()
{
	if(!Session::has('username'))
         return redirect('/');

	$mytime = Carbon\Carbon::now();
    $time=$mytime->toDateTimeString();
	$quest = new App\QA;
	$quest->question=Input::get( 'question' );
	$quest->quest_user=Session::get('username');
	$quest->quest_time=$time;
	$quest->save();
	return redirect('QA');
});
Route::post('commentpost/{id}', function($id)
{
	//return $id;
	if(!Session::has('username'))
         return redirect('/');

	$mytime = Carbon\Carbon::now();
    $time=$mytime->toDateTimeString();
	$comment = new App\comments;
	$comment->answer=Input::get( 'comment' );
	$comment->answer_poster=Session::get('username');
	$comment->qid=$id;
	$comment->answer_time=$time;
	$comment->save();
	return redirect('comments/'.$id);
});
Route::get('comments/{id}', function($id)
{

	if(!Session::has('username'))
         return redirect('/');
    $question=App\QA::whereId($id)->first();
    $comments=App\comments::whereQid($id)->get();
	return View::make('comments')->with('qa',array('question'=>$question,'comments'=>$comments));
});



//Routes For track your faculty
Route::get('track', function()
{
	if(!Session::has('username'))
         return redirect('/');
    return View::make('track')->with('teacher',NULL);
	
});
//route for tracking the faculty
Route::post('trackteacher','TrackController@track');



Route::get('settings', function()
{
	if(!Session::has('username'))
         return redirect('/');

     return View::make('settings')->with('errors',Null);
});
Route::post('settings','SettingsController@settings');


Route::get('confirmaccount', function()
{
	return View::make('accountverification')->with('data',array('username' => Input::get('username') , 'secret' => Input::get('secret') ));
});

Route::post('confirmation', function()
{
	
    $username=Input::get('username');
    $secret=Input::get('secret');
    $user=App\User::whereUsername($username)->first();
    $ectstamp=$user->ectstamp;
    $confirmed=$user->confirmed;
    $verifytime = Carbon\Carbon::now();
    if(($verifytime-$ectstamp)<=(1800))
    {
	    if($confirmed==0)
	    {
	    	$uniquestring=$user->uniquestring;
	    	if($uniquestring==$secret)
	    	{
	    		$user->confirmed=1;
	    		$user->uniquestring="";
	    		$user->save();
	    		return redirect('/');
	    	}
	    }
	}
	else
	{
		$user->delete();
		return "Link Expired. Please signup again. We apologise for the inconvenience.";
	}
	return "Invalid Link.";
});


//Route for signup form.
Route::post( 'signup', 'UsersController@store');
//Route for login form
Route::post( 'login', 'UsersController@store');


//Route for logging out.
Route::get('logout', function()
{
	Session::flush();
   return redirect('/');
});





















//Route for login
// Route::post('login', function()
// {

// 	if (Session::has('username')) 
// 	{
// 	  $username = Session::get('username');
// 	  $response = array(
//              'msg' => $username,
//          	);
//          	return Response::json( $response );
// 	}

// 	$username = Input::get( 'username' );
//     $password = Input::get( 'password' );
//     $hashed_password=md5($password);
    
//     $user=DB::table('users')->where('username',$username)->first();

//     $checkpassword=DB::table('users')->where('username',$username)->pluck('password');
//     if($checkpassword==$hashed_password)
//     {
    	
//     	Session::put('username', $username);
//     	Session::put('user',$user);
//          return redirect('QA');
//     }

	
//  });








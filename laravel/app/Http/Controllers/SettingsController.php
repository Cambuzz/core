<?php

namespace App\Http\Controllers;
use DB;
use View;
use Carbon;
use Session;
use App\User;
use File;
use Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
	public function settings(Request $request)
	{
		if(!Session::has('username'))
         return redirect('/');

    $opass="";
    $passmatch="";
    $passlen="";
    if($request['op']&&$request['np']&&$request['cp'])
    {
    	if(strlen($request['np'])>=6&&strlen($request['cp'])>=6)
    	{
	    	if($request['np']==$request['cp'])
	    	{
		    	$password=Session::get('user')->hashed_password;
		    	if (Hash::check($request['op'],$password)) 
		         {

		            	$user= user::whereUsername(Session::get('username'))->first();
		            	$user->hashed_password=Hash::make($request['np']);
		            	$user->save();
		            	$newuser= user::whereUsername(Session::get('username'))->first();
		                Session::put('user',$newuser);
		         }
		         else
		         {
		         	$opass="Invalid old password";
		         }
	        }
	        else
	        {
	        	$passmatch="The passwords donot match";
	        }
	    }
	    else
	    {
	    	$passlen="The length of newpassword should be more than 5";
	    }
    }
    $register="";
    if($request['registerno'])
    {
    	$count=user::whereUsername($request['registerno'])->count();
    	if($count==0)
    	{
	    	$user= user::whereUsername(Session::get('username'))->first();
	    	$user->username=$request['registerno'];
	    	$user->save();
	    	Session::put('username',$request['registerno']);
	    	$newuser= user::whereUsername(Session::get('username'))->first();
	    	Session::put('user',$newuser);	
	    }
	    else
	    {
	    	$register="The Username already exists.";
	    }
    	
    	
    }
    if($request['file'])
    {
    	$timestamp=strtotime(Carbon\Carbon::now());
    	$user= user::whereUsername(Session::get('username'))->first();
    	$id=$user->id;
    	$dps=$user->dpstamp;
    	$user->dpstamp=$timestamp;
    	$user->save();
    	$newuser= user::whereUsername(Session::get('username'))->first();
        Session::put('user',$newuser);
        if (File::exists("../../newimages/profile/".$id."_".$dps.".jpg"))
        {
        	File::delete("../../newimages/profile/".$id."_".$dps.".jpg");
        }
    	$imgurl=Session::get('user')->id.'_'.$timestamp.'.jpg';
    	$request['file']->move("../../newimages/profile",$imgurl);
    }
    $error=array('register'=>$register,'opass'=>$opass,'passmatch'=>$passmatch,'passlen'=>$passlen);
    if($opass==""&&$register==""&&$passlen==""&&$passmatch=="")
    	return redirect('settings');

    return View::make('settings')->withInput($request)->with('errors',$error);
	}
}

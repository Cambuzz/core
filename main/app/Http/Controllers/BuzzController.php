<?php

namespace App\Http\Controllers;
use DB;
use View;
use Carbon;
use Session;
use App\buzz as buzz;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BuzzController extends Controller
{
	public function buzzcreate(Request $request)
	{
		$poset=0;
		if($request['file'])
			$poset=1;
		$mytime = Carbon\Carbon::now();
	    $time=$mytime->toDateTimeString();
		$buzz = new buzz;
		$username=Session::get('username');
		$sdt=date('y-m-d h:i:s',strtotime($request['startingdate'].$request['startingtime']));
		$edt=date('y-m-d h:i:s',strtotime($request['endingdate'].$request['endingtime']));
		$buzz->title=$request['title'];
	    $buzz->content=$request['description'];
	    $buzz->start_date_time=$sdt;
		$buzz->end_date_time=$edt;
		$buzz->buzz_username=$username;
		$buzz->buzz_time=$time;
		$buzz->poset=$poset;
		$buzz->save();
		$newbuzz=buzz::where('buzz_username',$username)->where('buzz_time',$time)->first();
		$id =$newbuzz->id;
		$postername=$id.'.jpg';
		if($poset==1)
		$request['file']->move("../../images",$postername);
		return redirect('buzz');
	}
}

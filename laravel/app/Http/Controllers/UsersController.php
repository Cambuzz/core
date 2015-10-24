<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Mail;
use Carbon;
use DB;
use Hash;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\AuthController;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return "logged in";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return "loggedin";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */

    public function store(Request $request)
    {
        if($request->usernamelogin!=null)
        {
            
             $username = $request->usernamelogin;
             $password = $request->passwordlogin;
             //$hashed_password=bcrypt($password);
            // return $hashed_password;

             $user=DB::table('users')->where('username',$username)->first();
             $checkpassword=DB::table('users')->where('username',$username)->pluck('hashed_password');

             $conf=DB::table('users')->where('username',$username)->pluck('confirmed');
             if(!$user)
                return "failed";
             if($conf==0)
                return "nc";
            // $hashp = crypt($password,$checkpassword);
            // return $hashp;
            if (Hash::check($password,$checkpassword)) 
            {
                //return "hey2";
                // session()->put('username', $username);
                // session()->put('user',$user);
                Session::put('username', $username);
                Session::put('user',$user);
                return "done";
            } 
            return "failed";
        }

            $rules=array(
                'name' => 'required',
                'username' => 'required|unique:users',
                'password' => 'required|min:6',
                'email' => 'required|unique:users'
            );
        $validator = Validator::make($request->all(),$rules);
        
        $email=$request->input('email');
            if( substr($email,strlen($email)-10,10)!="@vit.ac.in")
            {
                return "failed";
            }
            else
            {
        if($validator->fails())
        {
            
                $errors=$validator->messages();
                return $errors;
            
            
        }
    }

        $name = $request->name;
        $register = $request->username;
        $email = $request->email;
        $password=$request->password;
        
        $hash_format = "$2y$10$";
        $length = 22;
        $unique_random_string = md5(uniqid(mt_rand(), true));
        $base64_string = base64_encode($unique_random_string);
        $modified_base64_string = str_replace('+', '.', $base64_string);
        $salt = substr($modified_base64_string, 0, $length);
        $format_and_salt = $hash_format . $salt;
        $hashed_password = crypt($password, $format_and_salt);
        
        $hashed_password =Hash::make($password);
        $uniquestring = str_random(50);
        $url="https://cambuzz.co.in/laravel/public/confirmaccount?username=".$register."&secret=".$uniquestring;
        $timestamp=strtotime(Carbon\Carbon::now());
        DB::table('users')->insert(['sname' => $name,'username' => $register,'email' => $email,'hashed_password' => $hashed_password,'confirm_string' => $uniquestring,'ectstamp' => $timestamp]);
        Mail::send('emails.sendemail', ['url' => $url], function ($m) use ($email) {
            $m->to($email, $name)->subject('Confirm Your Account.');
        });
        //DB::table('users')->insert(['sname' => $name,'username' => $register,'email' => $email,'hashed_password' => $hashed_password]);
 
        return 'done';
 
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cart;
use Auth;
use Session;
use App\Country;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class UsersController extends Controller
{
  public function userLoginRegister()
  {
    //seo meta tags
    $meta_title = "Shopping cart - E-Shop Website";
    $meta_description = "View Shopping Cart of E-Shop Website";
    $meta_keywords    = "shopping cart, e-shop website";

    return view('users.login_register');
  }

  //Register New User
  public function register(Request $request)
  {
    $data = $request->all();
  	if($request->isMethod('post'))
  	{
  		$userCount = User::where('email', $request->email)->count();
  		if($userCount > 0)
      {
  			return redirect()->back()->with('flash_message_error', 'Email Already Exists.');
  		}
      else
      {
        //create new user
        $request["password"] = bcrypt($request->password);
        $request["admin"]    = '0';
        User::create($request->all());

        //Send Confirmation Email
        $email = $data['email'];
        $messageData = ['email'=>$data['email'], 'name'=>$data['name'], 'code'=>base64_encode($data['email'])];
        Mail::send('emails.confirmation',$messageData,function($message) use($email){
           $message->to($email)->subject('Confirm your E-Shop account');
        });

        return redirect()->back()->with('flash_message_error', 'An Email is sent to your account, please confirm your email to activate your account');
        
        //redirect the user to cart page after registering
        if(Auth::attempt(['email'=>$data['email'],'password' => $data['password']]))
        {
          Session::put('frontSession', $data["email"]); 

           if(!empty(Session::get('session_id')))
           {
             $session_id = Session::get('session_id');
             Cart::where('session_id', $session_id)->update(['user_email'=>$data['email']]);
           }

          return redirect('/cart');
        }
      }
  	}
  }

  //activate account
  public function confirmAccount($email)
  {
    $email = base64_decode($email);
    $userCount = User::where('email', $email)->count();

    if($userCount > 0){
         $user = User::where('email', $email)->first();
         if($user->status == 0){
          User::where('email',$email)->update(['status'=>1]);

          //send welcome email
          $messageData = ['email'=>$email, 'name'=>$user->name];
          Mail::send('emails.wellcome',$messageData,function($message) use($email){
             $message->to($email)->subject('Wellcome E-Shop Website');
          });

          return redirect('/login-register')->with('flash_message_success', 'Your account has been activated. You can login now.');
         }
         else{
          return redirect('/login-register')->with('flash_message_success', 'Your account is already active. You can login.');
         }
    }
    else{
      abort(404);
    }
  }

  //User login function
  public function login(Request $request)
  {
      if($request->isMethod('post'))
      {
        $data = $request->all();

         //check if user account is active or not
          $user_status = User::where('email', $data['email'])->first();

          if($user_status->status == 0){
            return back()->with('flash_message_error', 'Your account is not active ! please confirm your email to activate your account.');
           }

         if(Auth::attempt(['email'=>$data['email'],'password' => $data['password'],'status' => '1'])){

           Session::put('frontSession', $data["email"]); 

           if(!empty(Session::get('session_id')))
           {
             $session_id = Session::get('session_id');
             Cart::where('session_id', $session_id)->update(['user_email'=>$data['email']]);
           }

           return redirect('/cart');
          }
         else
         {
            return back()->with('flash_message_error', 'Invalid Username or Password!');
         }

      }
  }

  //forgot password
  public function forgotPassword(Request $request)
  {
    if($request->isMethod('post')){
       $data = $request->all();

       $userCount = User::where('email', $data['email'])->count();
       if($userCount == 0){
        return redirect()->back()->with('flash_message_error', 'Email does not exist');
       }

       //user info
       $userInfo = User::where('email', $data['email'])->first();

       //generate random password
       $random_pwd = str_random(8);

       //encode pwd
       $new_pwd = bcrypt($random_pwd);

       //update user pwd
       User::where('email', $data['email'])->update(['password'=>$new_pwd]);

       //Send email to user
       $email = $data['email'];
       $name  = $userInfo->name;
       $messageData = ['email'=> $email, 'password'=>$random_pwd, 'name'=>$name];

        Mail::send('emails.forgot_password',$messageData, function($message) use($email){
         $message->to($email)->subject('New Password - E-Shop Website');

        return redirect('/login-register')->with('flash_message_success', 'Please check your email for new password.');

       });
    }
    return view('users.forgot_password');
  }

  //check if user already exist or not
  public function checkEmail(Request $request)
  {
     $userCount = User::where('email', $request->email)->count();
      if($userCount > 0){
          return "false";
      }
      else{
          return "true";
      }
  }

  //user account function
  public function account(Request $request)
  {
      if($request->isMethod('post'))
      {
          $user = User::find(Auth::user()->id);
          $user->name = $request->name;
          $user->address = $request->address;
          $user->city = $request->city;
          $user->state = $request->state;
          $user->country_id = $request->country_id;
          $user->pincode = $request->pincode;
          $user->mobile = $request->mobile;

          $user->save();
          return back()->with('flash_message_success', 'Account Info Updated.');
      }

      //for get request
      $user = Auth::user();
      $countries = Country::all();
      return view('users.account', compact('countries', 'user'));
  }

  //for checking user current pwd
  public function checkUserPwd(Request $request)
  {
      $data = $request->all();
      $current_password = $data['current_pwd'];

      $user = Auth::user();
      if(Hash::check($current_password , $user->password))
      {
          echo "true"; die;
      }else{
          echo "false"; die;
      }
  }

  //update user pwd
  public function updatePassword(Request $request)
  {
      $data = $request->all();
      $user = Auth::user();
  
      if(Hash::check($data['current_pwd'] , $user->password))
      {
          $password = bcrypt($data['new_pwd']);
          $user->password = $password;
          $user->save();
          return redirect('/account')->with('flash_message_success', 'Password has been updated.');
      }
      else{
          return redirect('/account')->with('flash_message_error', 'Current Password is Incorrect.');
      }
  }

  //User Logout function
  public function userlogout()
  {
    Auth::logout();
    Session::forget('frontSession');
    Session::forget('session_id');
    return redirect('/');
  }

  //view users
  public function viewUsers()
  {
    $users = User::all();
    return view('admin.users.view_users', compact('users'));
  }
}

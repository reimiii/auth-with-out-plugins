<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\Websitemail;
use Hash;
use Auth;

class WebsiteController extends Controller
{
  public function index()
  {
    return view('home');
  }

  public function dsh_user()
  {
    return view('dashboard-user');
  }

  public function login()
  {
    return view('login');
  }

  public function login_submit(Request $request)
  {
    $credentials = [
      'email' => $request->email,
      'password' => $request->password,
      'status' => 'Active',
    ];

    if (Auth::attempt($credentials)) {
      return redirect()->route('dsh_user');
    } else {
      return redirect()->route('login');
    }
  }

  public function logout()
  {
    Auth::guard('web')->logout();
    return redirect()->route('login');
  }

  public function register()
  {
    return view('register');
  }

  public function register_submit(Request $request)
  {
    $token = hash('sha256', time());

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->status = 'Pending';
    $user->token = $token;
    $user->save();

    $verif_link = url('register/verif/' . $token . '/' . $user->email);
    $subject = 'Verify your email address';
    $message =
      'Please click on the link below to verify your email address: <br><a href="' .
      $verif_link .
      '">clik
      </a>';

    \Mail::to($request->email)->send(new Websitemail($subject, $message));

    echo '<script>alert("Please check your email to verify your account.");</script>';
  }

  public function register_verif($token, $email)
  {
    $user = User::where('token', $token)
      ->where('email', $email)
      ->first();

    if (!$user) {
      echo '<script>alert("Invalid token.");</script>';
      return redirect()->route('login');
    }

    $user->status = 'Active';
    $user->token = '';
    $user->update();

    echo '<script>alert("Your account has been verified.");</script>';
  }

  public function fpass()
  {
    return view('forget_password');
  }

  public function fpass_submit(Request $request)
  {
    $token = hash('sha256', time());

    $user = User::where('email', $request->email)->first();
    if (!$user) {
      dd('Invalid email.');
    }

    $user->token = $token;
    $user->update();

    $verif_link = url('reset-password/verif/' . $token . '/' . $request->email);
    $subject = 'Reset your password';
    $message =
      'Please click on the link below to reset your password: <br><a href="' .
      $verif_link .
      '">clik</a>';
    \Mail::to($request->email)->send(new Websitemail($subject, $message));

    echo '<script>alert("Please check your email to reset your password.");</script>';
  }

  public function verif($token, $email)
  {
    $user = User::where('token', $token)
      ->where('email', $email)
      ->first();

    if (!$user) {
      echo '<script>alert("Invalid token.");</script>';
      return redirect()->route('login');
    }

    return view('reset-pass', compact('token', 'email'));
  }

  public function newpass(Request $request)
  {
    //
    $user = User::where('token', $request->token)
      ->where('email', $request->email)
      ->first();

    $user->token = '';
    $user->password = Hash::make($request->new_password);
    $user->update();

    echo '<script>alert("Your password has been reset.");</script>';
  }
}

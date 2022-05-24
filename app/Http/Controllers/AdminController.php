<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\Admin;

class AdminController extends Controller
{
  public function login()
  {
    return view('admin.login');
  }
  public function logout()
  {
    Auth::guard('admin')->logout();
    return redirect()->route('admin_login');
  }

  public function dsh()
  {
    return view('admin.dashboard');
  }

  public function setting()
  {
    return view('admin.setting');
  }

  public function admin_login_submit(Request $request)
  {
    $credentials = [
      'email' => $request->email,
      'password' => $request->password,
    ];

    if (Auth::guard('admin')->attempt($credentials)) {
      return redirect()->route('dsh_adm');
    } else {
      return redirect()->route('admin_login');
    }
  }
}

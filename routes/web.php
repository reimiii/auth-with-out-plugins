<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\AdminController;

Route::get('/', [WebsiteController::class, 'index'])->name('home');

// Admin
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin_login');

Route::get('/admin/dashboard', [AdminController::class, 'dsh'])
  ->name('dsh_adm')
  ->middleware('admin:admin');

Route::get('/admin/setting', [AdminController::class, 'setting'])
  ->name('adm_setting')
  ->middleware('admin:admin');

Route::post('/login-submit-admin', [AdminController::class, 'admin_login_submit'])->name(
  'admin_login_submit'
);

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('adm_logout');

// end Admin

Route::get('/dashboard', [WebsiteController::class, 'dsh_user'])
  ->name('dsh_user')
  ->middleware('auth');

Route::get('/login', [WebsiteController::class, 'login'])->name('login');
Route::post('/login-submit', [WebsiteController::class, 'login_submit'])->name('login_submit');

Route::get('/logout', [WebsiteController::class, 'logout'])->name('logout');

Route::get('/register', [WebsiteController::class, 'register'])->name('register');
Route::post('/register-submit', [WebsiteController::class, 'register_submit'])->name(
  'register_submit'
);
Route::get('register/verif/{token}/{email}', [WebsiteController::class, 'register_verif']);

Route::get('/forget-password', [WebsiteController::class, 'fpass'])->name('fpass');
Route::post('/forget-password-submit', [WebsiteController::class, 'fpass_submit'])->name(
  'forget.routeess'
);

Route::get('reset-password/verif/{token}/{email}', [WebsiteController::class, 'verif'])->name(
  'verif'
);
Route::post('/new-password', [WebsiteController::class, 'newpass'])->name('newpass');

<?php

use App\Http\Controllers\Frontend\Auth\AuthController;
use App\Http\Controllers\Frontend\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\Auth\SocialAuthController;
use App\Http\Controllers\Frontend\Auth\VerificationController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('welcome');

// Change languaje
Route::get('lang/{lang}', [HomeController::class, 'swap'])->name('lang.swap');

// Auth
Route::group(['middleware' => ['web']], function (){
	Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
	Route::post('login', [AuthController::class, 'login'])->name('login.user');
	Route::post('logout', [AuthController::class, 'logout'])->name('logout');

	if (config('envi.register')) {
		Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
		Route::post('register', [AuthController::class, 'register'])->name('register.user');
	}

	Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
	Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
	Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
	Route::post('password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');

	Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
	Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
	Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

	// Social Auth
	Route::get('oauth/{driver}', [SocialAuthController::class, 'redirectToProvider'])->name('social.oauth');
	Route::get('oauth/{driver}/callback', [SocialAuthController::class,'handleProviderCallback'])->name('social.callback');
});

// Admin panel
Route::group(['middleware' => ['auth', 'verified']], function () {
	Route::get('/home', [HomeController::class, 'home'])->name('home');
	// Env
	Route::resource('env', \App\Http\Controllers\Backend\EnvController::class, ['except' => ['create', 'store', 'show', 'destroy']]);
	// Settings
	Route::resource('setting', \App\Http\Controllers\Backend\SettingController::class, ['except' => ['create', 'edit', 'show', 'destroy']]);
	// Permissions
	Route::resource('permissions', \App\Http\Controllers\Backend\PermissionsController::class);
	// Roles
	Route::resource('roles', \App\Http\Controllers\Backend\RolesController::class);
	// Users
	Route::resource('users', \App\Http\Controllers\Backend\UserController::class);
	// Addons
	Route::resource('addons', \App\Http\Controllers\Backend\AddonsController::class);
	Route::post('addons/active', [App\Http\Controllers\Backend\AddonsController::class, 'active'])->name('addons.active');
	Route::post('addons/migrate/{addon}', [App\Http\Controllers\Backend\AddonsController::class, 'migrate'])->name('addons.migrate');
	Route::get('addons/download/{addon}', [App\Http\Controllers\Backend\AddonsController::class, 'download'])->name('addons.download');
});

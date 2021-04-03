<?php

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

Route::get( '/', function () {
    return view( 'welcome' );
} );

Auth::routes();

// Login With Google
Route::get('login/google', 'Auth\LoginController@redirectToGoogle')->name('login.google');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');

// User Routes
Route::post( 'complaint', 'ComplaintController@store' )->name( 'complaint.submit' );

//////////////////////////////////////////////////////////////////////////////////////////////////////

Route::get( '/home', 'HomeController@index' )->name( 'home' );
Route::post( '/user/logout', 'Auth\LoginController@userLogout' )->name( 'user.logout' );

// Admin Routes
Route::prefix( 'admin' )->group( function () {
    // Dashboard route
    Route::get( '/', 'AdminController@index' )->name( 'admin.dashboard' );
    // Update the Complaint
    Route::get('/complaint/{id}', 'AdminController@update')->name('update.complaint');

    // Login routes
    Route::get( '/login', 'Auth\AdminLoginController@showLoginForm' )->name( 'admin.login' );
    Route::post( '/login', 'Auth\AdminLoginController@login' )->name( 'admin.login.submit' );

    // Logout route
    Route::post( '/logout', 'Auth\AdminLoginController@logout' )->name( 'admin.logout' );

    // Register routes
    Route::get( '/register', 'Auth\AdminRegisterController@showRegistrationForm' )->name( 'admin.register' );
    Route::post( '/register', 'Auth\AdminRegisterController@register' )->name( 'admin.register.submit' );

    // Password reset routes
    Route::get( '/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm' )->name( 'admin.password.request' );
    Route::post( '/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail' )->name( 'admin.password.email' );
    Route::get( '/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm' )->name( 'admin.password.reset' );
    Route::post( '/password/reset', 'Auth\AdminResetPasswordController@reset' )->name( 'admin.password.update' );
} );

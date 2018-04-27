<?php

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

// Home Routes...
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');

// Apply for Coach
Route::get('apply', 'HomeController@showBecomeACoach')->name('apply');

// Auth Routes...
Route::group(['namespace' => 'Auth'], function () {
    // Authentication Routes...
    Route::get('sign-in', 'LoginController@showLoginForm')->name('sign-in');
    Route::post('sign-in', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('sign-up', 'LoginController@showLoginForm')->name('sign-up');
    Route::post('sign-up', 'RegisterController@register');
    Route::post('confirm', 'ConfirmController@attemptConfirmation')->name('confirmation');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset');
});

// Admin Routes...
Route::group([
    'namespace'  => 'Admin',
    'prefix'     => 'admin',
    'middleware' => ['auth', 'role:admin']
], function () {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
});
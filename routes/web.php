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
    Route::put('confirm', 'ConfirmController@resendConfirmation');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}/{email}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset');
});

Route::group([
    'middleware' => 'auth'
], function () {
    // Apply for Coach
    Route::get('apply', 'HomeController@showBecomeACoach')->name('apply');

    // Upload avatar
    Route::post('avatar', 'ProfileController@uploadAvatar')->name('avatar');
});

// Admin Routes...
Route::name('admin.')->namespace('Admin')->prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    // Users management...
    Route::prefix('users')->name('users')->group(function () {
        Route::get('/', 'DashboardController@users')->name('');
        Route::get('new', 'UsersController@editUser')->name('.new');
        Route::post('new', 'UsersController@createUser')->name('.new');
        Route::get('{user}', 'UsersController@editUser')->name('.edit');
        Route::put('{user}', 'UsersController@updateUser')->name('.update');
        Route::delete('{user}', 'UsersController@deleteUser')->name('.delete');
    });

    Route::get('reviews', 'DashboardController@reviews')->name('reviews');
    Route::get('report', 'DashboardController@report')->name('report');

    Route::prefix('settings')->group(function () {
        Route::get('/', 'DashboardController@settings')->name('settings');
        Route::put('basic', 'SettingsController@updateBasic')->name('settings.basic');
        Route::put('smtp', 'SettingsController@updateSmtp')->name('settings.smtp');
    });

});
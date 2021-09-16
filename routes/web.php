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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dash', 'HomeController@index')->name('dash');

Route::get('login/github', 'Auth\LoginController@redirectToGithubProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleGithubProviderCallback');

Route::get('login/google', 'Auth\LoginController@redirectToGoogleProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleProviderCallback');

Route::get('login/twitter', 'Auth\LoginController@redirectToTwitterProvider');
Route::get('login/twitter/callback', 'Auth\LoginController@handleTwitterProviderCallback');



Route::post('/twet/{id}', 'TwetController@store');
Route::get('/twet/{id}', 'TwetController@show')->name('twet');
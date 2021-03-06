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

Route::get('/', 'MicropostsController@index');
//user configration
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
Route::group(['middleware' => ['auth']], function(){
    Route::group(['prefix' => 'users/{id}'], function () {
       Route::post('follow', 'UserFollowController@store')->name('user.follow');
       Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
       
       Route::get('followings', 'UserController@followings')->name('users.followings');
       Route::get('followers', 'UserController@followers')->name('users.followers');
       
       Route::get('favorites', 'UserController@favorites')->name('users.favorites');
    });
    
    Route::resource('users', 'UserController', ['only' => ['index', 'show']]);
    
    Route::prefix('microposts/{id}')->group(function() {
        Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
    });
    
    Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy']]);
});


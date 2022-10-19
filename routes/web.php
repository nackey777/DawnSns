<?php
Auth::routes();

//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');
Route::get('added', 'Auth\RegisterController@added');

Route::get('/logout', 'Auth\LoginController@logout');


//ログイン中のページ
Route::get('/top','PostsController@index');
Route::post('/post','PostsController@post');
Route::post('/update-post','PostsController@updatePost');
Route::get('/profile','PostsController@profile');
Route::post('/update-profile','PostsController@updateProfile');

Route::get('/search','UsersController@search');
Route::post('/search','UsersController@search');
Route::get('/follow','UsersController@follow');
Route::get('/unfollow','UsersController@unfollow');
Route::get('/profile/{id}','UsersController@profile');

Route::get('/follow-list','FollowsController@followList');
Route::get('/follower-list','FollowsController@followerList');

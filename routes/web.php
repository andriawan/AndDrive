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

Route::get('/', array('as'=>'home','uses'=>'Home@index'));

Route::get('auth',array('as'=>'glogin','uses'=>'Home@google_login'));
Route::get('profile',array('as'=>'profile','uses'=>'Home@get_user_profile')) ;
Route::get('files',array('as'=>'lists','uses'=>'Home@list_files')) ;
Route::get('download/{id}',array('as'=>'download','uses'=>'Home@download_file')) ;
Route::get('logout',array('as'=>'logout','uses'=>'Home@logout')) ;

Route::post('/drive/from/local', array('as'=>'local_upload','uses'=>'Home@upload_local'));
Route::post('/drive/from/url', array('as'=>'url_upload','uses'=>'Home@upload_url'));
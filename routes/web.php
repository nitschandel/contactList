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

Route::get('/', array('as'=>'root', 'uses' => 'Auth\LoginController@login'));

Route::post('contacts/search', 'ContactController@search');

Route::resource('contacts', 'ContactController');

Route::post('contacts/{id}', 'ContactController@update');

Route::get('contacts/{id}/delete', 'ContactController@destroy');

Route::get('contacts/{id}/export', 'ContactVCardController@singleContactVCard');

Route::post('/signin','Auth\LoginController@signin');
Route::get('/logout','Auth\LoginController@logout');

Route::get('/signup','Auth\RegisterController@getSignup');
Route::post('/signup','Auth\RegisterController@signup');


Route::get('auth/facebook', 'Auth\LoginController@redirectToProviderFacebook');
Route::get('auth/facebook/callback', 'Auth\LoginController@handleProviderCallbackFacebook');

Route::get('auth/google', 'Auth\LoginController@redirectToProviderGoogle');
Route::get('auth/google/callback', 'Auth\LoginController@handleProviderCallbackGoogle');

Route::post('/forgotPassword' , 'Auth\ResetPasswordController@sendChangePasswordLink');
Route::get('/resetPassword' , 'Auth\ResetPasswordController@resetPassword');
Route::post('/saveNewPassword' , 'Auth\ResetPasswordController@saveNewPassword');


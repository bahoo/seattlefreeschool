<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::pattern('id', '\d+');
Route::pattern('slug', '[\w\-]+');


Route::group(array(), function(){
   Route::get('/login', array('as' => 'login', 'uses' => 'AuthController@getLogin'));
   Route::post('/login', array('as' => 'login.post', 'uses' => 'AuthController@postLogin'));
   Route::get('/logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));
   Route::post('/logout', array('as' => 'logout.post', 'uses' => 'AuthController@postLogout'));
});

Route::group(array('before' => 'auth.basic'), function()
{

   Route::get('/', array('as' => 'index', 'uses' => 'IndexController@index'));

   Route::group(array('prefix' => 'password'), function(){
      Route::get('/remind/{email?}', array('as' => 'password.remind', 'uses' => 'PasswordController@getRemind'));
      Route::post('/remind', array('as' => 'password.remind.post', 'uses' => 'PasswordController@postRemind'));
      Route::get('/reset/{token?}', array('as' => 'password.reset', 'uses' => 'PasswordController@getReset'));
      Route::post('/reset', array('as' => 'password.reset.post', 'uses' => 'PasswordController@postReset'));
   });

   Route::group(array('prefix' => 'classes'), function(){
      Route::get('/host', array('as' => 'classes.host', 'uses' => 'ClassController@host'));
      Route::get('/{slug?}', array('as' => 'classes.index', 'uses' => 'ClassController@index'));
      Route::get('/{slug}/{id}', array('as' => 'classes.view', 'uses' => 'ClassController@view'));
      Route::post('/{slug}/{id}/update', array('as' => 'classes.update', 'uses' => 'ClassController@update'));
      Route::post('/{slug}/{id}/attend', array('as' => 'classes.attend', 'uses' => 'ClassController@attend'));
   });

   Route::group(array('prefix' => 'community'), function(){
      Route::get('/', array('as' => 'community', 'uses' => 'CommunityController@index'));
      Route::get('/users', array('as' => 'community.users', 'uses' => 'CommunityController@users'));
      Route::get('/users/{id}', array('as' => 'community.user', 'uses' => 'CommunityController@user'));
      Route::post('/users/{id}/update', array('as' => 'community.user.update.post', 'uses' => 'CommunityController@postUpdate'));
   });

});


View::composer('layouts.master', function($view){
   $messages = Alert::getMessages();
   $view->with('messages', $messages);
});



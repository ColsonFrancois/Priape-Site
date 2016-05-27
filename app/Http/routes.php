<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', ['as'=>'home',
    'uses'=> 'Controller@showWelcome']);

Route::get('/connection', ['as' => 'login',
    'uses' => 'Controller@connection']);


Route::get('/register',['as'=>'register',
    'uses'=>'Controller@register']);

Route::post('/authentification', ['as'=> 'authentification',
'uses' => 'Controller@authentification']);

Route::post('/registration', ['as'=>'registration',
'uses'=> 'Controller@registration']);

Route::get('/logout', ['as' => 'logout',
    'uses' => 'Controller@logout'
]);

Route::get('/contact', ['as' => 'contact',
    'uses'=>'Controller@contact'
]);

Route::get('/dashboard', ['as' => 'dashboard',
 'uses'=> 'Controller@dashboard']);

Route::get('/profil', ['as' => 'profil',
 'uses'=>'Controller@profil']);

Route::post('/editing', ['as'=>'editing',
'uses'=>'Controller@editing'
]);

Route::get('/calendar', ['as' =>'calendar',
    'uses'=>'Controller@calendar'
]);

Route::post('/adding', ['as' => 'adding',
    'uses' => 'Controller@adding'
]);

Route::get('/delete/{objectId}', [
    'as' => 'deleleteEvent',
    'uses' => 'Controller@delete'
]);
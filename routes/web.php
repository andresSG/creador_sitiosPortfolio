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

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/adminPanel/', 'AdminController@getUsers')->name('adminPanel');

Route::post('/profile/{user}', 'profileUserController@modify')->name('modifiedUser');
Route::get('/profile/{user}', ['as' => 'modifyUser', 'uses' => 'profileUserController@index']);

//genera todas las llamadas entre vista y controler 'php artisan route:list'
//Route::resource('proyecto', 'ProyectController');

Route::get('/Proyecto/new', 'ProyectController@index')->name('newProyect');
Route::post('/Proyectos', 'ProyectController@create')->name('createProyect');
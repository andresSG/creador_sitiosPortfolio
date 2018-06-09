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
Route::get('/adminProyectos/', 'AdminController@getProyects')->name('adminProyectos');
Route::delete('/adminPanel/{id}/delete', 'AdminController@removeUser')->name('deleteUser');
Route::patch('/adminPanel/{id}/doAdmin', 'AdminController@makeAdmin')->name('makeAdmin');
Route::patch('/adminPanel/{id}/noAdmin', 'AdminController@noAdmin')->name('noAdmin');

Route::post('/admin/profile/{user}', 'profileUserController@indexAdmin')->name('modifyUserByAdmin');
Route::post('/admin/profile/{user}/ok', 'profileUserController@modifyByAdmin')->name('modifiedUserByAdmin');
Route::post('/profile/{user}', 'profileUserController@modify')->name('modifiedUser');
Route::get('/profile/{user}', ['as' => 'modifyUser', 'uses' => 'profileUserController@index']);

//genera todas las llamadas entre vista y controler 'php artisan route:list'
//Route::resource('proyecto', 'ProyectController');

Route::get('/proyecto/new', 'ProyectController@index')->name('newProyect');
Route::post('/proyecto', 'ProyectController@create')->name('createProyect');
Route::get('/proyecto/edit/{id}', 'ProyectController@editShow')->name('editProyect');
Route::post('/proyecto/edit/{id}', 'ProyectController@editMake')->name('editProyectSave');
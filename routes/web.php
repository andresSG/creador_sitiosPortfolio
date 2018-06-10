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
//pagina de inicio
	return view('welcome');
});

Auth::routes(); //rutas de autenticacion

Route::get('/home', 'HomeController@index')->name('home'); //home

//Panel de administracion, de usuarios 'adminPanel' y de proyectos 'adminProyectos'
Route::get('/adminPanel/', 'AdminController@getUsers')->name('adminPanel');
Route::delete('/adminPanel/{id}/delete', 'AdminController@removeUser')->name('deleteUser');
Route::patch('/adminPanel/{id}/doAdmin', 'AdminController@makeAdmin')->name('makeAdmin');
Route::patch('/adminPanel/{id}/noAdmin', 'AdminController@noAdmin')->name('noAdmin');

Route::get('/adminProyectos/', 'AdminController@getProyects')->name('adminProyectos');

//editar profile, desde admin y desde cada usuario
Route::post('/admin/profile/{user}', 'profileUserController@indexAdmin')->name('modifyUserByAdmin');
Route::post('/admin/profile/{user}/ok', 'profileUserController@modifyByAdmin')->name('modifiedUserByAdmin');
Route::post('/profile/{user}', 'profileUserController@modify')->name('modifiedUser');
Route::get('/profile/{user}', ['as' => 'modifyUser', 'uses' => 'profileUserController@index']);

//genera todas las llamadas entre vista y controler 'php artisan route:list'
//Route::resource('proyecto', 'ProyectController');

//proyectos de usuario y sus funciones
Route::get('/proyecto/new', 'ProyectController@index')->name('newProyect');
Route::post('/proyecto', 'ProyectController@create')->name('createProyect');
Route::get('/proyecto/edit/{id}', 'ProyectController@editShow')->name('editProyect');
Route::post('/proyecto/edit/{id}', 'ProyectController@editMake')->name('editProyectSave');
Route::post('/proyecto/delete', 'ProyectController@deleteProyect')->name('deleteProyect');

Route::get('/home/generate_proyect', 'FilesController@generateFile')->name('generateFiles');
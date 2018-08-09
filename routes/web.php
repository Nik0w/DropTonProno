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
Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

Route::get('/resultats/{id}','Resultats@index')->where('id', '[0-9]+')->name('resultats');

Route::post('/resultats/{id}', 'Resultats@createProno')->where('id', '[0-9]+')->name('resultats');;

Route::get('/classement', 'ClassementController@index');

Route::prefix('admin')->group(function () {

    Route::get('/', 'Admin\AdminHomeController@index');
    Route::get('/home', 'Admin\AdminHomeController@index');

    Route::resource('/championnats','Admin\AdminChampionnatsController');
    Route::resource('/journees','Admin\AdminJourneeController');
    Route::resource('/matchs','Admin\AdminMatchsController');
    Route::resource('/equipes','Admin\AdminEquipesController');

});

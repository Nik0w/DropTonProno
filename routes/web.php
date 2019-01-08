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
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');

Route::get('/resultats/{id}','Resultats@index')->where('id', '[0-9]+')->name('resultats');

Route::post('/resultats/{id}', 'Resultats@createProno')->where('id', '[0-9]+')->name('resultats');

Route::get('/classement', 'ClassementController@index')->name('classement');
Route::post('/classement', 'ClassementController@updateFavoris');
Route::get('/classement/mois', 'ClassementMoisController@index')->name('mois');
Route::post('/classement/mois', 'ClassementMoisController@updateFavoris');
Route::get('/classement/favoris', 'ClassementFavorisController@index');
Route::post('/classement/favoris', 'ClassementFavorisController@updateFavoris');

Route::get('/vestiaire', 'profilController@index');
Route::post('/vestiaire', 'profilController@updateInfos');

Route::get('/cgu', 'cguController@index');

//test CROM
Route::get('/CRON', function () {
    return view('cron');
});
Route::group(['prefix' => 'admin', 'middleware' => ['auth','isAdmin']], function(){

    Route::get('/', 'Admin\AdminHomeController@index');
    Route::get('/home', 'Admin\AdminHomeController@index');
    Route::resource('/users', 'Admin\AdminUsersController');
    Route::post('/users/search', 'Admin\AdminUsersController@search');
    Route::post('/users/{id_user}/{id_prono}', 'Admin\AdminUsersController@deleteProno')->where('id_user,id_prono', '[0-9]+');

    Route::get('/scores', 'Admin\AdminResetScoresController@index');
    Route::post('/scores','Admin\AdminResetScoresController@post');

    Route::resource('/championnats','Admin\AdminChampionnatsController');
    Route::resource('/journees','Admin\AdminJourneeController');
    Route::resource('/matchs','Admin\AdminMatchsController');
    Route::resource('/equipes','Admin\AdminEquipesController');

});

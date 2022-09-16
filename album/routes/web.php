<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\RedirectIfNotUser;
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
Auth::routes();

Route::group(['middleware' => RedirectIfNotUser::class], function () {
  Route::get('', [HomeController::class, 'index'])->name('homes');
  Route::get('/home', [HomeController::class, 'index'])->name('home');
  Route::group(['prefix' => '/album','as' => 'album.',  'controller' => AlbumController::class], function () {
      Route::get('/create', 'createalbum')->name('create');
      Route::post('/create', 'storeInformationalbum')->name('store');
      Route::get('/edit/{id}', 'editalbumPage')->name('edit');
      Route::put('/update/{id}', 'updateInformationalbum')->name('updates');
      Route::get('/view/{id}', 'viewalbum')->name('view');
      Route::get('/transport/{id}', 'transportPage')->name('transport');
      Route::post('/transport/{id}', 'transport')->name('dotransport');
      Route::delete('/delete/{id}', 'Deletealbum')->name('destroy');
});

Route::group(['prefix' => '/image','as' => 'picture.',  'controller' => PictureController::class], function () {
    Route::get('/home',  'index')->name('home');
    Route::get('/create','createpicture')->name('create');
    Route::post('/create', 'storeInformationpicture')->name('store');
    Route::get('/edit/{id}', 'editpicturePage')->name('edit');
    Route::put('/update/{id}', 'updateInformationpicture')->name('updates');
    Route::delete('/delete/{id}','Deletepicture')->name('destroy');
});

});
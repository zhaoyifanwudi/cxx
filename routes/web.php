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
Route::any('admin/login','Admin\LoginController@login');

Route::group(['prefix' => 'admin','as' => 'admin.','middleware' => ['admin.login']],function (){
    Route::any('quit','Admin\LoginController@quit')->name('qiut');
    Route::any('pass','Admin\IndexController@pass')->name('pass');
    Route::group(['prefix' => 'index','as' => 'index.'],function (){
        Route::get('index','Admin\IndexController@index')->name('index');
        Route::get('info','Admin\IndexController@info')->name('info');
    });
    Route::group(['prefix' => 'classify','as' => 'classify.'],function (){
        Route::any('add','Admin\ClassifyController@add')->name('add');
        Route::get('list','Admin\ClassifyController@list')->name('list');

    });
    Route::group(['prefix' => 'about','as' => 'about.'],function (){
        Route::any('add','Admin\AboutController@add')->name('add');
        Route::any('upload','Admin\AboutController@upload')->name('upload');
        Route::any('list','Admin\AboutController@list')->name('list');
        Route::any('destroy','Admin\AboutController@destroy')->name('destroy');
        Route::any('edit','Admin\AboutController@edit')->name('edit');
        Route::any('update','Admin\AboutController@update')->name('update');

    });
});
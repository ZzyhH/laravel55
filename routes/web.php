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





Route::get('admin/login/index', 'Admin\LoginController@index');
Route::get('admin/logout', 'Admin\LoginController@logout');
Route::post('admin/login', 'Admin\LoginController@login');

Route::group(['middleware' => ['Admin']], function () {
    Route::get('admin', ['uses' => 'Admin\IndexController@index']);
    Route::get('admin/index', ['uses' => 'Admin\IndexController@index']);
    Route::get('admin/category', 'Admin\CategoryController@index');
    Route::get('category/edit', 'Admin\CategoryController@edit');
    Route::post('category/save', 'Admin\CategoryController@save');
    Route::get('category/delete', 'Admin\CategoryController@delete');
    Route::get('admin/article', 'Admin\ArticleController@index');
    Route::get('article/edit', 'Admin\ArticleController@edit');
    Route::post('article/save', 'Admin\ArticleController@save');
    Route::get('article/delete', 'Admin\ArticleController@delete');
});
Route::get('/', 'IndexController@index');

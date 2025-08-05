<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Backend\Login;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group([

    // 'middleware' => 'authroute',
    'namespace'  => 'App\Http\Controllers',

],function ($router) {

    Route::get('/admin/dashboard', 'ViewController@dashboard');

    //user
    Route::get('/admin/users', 'ViewController@users');

    Route::get('/admin/users/create', 'ViewController@userCreate');

    Route::post('/admin/registerUser', 'ActionController@userRegister');

    Route::get('/admin/users/edit/{id}', 'ViewController@userEdit');

    Route::post('/admin/updateUser', 'ActionController@userUpdate');

    Route::post('/admin/users/delete/{id}', 'ActionController@userDelete');

    //category
    Route::get('/admin/categories', 'ViewController@categories');

    Route::get('/admin/categories/create', 'ViewController@categoryCreate');

    Route::post('/admin/addCategory', 'ActionController@categoryAdd');

    Route::get('/admin/categories/edit/{id}', 'ViewController@categoryEdit');

    Route::post('/admin/updateCategory', 'ActionController@categoryUpdate');

    Route::post('/admin/categories/delete/{id}', 'ActionController@categoryDelete');

    //brand
    Route::get('/admin/brands', 'ViewController@brands');

    Route::get('/admin/brands/create', 'ViewController@brandCreate');

    Route::post('/admin/addBrand', 'ActionController@brandAdd');

    Route::get('/admin/brands/edit/{id}', 'ViewController@brandEdit');

    Route::post('/admin/updateBrand', 'ActionController@brandUpdate');

    Route::post('/admin/brands/delete/{id}', 'ActionController@brandDelete');

    //product
    Route::get('/admin/products', 'ViewController@products');

    Route::get('/admin/products/create', 'ViewController@productCreate');

    Route::post('/admin/addProduct', 'ActionController@productAdd');

    Route::get('/admin/products/edit/{id}', 'ViewController@productEdit');

    Route::post('/admin/updateProduct', 'ActionController@productUpdate');

    Route::post('/admin/products/delete/{id}', 'ActionController@productDelete');

});
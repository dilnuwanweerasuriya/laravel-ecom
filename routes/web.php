<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\HomePage;
use App\Livewire\ProductsPage;
use App\Livewire\CartPage;
use App\Livewire\AboutPage;
use App\Livewire\ContactPage;
use App\Livewire\CheckoutPage;
use App\Livewire\SuccessPage;


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

    'namespace'  => 'App\Http\Controllers',

],function ($router) {

    //Admin Panel login
    Route::get('/admin/login', 'ViewController@login')->name('admin.login');

    //Admin Panel login check
    Route::post('/admin/adminLogin', 'AuthController@adminLogin');

    //Admin Panel logout
    Route::get('/admin/logout', 'AuthController@adminLogout');

    // //Landing Page
    // Route::get('/', 'ViewController@home');

    // //Shop Page
    // Route::get('/shop', 'ViewController@shop');

});

Route::group([

    'middleware' => 'admin',
    'namespace'  => 'App\Http\Controllers',

],function ($router) {

    //dashboard
    Route::get('/admin/dashboard', 'ViewController@dashboard')->name('admin.dashboard');

    //Profile
    Route::get('/admin/profile', 'ViewController@profile')->name('admin.profile');

    //Auth User Data Update
    Route::post('/admin/updateAuthData', 'ActionController@updateAuthData');

    Route::post('/admin/changePassword', 'ActionController@changePassword');

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

    //attribute
    Route::get('/admin/attributes', 'ViewController@attributes');

    Route::get('/admin/attributes/create', 'ViewController@attributeCreate');

    Route::post('/admin/addAttribute', 'ActionController@attributeAdd');

    Route::get('/admin/attributes/edit/{id}', 'ViewController@attributeEdit');

    Route::post('/admin/updateAttribute', 'ActionController@attributeUpdate');

    Route::post('/admin/attributes/delete/{id}', 'ActionController@attributeDelete');

    Route::get('/admin/attribute-values/{attribute}', 'ActionController@getAttributeValues');

    //product
    Route::get('/admin/products', 'ViewController@products');

    Route::get('/admin/products/create', 'ViewController@productCreate');

    Route::post('/admin/addProduct', 'ActionController@productAdd');

    Route::get('/admin/products/edit/{id}', 'ViewController@productEdit');

    Route::post('/admin/updateProduct/{id}', 'ActionController@productUpdate');

    Route::post('/admin/products/delete/{id}', 'ActionController@productDelete');

    //stock
    Route::get('/admin/stocks', 'ViewController@stocks');

    Route::post('/admin/stock/update', 'ActionController@stockUpdate');

     //order
    Route::get('/admin/orders', 'ViewController@orders');

    Route::get('/admin/orders/create', 'ViewController@orderCreate');

    Route::post('/admin/addOrder', 'ActionController@orderAdd');

    Route::get('/admin/orders/edit/{id}', 'ViewController@orderEdit');

    Route::post('/admin/updateOrder/{id}', 'ActionController@orderUpdate');

    Route::post('/admin/orders/delete/{id}', 'ActionController@orderDelete');

    //review
    Route::get('/admin/reviews', 'ViewController@reviews');

    Route::post('/admin/reviews/delete/{id}', 'ActionController@reviewDelete');

    Route::post('/admin/reviews/approve/{id}', 'ActionController@reviewApprove');

    Route::post('/admin/reviews/disapprove/{id}', 'ActionController@reviewDisapprove');

});


Route::get('/', HomePage::class);

Route::get('/products', ProductsPage::class);

Route::get('/cart', CartPage::class);

Route::get('/about', AboutPage::class);

Route::get('/contact', ContactPage::class);

Route::get('/checkout', CheckoutPage::class);

Route::get('/success-order', SuccessPage::class);
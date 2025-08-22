<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ViewController extends DataController
{
    //Login Function
    public function login(){
        return View::make('backend/login');
    }

    //Default Function
    public function defaultBackend($data){
        return View::make('backend/layout', $data);
    }

    //Dashboard Function
    public function dashboard(){
        $data = array(
            'view' => 'backend/dashboard',
            'title' => 'Dashboard',
            'orders' => $this->getOrders(),
            'counts' => $this->getDashboardCounts(),
        );

        return $this->defaultBackend($data);
    }

    //Users Function
    public function users(){
        $data = array(
            'view' => 'backend/user/users',
            'title' => 'Users',
            'users' => $this->getUsers(),
        );

        return $this->defaultBackend($data);
    }

    //User Create Function
    public function userCreate(){
        $data = array(
            'view' => 'backend/user/userCreate',
            'title' => 'Create User'
        );

        return $this->defaultBackend($data);
    }

    //User Edit Function
    public function userEdit($id){
        $data = array(
            'view' => 'backend/user/userEdit',
            'title' => 'Edit User',
            'user' => $this->getUserData($id),
        );

        return $this->defaultBackend($data);
    }

    //User Profile
    public function profile(){
        $data = array(
            'view' => 'backend/profile',
            'title' => 'Profile',
            'user' => $this->getAuthUserData(),
        );

        return $this->defaultBackend($data);
    }

    //Categories Function
    public function categories(){
        $data = array(
            'view' => 'backend/category/categories',
            'title' => 'Categories',
            'categories' => $this->getCategories(),
        );

        return $this->defaultBackend($data);
    }

    //Category Create Function
    public function categoryCreate(){
        $data = array(
            'view' => 'backend/category/categoryCreate',
            'title' => 'Create category',
            'categories' => $this->getCategories(),
        );

        return $this->defaultBackend($data);
    }

    //Category Edit Function
    public function categoryEdit($id){
        $data = array(
            'view' => 'backend/category/categoryEdit',
            'title' => 'Edit category',
            'category' => $this->getCategoryData($id),
            'categories' => $this->getCategories(),
        );

        return $this->defaultBackend($data);
    }

    //Brands Function
    public function brands(){
        $data = array(
            'view' => 'backend/brand/brands',
            'title' => 'Brands',
            'brands' => $this->getBrands(),
        );

        return $this->defaultBackend($data);
    }

    //Brand Create Function
    public function brandCreate(){
        $data = array(
            'view' => 'backend/brand/brandCreate',
            'title' => 'Create brand',
            'brands' => $this->getBrands(),
        );

        return $this->defaultBackend($data);
    }

    //Brand Edit Function
    public function brandEdit($id){
        $data = array(
            'view' => 'backend/brand/brandEdit',
            'title' => 'Edit brand',
            'brand' => $this->getBrandData($id),
        );

        return $this->defaultBackend($data);
    }

    //Attributes Function
    public function attributes(){
        $data = array(
            'view' => 'backend/attribute/attributes',
            'title' => 'Attributes',
            'attributes' => $this->getAttributes(),
        );

        return $this->defaultBackend($data);
    }

    //Attribute Create Function
    public function attributeCreate(){
        $data = array(
            'view' => 'backend/attribute/attributeCreate',
            'title' => 'Create attribute',
            'attributes' => $this->getAttributes(),
        );

        return $this->defaultBackend($data);
    }

    //Attribute Edit Function
    public function attributeEdit($id){
        $data = array(
            'view' => 'backend/attribute/attributeEdit',
            'title' => 'Edit attribute',
            'attribute' => $this->getAttributeData($id),
        );

        return $this->defaultBackend($data);
    }

    //Products Function
    public function products(){
        $data = array(
            'view' => 'backend/product/products',
            'title' => 'Products',
            'products' => $this->getProducts(),
        );

        return $this->defaultBackend($data);
    }

    //Product Create Function
    public function productCreate(){
        $data = array(
            'view' => 'backend/product/productCreate',
            'title' => 'Create product',
            'products' => $this->getProducts(),
            'attributes' => $this->getAttributes(),
            'categories' => $this->getCategories(),
            'brands' => $this->getBrands(),
        );

        return $this->defaultBackend($data);
    }

    //Product Edit Function
    public function productEdit($id){
        $data = array(
            'view' => 'backend/product/productEdit',
            'title' => 'Edit product',
            'product' => $this->getProductData($id),
            'attributes' => $this->getAttributes(),
            'categories' => $this->getCategories(),
            'brands' => $this->getBrands(),
        );
        // dd($data);

        return $this->defaultBackend($data);
    }

    //Stocks Function
    public function stocks(){
        $data = array(
            'view' => 'backend/stock/stocks',
            'title' => 'Stocks',
            'products' => $this->getProducts(),
        );

        return $this->defaultBackend($data);
    }


    //Orders Function
    public function orders(){
        $data = array(
            'view' => 'backend/order/orders',
            'title' => 'Orders',
            'orders' => $this->getOrders(),
        );
        // dd($data);

        return $this->defaultBackend($data);
    }

    //Order Create Function
    public function orderCreate(){
        $data = array(
            'view' => 'backend/order/orderCreate',
            'title' => 'Create order',
            'products' => $this->getProducts(),
            'users' => $this->getUsers(),
        );

        return $this->defaultBackend($data);
    }

    //Order Edit Function
    public function orderEdit($id){
        $data = array(
            'view' => 'backend/order/orderEdit',
            'title' => 'Edit order',
            'order' => $this->getOrderData($id),
            'users' => $this->getUsers(),
            'products' => $this->getProducts(),
        );
        // dd($data);

        return $this->defaultBackend($data);
    }

    //Reviews Function
    public function reviews(){
        $data = array(
            'view' => 'backend/review/reviews',
            'title' => 'Reviews',
            'reviews' => $this->getReviews(),
        );
        // dd($data);

        return $this->defaultBackend($data);
    }

    //------------------------ Fronyend ---------------------------//
    //Default Function
    // public function defaultFrontend($data){
    //     return View::make('frontend/app', $data);
    // }

    // //Home Function (Landing Page)
    // public function home(){
    //     $data = [
    //         'title' => 'Home',
    //         'view' => 'frontend/home',
    //         'css' => [
    //                 '/assets/css/plugins/jquery.countdown.css',
    //                 '/assets/css/skins/skin-demo-3.css',
    //                 '/assets/css/demos/demo-3.css'
    //             ],
    //         'script' => [
    //             '/assets/js/jquery.plugin.min.js',
    //             '/assets/js/jquery.countdown.min.js',
    //             '/assets/js/demos/demo-3.js'
    //         ],
    //         'brands' => $this->getBrands(),
    //     ];

    //     return $this->defaultFrontend($data);
    // }

    // //Shop Function
    // public function shop(){
    //     $data = [
    //         'title' => 'Shop',
    //         'view' => 'frontend/shop',
    //         'css'=> [
    //                 '/assets/css/plugins/nouislider/nouislider.css'
    //             ],
    //         'script' => [
    //             '/assets/js/wNumb.js',
    //             '/assets/js/nouislider.min.js'
    //         ]
    //     ];

    //     return $this->defaultFrontend($data);
    // }
}

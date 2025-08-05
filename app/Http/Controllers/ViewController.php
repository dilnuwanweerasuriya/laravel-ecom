<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ViewController extends DataController
{
    //Default Function
    public function default($data){
        return View::make('backend/layout', $data);
    }

    //Dashboard Function
    public function dashboard(){
        $data = array(
            'view' => 'backend/dashboard',
            'title' => 'Dashboard',
        );

        return $this->default($data);
    }

    //Users Function
    public function users(){
        $data = array(
            'view' => 'backend/user/users',
            'title' => 'Users',
            'users' => $this->getUsers(),
        );

        return $this->default($data);
    }

    //User Create Function
    public function userCreate(){
        $data = array(
            'view' => 'backend/user/userCreate',
            'title' => 'Create User'
        );

        return $this->default($data);
    }

    //User Edit Function
    public function userEdit($id){
        $data = array(
            'view' => 'backend/user/userEdit',
            'title' => 'Edit User',
            'user' => $this->getUserData($id),
        );

        return $this->default($data);
    }

    //Categories Function
    public function categories(){
        $data = array(
            'view' => 'backend/category/categories',
            'title' => 'Categories',
            'categories' => $this->getCategories(),
        );

        return $this->default($data);
    }

    //Category Create Function
    public function categoryCreate(){
        $data = array(
            'view' => 'backend/category/categoryCreate',
            'title' => 'Create category',
            'categories' => $this->getCategories(),
        );

        return $this->default($data);
    }

    //Category Edit Function
    public function categoryEdit($id){
        $data = array(
            'view' => 'backend/category/categoryEdit',
            'title' => 'Edit category',
            'category' => $this->getCategoryData($id),
            'categories' => $this->getCategories(),
        );

        return $this->default($data);
    }

    //Brands Function
    public function brands(){
        $data = array(
            'view' => 'backend/brand/brands',
            'title' => 'Categories',
            'brands' => $this->getBrands(),
        );

        return $this->default($data);
    }

    //Brand Create Function
    public function brandCreate(){
        $data = array(
            'view' => 'backend/brand/brandCreate',
            'title' => 'Create brand',
            'brands' => $this->getBrands(),
        );

        return $this->default($data);
    }

    //Brand Edit Function
    public function brandEdit($id){
        $data = array(
            'view' => 'backend/brand/brandEdit',
            'title' => 'Edit brand',
            'brand' => $this->getBrandData($id),
            'brands' => $this->getBrands(),
        );

        return $this->default($data);
    }

    //Products Function
    public function products(){
        $data = array(
            'view' => 'backend/product/products',
            'title' => 'Categories',
            'products' => $this->getProducts(),
        );

        return $this->default($data);
    }

    //Product Create Function
    public function productCreate(){
        $data = array(
            'view' => 'backend/product/productCreate',
            'title' => 'Create product',
            'products' => $this->getProducts(),
            'categories' => $this->getCategories(),
            'brands' => $this->getBrands(),
        );

        return $this->default($data);
    }

    //Product Edit Function
    public function productEdit($id){
        $data = array(
            'view' => 'backend/product/productEdit',
            'title' => 'Edit product',
            'product' => $this->getProductData($id),
            'products' => $this->getProducts(),
        );

        return $this->default($data);
    }
}

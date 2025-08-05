<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

class DataController extends Controller
{
    //Get Users
    public function getUsers(){
        $users = User::paginate(10);
        return $users;
    }

    //Get User Data
    public function getUserData($id){
        $user = User::where('id', $id)->first();
        return $user;
    }

    //Get Categories
    public function getCategories(){
        $categories = Category::with('parent')->paginate(10);
        return $categories;
    }

    //Get Category Data
    public function getCategoryData($id){
        $category = Category::where('id', $id)->first();
        return $category;
    }

    //Get Brands
    public function getBrands(){
        $brands = Brand::paginate(10);
        return $brands;
    }

    //Get Brand Data
    public function getBrandData($id){
        $brand = Brand::where('id', $id)->first();
        return $brand;
    }

    //Get Products
    public function getProducts(){
        $products = Product::with('images')->paginate(10);
        return $products;
    }

    //Get Product Data
    public function getProductData($id){
        $product = Product::where('id', $id)->first();
        return $product;
    }
}

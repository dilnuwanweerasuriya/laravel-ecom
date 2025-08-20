<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantAttributes;
use App\Models\Order;
use App\Models\Review;

class DataController extends Controller
{
    //Get Dashboard Counts
    public function getDashboardCounts(){
        $data = [
            'new_orders' => Order::where('status', 'pending')->count(),
            'processing_orders' => Order::whereIn('status', ['pending','paid'])->count(),
            'shipped_orders' => Order::where('status', 'shipped')->count(),
            'average_price' => number_format(Order::where('status', '!=', 'cancelled')->avg('total_amount'), 2),
        ];

        return $data;
    }

    //Get Users
    public function getUsers(){
        $users = User::get();
        return $users;
    }

    //Get User Data
    public function getUserData($id){
        $user = User::where('id', $id)->first();
        return $user;
    }

    //Get Auth User Data
    public function getAuthUserData(){
        $user = User::find(Auth::id());
        return $user;
    }

    //Get Categories
    public function getCategories(){
        $categories = Category::with('parent')->get();
        return $categories;
    }

    //Get Category Data
    public function getCategoryData($id){
        $category = Category::where('id', $id)->first();
        return $category;
    }

    //Get Brands
    public function getBrands(){
        $brands = Brand::get();
        return $brands;
    }

    //Get Brand Data
    public function getBrandData($id){
        $brand = Brand::where('id', $id)->first();
        return $brand;
    }

    //Get Attributes
    public function getAttributes(){
        $attributes = Attribute::with('attributeValues')->get();
        return $attributes;
    }

    //Get Attribute Data
    public function getAttributeData($id){
        $attribute = Attribute::with('attributeValues')->where('id', $id)->first();
        return $attribute;
    }

    //Get Products
    public function getProducts(){
        $products = Product::with('images','variants.images')->get();
        return $products;
    }

    //Get Product Data
    public function getProductData($id){
        $product = Product::with('images','variants.images','variants.attributes')->where('id', $id)->first();
        return $product;
    }

    //Get Orders
    public function getOrders(){
        $orders = Order::with('user','payment','items.product','items.variant')
                ->leftJoin('addresses', 'addresses.order_id', '=', 'orders.id')
                ->select('orders.*', 'addresses.*')
                ->orderBy('orders.created_at','desc')
                ->get();
        return $orders;
    }

    //Get Order Data
    public function getOrderData($id){
        $order = Order::with('user','payment','items.product','items.variant')
                ->leftJoin('addresses', 'addresses.order_id', '=', 'orders.id')
                ->where('orders.id', '=', $id)
                ->select('orders.*', 'addresses.*')
                ->orderBy('orders.created_at','desc')
                ->first();
        return $order;
    }

    //Get Reviews
    public function getReviews(){
        $reviews = Review::with('user', 'product.variants')->orderBy('reviews.created_at', 'desc')->get();
        return $reviews;
    }
}

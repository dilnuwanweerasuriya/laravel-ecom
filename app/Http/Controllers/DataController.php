<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantAttributes;

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
        $products = Product::with('images','variants.images')->paginate(10);
        return $products;
    }

    //Get Product Data
    public function getProductData($id){
        $product = Product::with('images','variants.images','variants.attribValues')->where('id', $id)->first();
        return $product;
    }

    //Get Selected Attributes For Product
    public function getSelectedAttributes($id){
        $variant = ProductVariant::where('product_id', $id)->pluck('id');
        $attribValues = ProductVariantAttributes::whereIn('variant_id', $variant)->pluck('attribute_value_id');
        $attributes = AttributeValue::whereIn('id', $attribValues)->pluck('attribute_id');

        $data = [
            'attributes' => $attributes,
            'attribValues' => $attribValues
        ];

        return $data;
    }
}

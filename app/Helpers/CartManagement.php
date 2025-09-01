<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class CartManagement {
    //add item to cart
    static public function addItemToCart($product_id){
        $cart_items = Auth::check() ? self::getCartItemsFromDatabase() : self::getCartItemsFromCookie();

        $existing_item = null;

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity']++;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
        }else{
            $product = Product::with('images')->where('id', $product_id)->first(['id', 'name', 'price']);
            if ($product) {
                foreach ($product->images as $image)
                    if($image->is_primary == 1){
                        $image = $image->image_url;
                    }
                $cart_items[] = [
                    'product_id' => $product_id,
                    'name' => $product->name,
                    'image' => $image,
                    'quantity' => 1,
                    'unit_amount' =>$product->price,
                    'total_amount' =>$product->price,
                ];
            }
        }

        if (Auth::check()) {
            self::addCartItemsToDatabase($cart_items);
        }else{
            self::addCartItemsToCookie($cart_items);
        }
        return count($cart_items);
    }

    //add item to cart with quantity
    static public function addItemToCartWithQty($product_id, $qty = 1, $variant_id = null){
        $cart_items = Auth::check() ? self::getCartItemsFromDatabase() : self::getCartItemsFromCookie();

        $existing_item = null;

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id && $item['variant_id'] == $variant_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity'] = $qty;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
        }else{
            $product = Product::with('images', 'variants.images', 'variants.attributes')->where('id', $product_id)->first(['id', 'name', 'price']);
            if ($product) {
                $unit_amount = $product->price;
                foreach ($product->images as $image)
                if($image->is_primary == 1){
                    $image = $image->image_url;
                }

                if ($variant_id) {
                    $variant = $product->variants->where('id', $variant_id)->first();
                    if ($variant) {
                        $unit_amount = $variant->price ?? $unit_amount; // variant price if exists
                        $variant_image = $variant->images->first()->image_url ?? null;
                        if ($variant_image) {
                            $image = $variant_image;
                        }

                        foreach ($variant->attributes as $attr) {
                            $attributes[strtolower($attr->attribute_name)] = $attr->attribute_value;
                        }
                    }

                }

                $cart_items[] = [
                    'product_id' => $product_id,
                    'variant_id' => $variant_id,
                    'name' => $product->name,
                    'image' => $image,
                    'quantity' => $qty,
                    'unit_amount' =>$unit_amount,
                    'total_amount' =>$unit_amount * $qty,
                    'attributes'   => $attributes,
                ];
            }
        }

        if (Auth::check()) {
            self::addCartItemsToDatabase($cart_items);
        }else{
            self::addCartItemsToCookie($cart_items);
        }
        return count($cart_items);
    }

    //remove cart item from cookie
    static public function removeCartItemFromCookie($product_id){
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($cart_items[$key]);
            }
        }

        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    //remove cart item from db
    public static function removeCartItemFromDatabase($product_id, $variant_id = null){
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart) {
            return [];
        }

        $query = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product_id);

        if (!empty($variant_id)) {
            $query->where('variant_id', $variant_id);
        } else {
            $query->whereNull('variant_id');
        }

        $query->delete();

        return CartItem::where('cart_id', $cart->id)->get()->toArray();
    }

    //add cart items to cookie
    static public function addCartItemsToCookie($cart_items){
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }

    //add cart items to db
    static public function addCartItemsToDatabase($cart_items){
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        foreach ($cart_items as $item) {

            // Match existing cart item by product + variant
            $existingItemQuery = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $item['product_id']);

            if (!empty($item['variant_id'])) {
                $existingItemQuery->where('variant_id', $item['variant_id']);
            } else {
                $existingItemQuery->whereNull('variant_id');
            }

            $existingItem = $existingItemQuery->first();

            if ($existingItem) {
                // Update quantity and total
                $existingItem->quantity = $item['quantity']; // Or += if merging quantities
                $existingItem->total_amount = $existingItem->quantity * $existingItem->unit_amount;

                // Store attributes as JSON
                $existingItem->attributes = $item['attributes'] ?? null;
                $existingItem->save();
            } else {
                // Create new cart item
                CartItem::create([
                    'cart_id'      => $cart->id,
                    'product_id'   => $item['product_id'],
                    'variant_id'   => $item['variant_id'] ?? null,
                    'name'         => $item['name'],
                    'image'        => $item['image'],
                    'quantity'     => $item['quantity'],
                    'unit_amount'  => $item['unit_amount'],
                    'total_amount' => $item['quantity'] * $item['unit_amount'],
                    'attributes'   => $item['attributes'] ?? null,
                ]);
            }
        }
    }

    //clear cart items from cookie
    static public function clearCartItems(){
        Cookie::queue(Cookie::forget('cart_items'));
    }

    //get all cart items from cookie
    static public function getCartItemsFromCookie(){
        $cart_items = json_decode(Cookie::get('cart_items'), true);
        if(!$cart_items){
            $cart_items = [];
        }

        return $cart_items;
    }

    //get all cart items from db
    static public function getCartItemsFromDatabase(){
        $cart_items = CartItem::where('cart_id', Auth::user()->cart->id)->get()->toArray();
        return $cart_items;
    }

    //increase item quantity
    static public function increaseQuantityToCartItem($product_id){
        if(Auth::check()){
            $cart_items = self::getCartItemsFromDatabase();
        }else{
            $cart_items = self::getCartItemsFromCookie();
        }

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
            }
        }

        if (Auth::check()) {
            self::addCartItemsToDatabase($cart_items);
        }else{
            self::addCartItemsToCookie($cart_items);
        }
        return $cart_items;
    }

    //decrease item quantity
    static public function decreaseQuantityToCartItem($product_id){
        if(Auth::check()){
            $cart_items = self::getCartItemsFromDatabase();
        }else{
            $cart_items = self::getCartItemsFromCookie();
        }

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                if ($cart_items[$key]['quantity'] > 1){
                    $cart_items[$key]['quantity']--;
                    $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                }
            }
        }

        if (Auth::check()) {
            self::addCartItemsToDatabase($cart_items);
        }else{
            self::addCartItemsToCookie($cart_items);
        }
        return $cart_items;
    }

    //calculate grand total
    static public function calculateGrandTotal($items){
        return array_sum(array_column($items, 'total_amount'));
    }
}
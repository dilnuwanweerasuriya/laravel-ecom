<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;

class ActionController extends Controller
{
    //Register User
    public function userRegister(Request $request){
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|min:6',
                'phone' => 'required',
                'address' => 'required',
                'role' => 'required',
            ]);

            DB::beginTransaction();

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'role' => $request->role,
            ]);

            DB::commit();

            toastr()->success('User created successfully.');
            return redirect('/admin/users');

        } catch (\Throwable $e) {
            DB::rollback();
            toastr()->error('User creation failed. Please try again.');
            return redirect()->back();
        }
    }

    //Update User
    public function userUpdate(Request $request){
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required',
                'address' => 'required',
                'role' => 'required',
            ]);

            DB::beginTransaction();

            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->role = $request->role;

            if($request->password != null){
                $user->password = Hash::make($request->password);
            }

            $user->save();

            DB::commit();

            toastr()->success('User updated successfully.');
            return redirect('/admin/users');

        } catch (\Throwable $e) {dd($e);
            DB::rollback();
            toastr()->error('Updating user failed. Please try again.');
            return redirect()->back();
        }

    }

    //User Delete (AJAX)
    public function userDelete($id){
        try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->delete();
            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => 'Failed to delete user.'], 500);
        }
    }


    //Create Category
    public function categoryAdd(Request $request){
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'slug' => 'required|unique:categories|max:255',
                // 'status' => 'required',
            ]);

            DB::beginTransaction();

            // if($request->status == on){
            //     $status = 1;
            // }else{
            //     $status = 0;
            // }

            if($request->parent != null){
                $parent = $request->parent;
            }else{
                $parent = null;
            }

            $category = Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                // 'status' => $request->role,
                'parent_id' => $parent
            ]);

            DB::commit();

            toastr()->success('Category created successfully.');
            return redirect('/admin/categories');

        } catch (\Throwable $e) {
            DB::rollback();
            toastr()->error('Category creation failed. Please try again.');
            return redirect()->back();
        }
    }

    //Update Category
    public function categoryUpdate(Request $request){
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'slug' => 'required|max:255',
                // 'status' => 'required',
            ]);

            DB::beginTransaction();

            if($request->status){
                $status = 1;
            }else{
                $status = 0;
            }

            $category = Category::find($request->id);
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->parent_id = $request->parent;
            $category->is_active = $status;

            $category->save();

            DB::commit();

            toastr()->success('Category updated successfully.');
            return redirect('/admin/categories');

        } catch (\Throwable $e) {dd($e);
            DB::rollback();
            toastr()->error('Updating category failed. Please try again.');
            return redirect()->back();
        }
    }

    //Category Delete (AJAX)
    public function categoryDelete($id){
        try {
            DB::beginTransaction();
            $category = Category::find($id);
            $category->delete();
            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => 'Failed to delete user.'], 500);
        }
    }

    //Create Brand
    public function brandAdd(Request $request){
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'slug' => 'required|unique:brands|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/uploads/brands'), $imageName);
                $imagePath = 'storage/uploads/brands/' . $imageName;
            } else {
                $imagePath = null;
            }

            $brand = Brand::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'image' => $imagePath,
            ]);

            DB::commit();

            toastr()->success('Brand created successfully.');
            return redirect('/admin/brands');

        } catch (\Throwable $e) {
            DB::rollback();dd($e);
            toastr()->error('Brand creation failed. Please try again.');
            return redirect()->back();
        }
    }

    //Update Brand
    public function brandUpdate(Request $request){
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'slug' => 'required|max:255',
                // 'status' => 'required',
            ]);

            DB::beginTransaction();

            if($request->status){
                $status = 1;
            }else{
                $status = 0;
            }

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/uploads/brands'), $imageName);
                $imagePath = 'storage/uploads/brands/' . $imageName;
            } else {
                $imagePath = null;
            }

            $brand = Brand::find($request->id);
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->image = $imagePath;
            $brand->is_active = $status;

            $brand->save();

            DB::commit();

            toastr()->success('Brand updated successfully.');
            return redirect('/admin/brands');

        } catch (\Throwable $e) {
            DB::rollback();
            toastr()->error('Updating brand failed. Please try again.');
            return redirect()->back();
        }
    }

    //Brand Delete (AJAX)
    public function brandDelete($id){
        try {
            DB::beginTransaction();
            $brand = Brand::find($id);
            $brand->delete();
            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => 'Failed to delete user.'], 500);
        }
    }

    //Create Product
    public function productAdd(Request $request){
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'slug' => 'required|unique:products,slug|max:255',
                'description' => 'required',
                'category' => 'required|exists:categories,id',
                'brand' => 'required|exists:brands,id',
                'type' => 'required|in:variant-product,normal-product',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->input('type') === 'variant-product') {
                $variantRules = [
                    'variants' => 'required|array|min:1',
                    'variants.*.name' => 'required|string|max:255',
                    'variants.*.price' => 'required|numeric|min:0',
                    'variants.*.stock' => 'required|integer|min:0',
                    'variants.*.image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];

                $request->validate($variantRules);
            }

            DB::beginTransaction();

            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/uploads/products'), $imageName);
                $imagePath = 'storage/uploads/products/' . $imageName;
            } else {
                $imagePath = null;
            }

            if ($request->input('type') === 'variant-product') {
                $price = $request->variants[0]['price'];
                $stock = $request->variants[0]['stock'];
            } else {
                $price = $request->price;
                $stock = $request->stock;
            }

            $product = Product::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'type' => $request->type,
                'category_id' => $request->category,
                'brand_id' => $request->brand,
                'price' => $price,
                'stock' => $stock,
            ]);

            if ($imagePath) {
                $productImage = ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                ]);

                $product->thumbnail = $productImage->id;
                $product->save();
            }

            if ($request->input('type') === 'variant-product') {
                foreach ($request->variants as $index => $variantData) {
                    $variantImagePath = null;

                    if ($request->hasFile("variants.{$index}.image")) {
                        $variantImage = $request->file("variants.{$index}.image");
                        $variantImageName = time() . '_' . uniqid() . '.' . $variantImage->getClientOriginalExtension();
                        $variantImage->move(public_path('storage/uploads/products'), $variantImageName);
                        $variantImagePath = 'storage/uploads/products/' . $variantImageName;
                    }

                    $variant = ProductVariant::create([
                        'product_id' => $product->id,
                        'variant_name' => $variantData['name'],
                        'price' => $variantData['price'],
                        'stock' => $variantData['stock'],
                    ]);

                    if ($variantImagePath) {
                        ProductImage::create([
                            'product_id' => $product->id,
                            'variant_id' => $variant->id, 
                            'image_path' => $variantImagePath,
                        ]);
                    }
                }
            }

            DB::commit();

            toastr()->success('Product created successfully.');
            return redirect('/admin/products');

        } catch (\Throwable $e) {
            DB::rollback();dd($e);
            toastr()->error('Product creation failed. Please try again.');
            return redirect()->back();
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\VariantImage;
use App\Models\ProductVariantAttributes;

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

        } catch (\Throwable $e) {
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
        } catch (\Throwable $e) {
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

        } catch (\Throwable $e) {
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
        } catch (\Throwable $e) {
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
            DB::rollback();
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
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json(['error' => 'Failed to delete user.'], 500);
        }
    }

    //Create Attribute
    public function attributeAdd(Request $request){
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
            ]);

            DB::beginTransaction();

            $attribute = Attribute::create([
                'name' => $request->name,
            ]);

            DB::commit();

            toastr()->success('Attribute created successfully.');
            return redirect('/admin/attributes');

        } catch (\Throwable $e) {
            DB::rollback();
            toastr()->error('Attribute creation failed. Please try again.');
            return redirect()->back();
        }
    }

    //Update Attribute
    public function attributeUpdate(Request $request){
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
            ]);

            DB::beginTransaction();

            $attribute = Attribute::find($request->id);
            $attribute->name = $request->name;

            $attribute->save();

            if ($request->has('values')){
                AttributeValue::where('attribute_id', $request->id)->delete();

                foreach ($request->values as $value) {
                    $attribValues = AttributeValue::create([
                        'attribute_id' => $request->id,
                        'value' => $value
                    ]);
                }
            }

            DB::commit();

            toastr()->success('Attribute updated successfully.');
            return redirect('/admin/attributes');

        } catch (\Throwable $e) {
            DB::rollback();
            toastr()->error('Updating attribute failed. Please try again.');
            return redirect()->back();
        }
    }

    //Attribute Delete (AJAX)
    public function attributeDelete($id){
        try {
            DB::beginTransaction();
            $attribute = Attribute::with('attributeValues')->where('id', $id)->first();
            
            if($attribute->attributeValues){
                $attribute->attributeValues()->delete();
            }
            $attribute->delete();
            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json(['error' => 'Failed to delete attribute.'], 500);
        }
    }

    //Get Selected Attribute Values
    public function getAttributeValues($attributeId){
        $values = AttributeValue::where('attribute_id', $attributeId)
            ->orderBy('value')
            ->get(['id', 'value']);

        return response()->json($values);
    }

    //Create Product
    public function productAdd(Request $request){
        try {
            // Base validation rules
            $rules = [
                'name' => 'required|max:255',
                'description' => 'required',
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'required|exists:brands,id',
                'product_type' => 'required|in:variant,simple',
                'images' => 'required|array|max:5',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];

            // Add type-specific validation rules
            if ($request->input('product_type') === 'variant') {
                $rules = array_merge($rules, [
                    'variants' => 'required|array|min:1',
                    'variants.*.attributes' => 'required|array',
                    'variants.*.values' => 'required|array',
                    'variants.*.sku' => 'required|string|max:255',
                    'variants.*.price' => 'required|numeric|min:0',
                    'variants.*.stock' => 'required|integer|min:0',
                    'variants.*.images' => 'required|array|max:5',
                    'variants.*.images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                ]);
            } else {
                $rules = array_merge($rules, [
                    'sku' => 'required|string|max:255',
                    'price' => 'required|numeric|min:0',
                    'stock' => 'required|integer|min:0',
                ]);
            }

            // Validate all rules once
            $validated = $request->validate($rules);

            DB::beginTransaction();

            $saveImage = function ($imageFile) {
                $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('storage/uploads/products'), $imageName);
                return 'storage/uploads/products/' . $imageName;
            };

            // Create product
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'has_variants' => $request->product_type == 'simple' ? 0 : 1,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'sku' => $request->product_type == 'simple' ? $request->sku : null,
                'price' => $request->product_type == 'simple' ? $request->price : null,
                'stock' => $request->product_type == 'simple' ? $request->stock : null,
            ]);

            // Save multiple product images
            foreach ($request->file('images') as $index => $imageFile) {
                $imagePath = $saveImage($imageFile);

                $image = ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $imagePath,
                    'is_primary' => $request->primary_product_image == null ? 1 : 0 ,
                ]);
            }

            if ($request->input('product_type') === 'variant') {
                foreach ($request->variants as $index => $variantData) {
                    $variant = ProductVariant::create([
                        'product_id' => $product->id,
                        'sku'        => $variantData['sku'],
                        'price'      => $variantData['price'],
                        'stock'      => $variantData['stock'],
                    ]);

                    if ($request->hasFile("variants.$index.images")) {
                        foreach ($request->file("variants.$index.images") as $key => $variantImageFile) {
                            $variantImagePath = $saveImage($variantImageFile);

                            $primaryVariantImage = $variantData['primary_image'] ?? 0;

                            VariantImage::create([
                                'variant_id' => $variant->id,
                                'image_url' => $variantImagePath,
                                'is_primary' => ((string)$key === (string)$primaryVariantImage) ? 1 : 0,
                            ]);
                        }
                    }

                    foreach ($variantData['attributes'] as $index => $attrId) {
                        $attribute = Attribute::find($attrId);

                        $variant->attributes()->create([
                            'variant_id' => $variant->id,
                            'attribute_name' => $attribute->name,
                            'attribute_value' => $variantData['values'][$index],
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

    //Product Update
    public function productUpdate(Request $request){
        dd($request);
    }

    //Product Delete (AJAX)
    public function productDelete($id){
        try {
            DB::beginTransaction();

            $product = Product::findOrFail($id);
            $productVariantIds = ProductVariant::where('product_id', $product->id)->pluck('id');

            if ($product->type === 'variant-product') {
                ProductVariantAttributes::whereIn('variant_id', $productVariantIds)->delete();
            }

            ProductVariant::where('product_id', $product->id)->delete();

            $images = ProductImage::where('product_id', $product->id)->get();
            foreach ($images as $image) {
                $filePath = public_path('storage/uploads/products/' . basename($image->image_path));
                
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }

                $image->delete();
            }

            $product->delete();

            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete product.'], 500);
        }
    }
}

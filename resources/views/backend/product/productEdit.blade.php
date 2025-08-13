<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3 me-3">Edit Product</h6>
                </div>
            </div>
            <div class="card-body pt-4 px-4">
                <form method="POST" action="/admin/editProduct/{{ $product->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Product Name --}}
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="form-label">Product Name</label>
                            <input type="text" id="product" name="name" class="form-control"
                                placeholder="Product Name" value="{{ old('name', $product->name) }}" required>
                        </div>
                    </div>

                    {{-- Product Description --}}
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="form-label">Product Description</label>
                            <textarea class="form-control" name="description" id="description" required>{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>

                    {{-- Product Images --}}
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Images (Max 5)</label>
                        <input id="productImagesInput" class="form-control" type="file" name="images[]"
                            accept="image/*" multiple onchange="previewProductImages(event)">
                        <div id="productImagePreviewContainer" class="d-flex flex-wrap mt-2">
                            @foreach ($product->images as $imgIndex => $img)
                                <div class="position-relative m-1">
                                    <img src="{{ asset($img->image_path) }}" class="img-thumbnail"
                                        style="width:100px;height:100px;object-fit:cover;">
                                    <button type="button"
                                        style="position:absolute;top:0;right:0;background:white;color:black;border-radius:50%;width:20px;height:20px;font-size:12px;padding:0;border:none;cursor:pointer;"
                                        onclick="removeProductImage({{ $imgIndex }})">x</button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <hr>

                    {{-- Category & Brand --}}
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Category</label>
                            <select class="select form-control" name="category" required>
                                <option value="">Select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Brand</label>
                            <select class="select form-control" name="brand">
                                <option value="">Select brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr>

                    {{-- Product Type --}}
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Product Type</label>
                            <select class="select form-control" name="type" id="type" required>
                                <option value="">Select product type</option>
                                <option value="variant-product"
                                    {{ $product->type == 'variant-product' ? 'selected' : '' }}>Variant Product
                                </option>
                                <option value="normal-product"
                                    {{ $product->type == 'normal-product' ? 'selected' : '' }}>Normal Product</option>
                            </select>
                        </div>

                        <div id="normal-product-sku"
                            class="col-md-6 mb-4 {{ $product->type == 'variant-product' ? 'd-none' : '' }}">
                            <label class="form-label">SKU</label>
                            <input type="text" class="form-control sku" name="sku" placeholder="Auto-generated"
                                value="{{ $product->sku }}" readonly required>
                        </div>
                    </div>

                    {{-- Variant Section --}}
                    <div id="variant-section" class="{{ $product->type == 'normal-product' ? 'd-none' : '' }}">
                        <label class="form-label">Product Variants</label>
                        <div id="variant-container">
                            @foreach ($product->variants as $vIndex => $variant)
                                <div class="variant-block border p-3 mb-3 position-relative"
                                    data-variant-index="{{ $vIndex }}">
                                    <button type="button" class="btn-close position-absolute top-0 end-0 me-2 mt-2"
                                        style="position: absolute; top: 0; right: 0; background: gray; 
                                    color: white; border-radius: 50%; width: 20px; height: 20px; 
                                    font-size: 12px; padding: 0; border: none; cursor: pointer;"
                                        onclick="removeVariant(this)">x</button>

                                    <label class="form-label">Attributes</label>
                                    <div class="variant-attributes" data-variant-index="{{ $vIndex }}">
                                        @foreach ($variant->attribValues as $aIndex => $value)
                                            <div class="row attribute-row mb-2" data-attr-index="{{ $aIndex }}">
                                                <div class="col-md-5">
                                                    <select class="form-control attribute-select"
                                                        data-variant="{{ $vIndex }}"
                                                        data-attr="{{ $aIndex }}" required>
                                                        <option value="">Select Attribute</option>
                                                        @foreach ($attributes as $attribute)
                                                            @foreach ($selected_attributes as $selected_attrib)
                                                                <option value="{{ $attribute->id }}"
                                                                    {{ $selected_attrib == $attribute->id ? 'selected' : '' }}>
                                                                    {{ $attribute->name }}
                                                                </option>
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="form-control value-select"
                                                        name="variants[{{ $vIndex }}][attributes][{{ $aIndex }}][value_id]"
                                                        required>
                                                        @foreach ($attributes as $attribute)
                                                            @foreach ($attribute->attributeValues as $attributeVal)
                                                                <option value="{{ $attributeVal->id }}"
                                                                    {{ $value->attribute_value_id == $attributeVal->id ? 'selected' : '' }}>
                                                                    {{ $attributeVal->value }}
                                                                </option>
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        onclick="removeAttributeRow({{ $vIndex }}, {{ $aIndex }})">X</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-secondary mt-2"
                                        onclick="addAttributeRow({{ $vIndex }})">Add Another Attribute</button>

                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Variant SKU</label>
                                            <input type="text" class="form-control variant-sku"
                                                name="variants[{{ $vIndex }}][sku]"
                                                value="{{ $variant->sku }}" readonly required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Price</label>
                                            <input type="text" name="variants[{{ $vIndex }}][price]"
                                                class="form-control" value="{{ $variant->price }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Stock</label>
                                            <input type="number" name="variants[{{ $vIndex }}][stock]"
                                                class="form-control" value="{{ $variant->stock }}" required>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Variant Images (Max 5)</label>
                                            <input id="variantImagesInput{{ $vIndex }}" type="file"
                                                accept="image/*" multiple
                                                name="variants[{{ $vIndex }}][images][]"
                                                onchange="previewVariantImages(event, {{ $vIndex }})">
                                            <div id="variantImagePreviewContainer{{ $vIndex }}"
                                                class="d-flex flex-wrap mt-2">
                                                @foreach ($variant->images as $imgIndex => $img)
                                                    <div class="position-relative m-1">
                                                        <img src="{{ asset($img->image_path) }}"
                                                            class="img-thumbnail"
                                                            style="width:100px;height:100px;object-fit:cover;">
                                                        <button type="button"
                                                            style="position:absolute;top:0;right:0;background:white;color:black;border-radius:50%;width:20px;height:20px;font-size:12px;padding:0;border:none;cursor:pointer;"
                                                            onclick="removeVariantImage({{ $vIndex }}, {{ $imgIndex }})">x</button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-dark my-3" onclick="addVariant()">Add
                            Variant</button>
                    </div>

                    {{-- Default Price/Stock --}}
                    <div id="default-price-stock" class="{{ $product->type == 'variant-product' ? 'd-none' : '' }}">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Price</label>
                                <input type="text" id="price" name="price" class="form-control"
                                    placeholder="Product Price" value="{{ $product->price }}" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Stock</label>
                                <input type="number" id="stock" name="stock" class="form-control"
                                    placeholder="Product Stock" value="{{ $product->stock }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-success">Update Product</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

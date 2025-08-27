<style>
    .image-wrapper.primary img {
        border: 3px solid red !important;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3 me-3">Edit Product</h6>
                </div>
            </div>
            <div class="card-body pt-4 px-4">
                <form action="/admin/updateProduct/{{ $product->id }}" id="productForm" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Product Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" id="productName" name="name" class="form-control"
                                value="{{ old('name', $product->name) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Slug</label>
                            <input type="text" id="slug" name="slug" class="form-control"
                                value="{{ old('slug', $product->slug) }}" required readonly>
                        </div>

                        <!-- Short Description -->
                        <div class="mb-3">
                            <label class="form-label">Short Description (1-2 sentences)</label>
                            <textarea name="short_description" class="form-control">{{ old('short_description', $product->short_description) }}</textarea>
                        </div>

                        <!-- Long Description -->
                        <div class="mb-3">
                            <label class="form-label">Long Description</label>
                            <textarea name="description" id="myeditorinstance" class="form-control">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <!-- Existing Product Images -->
                        <div class="mb-3">
                            <label class="form-label">Existing Product Images</label>
                            <div id="existingImages" class="d-flex gap-2 flex-wrap">
                                @foreach ($product->images as $index => $img)
                                    <div class="position-relative image-wrapper {{ $product->primary_image_index == $index ? 'primary' : '' }}"
                                        style="width:80px;">
                                        <img src="{{ asset($img->image_url) }}" class="rounded border img-thumbnail"
                                            style="width:80px;">
                                        <button type="button" class="btn btn-primary btn-sm position-absolute"
                                            style="bottom:5px;left:5px;"
                                            onclick="setPrimaryExisting({{ $index }})">Primary</button>
                                        <button type="button" class="btn btn-danger btn-sm position-absolute"
                                            style="top:5px;right:5px;"
                                            onclick="removeExistingImage({{ $index }})">X</button>
                                        <input type="hidden" name="keep_images[]" value="{{ $img->id }}">
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="primary_existing_image" id="primaryExistingImage"
                                value="{{ $product->primary_image_index }}">
                        </div>

                        <!-- Add New Product Images -->
                        <div class="mb-3">
                            <label class="form-label">Add New Product Images (Max 5)</label>
                            <input type="file" id="productImages" name="images[]" class="form-control" multiple
                                accept="image/*">
                            <div id="productImagePreview" class="d-flex gap-2 mt-2 flex-wrap"></div>
                            <input type="hidden" name="primary_product_image" id="primaryProductImage">
                        </div>

                        <hr>

                        <!-- Category -->
                        <div class="col-6 mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Brand -->
                        <div class="col-6 mb-3">
                            <label class="form-label">Brand</label>
                            <select name="brand_id" id="brandSelect" class="form-select" required>
                                <option value="">Select Brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Product Type -->
                        <div class="col-6 mb-3">
                            <label class="form-label">Product Type</label>
                            <select id="productType" name="product_type" class="form-select" required>
                                <option value="simple" {{ $product->has_variants == 0 ? 'selected' : '' }}>
                                    Simple</option>
                                <option value="variant" {{ $product->has_variants == 1 ? 'selected' : '' }}>
                                    Variant</option>
                            </select>
                        </div>

                        <hr>

                        <!-- Simple Product Fields -->
                        <div id="simpleFields" class="{{ $product->has_variants == 1 ? 'd-none' : '' }}">
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label class="form-label">SKU</label>
                                    <input type="text" id="skuField" name="sku" class="form-control"
                                        value="{{ $product->sku }}" readonly>
                                </div>
                                <div class="col-6 mb-2">
                                    <label>Price</label>
                                    <input type="number" step="0.01" name="price" class="form-control"
                                        value="{{ $product->price }}">
                                </div>
                                <div class="col-6 mb-2">
                                    <label>Stock</label>
                                    <input type="number" name="stock" class="form-control"
                                        value="{{ $product->stock }}">
                                </div>
                            </div>
                        </div>

                        <!-- Variant Section -->
                        <div id="variantSection" class="{{ $product->has_variants == 1 ? '' : 'd-none' }}">
                            <h5>Variants</h5>
                            <div id="variantsContainer">
                                @foreach ($product->variants as $vIndex => $variant)
                                    <div class="card p-3 mb-3 variant-card" data-variant-index="{{ $vIndex }}">
                                        <div class="row">
                                            <div class="col-6">
                                                <h6 class="variant-title">Variant #{{ $loop->iteration }}</h6>
                                            </div>
                                            <div class="col-6 text-end">
                                                <button type="button"
                                                    class="btn btn-danger btn-sm remove-variant">Remove</button>
                                            </div>
                                        </div>

                                        <div class="variant-attributes">
                                            @foreach ($variant->attributes as $attrIndex => $attr)
                                                <div class="d-flex gap-2 mt-2 attr-row">
                                                    <select name="variants[{{ $vIndex }}][attributes][]"
                                                        class="form-select attr-select" required>
                                                        <option value="">Select Attribute</option>
                                                        @foreach ($attributes as $a)
                                                            <option value="{{ $a->id }}"
                                                                {{ $a->name == $attr->attribute_name ? 'selected' : '' }}>
                                                                {{ $a->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @php
                                                        $attributeModel = $attributes->firstWhere(
                                                            'name',
                                                            $attr->attribute_name,
                                                        );
                                                    @endphp
                                                    <select name="variants[{{ $vIndex }}][values][]"
                                                        class="form-select value-select" required>
                                                        <option value="">Select Value</option>
                                                        @if ($attributeModel && $attributeModel->attributeValues)
                                                            @foreach ($attributeModel->attributeValues as $val)
                                                                <option value="{{ $val->value }}"
                                                                    {{ $val->value == $attr->attribute_value ? 'selected' : '' }}>
                                                                    {{ $val->value }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm removeAttrBtn">X</button>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="text-start mt-2">
                                            <button type="button"
                                                class="btn btn-secondary btn-sm addAttributeBtn">Add Attribute</button>
                                        </div>

                                        <input type="hidden" name="variants[{{ $vIndex }}][variant_id]"
                                            value="{{ $variant->id }}">
                                        <div class="row">
                                            <div class="col-6 mt-2">
                                                <label>Price</label>
                                                <input type="number" step="0.01"
                                                    name="variants[{{ $vIndex }}][price]" class="form-control"
                                                    value="{{ $variant->price }}">
                                            </div>
                                            <div class="col-6 mt-2">
                                                <label>Stock</label>
                                                <input type="number" name="variants[{{ $vIndex }}][stock]"
                                                    class="form-control" value="{{ $variant->stock }}">
                                            </div>
                                            <div class="col-6 mt-2">
                                                <label>SKU</label>
                                                <input type="text" name="variants[{{ $vIndex }}][sku]"
                                                    class="form-control variant-sku" value="{{ $variant->sku }}"
                                                    readonly>
                                            </div>

                                            <!-- Existing Variant Images -->
                                            <div class="mt-2">
                                                <label>Existing Variant Images</label>
                                                <div class="variant-image-preview d-flex gap-2 mt-2 flex-wrap">
                                                    @foreach ($variant->images as $index => $img)
                                                        <div class="position-relative image-wrapper {{ $variant->primary_image_index == $index ? 'primary' : '' }}"
                                                            style="width:80px;">
                                                            <img src="{{ asset($img->image_url) }}"
                                                                class="rounded border img-thumbnail"
                                                                style="width:80px;">
                                                            <button type="button"
                                                                class="btn btn-primary btn-sm position-absolute"
                                                                style="bottom:5px;left:5px;"
                                                                onclick="setPrimaryVariantExisting(this, {{ $vIndex }}, {{ $index }})">Primary</button>
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm position-absolute"
                                                                style="top:5px;right:5px;"
                                                                onclick="removeVariantExistingImage(this)">X</button>
                                                            <input type="hidden"
                                                                name="variants[{{ $vIndex }}][keep_images][]"
                                                                value="{{ $img->id }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <input type="hidden"
                                                    name="variants[{{ $vIndex }}][primary_existing_image]"
                                                    value="{{ $variant->primary_image_index }}">
                                            </div>

                                            <!-- Add New Variant Images -->
                                            <div class="mt-2">
                                                <label>Add New Images (Max 5)</label>
                                                <input type="file" class="form-control variant-images"
                                                    name="variants[{{ $vIndex }}][images][]" multiple
                                                    accept="image/*">
                                                <div class="variant-image-preview d-flex gap-2 mt-2 flex-wrap"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="addVariantBtn" class="btn btn-primary btn-sm mt-2">Add
                                Variant</button>
                        </div>

                        <hr>

                        <div class="col-6 mb-3">
                            <label class="form-label">Is Featured?</label>
                            <select name="is_featured" class="form-select" required>
                                <option value="1" {{ $product->is_featured == 1 ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="0" {{ $product->is_featured == 0 ? 'selected' : '' }}>
                                    No</option>
                            </select>
                        </div>

                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn bg-gradient-dark">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const attributes = @json($attributes);
    let variantIndex = {{ count($product->variants) }};
    let variantCounter = {};

    //formatting
    tinymce.init({
        selector: 'textarea[name="description"]',
        height: 500,
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak ' +
            'searchreplace wordcount visualblocks visualchars code fullscreen ' +
            'insertdatetime media table emoticons help',
        toolbar: 'undo redo | styles | bold italic underline strikethrough | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | link image media table | ' +
            'forecolor backcolor emoticons | removeformat | code | help',
        menubar: 'file edit view insert format tools table help',
        branding: false,
        image_advtab: true,
        automatic_uploads: true,
        images_upload_url: '/upload-image', // optional backend handler
        file_picker_types: 'image',
        content_style: "body { font-family:Helvetica,Arial,sans-serif; font-size:14px }"
    });

    //slug generator
    $('#productName').on('input', function() {
        const product = $(this).val();
        const slug = product
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');

        $('#slug').val(slug);
    });

    // ------------------------------
    // SKU GENERATOR & UTILITIES
    // ------------------------------
    function slugify(text) {
        return text.toString().toLowerCase().trim()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-');
    }

    // function generateSku(productName, attrValues = []) {
    //     let sku = slugify(productName);
    //     if (attrValues.length) {
    //         sku += '-' + attrValues.map(v => slugify(v)).join('-');
    //     }
    //     return sku;
    // }

    function generateSku(brand, productName, attrValues = []) {
        const brandSlug = slugify(brand);

        // Generate product code
        const productParts = productName.toLowerCase().split(/\s+/);
        let productCode = '';

        const numberPart = productParts.find(p => /\d+/.test(p));
        if (numberPart) {
            // Has a number → first letter + number
            productCode = productParts[0][0] + numberPart.replace(/\D/g, '');
        } else {
            // No number → take first letters of first two words
            productCode = productParts.slice(0, 2).map(word => word[0]).join('');
        }

        // If no attributes → return brand-productCode
        if (!attrValues.length) {
            const key = `${brandSlug}-${productCode}`;
            if (!variantCounter[key]) {
                variantCounter[key] = 1;
            } else {
                variantCounter[key]++;
            }
            const seqNumber = variantCounter[key].toString().padStart(3, '0');
            return `${brandSlug}-${productCode}-${seqNumber}`;
        }

        // First attribute = color → initials
        const color = attrValues[0] || '';
        const colorCode = color.toLowerCase().split(/\s+/).map(w => w[0]).join('');

        // Create sequence key for brand-product-color
        const key = `${brandSlug}-${productCode}-${colorCode}`;
        if (!variantCounter[key]) {
            variantCounter[key] = 1;
        } else {
            variantCounter[key]++;
        }

        const seqNumber = variantCounter[key].toString().padStart(3, '0');

        return `${brandSlug}-${productCode}-${colorCode}-${seqNumber}`;
    }

    // ------------------------------
    // PRODUCT TYPE TOGGLE
    // ------------------------------
    document.getElementById('productType').addEventListener('change', function() {
        document.getElementById('variantSection').classList.toggle('d-none', this.value !== 'variant');
        document.getElementById('simpleFields').classList.toggle('d-none', this.value === 'variant');
        updateProductSku();
    });

    // Update SKU for simple product
    document.getElementById('productName').addEventListener('input', updateProductSku);
    document.getElementById('brandName')?.addEventListener('input', updateProductSku);

    function updateProductSku() {
        if (document.getElementById('productType').value === 'simple') {
            const brand = document.getElementById('brandSelect').selectedOptions[0]?.text || '';
            document.getElementById('skuField').value =
                generateSku(brand, document.getElementById('productName').value);
        }
    }

    // ------------------------------
    // UPDATE VARIANT SKUs WHEN PRODUCT NAME CHANGES
    // ------------------------------
    document.getElementById('productName').addEventListener('input', function() {
        let productType = document.getElementById('productType').value;
        if (productType === 'variant') {
            document.querySelectorAll('.variant-card').forEach(card => {
                let skuField = card.querySelector('.variant-sku');
                if (skuField) {
                    let values = [...card.querySelectorAll('.value-select')]
                        .map(s => s.value)
                        .filter(v => v);
                    skuField.value = generateSku(this.value, values);
                }
            });
        }
    });

    // ------------------------------
    // VARIANT ADD / REMOVE
    // ------------------------------
    document.getElementById('addVariantBtn').addEventListener('click', () => {
        let variantHTML = `
        <div class="card p-3 mb-3 variant-card" data-variant-index="${variantIndex}">
            <div class="row">
                <div class="col-6"><h6 class="variant-title">Variant</h6></div>
                <div class="col-6 text-end">
                    <button type="button" class="btn btn-danger btn-sm remove-variant">Remove</button>
                </div>
            </div>
            <div class="variant-attributes"></div>
            <div class="text-start mt-2">
                <button type="button" class="btn btn-secondary btn-sm addAttributeBtn">Add Attribute</button>
            </div>
            <div class="row">
                <div class="col-6 mt-2">
                    <label>Price</label>
                    <input type="number" step="0.01" name="variants[${variantIndex}][price]" class="form-control">
                </div>
                <div class="col-6 mt-2">
                    <label>Stock</label>
                    <input type="number" name="variants[${variantIndex}][stock]" class="form-control">
                </div>
                <div class="col-6 mt-2">
                    <label>SKU</label>
                    <input type="text" name="variants[${variantIndex}][sku]" class="form-control variant-sku" readonly>
                </div>
                <div class="mt-2">
                    <label>Variant Images (Max 5)</label>
                    <input type="file" class="form-control variant-images" name="variants[${variantIndex}][images][]" multiple accept="image/*">
                    <div class="variant-image-preview d-flex gap-2 mt-2 flex-wrap"></div>
                </div>
            </div>
        </div>`;
        document.getElementById('variantsContainer').insertAdjacentHTML('beforeend', variantHTML);
        variantIndex++;
        updateVariantTitles();
    });

    document.getElementById('variantsContainer').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-variant')) {
            e.target.closest('.card').remove();
            updateVariantTitles();
        }
    });

    function updateVariantTitles() {
        document.querySelectorAll('.variant-card').forEach((card, index) => {
            card.querySelector('.variant-title').textContent = `Variant #${index + 1}`;
        });
    }

    // ------------------------------
    // ATTRIBUTE MANAGEMENT (ADD/REMOVE)
    // ------------------------------
    document.getElementById('variantsContainer').addEventListener('click', function(e) {
        if (e.target.classList.contains('addAttributeBtn')) {
            let variantCard = e.target.closest('.card');
            let variantIndex = variantCard.dataset.variantIndex;

            let usedAttrIds = [...variantCard.querySelectorAll('.attr-select')]
                .map(s => s.value).filter(v => v);

            let attrOptions = attributes
                .filter(a => !usedAttrIds.includes(a.id.toString()))
                .map(a => `<option value="${a.id}">${a.name}</option>`).join('');

            let attrHTML = `
            <div class="d-flex gap-2 mt-2 attr-row">
                <select name="variants[${variantIndex}][attributes][]" class="form-select attr-select" required>
                    <option value="">Select Attribute</option>
                    ${attrOptions}
                </select>
                <select name="variants[${variantIndex}][values][]" class="form-select value-select" required>
                    <option value="">Select Value</option>
                </select>
                <button type="button" class="btn btn-danger btn-sm removeAttrBtn">X</button>
            </div>`;
            variantCard.querySelector('.variant-attributes').insertAdjacentHTML('beforeend', attrHTML);
        }

        if (e.target.classList.contains('removeAttrBtn')) {
            let variantCard = e.target.closest('.card');
            e.target.closest('.attr-row').remove();
            refreshAttributeOptions(variantCard);
            updateAllVariantSkus();
        }
    });

    function refreshAttributeOptions(variantCard) {
        let selectedIds = [...variantCard.querySelectorAll('.attr-select')]
            .map(s => s.value).filter(v => v);

        variantCard.querySelectorAll('.attr-select').forEach(select => {
            let currentValue = select.value;
            select.innerHTML = `<option value="">Select Attribute</option>` +
                attributes
                .filter(a => !selectedIds.includes(a.id.toString()) || a.id.toString() === currentValue)
                .map(a => `<option value="${a.id}">${a.name}</option>`).join('');
            select.value = currentValue;
        });
    }

    // ------------------------------
    // LOAD ATTRIBUTE VALUES & UPDATE SKU
    // ------------------------------
    document.getElementById('variantsContainer').addEventListener('change', function(e) {
        if (e.target.classList.contains('attr-select')) {
            let attrId = e.target.value;
            let values = attributes.find(a => a.id == attrId)?.attribute_values || [];
            let valueSelect = e.target.closest('.attr-row').querySelector('.value-select');
            valueSelect.innerHTML = `<option value="">Select Value</option>` +
                values.map(v => `<option value="${v.value}">${v.value}</option>`).join('');
        }

        if (e.target.classList.contains('attr-select') || e.target.classList.contains('value-select')) {
            let variantCard = e.target.closest('.card');
            let productName = document.getElementById('productName').value;
            let values = [...variantCard.querySelectorAll('.value-select')]
                .map(s => s.value).filter(v => v);

            // Check duplicate variant
            if (isDuplicateVariant(variantCard, values)) {
                alert('This variant combination already exists!');
                e.target.value = '';
                variantCard.querySelector('.variant-sku').value = '';
                return;
            }

            variantCard.querySelector('.variant-sku').value = generateSku(productName, values);
        }
    });

    function isDuplicateVariant(currentCard, values) {
        if (!values.length) return false;

        let isDuplicate = false;
        document.querySelectorAll('.variant-card').forEach(card => {
            if (card === currentCard) return;
            let cardValues = [...card.querySelectorAll('.value-select')]
                .map(s => s.value)
                .filter(v => v);
            if (cardValues.length && arrayEquals(cardValues, values)) {
                isDuplicate = true;
            }
        });
        return isDuplicate;
    }

    function arrayEquals(a, b) {
        if (a.length !== b.length) return false;
        for (let i = 0; i < a.length; i++) {
            if (a[i] !== b[i]) return false;
        }
        return true;
    }

    function updateAllVariantSkus() {
        variantCounter = {}; // Reset counters for fresh sequencing
        const brand = document.getElementById('brandSelect').selectedOptions[0]?.text || '';
        const productName = document.getElementById('productName').value;

        document.querySelectorAll('.variant-card').forEach(card => {
            const skuField = card.querySelector('.variant-sku');
            if (skuField) {
                const values = [...card.querySelectorAll('.value-select')]
                    .map(s => s.value)
                    .filter(v => v);
                skuField.value = generateSku(brand, productName, values);
            }
        });
    }

    // Trigger variant SKU update when product name, brand, or attributes change
    document.getElementById('productName').addEventListener('input', updateAllVariantSkus);
    document.getElementById('brandName')?.addEventListener('input', updateAllVariantSkus);

    document.getElementById('variantsContainer').addEventListener('change', function(e) {
        if (e.target.classList.contains('attr-select') || e.target.classList.contains('value-select')) {
            updateAllVariantSkus();
        }
    });

    // ------------------------------
    // IMAGE MANAGEMENT
    // ------------------------------
    // Product new images
    const productInput = document.getElementById('productImages');
    const preview = document.getElementById('productImagePreview');
    const dt = new DataTransfer();

    productInput.addEventListener('change', function() {
        let newFiles = [...this.files];

        if (dt.files.length + newFiles.length > 5) {
            alert('You can only upload up to 5 product images.');
            newFiles = newFiles.slice(0, 5 - dt.files.length);
        }

        newFiles.forEach(file => {
            dt.items.add(file);

            const reader = new FileReader();
            reader.onload = e => {
                const wrapper = document.createElement('div');
                wrapper.classList.add('position-relative', 'image-wrapper');
                wrapper.style.width = '80px';
                wrapper.style.marginRight = '10px';
                wrapper.style.display = 'inline-block';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('rounded', 'border', 'img-thumbnail');
                img.style.width = '80px';

                const primaryBtn = document.createElement('button');
                primaryBtn.type = 'button';
                primaryBtn.textContent = 'Primary';
                primaryBtn.classList.add('btn', 'btn-primary', 'btn-sm', 'position-absolute');
                primaryBtn.style.bottom = '5px';
                primaryBtn.style.left = '5px';
                primaryBtn.addEventListener('click', function() {
                    preview.querySelectorAll('.image-wrapper').forEach(el => {
                        el.classList.remove('primary');
                        el.style.border = '';
                    });
                    wrapper.classList.add('primary');
                    wrapper.style.border = '2px solid red';

                    document.getElementById('primaryProductImage').value = Array.from(
                        preview.children).indexOf(wrapper);
                });

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.textContent = 'X';
                removeBtn.classList.add('btn', 'btn-danger', 'btn-sm', 'position-absolute');
                removeBtn.style.top = '5px';
                removeBtn.style.right = '5px';
                removeBtn.addEventListener('click', function() {
                    const index = Array.from(preview.children).indexOf(wrapper);
                    wrapper.remove();
                    dt.items.remove(index);
                    productInput.files = dt.files;

                    if (wrapper.classList.contains('primary')) {
                        document.getElementById('primaryProductImage').value = '';
                    }
                });

                wrapper.appendChild(img);
                wrapper.appendChild(primaryBtn);
                wrapper.appendChild(removeBtn);
                preview.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });

        productInput.files = dt.files;
    });


    document.getElementById('variantsContainer').addEventListener('change', function(e) {
        if (e.target.classList.contains('variant-images')) {
            const input = e.target;
            const previewContainer = input.closest('.card').querySelector('.variant-image-preview');

            const files = [...input.files];

            // Count existing + new previews to enforce max 5
            const currentCount = previewContainer.querySelectorAll('.image-wrapper').length;
            if (currentCount + files.length > 5) {
                alert('You can only have up to 5 images per variant (existing + new).');
                return;
            }

            files.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = event => {
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('position-relative', 'image-wrapper');
                    wrapper.style.width = '80px';

                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.classList.add('rounded', 'border', 'img-thumbnail');
                    img.style.width = '80px';

                    const primaryBtn = document.createElement('button');
                    primaryBtn.type = 'button';
                    primaryBtn.textContent = 'Primary';
                    primaryBtn.classList.add('btn', 'btn-primary', 'btn-sm', 'position-absolute');
                    primaryBtn.style.bottom = '5px';
                    primaryBtn.style.left = '5px';
                    primaryBtn.addEventListener('click', function() {
                        previewContainer.querySelectorAll('.image-wrapper').forEach(el => {
                            el.classList.remove('primary');
                            el.style.border = '';
                        });
                        wrapper.classList.add('primary');
                        wrapper.style.border = '2px solid red';

                        // Update hidden input for primary new image index
                        const hiddenInput = input.closest('.card').querySelector(
                            'input[name$="[primary_product_image]"]');
                        if (hiddenInput) {
                            // Calculate index among new images
                            const newIndex = Array.from(previewContainer.children).indexOf(
                                wrapper);
                            hiddenInput.value = newIndex;
                        }
                    });

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.textContent = 'X';
                    removeBtn.classList.add('btn', 'btn-danger', 'btn-sm', 'position-absolute');
                    removeBtn.style.top = '5px';
                    removeBtn.style.right = '5px';
                    removeBtn.addEventListener('click', function() {
                        wrapper.remove();
                        // Optional: sync with input.files using DataTransfer
                    });

                    wrapper.appendChild(img);
                    wrapper.appendChild(primaryBtn);
                    wrapper.appendChild(removeBtn);
                    previewContainer.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        }
    });

    // ------------------------------
    // EXISTING IMAGE HANDLERS
    // ------------------------------
    function removeExistingImage(index) {
        const wrapper = document.querySelector(`#existingImages .image-wrapper:nth-child(${index + 1})`);
        if (wrapper) {
            const hiddenInput = wrapper.querySelector('input[name="keep_images[]"]');
            if (hiddenInput) hiddenInput.remove();
            wrapper.remove();
        }
    }

    function setPrimaryExisting(index) {
        document.querySelectorAll('#existingImages .image-wrapper').forEach(el => {
            el.classList.remove('primary');
            el.style.border = '';
        });
        const wrapper = document.querySelector(`#existingImages .image-wrapper:nth-child(${index + 1})`);
        if (wrapper) {
            wrapper.classList.add('primary');
            wrapper.style.border = '2px solid red';
            document.getElementById('primaryExistingImage').value = index;
        }
    }

    function setPrimaryVariantExisting(btn, variantIndex, imgIndex) {
        const preview = btn.closest('.variant-image-preview');
        preview.querySelectorAll('.image-wrapper').forEach(el => {
            el.classList.remove('primary');
            el.style.border = '';
        });
        btn.closest('.image-wrapper').classList.add('primary');
        btn.closest('.image-wrapper').style.border = '2px solid red';

        const hidden = btn.closest('.card').querySelector(
            `input[name="variants[${variantIndex}][primary_existing_image]"]`);
        if (hidden) hidden.value = imgIndex;
    }

    function removeVariantExistingImage(btn) {
        const wrapper = btn.closest('.image-wrapper');
        const hiddenInput = wrapper.querySelector('input[name*="[keep_images][]"]');
        if (hiddenInput) hiddenInput.remove();
        wrapper.remove();
    }
</script>

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
                    <h6 class="text-white text-capitalize ps-3 me-3">Create Product</h6>
                </div>
            </div>
            <div class="card-body pt-4 px-4">
                <form id="productForm" action="/admin/addProduct" id="productForm" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Product Name -->
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" id="productName" name="name" class="form-control" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>

                        <!-- Product Images -->
                        <div class="mb-3">
                            <label class="form-label">Product Images (Max 5)</label>
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
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 mb-3">
                            <label class="form-label">Brand</label>
                            <select name="brand_id" class="form-select" required>
                                <option value="">Select Brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Product Type -->
                        <div class="col-6 mb-3">
                            <label class="form-label">Product Type</label>
                            <select id="productType" name="product_type" class="form-select" required>
                                <option value="simple">Simple</option>
                                <option value="variant">Variant</option>
                            </select>
                        </div>

                        <hr>

                        <!-- Simple Product Fields -->
                        <div id="simpleFields" class="mb-3">
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label class="form-label">SKU</label>
                                    <input type="text" id="skuField" name="sku" class="form-control" readonly>
                                </div>

                                <div class="col-6 mb-2">
                                    <label>Price</label>
                                    <input type="number" step="0.01" name="price" class="form-control">
                                </div>
                                <div class="col-6 mb-2">
                                    <label>Stock</label>
                                    <input type="number" name="stock" class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Variant Section -->
                        <div id="variantSection" class="d-none">
                            <h5>Variants</h5>
                            <div id="variantsContainer"></div>
                            <button type="button" id="addVariantBtn" class="btn btn-primary btn-sm mt-2">Add
                                Variant</button>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn bg-gradient-dark">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const attributes = @json($attributes);
    let variantIndex = 0;

    // SKU generator
    function slugify(text) {
        return text.toString().toLowerCase().trim()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-');
    }

    function generateSku(productName, attrValues = []) {
        let sku = slugify(productName);
        if (attrValues.length) {
            sku += '-' + attrValues.map(v => slugify(v)).join('-');
        }
        return sku;
    }

    // Product type toggle
    document.getElementById('productType').addEventListener('change', function() {
        document.getElementById('variantSection').classList.toggle('d-none', this.value !== 'variant');
        document.getElementById('simpleFields').classList.toggle('d-none', this.value === 'variant');
        updateProductSku();
    });

    // Update SKU for simple product
    document.getElementById('productName').addEventListener('input', updateProductSku);

    function updateProductSku() {
        if (document.getElementById('productType').value === 'simple') {
            document.getElementById('skuField').value = generateSku(document.getElementById('productName').value);
        }
    }

    // Add Variant
    document.getElementById('addVariantBtn').addEventListener('click', () => {
        let variantHTML = `
        <div class="card p-3 mb-3 variant-card" data-variant-index="${variantIndex}">
            <div class="row">
                <div class="col-6">
                    <h6 class="variant-title">Variant</h6>
                </div>
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
        </div>
    `;
        document.getElementById('variantsContainer').insertAdjacentHTML('beforeend', variantHTML);
        variantIndex++;
        updateVariantTitles();
    });

    // Delegate Add Attribute
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
            </div>
        `;
            variantCard.querySelector('.variant-attributes').insertAdjacentHTML('beforeend', attrHTML);
        }

        if (e.target.classList.contains('removeAttrBtn')) {
            let variantCard = e.target.closest('.card');
            e.target.closest('.attr-row').remove();
            refreshAttributeOptions(variantCard);
            updateAllVariantSkus();
        }

        if (e.target.classList.contains('remove-variant')) {
            e.target.closest('.card').remove();
            updateVariantTitles();
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

    // Load Attribute Values when Attribute changes
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
                let skuField = variantCard.querySelector('.variant-sku');
                skuField.value = '';
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

    // Update SKU when product name changes
    document.getElementById('productName').addEventListener('input', function() {
        let productType = document.getElementById('productType').value;

        if (productType === 'simple') {
            document.getElementById('skuField').value = generateSku(this.value);
        } else {
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

    // Image preview (Product)
    const productInput = document.getElementById('productImages');
    const preview = document.getElementById('productImagePreview');
    const dt = new DataTransfer();

    productInput.addEventListener('change', function() {
        let newFiles = [...this.files];

        // Limit total files to 5
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

                // Primary button
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

                    let hidden = document.getElementById('primaryProductImage');
                    if (!hidden) {
                        hidden = document.createElement('input');
                        hidden.type = 'hidden';
                        hidden.id = 'primaryProductImage';
                        hidden.name = 'primary_product_image';
                        document.querySelector('form').appendChild(hidden);
                    }
                    hidden.value = Array.from(preview.children).indexOf(wrapper);
                });

                // Remove button
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.textContent = 'X';
                removeBtn.classList.add('btn', 'btn-danger', 'btn-sm', 'position-absolute');
                removeBtn.style.top = '5px';
                removeBtn.style.right = '5px';
                removeBtn.addEventListener('click', function() {
                    const index = Array.from(preview.children).indexOf(wrapper);
                    wrapper.remove();
                    dt.items.remove(index); // remove file from DataTransfer
                    productInput.files = dt.files;

                    // Clear primary if removed
                    if (wrapper.classList.contains('primary')) {
                        const hidden = document.getElementById('primaryProductImage');
                        if (hidden) hidden.value = '';
                    }
                });

                wrapper.appendChild(img);
                wrapper.appendChild(primaryBtn);
                wrapper.appendChild(removeBtn);
                preview.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });

        // Update input files
        productInput.files = dt.files;
    });



    // Remove product image from preview
    document.getElementById('productImagePreview').addEventListener('click', function(e) {
        if (e.target.classList.contains('removeProductImgBtn')) {
            e.target.closest('div').remove();
        }
    });

    // Image preview (Variant)
    document.getElementById('variantsContainer').addEventListener('change', function(e) {
        if (!e.target.classList.contains('variant-images')) return;

        const input = e.target;
        const card = input.closest('.card');
        const preview = card.querySelector('.variant-image-preview');

        if (!card.dt) card.dt = new DataTransfer(); // store files per variant

        let newFiles = [...input.files];

        // Limit total files to 5
        if (card.dt.files.length + newFiles.length > 5) {
            alert('You can only upload up to 5 images per variant.');
            newFiles = newFiles.slice(0, 5 - card.dt.files.length);
        }

        newFiles.forEach(file => {
            card.dt.items.add(file);

            const reader = new FileReader();
            reader.onload = ev => {
                const wrapper = document.createElement('div');
                wrapper.classList.add('position-relative', 'image-wrapper');
                wrapper.style.width = '80px';

                const img = document.createElement('img');
                img.src = ev.target.result;
                img.classList.add('rounded', 'border', 'img-thumbnail');
                img.style.width = '80px';

                // Primary button
                const primaryBtn = document.createElement('button');
                primaryBtn.type = 'button';
                primaryBtn.textContent = 'Primary';
                primaryBtn.classList.add('btn', 'btn-primary', 'btn-sm', 'position-absolute');
                primaryBtn.style.bottom = '5px';
                primaryBtn.style.left = '5px';
                primaryBtn.addEventListener('click', () => {
                    preview.querySelectorAll('.image-wrapper').forEach(el => {
                        el.classList.remove('primary');
                        el.style.border = '';
                    });
                    wrapper.classList.add('primary');
                    wrapper.style.border = '2px solid red';

                    let hidden = card.querySelector('.primaryVariantImage');
                    if (!hidden) {
                        hidden = document.createElement('input');
                        hidden.type = 'hidden';
                        hidden.name =
                            `variants[${card.dataset.variantIndex}][primary_image]`;
                        hidden.classList.add('primaryVariantImage');
                        card.appendChild(hidden);
                    }
                    hidden.value = Array.from(preview.children).indexOf(wrapper);
                });

                // Remove button
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.textContent = 'X';
                removeBtn.classList.add('btn', 'btn-danger', 'btn-sm', 'position-absolute');
                removeBtn.style.top = '5px';
                removeBtn.style.right = '5px';
                removeBtn.addEventListener('click', () => {
                    const index = Array.from(preview.children).indexOf(wrapper);
                    wrapper.remove();
                    card.dt.items.remove(index);
                    input.files = card.dt.files;

                    // Clear primary if removed
                    if (wrapper.classList.contains('primary')) {
                        const hidden = card.querySelector('.primaryVariantImage');
                        if (hidden) hidden.value = '';
                    }
                });

                wrapper.appendChild(img);
                wrapper.appendChild(primaryBtn);
                wrapper.appendChild(removeBtn);
                preview.appendChild(wrapper);

                // Update input files
                input.files = card.dt.files;
            };
            reader.readAsDataURL(file);
        });
    });

    // Remove variant image from preview
    document.getElementById('variantsContainer').addEventListener('click', function(e) {
        if (e.target.classList.contains('removeVariantImgBtn')) {
            e.target.closest('div').remove();
        }
    });

    // Helper to update SKUs after removing attributes
    function updateAllVariantSkus() {
        document.querySelectorAll('.variant-card').forEach(card => {
            let skuField = card.querySelector('.variant-sku');
            if (skuField) {
                let values = [...card.querySelectorAll('.value-select')]
                    .map(s => s.value)
                    .filter(v => v);
                skuField.value = generateSku(document.getElementById('productName').value, values);
            }
        });
    }

    function updateVariantTitles() {
        document.querySelectorAll('.variant-card').forEach((card, index) => {
            card.querySelector('.variant-title').textContent = `Variant #${index + 1}`;
        });
    }
</script>

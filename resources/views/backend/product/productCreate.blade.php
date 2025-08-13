<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3 me-3">Create Product</h6>
                </div>
            </div>
            <div class="card-body pt-4 px-4">
                <form method="POST" action="/admin/addProduct" enctype="multipart/form-data">
                    @csrf

                    {{-- Product Name --}}
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="form-label">Product Name</label>
                            <input type="text" id="product" name="name" class="form-control"
                                placeholder="Product Name" required>
                        </div>
                    </div>

                    {{-- Product Description --}}
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="form-label">Product Description</label>
                            <textarea class="form-control" name="description" id="description" required></textarea>
                        </div>
                    </div>

                    {{-- Product Image --}}
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Images (Max 5)</label>
                        <input id="productImagesInput" class="form-control" type="file" name="images[]"
                            accept="image/*" multiple onchange="previewProductImages(event)">
                        <div id="productImagePreviewContainer" class="d-flex flex-wrap mt-2"></div>
                    </div>

                    <hr>

                    {{-- Category & Brand --}}
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Category</label>
                            <select class="select form-control" name="category" required>
                                <option value="">Select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Brand</label>
                            <select class="select form-control" name="brand">
                                <option value="">Select brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                                <option value="variant-product">Variant Product</option>
                                <option value="normal-product">Normal Product</option>
                            </select>
                        </div>

                        <div id="normal-product-sku" class="col-md-6 mb-4 d-none">
                            <label class="form-label">SKU</label>
                            <input type="text" class="form-control sku" name="sku" placeholder="Auto-generated"
                                readonly required>
                        </div>
                    </div>

                    {{-- Variant Section --}}
                    <div id="variant-section" class="d-none">
                        <label class="form-label">Product Variants</label>
                        <div id="variant-container"></div>
                        <button type="button" class="btn btn-sm btn-outline-dark my-3" onclick="addVariant()">Add
                            Variant</button>
                    </div>

                    {{-- Default Price/Stock for non-variant products --}}
                    <div id="default-price-stock">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Price</label>
                                <input type="text" id="price" name="price" class="form-control"
                                    placeholder="Product Price" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Stock</label>
                                <input type="number" id="stock" name="stock" class="form-control"
                                    placeholder="Product Stock" required>
                            </div>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="text-end">
                        <button type="submit" class="btn bg-gradient-dark">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#type').on('change', function() {
            const type = $(this).val();
            if (type === 'variant-product') {
                $('#variant-section').removeClass('d-none');
                $('#default-price-stock').addClass('d-none');
                $('#normal-product-sku').addClass('d-none');
                $('#price, #stock').prop('required', false);
            } else {
                $('#variant-section').addClass('d-none');
                $('#default-price-stock').removeClass('d-none');
                $('#normal-product-sku').removeClass('d-none');
                $('#price, #stock').prop('required', true);

                const productNameSlug = $('#product').val().trim().toLowerCase().replace(/\s+/g, '-');
                $('.sku').val(productNameSlug);
            }
        });
    });

    let variantIndex = 0;
    let productImages = [];
    let variantImages = {};

    // ===== Get Already Used Attributes in a Variant =====
    function getUsedAttributesInVariant(variantIndex) {
        let used = [];
        $(`.variant-attributes[data-variant-index="${variantIndex}"] .attribute-select`).each(function() {
            let val = $(this).val();
            if (val) used.push(val);
        });
        return used;
    }

    // ===== Refresh Attribute Dropdowns (remove duplicates) =====
    function refreshAttributeDropdowns(variantIndex) {
        let usedAttrs = getUsedAttributesInVariant(variantIndex);
        $(`.variant-attributes[data-variant-index="${variantIndex}"] .attribute-select`).each(function() {
            let currentVal = $(this).val();
            $(this).find('option').each(function() {
                let optVal = $(this).val();
                if (!optVal) return;
                if (usedAttrs.includes(optVal) && optVal !== currentVal) {
                    $(this).prop('disabled', true);
                } else {
                    $(this).prop('disabled', false);
                }
            });
        });
    }

    // ===== Attribute Row HTML =====
    function getAttributeRowHTML(variantIndex, attrIndex, selectedAttr = "") {
        let usedAttrs = getUsedAttributesInVariant(variantIndex);
        let options = '<option value="">Select Attribute</option>';
        @foreach ($attributes as $attribute)
            options += `<option value="{{ $attribute->id }}" 
                        ${selectedAttr == "{{ $attribute->id }}" ? "selected" : ""} 
                        ${usedAttrs.includes("{{ $attribute->id }}") && selectedAttr != "{{ $attribute->id }}" ? "disabled" : ""}>
                        {{ $attribute->name }}
                    </option>`;
        @endforeach

        return `
        <div class="row attribute-row mb-2" data-attr-index="${attrIndex}">
            <div class="col-md-5">
                <select class="form-control attribute-select" 
                        data-variant="${variantIndex}" 
                        data-attr="${attrIndex}" required>
                    ${options}
                </select>
            </div>
            <div class="col-md-6">
                <select class="form-control value-select" 
                        name="variants[${variantIndex}][attributes][${attrIndex}][value_id]" 
                        required disabled>
                    <option value="">Select Value</option>
                </select>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-sm btn-outline-danger" 
                        onclick="removeAttributeRow(${variantIndex}, ${attrIndex})">X</button>
            </div>
        </div>`;
    }

    // ===== Add Variant =====
    function addVariant() {
        const variantHTML = `
        <div class="variant-block border p-3 mb-3 position-relative" data-variant-index="${variantIndex}">
            <button type="button" class="btn-close position-absolute top-0 end-0 me-2 mt-2" style="position: absolute; top: 0; right: 0; background: gray; 
                    color: white; border-radius: 50%; width: 20px; height: 20px; 
                    font-size: 12px; padding: 0; border: none; cursor: pointer;"
                    onclick="removeVariant(this)">x</button>

            <label class="form-label">Attributes</label>
            <div class="variant-attributes" data-variant-index="${variantIndex}">
                ${getAttributeRowHTML(variantIndex, 0)}
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary mt-2" 
                    onclick="addAttributeRow(${variantIndex})">
                Add Another Attribute
            </button>

            <hr>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Variant SKU</label>
                    <input type="text" class="form-control variant-sku" 
                        name="variants[${variantIndex}][sku]" readonly required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Price</label>
                    <input type="text" name="variants[${variantIndex}][price]" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" name="variants[${variantIndex}][stock]" class="form-control" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Variant Images (Max 5)</label>
                    <input id="variantImagesInput${variantIndex}" type="file" accept="image/*" multiple
                        name="variants[${variantIndex}][images][]"
                        onchange="previewVariantImages(event, ${variantIndex})">
                    <div id="variantImagePreviewContainer${variantIndex}" class="d-flex flex-wrap mt-2"></div>
                </div>
            </div>
        </div>`;
        $('#variant-container').append(variantHTML);
        variantIndex++;
    }

    // ===== Add Attribute Row =====
    function addAttributeRow(variantIndex) {
        const container = $(`.variant-attributes[data-variant-index="${variantIndex}"]`);
        const attrIndex = container.find('.attribute-row').length;
        container.append(getAttributeRowHTML(variantIndex, attrIndex));
        refreshAttributeDropdowns(variantIndex);
    }

    // ===== Remove Attribute Row =====
    function removeAttributeRow(variantIndex, attrIndex) {
        $(`.variant-attributes[data-variant-index="${variantIndex}"] .attribute-row[data-attr-index="${attrIndex}"]`)
            .remove();
        refreshAttributeDropdowns(variantIndex);
        updateVariantSKU($(`.variant-block[data-variant-index="${variantIndex}"]`));
    }

    // ===== On Attribute Change =====
    $(document).on('change', '.attribute-select', function() {
        const variantIndex = $(this).data('variant');
        const attrIndex = $(this).data('attr');
        const attributeId = $(this).val();
        const valueSelect = $(
            `.variant-attributes[data-variant-index="${variantIndex}"] .attribute-row[data-attr-index="${attrIndex}"] .value-select`
            );

        refreshAttributeDropdowns(variantIndex);

        if (!attributeId) {
            valueSelect.html('<option value="">Select Value</option>').prop('disabled', true);
            return;
        }

        $.get(`/admin/attribute-values/${attributeId}`, function(data) {
            let options = '<option value="">Select Value</option>';
            data.forEach(function(value) {
                options += `<option value="${value.id}">${value.value}</option>`;
            });
            valueSelect.html(options).prop('disabled', false);
        });
    });

    // ===== On Value Change, Update SKU =====
    $(document).on('change', '.value-select', function() {
        const variantBlock = $(this).closest('.variant-block');
        updateVariantSKU(variantBlock);
    });

    // ===== On Product Name Change, Update SKUs =====
    $('#product').on('input', function() {
        if ($('#type').val() === 'normal-product') {
            const slug = $(this).val().trim().toLowerCase().replace(/\s+/g, '-');
            $('.sku').val(slug);
        }
        $('.variant-block').each(function() {
            updateVariantSKU($(this));
        });
    });

    // ===== Update Variant SKU =====
    function updateVariantSKU(variantBlock) {
        let slug = $('#product').val().trim().toLowerCase().replace(/\s+/g, '-');
        let parts = [];
        variantBlock.find('.value-select option:selected').each(function() {
            const txt = $(this).text().trim();
            if (txt) {
                parts.push(txt.toLowerCase().replace(/\s+/g, '-'));
            }
        });
        variantBlock.find('.variant-sku').val(slug + (parts.length ? '-' + parts.join('-') : ''));
    }

    // ===== Remove Variant =====
    function removeVariant(button) {
        const index = $(button).closest('.variant-block').data('variant-index');
        delete variantImages[index];
        $(button).closest('.variant-block').remove();
    }

    // ===== Sync Files Before Submit =====
    $('form').on('submit', function() {
        let dtProduct = new DataTransfer();
        productImages.forEach(file => dtProduct.items.add(file));
        document.getElementById('productImagesInput').files = dtProduct.files;

        for (const [index, files] of Object.entries(variantImages)) {
            let dtVariant = new DataTransfer();
            files.forEach(file => dtVariant.items.add(file));
            const input = document.getElementById(`variantImagesInput${index}`);
            if (input) input.files = dtVariant.files;
        }
    });

    // ===== PRODUCT IMAGE PREVIEW =====
    function previewProductImages(event) {
        const newFiles = Array.from(event.target.files);
        if (productImages.length + newFiles.length > 5) {
            alert("You can upload a maximum of 5 images.");
            event.target.value = "";
            return;
        }
        productImages.push(...newFiles);
        event.target.value = "";
        renderProductImagePreview();
    }

    function renderProductImagePreview() {
        const previewContainer = $('#productImagePreviewContainer');
        previewContainer.empty();
        productImages.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = e => {
                previewContainer.append(`
                    <div class="position-relative m-1">
                        <img src="${e.target.result}" class="img-thumbnail" 
                            style="width: 100px; height: 100px; object-fit: cover;">
                        <button type="button" 
                                style="position: absolute; top: 0; right: 0; background: white; 
                                    color: black; border-radius: 50%; width: 20px; height: 20px; 
                                    font-size: 12px; padding: 0; border: none; cursor: pointer;"
                                onclick="removeProductImage(${index})">x</button>
                    </div>
                `);
            };
            reader.readAsDataURL(file);
        });
    }

    function removeProductImage(index) {
        productImages.splice(index, 1);
        renderProductImagePreview();
    }

    // ===== VARIANT IMAGE PREVIEW =====
    function previewVariantImages(event, index) {
        if (!variantImages[index]) variantImages[index] = [];
        const newFiles = Array.from(event.target.files);
        if (variantImages[index].length + newFiles.length > 5) {
            alert("You can upload a maximum of 5 images for this variant.");
            event.target.value = "";
            return;
        }
        variantImages[index].push(...newFiles);
        event.target.value = "";
        renderVariantImagePreview(index);
    }

    function renderVariantImagePreview(index) {
        const previewContainer = $(`#variantImagePreviewContainer${index}`);
        previewContainer.empty();
        variantImages[index].forEach((file, fileIndex) => {
            const reader = new FileReader();
            reader.onload = e => {
                previewContainer.append(`
                    <div class="position-relative m-1">
                        <img src="${e.target.result}" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                        <button type="button" style="position: absolute; top: 0; right: 0; background: white; 
                                color: black; border-radius: 50%; width: 20px; height: 20px; 
                                font-size: 12px; padding: 0; border: none; cursor: pointer;" 
                                onclick="removeVariantImage(${index}, ${fileIndex})">x</button>
                    </div>
                `);
            };
            reader.readAsDataURL(file);
        });
    }

    function removeVariantImage(index, fileIndex) {
        variantImages[index].splice(fileIndex, 1);
        renderVariantImagePreview(index);
    }
</script>

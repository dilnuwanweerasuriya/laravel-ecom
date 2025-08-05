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
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Product Name</label>
                            <input type="text" id="product" name="name" class="form-control"
                                placeholder="Product Name" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Product Slug</label>
                            <input type="text" id="slug" name="slug" class="form-control" placeholder=""
                                required readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="form-label">Product Description</label>
                            <textarea class="form-control" name="description" id="description" required></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Image</label>
                            <img id="imagePreview" src="#" alt="Preview" class="img-fluid mb-2 d-none"
                                style="max-height: 150px;" />
                            <input class="form-control" type="file" name="image" accept="image/*"
                                onchange="previewImage(event)">
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Category</label>
                            <select class="select form-control" name="category">
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

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Product Type</label>
                            <select class="select form-control" name="type" id="type">
                                <option value="">Select product type</option>
                                <option value="variant-product">Variant Product</option>
                                <option value="normal-product">Normal Product</option>
                            </select>
                        </div>
                    </div>

                    <div id="variant-section" class="d-none">
                        <label class="form-label">Product Variants</label>
                        <div id="variant-container"></div>

                        <button type="button" class="btn btn-sm btn-outline-dark my-3" onclick="addVariant()">Add
                            Variant</button>
                    </div>

                    <!-- Default Price/Stock for non-variant products -->
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
        $('#product').on('input', function() {
            const product = $(this).val();
            const slug = product.toLowerCase().trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            $('#slug').val(slug);
        });

        $('#type').on('change', function() {
            const type = $(this).val();
            if (type === 'variant-product') {
                $('#variant-section').removeClass('d-none');
                $('#default-price-stock').addClass('d-none');
                // Remove 'required' from default fields
                $('#price, #stock').prop('required', false);
            } else {
                $('#variant-section').addClass('d-none');
                $('#default-price-stock').removeClass('d-none');
                $('#price, #stock').prop('required', true);
            }
        });
    });

    let variantIndex = 0;

    function addVariant() {
        const variantHTML = `
            <div class="variant-block border p-3 mb-3 position-relative">
                <button type="button"
                    class="btn-close position-absolute top-0 end-0 me-2 mt-2"
                    style="filter: invert(0); background-color: #57564F; border-radius: 10%;"
                    onclick="removeVariant(this)">
                </button>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Variant Name</label>
                        <input type="text" name="variants[${variantIndex}][name]" class="form-control" placeholder="Variant Name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Variant Image</label>
                        <img id="variantImagePreview${variantIndex}" src="#" alt="Preview" class="img-fluid mb-2 d-none" style="max-height: 150px;" />
                        <input type="file" name="variants[${variantIndex}][image]" accept="image/*" class="form-control" onchange="previewVariantImage(event, ${variantIndex})" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Price</label>
                        <input type="text" name="variants[${variantIndex}][price]" class="form-control" placeholder="Variant Price" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stock</label>
                        <input type="text" name="variants[${variantIndex}][stock]" class="form-control" placeholder="Variant Stock" required>
                    </div>
                </div>
            </div>
        `;
        $('#variant-container').append(variantHTML);
        variantIndex++;
    }

    function removeVariant(button) {
        $(button).closest('.variant-block').remove();
    }

    function previewVariantImage(event, index) {
        const [file] = event.target.files;
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $(`#variantImagePreview${index}`).attr('src', e.target.result).removeClass('d-none');
            };
            reader.readAsDataURL(file);
        }
    }

    function previewImage(event) {
        const [file] = event.target.files;
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result).removeClass('d-none');
            };
            reader.readAsDataURL(file);
        }
    }
</script>

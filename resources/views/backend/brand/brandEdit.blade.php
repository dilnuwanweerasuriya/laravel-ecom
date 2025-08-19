<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3 me-3">Edit Brand</h6>
                </div>
            </div>
            <div class="card-body pt-4 px-4">
                <form id="brandForm" method="POST" action="/admin/updateBrand" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $brand->id }}">

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Brand Name</label>
                            <input type="text" id="brand" name="name" class="form-control"
                                value="{{ $brand->name }}" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Brand Slug</label>
                            <input type="text" id="slug" name="slug" class="form-control"
                                value="{{ $brand->slug }}" required readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Image</label><br>
                            @if($brand->image)
                                <img id="imagePreview" src="{{ asset($brand->image) }}" alt="Current Image"
                                    class="img-fluid mb-2" style="max-height: 150px;">
                            @else
                                <img id="imagePreview" src="#" alt="Preview"
                                    class="img-fluid mb-2 d-none" style="max-height: 150px;">
                            @endif
                            <input class="form-control" type="file" name="image" accept="image/*"
                                onchange="previewImage(event)">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="statusToggle" name="status"
                                    {{ $brand->is_active == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusToggle">Active</label>
                            </div>
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
    // Live Slug Generator
    $(document).ready(function () {
        $("#brandForm").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 50
                },
                image: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "Please enter an brand name",
                    maxlength: "Brand name cannot exceed 50 characters"
                },
                image: {
                    required: "Please upload an image",
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('text-danger');
                error.insertAfter(element);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            }
        });
        
        $('#brand').on('input', function () {
            const brand = $(this).val();
            const slug = brand
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            $('#slug').val(slug);
        });
    });

    // Image Preview
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.classList.remove('d-none');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

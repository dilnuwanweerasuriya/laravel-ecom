<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3 me-3">Edit Attribute</h6>
                </div>
            </div>
            <div class="card-body pt-4 px-4">
                <form id="attributeForm" method="POST" action="/admin/updateAttribute">
                    @csrf

                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="form-label">Attribute Name</label>
                            <input type="text" id="attribute" name="name" class="form-control"
                                value="{{ $attribute->name }}" required>
                        </div>
                    </div>

                    {{-- Dynamic Attribute Values --}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Attribute Values</label>
                            <div id="attribute-values">
                                @foreach ($attribute->attributeValues as $val)
                                    <div class="input-group mb-2">
                                        <input type="text" name="values[]" class="form-control"
                                            value="{{ $val->value }}" required>
                                        <button type="button" class="btn btn-danger remove-value">&times;</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="add-value" class="btn btn-sm btn-primary mt-2">+ Add
                                Value</button>
                        </div>
                    </div>

                    <div class="text-end">
                        <input type="hidden" name="id" value="{{ $attribute->id }}">
                        <button type="submit" class="btn bg-gradient-dark">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- jQuery Script for Dynamic Fields --}}
<script>
    $(document).ready(function() {
        $("#attributeForm").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 50
                }
            },
            messages: {
                name: {
                    required: "Please enter an attribute name",
                    maxlength: "Attribute name cannot exceed 50 characters"
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

        // Add new attribute value field
        $('#add-value').on('click', function() {
            $('#attribute-values').append(`
                <div class="input-group mb-2">
                    <input type="text" name="values[]" class="form-control" placeholder="Enter value" required>
                    <button type="button" class="btn btn-danger remove-value">&times;</button>
                </div>
            `);
        });

        // Remove attribute value field
        $(document).on('click', '.remove-value', function() {
            $(this).closest('.input-group').remove();
        });

    });
</script>

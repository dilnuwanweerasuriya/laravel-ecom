<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3 me-3">Create Attribute</h6>
                </div>
            </div>
            <div class="card-body pt-4 px-4">
                <form id="attributeForm" method="POST" action="/admin/addAttribute">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="form-label">Attribute Name</label>
                            <input type="text" id="attribute" name="name" class="form-control"
                                placeholder="Attribute Name" required>
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
    });
</script>

<style>
    form.input {
        border: 1px solid gray !important;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3 me-3">Create User</h6>
                </div>
            </div>
            <div class="card-body pt-4 px-4">
                <form id="userForm" method="POST" action="/admin/registerUser">
                    @csrf

                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="email@example.com"
                                required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="********" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="+1234567890"
                                required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="123 Main St."
                                required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Role</label>
                            <select class="select form-control" name="role">
                                <option value="">Select a role</option>
                                <option value="admin">Admin</option>
                                <option value="customer">Customer</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn bg-gradient-dark">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $("#userForm").validate({
        rules: {
            name: {
                required: true,
                maxlength: 50
            },
            email: {
                required: true,
            },
            password: {
                required: true,
                minlength: 5
            },
            phone: {
                required: true,
            },
            address: {
                required: true,
            },
            role: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter the user name",
                maxlength: "User name cannot exceed 50 characters"
            },
            email: {
                required: "Please enter an email address",
            },
            password: {
                required: "Please enter a password",
                minlength: "Password must be at least 5 characters long"
            },
            phone: {
                required: "Please enter mobile number",
            },
            address: {
                required: "Please enter the address",
            },
            role: {
                required: "Please select an user role",
            },
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
</script>

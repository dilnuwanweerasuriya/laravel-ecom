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
                    <h6 class="text-white text-capitalize ps-3 me-3">Edit User</h6>
                </div>
            </div>
            <div class="card-body pt-4 px-4">
                <form method="POST" action="/admin/updateUser">
                    @csrf

                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" value="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}"
                                required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" value="{{ $user->address }}"
                                required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Role</label>
                            <select class="select form-control" name="role">
                                <option value="">Select a role</option>
                                <option value="admin" {{ isset($user) && $user->role == 'admin' ? 'selected' : '' }}>
                                    Admin</option>
                                <option value="customer"
                                    {{ isset($user) && $user->role == 'customer' ? 'selected' : '' }}>Customer
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="text-end">
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <button type="submit" class="btn bg-gradient-dark">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

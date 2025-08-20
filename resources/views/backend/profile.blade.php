<div class="profile-card">
    <!-- Profile Header -->
    <div class="text-center mb-4">
        <img src="https://dummyimage.com/120x120/007bff/fff&text={{ $user->name }}" alt="User Photo" class="profile-img mb-3">
        <h4 class="mb-0">{{ $user->name }}</h4>
        <button class="btn btn-outline-primary btn-sm">Edit Profile</button>
    </div>

    <!-- Profile Tabs -->
    <ul class="nav nav-tabs justify-content-center mb-4" id="profileTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview"
                type="button" role="tab">Overview</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button"
                role="tab">Settings</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button"
                role="tab">Security</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="profileTabsContent">
        <!-- Overview -->
        <div class="tab-pane fade show active" id="overview" role="tabpanel">
            <div class="row g-3">
                <div class="col-md-6">
                    <h6>Email:</h6>
                    <p>{{ $user->email }}</p>
                </div>
                <div class="col-md-6">
                    <h6>Phone:</h6>
                    <p>{{ $user->phone }}</p>
                </div>
                <div class="col-md-6">
                    <h6>Address:</h6>
                    <p>{{ $user->address }}</p>
                </div>
                <div class="col-md-6">
                    <h6>Member Since:</h6>
                    <p>{{ $user->created_at }}</p>
                </div>
            </div>
        </div>

        <!-- Settings -->
        <div class="tab-pane fade" id="settings" role="tabpanel">
            <form action="/admin/updateAuthData" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                </div>
                <button type="submit" class="btn bg-gradient-dark">Save Changes</button>
            </form>
        </div>

        <!-- Security -->
        <div class="tab-pane fade" id="security" role="tabpanel">
            <h6>Change Password</h6>
            <form action="/admin/changePassword" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Current Password</label>
                    <input type="password" name="old_password" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" name="new_password" class="form-control">
                </div>
                <button type="submit" class="btn btn-danger">Update Password</button>
            </form>
        </div>
    </div>
</div>

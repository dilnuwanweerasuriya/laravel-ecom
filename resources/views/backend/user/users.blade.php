<style>
    .dataTables_filter input {
        border-radius: 8px;
        padding: 6px 12px;
        border: 1px solid #ccc;
    }

    #users-table_filter {
        padding-right: 20px;
    }

    .dataTables_length select {
        border-radius: 8px;
        padding: 4px 8px;
    }

    .page-item.active .page-link {
        background-color: #191919 !important;
        border-color: #191919 !important;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h6 class="text-white text-capitalize ps-3 me-3">Users table</h6>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <a href="/admin/users/create" class="btn btn-primary btn-sm me-3">Add New</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table id="users-table" class="table align-items-center mb-0 table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">User</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr id="user-row-{{ $user->id }}">
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center px-2 py-1">
                                            <div class="d-flex align-items-center">
                                                <img src="../assets/img/team-2.jpg"
                                                    class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                <div class="d-flex flex-column text-start">
                                                    <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0 text-capitalize">{{ $user->role }}</p>
                                        {{-- <p class="text-xs text-secondary mb-0">Organization</p> --}}
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">Online</span>
                                    </td>
                                    {{-- <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">23/04/18</span> --}}
                                    </td>
                                    <td class="align-middle text-center">
                                        <!-- Edit -->
                                        <a href="/admin/users/edit/{{ $user->id }}"
                                            class="text-secondary font-weight-bold text-xs">
                                            <i class="material-symbols-rounded opacity-5">edit</i>
                                        </a>

                                        <!-- View (opens modal) -->
                                        <a href="javascript:void(0)" class="text-secondary font-weight-bold text-xs"
                                            data-bs-toggle="modal" data-bs-target="#userModal{{ $user->id }}"
                                            title="View user">
                                            <i class="material-symbols-rounded opacity-5">visibility</i>
                                        </a>

                                        <!-- Delete (with JS confirm) -->
                                        <a href="javascript:void(0);" data-id="{{ $user->id }}"
                                            class="btn-delete-user text-danger font-weight-bold text-xs"
                                            title="Delete user">
                                            <i class="material-symbols-rounded opacity-5">delete</i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- User Details Modal -->
                                <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content shadow-lg rounded-3 border-0">

                                            <!-- Modal Header -->
                                            <div class="modal-header bg-gradient-dark text-white">
                                                <h5 class="modal-title d-flex align-items-center text-white"
                                                    id="userModalLabel{{ $user->id }}">
                                                    <i class="material-symbols-rounded me-2">person</i>
                                                    User Details
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <h6 class="text-dark fw-bold mb-1"><i
                                                            class="material-symbols-rounded me-1">badge</i> Name</h6>
                                                    <p class="text-dark">{{ $user->name }}</p>
                                                </div>

                                                <div class="mb-3">
                                                    <h6 class="text-dark fw-bold mb-1"><i
                                                            class="material-symbols-rounded me-1">email</i> Email</h6>
                                                    <p class="text-muted">{{ $user->email }}</p>
                                                </div>

                                                <div class="mb-3">
                                                    <h6 class="text-dark fw-bold mb-1"><i
                                                            class="material-symbols-rounded me-1">call</i> Phone</h6>
                                                    <p class="text-muted">{{ $user->phone }}</p>
                                                </div>

                                                <div class="mb-3">
                                                    <h6 class="text-dark fw-bold mb-1"><i
                                                            class="material-symbols-rounded me-1">home</i> Address</h6>
                                                    <p class="text-muted">{{ $user->address }}</p>
                                                </div>

                                                <div>
                                                    <h6 class="text-dark fw-bold mb-1"><i
                                                            class="material-symbols-rounded me-1">security</i> Role</h6>
                                                    @php
                                                        $roleClass = match ($user->role) {
                                                            'admin' => 'bg-danger',
                                                            'user' => 'bg-success',
                                                            default => 'bg-secondary',
                                                        };
                                                    @endphp
                                                    <span
                                                        class="badge {{ $roleClass }} text-white px-3 py-2">{{ ucfirst($user->role) }}</span>
                                                </div>
                                            </div>

                                            <!-- Modal Footer -->
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    <i class="material-symbols-rounded me-1">close</i> Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            paging: true,
            searching: true,
            lengthChange: true,
            pageLength: 10,
            ordering: false, // Disable sorting for now
            info: true,
            responsive: true,
            dom: '<"row mb-3"<"col-md-6 d-flex align-items-center"l><"col-md-6 d-flex justify-content-end"f>>t<"row mt-3"<"col-md-6"i><"col-md-6 d-flex justify-content-end"p>>',
            language: {
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ users",
                infoEmpty: "No users available",
                infoFiltered: "(filtered from _MAX_ total users)",
                zeroRecords: "No matching users found",
                search: "",
                searchPlaceholder: "🔍 Search users...",
                paginate: {
                    previous: "←",
                    next: "→"
                }
            }
        });
        $(document).on('click', '.btn-delete-user', function(e) {
            e.preventDefault();
            var userId = $(this).data('id');

            if (!confirm('Are you sure you want to delete this user?')) return;

            $.ajax({
                url: '/admin/users/delete/' + userId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#user-row-' + userId).fadeOut(300, function() {
                        $(this).remove();
                    });

                    toastr.success('User deleted successfully.');
                },
                error: function() {
                    toastr.error('Failed to delete user.');
                }
            });
        });
    });
</script>

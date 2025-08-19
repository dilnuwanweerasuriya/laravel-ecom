<style>
    .dataTables_filter input {
        border-radius: 8px;
        padding: 6px 12px;
        border: 1px solid #ccc;
    }

    #categories-table_filter {
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
                            <h6 class="text-white text-capitalize ps-3 me-3">Categories</h6>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <a href="/admin/categories/create" class="btn btn-primary btn-sm me-3">Add New</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table id="categories-table" class="table align-items-center mb-0 table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Category</th>
                                <th class="text-center">Slug</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr id="category-row-{{ $category->id }}">
                                    <td class="text-center">
                                        <div class="px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $category->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    @if ($category->parent_id != null)
                                                        {{ $category->parent->name }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0 text-capitalize">{{ $category->slug }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if ($category->is_active == 1)
                                            <span class="badge badge-sm bg-gradient-success">Active</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-warning">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <!-- Edit -->
                                        <a href="/admin/categories/edit/{{ $category->id }}"
                                            class="text-secondary font-weight-bold text-xs">
                                            <i class="material-symbols-rounded opacity-5">edit</i>
                                        </a>

                                        <!-- View (opens modal) -->
                                        <a href="javascript:void(0)" class="text-secondary font-weight-bold text-xs"
                                            data-bs-toggle="modal" data-bs-target="#categoryModal{{ $category->id }}"
                                            title="View category">
                                            <i class="material-symbols-rounded opacity-5">visibility</i>
                                        </a>

                                        <!-- Delete (with JS confirm) -->
                                        <a href="javascript:void(0);" data-id="{{ $category->id }}"
                                            class="btn-delete-category text-danger font-weight-bold text-xs"
                                            title="Delete category">
                                            <i class="material-symbols-rounded opacity-5">delete</i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Category Details Modal -->
                                <div class="modal fade" id="categoryModal{{ $category->id }}" tabindex="-1"
                                    aria-labelledby="categoryModalLabel{{ $category->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content shadow-lg rounded-3 border-0">

                                            <!-- Modal Header -->
                                            <div class="modal-header bg-gradient-dark text-white">
                                                <h5 class="modal-title d-flex align-items-center text-white"
                                                    id="categoryModalLabel{{ $category->id }}">
                                                    <i class="material-symbols-rounded me-2">category</i>
                                                    Category Details
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <!-- Category Name -->
                                                <div class="mb-3">
                                                    <h6 class="text-dark fw-bold mb-1"><i
                                                            class="material-symbols-rounded me-1">label</i> Name</h6>
                                                    <p class="fs-6 text-dark">{{ $category->name }}</p>
                                                </div>

                                                <!-- Slug -->
                                                <div class="mb-3">
                                                    <h6 class="text-dark fw-bold mb-1"><i
                                                            class="material-symbols-rounded me-1">link</i> Slug</h6>
                                                    <p class="text-muted">{{ $category->slug }}</p>
                                                </div>

                                                <!-- Status -->
                                                <div>
                                                    <h6 class="text-dark fw-bold mb-1"><i
                                                            class="material-symbols-rounded me-1">info</i> Status</h6>
                                                    @if ($category->is_active == 1)
                                                        <span class="badge bg-success px-3 py-2">Active</span>
                                                    @else
                                                        <span
                                                            class="badge bg-warning text-dark px-3 py-2">Inactive</span>
                                                    @endif
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
        $('#categories-table').DataTable({
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
                info: "Showing _START_ to _END_ of _TOTAL_ categories",
                infoEmpty: "No categories available",
                infoFiltered: "(filtered from _MAX_ total categories)",
                zeroRecords: "No matching categories found",
                search: "",
                searchPlaceholder: "🔍 Search categories...",
                paginate: {
                    previous: "←",
                    next: "→"
                }
            }
        });
        $(document).on('click', '.btn-delete-category', function(e) {
            e.preventDefault();
            var categoryId = $(this).data('id');

            if (!confirm('Are you sure you want to delete this category?')) return;

            $.ajax({
                url: '/admin/categories/delete/' + categoryId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#category-row-' + categoryId).fadeOut(300, function() {
                        $(this).remove();
                    });

                    toastr.success('Category deleted successfully.');
                },
                error: function() {
                    toastr.error('Failed to delete category.');
                }
            });
        });
    });
</script>

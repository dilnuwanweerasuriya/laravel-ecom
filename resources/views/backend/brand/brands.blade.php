<style>
    .dataTables_filter input {
        border-radius: 8px;
        padding: 6px 12px;
        border: 1px solid #ccc;
    }

    #brands-table_filter{
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
                            <h6 class="text-white text-capitalize ps-3 me-3">Brands</h6>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <a href="/admin/brands/create" class="btn btn-primary btn-sm me-3">Add New</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table id="brands-table" class="table align-items-center mb-0 table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Brand</th>
                                <th class="text-center">Slug</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr id="brand-row-{{ $brand->id }}">
                                    <td class="text-center">
                                        <div class="px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $brand->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0 text-capitalize">{{ $brand->slug }}</p>
                                    </td>
                                    <td class="text-center">
                                        @if ($brand->image)
                                            <img src="{{ asset($brand->image) }}" alt="Brand Image"
                                                style="height: 40px;">
                                        @endif
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if ($brand->is_active == 1)
                                            <span class="badge badge-sm bg-gradient-success">Active</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-warning">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <!-- Edit -->
                                        <a href="/admin/brands/edit/{{ $brand->id }}"
                                            class="text-secondary font-weight-bold text-xs">
                                            <i class="material-symbols-rounded opacity-5">edit</i>
                                        </a>

                                        <!-- View (opens modal) -->
                                        <a href="javascript:void(0)" class="text-secondary font-weight-bold text-xs"
                                            data-bs-toggle="modal" data-bs-target="#brandModal{{ $brand->id }}"
                                            title="View brand">
                                            <i class="material-symbols-rounded opacity-5">visibility</i>
                                        </a>

                                        <!-- Delete (with JS confirm) -->
                                        <a href="javascript:void(0);" data-id="{{ $brand->id }}"
                                            class="btn-delete-brand text-danger font-weight-bold text-xs"
                                            title="Delete brand">
                                            <i class="material-symbols-rounded opacity-5">delete</i>
                                        </a>
                                    </td>
                                </tr>


                                <!-- Brand Details Modal -->
                                <div class="modal fade" id="brandModal{{ $brand->id }}" tabindex="-1"
                                    aria-labelledby="brandModalLabel{{ $brand->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content shadow-lg rounded-3 border-0">

                                            <!-- Header -->
                                            <div class="modal-header bg-gradient-dark text-white">
                                                <h5 class="modal-title d-flex align-items-center text-white"
                                                    id="brandModalLabel{{ $brand->id }}">
                                                    <i class="material-symbols-rounded me-2">branding_watermark</i>
                                                    Brand Details
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <!-- Brand Image -->
                                                @if ($brand->image)
                                                    <div class="text-center mb-3">
                                                        <img src="{{ asset($brand->image) }}" alt="Brand Image"
                                                            class="img-fluid rounded shadow-sm"
                                                            style="max-height: 100px;">
                                                    </div>
                                                @endif

                                                <!-- Brand Info -->
                                                <div class="mb-3">
                                                    <h6 class="text-dark fw-bold mb-2"><i
                                                            class="material-symbols-rounded me-1">label</i> Brand Name
                                                    </h6>
                                                    <p class="fs-6 text-dark">{{ $brand->name }}</p>
                                                </div>

                                                <div class="mb-3">
                                                    <h6 class="text-dark fw-bold mb-2"><i
                                                            class="material-symbols-rounded me-1">link</i> Slug</h6>
                                                    <p class="text-muted">{{ $brand->slug }}</p>
                                                </div>

                                                <!-- Status -->
                                                <div>
                                                    <h6 class="text-dark fw-bold mb-2"><i
                                                            class="material-symbols-rounded me-1">info</i> Status</h6>
                                                    @if ($brand->is_active == 1)
                                                        <span class="badge bg-success px-3 py-2">Active</span>
                                                    @else
                                                        <span
                                                            class="badge bg-warning text-dark px-3 py-2">Inactive</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Footer -->
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
        $('#brands-table').DataTable({
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
                info: "Showing _START_ to _END_ of _TOTAL_ brands",
                infoEmpty: "No brands available",
                infoFiltered: "(filtered from _MAX_ total brands)",
                zeroRecords: "No matching brands found",
                search: "",
                searchPlaceholder: "🔍 Search brands...",
                paginate: {
                    previous: "←",
                    next: "→"
                }
            }
        });
        $(document).on('click', '.btn-delete-brand', function(e) {
            e.preventDefault();
            var brandId = $(this).data('id');

            if (!confirm('Are you sure you want to delete this brand?')) return;

            $.ajax({
                url: '/admin/brands/delete/' + brandId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#brand-row-' + brandId).fadeOut(300, function() {
                        $(this).remove();
                    });

                    toastr.success('Brand deleted successfully.');
                },
                error: function() {
                    toastr.error('Failed to delete brand.');
                }
            });
        });
    });
</script>

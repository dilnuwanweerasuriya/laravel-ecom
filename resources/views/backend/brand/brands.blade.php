<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h6 class="text-white text-capitalize ps-3 me-3">Brands table</h6>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <a href="/admin/brands/create" class="btn btn-primary btn-sm me-3">Add New</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Brand
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Slug</th>
                                <th class="text-xxs opacity-7 ps-2">Image</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr id="brand-row-{{ $brand->id }}">
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $brand->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 text-capitalize">{{ $brand->slug }}</p>
                                    </td>
                                    <td>
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
                                    <td class="align-middle">
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
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="brandModalLabel{{ $brand->id }}">Brand
                                                    Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Name:</strong> {{ $brand->name }}</p>
                                                <p><strong>Slug:</strong> {{ $brand->slug }}</p>
                                                <p><strong>Image:</strong>
                                                    @if ($brand->image)
                                                        <img src="{{ asset($brand->image) }}" alt="Brand Image"
                                                            style="height: 40px;">
                                                    @endif
                                                </p>
                                                <p><strong>Status:</strong>
                                                    @if ($brand->is_active == 1)
                                                        <span class="badge badge-sm bg-gradient-success">Active</span>
                                                    @else
                                                        <span class="badge badge-sm bg-gradient-warning">Inactive</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm bg-gradient-secondary"
                                                    data-bs-dismiss="modal">Close</button>
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
</script>

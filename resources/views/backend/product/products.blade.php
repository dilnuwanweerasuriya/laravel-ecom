<style>
    .dataTables_filter input {
        border-radius: 8px;
        padding: 6px 12px;
        border: 1px solid #ccc;
    }

    #products-table_filter{
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
                            <h6 class="text-white text-capitalize ps-3 me-3">Products table</h6>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <a href="/admin/products/create" class="btn btn-primary btn-sm me-3">Add New</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table id="products-table" class="table align-items-center mb-0 table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Product Type</th>
                                <th class="text-center">Primary Image</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr id="product-row-{{ $product->id }}">
                                    <td class="text-center">
                                        <div class="px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $product->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0 text-capitalize">
                                            {{ $product->description }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0 text-capitalize">
                                            {{ $product->has_variants == 0 ? 'Simple Product' : 'Variant Product' }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        @if ($product->images)
                                            @foreach ($product->images as $image)
                                                @if ($image->is_primary == 1)
                                                    <img src="{{ asset($image->image_url) }}" alt="Product Image"
                                                        style="height: 60px;">
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <!-- Edit -->
                                        <a href="/admin/products/edit/{{ $product->id }}"
                                            class="text-secondary font-weight-bold text-xs">
                                            <i class="material-symbols-rounded opacity-5">edit</i>
                                        </a>

                                        <!-- View (opens modal) -->
                                        <a href="javascript:void(0)" class="text-secondary font-weight-bold text-xs"
                                            data-bs-toggle="modal" data-bs-target="#productModal{{ $product->id }}"
                                            title="View product">
                                            <i class="material-symbols-rounded opacity-5">visibility</i>
                                        </a>

                                        <!-- Delete (with JS confirm) -->
                                        <a href="javascript:void(0);" data-id="{{ $product->id }}"
                                            class="btn-delete-product text-danger font-weight-bold text-xs"
                                            title="Delete product">
                                            <i class="material-symbols-rounded opacity-5">delete</i>
                                        </a>
                                    </td>
                                </tr>


                                <!-- Product Details Modal -->
                                <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1"
                                    aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content shadow-lg rounded-3 border-0">
                                            <!-- Header -->
                                            <div class="modal-header bg-gradient-dark text-white">
                                                <h5 class="modal-title d-flex align-items-center text-white"
                                                    id="productModalLabel{{ $product->id }}">
                                                    <i class="material-symbols-rounded me-2">inventory_2</i>
                                                    Product Details
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <!-- Product Info -->
                                                <div class="mb-4">
                                                    <h6 class="text-primary fw-bold mb-3"><i
                                                            class="material-symbols-rounded me-1">info</i> General
                                                        Information</h6>
                                                    <p><strong>Name:</strong> {{ $product->name }}</p>
                                                    <p><strong>Description:</strong> {{ $product->description }}</p>
                                                    <p><strong>Type:</strong>
                                                        {{ $product->has_variants == 0 ? 'Simple Product' : 'Variant Product' }}
                                                    </p>

                                                    <!-- Product Image -->
                                                    @if ($product->images)
                                                        @foreach ($product->images as $image)
                                                            @if ($image->is_primary == 1)
                                                                <div class="mb-3">
                                                                    <img src="{{ asset($image->image_url) }}"
                                                                        alt="Product Image"
                                                                        class="img-fluid rounded shadow-sm"
                                                                        style="max-height:150px;">
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>

                                                <!-- Variants Section -->
                                                @if ($product->has_variants == 1)
                                                    <hr class="my-3">
                                                    <h6 class="text-primary fw-bold mb-3"><i
                                                            class="material-symbols-rounded me-1">category</i> Variant
                                                        Details</h6>
                                                    <div class="row">
                                                        @foreach ($product->variants as $index => $variant)
                                                            <div class="col-md-6 mb-4">
                                                                <div class="card border-0 shadow-sm rounded-3 h-100">
                                                                    <div class="card-body">
                                                                        <h6 class="card-title text-dark fw-bold mb-3">
                                                                            Variant {{ $index + 1 }}</h6>
                                                                        @foreach ($variant->images as $image)
                                                                            @if ($image->is_primary == 1)
                                                                                <img src="{{ asset($image->image_url) }}"
                                                                                    alt="Variant Image"
                                                                                    class="img-fluid rounded mb-3"
                                                                                    style="max-height:100px;">
                                                                            @endif
                                                                        @endforeach
                                                                        <p><strong>SKU:</strong> {{ $variant->sku }}
                                                                        </p>
                                                                        <p><strong>Price:</strong>
                                                                            <span class="badge bg-success">LKR
                                                                                {{ number_format($variant->price, 2) }}</span>
                                                                        </p>
                                                                        <p><strong>Stock:</strong>
                                                                            <span
                                                                                class="badge bg-info text-dark">{{ $variant->stock }}</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <hr class="my-3">
                                                    <p><strong>SKU:</strong> {{ $product->sku }}</p>
                                                    <p><strong>Price:</strong>
                                                        <span class="badge bg-success">LKR
                                                            {{ number_format($product->price, 2) }}</span>
                                                    </p>
                                                    <p><strong>Stock:</strong>
                                                        <span
                                                            class="badge bg-info text-dark">{{ $product->stock }}</span>
                                                    </p>
                                                @endif
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
        $('#products-table').DataTable({
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
                info: "Showing _START_ to _END_ of _TOTAL_ products",
                infoEmpty: "No products available",
                infoFiltered: "(filtered from _MAX_ total products)",
                zeroRecords: "No matching products found",
                search: "",
                searchPlaceholder: "🔍 Search products...",
                paginate: {
                    previous: "←",
                    next: "→"
                }
            }
        });
        $(document).on('click', '.btn-delete-product', function(e) {
            e.preventDefault();
            var productId = $(this).data('id');

            if (!confirm('Are you sure you want to delete this product?')) return;

            $.ajax({
                url: '/admin/products/delete/' + productId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#product-row-' + productId).fadeOut(300, function() {
                        $(this).remove();
                    });

                    toastr.success('Product deleted successfully.');
                },
                error: function() {
                    toastr.error('Failed to delete product.');
                }
            });
        });
    });
</script>

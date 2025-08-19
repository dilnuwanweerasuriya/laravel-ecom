<style>
    .dataTables_filter input {
        border-radius: 8px;
        padding: 6px 12px;
        border: 1px solid #ccc;
    }

    #stocks-table_filter{
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
                            <h6 class="text-white text-capitalize ps-3 me-3">Stocks</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table id="stocks-table" class="table align-items-center mb-0 table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Product Type</th>
                                <th class="text-center">Stock Count</th>
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
                                            {{ $product->has_variants == 0 ? 'Simple Product' : 'Variant Product' }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0 text-capitalize">
                                            {{ $product->has_variants == 0 ? $product->stock : 'Variant' }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <!-- View (opens modal) -->
                                        <a href="javascript:void(0)" class="text-secondary font-weight-bold text-xs"
                                            data-bs-toggle="modal" data-bs-target="#productModal{{ $product->id }}"
                                            title="View product">
                                            <i class="material-symbols-rounded opacity-5">edit</i>
                                        </a>
                                    </td>
                                </tr>


                                <!-- Product Details Modal -->
                                <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1"
                                    aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content shadow-lg border-0 rounded-3">
                                            <!-- Modal Header -->
                                            <div
                                                class="modal-header bg-gradient-dark text-white d-flex justify-content-between align-items-center">
                                                <h5 class="modal-title d-flex align-items-center text-white"
                                                    id="productModalLabel{{ $product->id }}">
                                                    <i class="material-symbols-rounded me-2">inventory_2</i>
                                                    Product Details
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <!-- Product Info -->
                                                <div class="mb-4">
                                                    <h6 class="text-dark fw-bold mb-3"><i
                                                            class="material-symbols-rounded me-1">info</i> General
                                                        Information</h6>
                                                    <p><strong>Product:</strong> {{ $product->name }}</p>
                                                    <p><strong>Type:</strong>
                                                        {{ $product->has_variants == 0 ? 'Simple Product' : 'Variant Product' }}
                                                    </p>
                                                </div>

                                                @if ($product->has_variants == 1)
                                                    <hr class="my-3">
                                                    <h6 class="text-dark fw-bold mb-3"><i
                                                            class="material-symbols-rounded me-1">category</i> Variant
                                                        Details</h6>

                                                    <div class="row">
                                                        @foreach ($product->variants as $index => $variant)
                                                            <div class="col-md-6 mb-4">
                                                                <div class="card border-0 shadow-sm h-100">
                                                                    <div class="card-body">
                                                                        <h6 class="card-title text-dark fw-bold mb-2">
                                                                            Variant {{ $index + 1 }}</h6>
                                                                        <p class="mb-1"><strong>SKU:</strong>
                                                                            {{ $variant->sku }}</p>
                                                                        <p class="mb-3"><strong>Current
                                                                                Stock:</strong> {{ $variant->stock }}
                                                                        </p>
                                                                        <div class="input-group">
                                                                            <span class="input-group-text"><i
                                                                                    class="material-symbols-rounded">inventory</i></span>
                                                                            <input type="number" name="new_stock"
                                                                                class="form-control stock-input"
                                                                                data-variant-id="{{ $variant->id }}"
                                                                                placeholder="Enter new stock">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <hr class="my-3">
                                                    <p><strong>SKU:</strong> {{ $product->sku }}</p>
                                                    <p><strong>Current Stock:</strong> {{ $product->stock }}</p>
                                                    <div class="input-group w-50">
                                                        <span class="input-group-text"><i
                                                                class="material-symbols-rounded">inventory</i></span>
                                                        <input type="number" name="new_stock"
                                                            class="form-control stock-input"
                                                            data-product-id="{{ $product->id }}"
                                                            placeholder="Enter new stock">
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Modal Footer -->
                                            <div class="modal-footer bg-light d-flex justify-content-between">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    <i class="material-symbols-rounded me-1">close</i> Close
                                                </button>
                                                <button type="button" class="btn btn-dark save-stock-btn"
                                                    data-product-id="{{ $product->id }}">
                                                    <i class="material-symbols-rounded me-1">save</i> Save Changes
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
        $('#stocks-table').DataTable({
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

        $('.save-stock-btn').on('click', function() {
            let productId = $(this).data('product-id');
            let modal = $(this).closest('.modal');
            let stockData = [];

            modal.find('.stock-input').each(function() {
                let value = $(this).val().trim();
                if (value !== '') {
                    stockData.push({
                        variant_id: $(this).data('variant-id') || null,
                        product_id: $(this).data('product-id') || productId,
                        new_stock: value
                    });
                }
            });

            if (stockData.length === 0) {
                alert('Please enter at least one stock value.');
                return;
            }

            $.ajax({
                url: '/admin/stock/update',
                method: 'POST',
                data: {
                    stock: stockData,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success('Stock updated successfully.');
                        location.reload();
                    } else {
                        toastr.error('Failed to update stock.');
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Failed to update stock.');
                }
            });
        });
    });
</script>

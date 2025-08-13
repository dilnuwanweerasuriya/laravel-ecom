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
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product
                                    Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Description</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Product Type</th>
                                <th class="text-xxs opacity-7 ps-2">Image</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr id="product-row-{{ $product->id }}">
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $product->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 text-capitalize">
                                            {{ $product->description }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 text-capitalize">{{ $product->type }}
                                        </p>
                                    </td>
                                    <td>
                                        @if ($product->images)
                                            <img src="{{ asset($product->images[0]->image_path) }}" alt="Product Image"
                                                style="height: 40px;">
                                        @endif
                                    </td>
                                    <td class="align-middle">
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
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="productModalLabel{{ $product->id }}">
                                                    Product Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Product:</strong> {{ $product->name }}</p>
                                                <p><strong>Slug:</strong> {{ $product->slug }}</p>
                                                <p><strong>Description:</strong> {{ $product->description }}</p>
                                                <p><strong>Type:</strong> {{ $product->type }}</p>
                                                <p><strong>Image:</strong>
                                                    @if ($product->images && isset($product->Images[0]))
                                                        <img src="{{ asset($product->Images[0]->image_path) }}"
                                                            alt="Product Image" style="height: 50px;">
                                                    @endif
                                                </p>

                                                @if ($product->type == 'variant-product')
                                                    <strong class="d-block mb-3">Variant Details</strong>

                                                    <div class="row">
                                                        @foreach ($product->variants as $index => $variant)
                                                            <div class="col-md-6 mb-4">
                                                                <div class="border rounded p-3 mb-3 bg-light">
                                                                    <h6 class="mb-2">Variant {{ $index + 1 }}</h6>
                                                                    <p><strong>Variant SKU:</strong>
                                                                        {{ $variant->sku }}</p>
                                                                    <p><strong>Image:</strong>
                                                                        @foreach ($variant->images as $image)
                                                                            <img src="{{ asset($image->image_path) }}"
                                                                                alt="Variant Image"
                                                                                style="height: 60px; width: auto;">
                                                                        @endforeach
                                                                    </p>
                                                                    <p><strong>Variant Price:</strong> LKR
                                                                        {{ number_format($variant->price, 2) }}</p>
                                                                    <p><strong>Variant Stock:</strong>
                                                                        {{ $variant->stock }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <p><strong>SKU: </strong> {{ $product->variants[0]->sku }}</p>
                                                    <p><strong>Price:</strong> LKR
                                                        {{ number_format($product->variants[0]->price, 2) }}</p>
                                                    <p><strong>Stock:</strong> {{ $product->variants[0]->stock }}</p>
                                                @endif
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
</script>

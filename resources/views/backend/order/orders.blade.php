<style>
    .dataTables_filter input {
        border-radius: 8px;
        padding: 6px 12px;
        border: 1px solid #ccc;
    }

    #orders-table_filter {
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

    .hover-shadow:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
        transform: translateY(-2px);
        transition: all 0.3s ease-in-out;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    .badge {
        font-size: 0.85rem;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h6 class="text-white text-capitalize ps-3 me-3">Orders table</h6>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <a href="/admin/orders/create" class="btn btn-primary btn-sm me-3">Add New</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table id="orders-table" class="table align-items-center mb-0 table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Order ID</th>
                                <th class="text-center">User</th>
                                <th class="text-center">Total Amount</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @php
                                    switch ($order->status) {
                                        case 'pending':
                                            $statusColor = 'warning';
                                            break;

                                        case 'paid':
                                            $statusColor = 'info';
                                            break;

                                        case 'shipped':
                                        case 'delivered':
                                            $statusColor = 'success';
                                            break;

                                        case 'cancelled':
                                            $statusColor = 'danger';
                                            break;

                                        default:
                                            $statusColor = 'dark';
                                            break;
                                    }
                                @endphp

                                <tr id="order-row-{{ $order->id }}">
                                    <td class="text-center">
                                        <div class="px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"># {{ $order->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0 text-capitalize">
                                            {{ $order->user->name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0 text-capitalize">
                                            {{ $order->total_amount }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0 text-capitalize">
                                            <span class="badge bg-{{ $statusColor }}">{{ $order->status }}</span>
                                        </p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <!-- Edit -->
                                        <a href="/admin/orders/edit/{{ $order->id }}"
                                            class="text-secondary font-weight-bold text-xs">
                                            <i class="material-symbols-rounded opacity-5">edit</i>
                                        </a>

                                        <!-- View (opens modal) -->
                                        <a href="javascript:void(0)" class="text-secondary font-weight-bold text-xs"
                                            data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}"
                                            title="View order">
                                            <i class="material-symbols-rounded opacity-5">visibility</i>
                                        </a>

                                        <!-- Delete (with JS confirm) -->
                                        <a href="javascript:void(0);" data-id="{{ $order->id }}"
                                            class="btn-delete-order text-danger font-weight-bold text-xs"
                                            title="Delete order">
                                            <i class="material-symbols-rounded opacity-5">delete</i>
                                        </a>
                                    </td>
                                </tr>


                                <!-- order Details Modal -->
                                <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1"
                                    aria-labelledby="orderModalLabel{{ $order->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content shadow-lg rounded-4 border-0">

                                            <!-- Header -->
                                            <div class="modal-header bg-gradient-dark text-white py-3">
                                                <h5 class="modal-title d-flex align-items-center text-white"
                                                    id="orderModalLabel{{ $order->id }}">
                                                    <i class="material-symbols-rounded me-2 fs-4">inventory_2</i>
                                                    Order Details
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">

                                                <!-- Order Info -->
                                                <div class="mb-4 p-3 bg-light rounded-3 shadow-sm">
                                                    <h6 class="text-dark fw-bold mb-3">
                                                        <i class="material-symbols-rounded me-1">info</i> General
                                                        Information
                                                    </h6>
                                                    <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                                                    <p><strong>User:</strong> {{ $order->user->name }}</p>
                                                    <p><strong>Total Amount:</strong> <span
                                                            class="text-success fw-bold">LKR
                                                            {{ number_format($order->total_amount, 2) }}</span></p>
                                                    <p><strong>Delivery Fee:</strong> <span
                                                            class="text-success fw-bold">LKR
                                                            {{ number_format($order->delivery_fee, 2) }}</span></p>
                                                    <p><strong>Status: </strong><span
                                                            class="badge bg-{{ $statusColor }}">{{ $order->status }}</span>
                                                    </p>
                                                </div>

                                                <!-- Products Section -->
                                                <h6 class="text-secondary fw-bold mb-3">
                                                    <i class="material-symbols-rounded me-1">shopping_cart</i> Products
                                                </h6>
                                                <div class="row g-2">
                                                    <!-- Header Row -->
                                                    <div
                                                        class="col-12 d-none d-md-flex bg-light fw-bold rounded-3 p-2 border">
                                                        <div class="col-md-1">#</div>
                                                        <div class="col-md-4">Product</div>
                                                        <div class="col-md-3">Variant SKU</div>
                                                        <div class="col-md-2">Price</div>
                                                        <div class="col-md-2">Quantity</div>
                                                    </div>

                                                    <!-- Items -->
                                                    @foreach ($order->items as $index => $item)
                                                        <div
                                                            class="col-12 d-flex flex-column flex-md-row align-items-start align-items-md-center bg-white rounded-3 shadow-sm p-2 border mb-2">
                                                            <div class="col-12 col-md-1 fw-bold mb-1 mb-md-0">
                                                                {{ $index + 1 }}</div>
                                                            <div class="col-12 col-md-4">{{ $item->product['name'] }}
                                                            </div>
                                                            <div class="col-12 col-md-3">
                                                                {{ $item->variant->sku ?? '-' }}</div>
                                                            <div class="col-12 col-md-2">
                                                                <span class="badge bg-success">LKR
                                                                    {{ number_format($item->price_at_time, 2) }}</span>
                                                            </div>
                                                            <div class="col-12 col-md-2">
                                                                <span
                                                                    class="badge bg-info text-dark">{{ $item->quantity }}</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <!-- Shipping Address -->
                                                <div class="mt-4 p-3 bg-light rounded-3 shadow-sm">
                                                    <h6 class="text-dark fw-bold mb-2">
                                                        <i class="material-symbols-rounded me-1">location_on</i>
                                                        Shipping Address
                                                    </h6>
                                                    <p><strong>Full Name:</strong> {{ $order->full_name }}</p>
                                                    <p><strong>Street Address:</strong> {{ $order->street_address }}
                                                    </p>
                                                    <p><strong>City:</strong> {{ $order->city }}</p>
                                                    <p><strong>State:</strong> {{ $order->state ?? '-' }}</p>
                                                    <p><strong>Zip Code:</strong> {{ $order->zip_code }}</p>
                                                    <p><strong>Mobile No:</strong> {{ $order->phone }}</p>
                                                </div>

                                            </div>

                                            <!-- Footer -->
                                            <div class="modal-footer bg-light py-3">
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
        $('#orders-table').DataTable({
            paging: true,
            searching: true,
            lengthChange: true,
            pageLength: 10,
            ordering: false,
            info: true,
            responsive: true,
            dom: '<"row mb-3"<"col-md-6 d-flex align-items-center"l><"col-md-6 d-flex justify-content-end"f>>t<"row mt-3"<"col-md-6"i><"col-md-6 d-flex justify-content-end"p>>',
            language: {
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ orders",
                infoEmpty: "No orders available",
                infoFiltered: "(filtered from _MAX_ total orders)",
                zeroRecords: "No matching orders found",
                search: "",
                searchPlaceholder: "🔍 Search orders...",
                paginate: {
                    previous: "←",
                    next: "→"
                }
            }
        });
        $(document).on('click', '.btn-delete-order', function(e) {
            e.preventDefault();
            var orderId = $(this).data('id');

            if (!confirm('Are you sure you want to delete this order?')) return;

            $.ajax({
                url: '/admin/orders/delete/' + orderId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#order-row-' + orderId).fadeOut(300, function() {
                        $(this).remove();
                    });

                    toastr.success('Order deleted successfully.');
                },
                error: function() {
                    toastr.error('Failed to delete order.');
                }
            });
        });
    });
</script>

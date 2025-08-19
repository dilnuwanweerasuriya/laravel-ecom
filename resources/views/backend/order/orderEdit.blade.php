<style>
    .order-summary {
        border-top: 2px solid #ccc;
        margin-top: 15px;
        padding-top: 10px;
    }

    .order-summary h5 {
        margin-bottom: 8px;
    }

    table th,
    table td {
        vertical-align: middle;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3 me-3">Edit Order</h6>
                </div>
            </div>
            <div class="card-body pt-4 px-4">
                <form id="orderForm" action="/admin/updateOrder/{{ $order->id }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- User Info -->
                    <h4>User Info</h4>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Full Name</label>
                            <select name="shipping[user]" class="form-control" required>
                                <option value="">Select a user</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $order->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Address</label>
                            <input type="text" name="shipping[address]" class="form-control"
                                value="{{ $order->shipping_address }}" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">City</label>
                            <input type="text" name="shipping[city]" class="form-control" value="{{ $order->city }}"
                                required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">State</label>
                            <input type="text" name="shipping[state]" class="form-control"
                                value="{{ $order->state }}" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Zip Code</label>
                            <input type="text" name="shipping[zip]" class="form-control"
                                value="{{ $order->zip_code }}" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Mobile Number</label>
                            <input type="text" name="shipping[phone]" class="form-control"
                                value="{{ $order->phone }}" required>
                        </div>
                    </div>

                    <hr>

                    <!-- Products Table -->
                    <h4>Products</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle" id="orderProductsTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Variant</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="orderProductsContainer">
                                @foreach ($order->items as $index => $item)
                                    <tr id="orderProductRow_{{ $index + 1 }}">
                                        <td>
                                            <select name="products[{{ $index + 1 }}][product_id]"
                                                class="form-control productSelect">
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}"
                                                        {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="products[{{ $index + 1 }}][variant_id]"
                                                class="form-control variantSelect"
                                                {{ $item->variant_id ? '' : 'disabled' }}>
                                                @if ($item->product->has_variants)
                                                    <option value="">Select Variant</option>
                                                    @foreach ($item->product->variants as $variant)
                                                        <option value="{{ $variant->id }}"
                                                            {{ $item->variant_id == $variant->id ? 'selected' : '' }}>
                                                            {{ $variant->sku }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="">-</option>
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="products[{{ $index + 1 }}][price]"
                                                class="form-control priceInput" value="{{ $item->price_at_time }}"
                                                readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="products[{{ $index + 1 }}][quantity]"
                                                class="form-control qtyInput" value="{{ $item->quantity }}"
                                                min="1">
                                        </td>
                                        <td>
                                            <span
                                                class="subtotal">{{ number_format($item->price_at_time * $item->quantity, 2) }}</span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger removeRowBtn">X</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-secondary mb-3" id="addOrderProductBtn">Add Product</button>

                    <hr>

                    <!-- Payment Info -->
                    <h4>Payment Method</h4>
                    <div class="mb-3">
                        <select name="payment_method" class="form-select" required>
                            <option value="">Select Payment Method</option>
                            <option value="credit_card"
                                {{ $order->payment->payment_method == 'credit_card' ? 'selected' : '' }}>Credit Card
                            </option>
                            <option value="paypal" {{ $order->payment->payment_method == 'paypal' ? 'selected' : '' }}>
                                PayPal</option>
                            <option value="cash" {{ $order->payment->payment_method == 'cash' ? 'selected' : '' }}>
                                Cash on Delivery</option>
                        </select>
                    </div>

                    <!-- Order Remarks -->
                    <h4>Other Details</h4>
                    <div class="mb-3">
                        <label class="form-label">Order Remarks</label>
                        <textarea name="order_remarks" class="form-control">{{ $order->order_remarks }}</textarea>
                    </div>

                    <!-- Order Summary -->
                    <div class="order-summary text-end">
                        <h5>Subtotal: LKR <span id="subtotalAmount">0.00</span></h5>
                        <input type="hidden" name="subtotal" id="bill_subtotal">
                        <h5>Delivery Fee: LKR <input type="number" id="deliveryFee" name="delivery_fee"
                                value="{{ $order->delivery_fee }}" step="0.01"
                                style="width:90px; display:inline-block;"></h5>
                        <h4>Total: LKR <span id="totalAmount">0.00</span></h4>
                        <input type="hidden" name="total" id="bill_total">
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn bg-gradient-dark">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const products = @json($products);
    let orderProductCount = {{ count($order->items) }};

    document.addEventListener('DOMContentLoaded', function() {
        const addBtn = document.getElementById('addOrderProductBtn');
        const container = document.getElementById('orderProductsContainer');

        // Attach event listeners to existing rows
        document.querySelectorAll('#orderProductsContainer tr').forEach((row, index) => {
            attachEvents(row, index + 1);
        });

        addBtn.addEventListener('click', function() {
            addProductRow();
        });

        function addProductRow() {
            orderProductCount++;
            const productOptions = products.map(p => `<option value="${p.id}">${p.name}</option>`).join('');

            const row = document.createElement('tr');
            row.setAttribute('id', `orderProductRow_${orderProductCount}`);
            row.innerHTML = `
            <td>
                <select name="products[${orderProductCount}][product_id]" class="form-control productSelect">
                    <option value="">Select Product</option>
                    ${productOptions}
                </select>
            </td>
            <td>
                <select name="products[${orderProductCount}][variant_id]" class="form-control variantSelect" disabled>
                    <option value="">Select Variant</option>
                </select>
            </td>
            <td><input type="number" name="products[${orderProductCount}][price]" class="form-control priceInput" readonly></td>
            <td><input type="number" name="products[${orderProductCount}][quantity]" class="form-control qtyInput" value="1" min="1"></td>
            <td><span class="subtotal">0.00</span></td>
            <td><button type="button" class="btn btn-danger removeRowBtn">X</button></td>
        `;

            container.appendChild(row);
            attachEvents(row, orderProductCount);
        }

        function attachEvents(row, id) {
            const productSelect = row.querySelector('.productSelect');
            const variantSelect = row.querySelector('.variantSelect');
            const qtyInput = row.querySelector('.qtyInput');

            productSelect.addEventListener('change', function() {
                selectProduct(id, this);
            });

            variantSelect.addEventListener('change', function() {
                updateVariantPrice(id, this);
            });

            qtyInput.addEventListener('input', function() {
                updateSubtotal(id);
            });

            row.querySelector('.removeRowBtn').addEventListener('click', function() {
                row.remove();
                calculateTotal();
            });
        }

        function selectProduct(id, select) {
            const row = document.getElementById(`orderProductRow_${id}`);
            const variantSelect = row.querySelector('.variantSelect');
            const priceInput = row.querySelector('.priceInput');

            const selectedProduct = products.find(p => p.id == select.value);
            if (!selectedProduct) return;

            // Check if product without variants is already added
            if (!selectedProduct.has_variants) {
                const duplicate = Array.from(document.querySelectorAll('.productSelect'))
                    .filter(s => s !== select && s.value == selectedProduct.id);
                if (duplicate.length > 0) {
                    alert('This product is already added!');
                    select.value = '';
                    priceInput.value = '';
                    updateSubtotal(id);
                    return;
                }
            }

            if (selectedProduct.has_variants) {
                variantSelect.disabled = false;
                variantSelect.innerHTML = '<option value="">Select Variant</option>';
                selectedProduct.variants.forEach(v => {
                    // Prevent duplicate variants
                    const variantAdded = Array.from(document.querySelectorAll('.variantSelect'))
                        .some(s => s.value == v.id);
                    if (!variantAdded) {
                        variantSelect.innerHTML += `<option value="${v.id}">${v.sku}</option>`;
                    }
                });
                priceInput.value = '';
            } else {
                variantSelect.disabled = true;
                variantSelect.innerHTML = '<option value="">-</option>';
                priceInput.value = selectedProduct.price;
                updateSubtotal(id);
            }
        }

        function updateVariantPrice(id, select) {
            const row = document.getElementById(`orderProductRow_${id}`);
            const priceInput = row.querySelector('.priceInput');

            const productId = row.querySelector('.productSelect').value;
            const product = products.find(p => p.id == productId);
            const variant = product.variants.find(v => v.id == select.value);

            if (!variant) return;

            // Check duplicate variant
            const duplicate = Array.from(document.querySelectorAll('.variantSelect'))
                .filter(s => s !== select && s.value == variant.id);
            if (duplicate.length > 0) {
                alert('This variant is already added!');
                select.value = '';
                priceInput.value = '';
                updateSubtotal(id);
                return;
            }

            priceInput.value = variant.price;
            updateSubtotal(id);
        }

        function updateSubtotal(id) {
            const row = document.getElementById(`orderProductRow_${id}`);
            const price = parseFloat(row.querySelector('.priceInput').value) || 0;
            const qty = parseFloat(row.querySelector('.qtyInput').value) || 0;
            const subtotal = (price * qty).toFixed(2);
            row.querySelector('.subtotal').innerText = subtotal;
            calculateTotal();
        }

        function calculateTotal() {
            // Calculate subtotal from all rows
            let subtotalTotal = 0;
            document.querySelectorAll('.subtotal').forEach(sub => {
                subtotalTotal += parseFloat(sub.innerText) || 0;
            });

            // Update subtotal display
            document.getElementById('subtotalAmount').innerText = subtotalTotal.toFixed(2);
            document.getElementById('bill_subtotal').value = subtotalTotal.toFixed(2);

            // Get delivery fee
            const deliveryFee = parseFloat(document.getElementById('deliveryFee').value) || 0;

            // Calculate total
            const total = subtotalTotal + deliveryFee;
            document.getElementById('totalAmount').innerText = total.toFixed(2);
            document.getElementById('bill_total').value = total.toFixed(2);
        }

        document.querySelectorAll('#orderProductsContainer tr').forEach((row, index) => {
            updateSubtotal(index + 1);
        });

        // Recalculate total on delivery fee change
        document.getElementById('deliveryFee').addEventListener('input', calculateTotal);

        calculateTotal();
    });
</script>

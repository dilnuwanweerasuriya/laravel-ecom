<style>
    .order-summary {
        border-top: 2px solid #ccc;
        margin-top: 15px;
        padding-top: 10px;
    }
    .order-summary h5 {
        margin-bottom: 8px;
    }
    table th, table td {
        vertical-align: middle;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3 me-3">Create Order</h6>
                </div>
            </div>
            <div class="card-body pt-4 px-4">
                <form id="orderForm" action="/admin/addOrder" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- User Info -->
                    <h4>User Info</h4>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Full Name</label>
                            {{-- <input type="text" name="shipping[name]" class="form-control" required> --}}
                            <select name="shipping[user]" class="form-control" required>
                                <option value="">Select a user</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Address</label>
                            <input type="text" name="shipping[address]" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">City</label>
                            <input type="text" name="shipping[city]" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">State</label>
                            <input type="text" name="shipping[state]" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Zip Code</label>
                            <input type="text" name="shipping[zip]" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Mobile Number</label>
                            <input type="text" name="shipping[phone]" class="form-control" required>
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
                            <tbody id="orderProductsContainer"></tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-secondary mb-3" id="addOrderProductBtn">Add Product</button>

                    <hr>

                    <!-- Payment Info -->
                    <h4>Payment Method</h4>
                    <div class="mb-3">
                        <select name="payment_method" class="form-select" required>
                            <option value="">Select Payment Method</option>
                            <option value="credit_card">Credit Card</option>
                            <option value="paypal">PayPal</option>
                            <option value="cash">Cash on Delivery</option>
                        </select>
                    </div>

                    <!-- Order Remarks -->
                    <h4>Other Details</h4>
                    <div class="mb-3">
                        <label class="form-label">Order Remarks</label>
                        <textarea name="order_remarks" class="form-control"></textarea>
                    </div>

                    <!-- Order Summary -->
                    <div class="order-summary text-end">
                        <h5>Subtotal: LKR <span id="subtotalAmount">0.00</span></h5>
                        <input type="hidden" name="subtotal" id="bill_subtotal">
                        <h5>Delivery Fee: LKR <input type="number" id="deliveryFee" name="delivery_fee" value="0" step="0.01" style="width:80px; display:inline-block;"></h5>
                        <h4>Total: LKR <span id="totalAmount">0.00</span></h4>
                        <input type="hidden" name="total" id="bill_total">
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn bg-gradient-dark">Create Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    const products = @json($products);
    let orderProductCount = 0;

    // Track usage
    const usedNoVariantProducts = new Set();
    const usedVariants = {};

    // Add row
    document.getElementById('addOrderProductBtn').addEventListener('click', function () {
        orderProductCount++;

        const productOptions = products.map(p => `<option value="${p.id}">${p.name}</option>`).join('');

        const row = document.createElement('tr');
        row.id = `orderProduct-${orderProductCount}`;
        row.innerHTML = `
            <td>
                <select class="form-select productSelect"
                        name="products[${orderProductCount}][id]"
                        onchange="selectProduct(${orderProductCount}, this)"
                        data-prev-product-id=""
                        data-lock-nonvariant="0">
                    <option value="">Select Product</option>
                    ${productOptions}
                </select>
            </td>
            <td id="variantCell-${orderProductCount}">-</td>
            <td><input type="number" step="0.01" class="form-control priceInput" name="products[${orderProductCount}][price]" readonly></td>
            <td><input type="number" class="form-control qtyInput" name="products[${orderProductCount}][quantity]" value="1" min="1" readonly></td>
            <td>LKR <span class="subtotal">0.00</span></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeOrderProduct(${orderProductCount})">Remove</button></td>
        `;
        document.getElementById('orderProductsContainer').appendChild(row);
    });

    // Handle product selection
    function selectProduct(id, select) {
        const newProductId = select.value;
        const prevProductId = select.getAttribute('data-prev-product-id') || '';
        const row = document.getElementById(`orderProduct-${id}`);
        const priceInput = row.querySelector('.priceInput');
        const qtyInput = row.querySelector('.qtyInput');
        const variantCell = document.getElementById(`variantCell-${id}`);

        // Clean current row UI
        priceInput.value = '';
        qtyInput.value = 1;
        qtyInput.readOnly = true;
        variantCell.innerHTML = '-';

        // If product changed, free previous locks from this row
        if (prevProductId) {
            const prevProduct = products.find(p => p.id == prevProductId);
            if (prevProduct) {
                if (prevProduct.has_variants == 1) {
                    const prevVariantSelect = row.querySelector('.variantSelect');
                    if (prevVariantSelect) {
                        const prevVariantId = prevVariantSelect.getAttribute('data-prev-variant');
                        if (prevVariantId && usedVariants[prevProductId]) {
                            usedVariants[prevProductId].delete(prevVariantId);
                            updateVariantDropdowns(prevProductId);
                        }
                    }
                } else {
                    // Non-variant previously locked by this row?
                    if (select.getAttribute('data-lock-nonvariant') === '1') {
                        usedNoVariantProducts.delete(prevProductId);
                        select.setAttribute('data-lock-nonvariant', '0');
                    }
                }
            }
        }

        // If cleared
        if (!newProductId) {
            select.setAttribute('data-prev-product-id', '');
            calculateTotal();
            return;
        }

        const product = products.find(p => p.id == newProductId);
        if (!product) return;

        // Initialize variant set for variant products
        if (product.has_variants == 1) {
            if (!usedVariants[newProductId]) usedVariants[newProductId] = new Set();

            // Build variant dropdown; disable already used variants for this product
            const variantOptions = product.variants.map(v => {
                const disabled = usedVariants[newProductId].has(String(v.id)) ? 'disabled' : '';
                return `<option value="${v.id}" data-price="${v.price}" data-stock="${v.stock}" ${disabled}>${v.sku}</option>`;
            }).join('');

            variantCell.innerHTML = `
                <select class="form-select variantSelect"
                        name="products[${id}][variant_id]"
                        onchange="updateVariantPrice(${id}, this, ${newProductId})"
                        data-prev-variant="">
                    <option value="">Select Variant</option>
                    ${variantOptions}
                </select>
            `;
            // No lock yet; lock will happen when a variant is picked
            select.setAttribute('data-lock-nonvariant', '0');
        } else {
            // Product WITHOUT variants: allow adding only once globally
            if (usedNoVariantProducts.has(newProductId)) {
                alert('This product is already added!');
                // revert to empty (or previous product if needed)
                select.value = '';
                select.setAttribute('data-prev-product-id', '');
                calculateTotal();
                return;
            }
            usedNoVariantProducts.add(newProductId);
            select.setAttribute('data-lock-nonvariant', '1');
            priceInput.value = product.price;
            qtyInput.max = product.stock;
            qtyInput.readOnly = false;
        }

        // Store as current product in this row
        select.setAttribute('data-prev-product-id', newProductId);

        // Recalculate
        calculateTotal();
    }

    // Handle variant selection for variant products
    function updateVariantPrice(id, select, productId) {
        const row = document.getElementById(`orderProduct-${id}`);
        const priceInput = row.querySelector('.priceInput');
        const qtyInput = row.querySelector('.qtyInput');

        if (!usedVariants[productId]) usedVariants[productId] = new Set();

        const chosen = select.value;
        const prevVariantId = select.getAttribute('data-prev-variant');

        // Free previous variant (if any)
        if (prevVariantId) {
            usedVariants[productId].delete(prevVariantId);
        }

        // If cleared
        if (!chosen) {
            priceInput.value = '';
            qtyInput.readOnly = true;
            select.setAttribute('data-prev-variant', '');
            updateVariantDropdowns(productId);
            calculateTotal();
            return;
        }

        // Prevent duplicate variant for this product
        if (usedVariants[productId].has(chosen)) {
            alert('This variant of the product is already added!');
            // revert to no selection
            select.value = '';
            select.setAttribute('data-prev-variant', '');
            priceInput.value = '';
            qtyInput.readOnly = true;
            updateVariantDropdowns(productId);
            calculateTotal();
            return;
        }

        // Lock this variant for the product
        usedVariants[productId].add(chosen);
        select.setAttribute('data-prev-variant', chosen);

        // Apply price/stock to row
        const opt = select.options[select.selectedIndex];
        priceInput.value = opt.dataset.price || '';
        qtyInput.max = opt.dataset.stock || '';
        qtyInput.readOnly = false;

        updateVariantDropdowns(productId);
        calculateTotal();
    }

    // Disable used variants in all rows for the SAME product (but keep current selections enabled)
    function updateVariantDropdowns(productId) {
        document.querySelectorAll('.variantSelect').forEach(vs => {
            // Only affect variant selects that belong to rows where productId matches
            const row = vs.closest('tr');
            const rowProductSelect = row.querySelector('.productSelect');
            if (!rowProductSelect || rowProductSelect.value != String(productId)) return;

            const currentValue = vs.value;
            vs.querySelectorAll('option').forEach(opt => {
                if (!opt.value) return; // skip placeholder
                if (opt.value === currentValue) {
                    opt.disabled = false; // keep the currently selected one enabled
                } else {
                    opt.disabled = usedVariants[productId]?.has(opt.value) || false;
                }
            });
        });
    }

    // Remove row: free any locks used by this row
    function removeOrderProduct(id) {
        const row = document.getElementById(`orderProduct-${id}`);
        if (!row) return;

        const productSelect = row.querySelector('.productSelect');
        const productId = productSelect ? productSelect.value : '';

        if (productId) {
            const product = products.find(p => p.id == productId);
            if (product) {
                if (product.has_variants == 1) {
                    const variantSelect = row.querySelector('.variantSelect');
                    if (variantSelect) {
                        const vId = variantSelect.getAttribute('data-prev-variant');
                        if (vId && usedVariants[productId]) {
                            usedVariants[productId].delete(vId);
                            updateVariantDropdowns(productId);
                        }
                    }
                } else {
                    // Only if this row had locked the non-variant product
                    if (productSelect.getAttribute('data-lock-nonvariant') === '1') {
                        usedNoVariantProducts.delete(productId);
                    }
                }
            }
        }

        row.remove();
        calculateTotal();
    }

    // Totals
    function calculateTotal() {
        let subtotal = 0;

        document.querySelectorAll('#orderProductsContainer tr').forEach(row => {
            const price = parseFloat(row.querySelector('.priceInput')?.value || 0);
            const qty = parseInt(row.querySelector('.qtyInput')?.value || 0);
            const rowSubtotal = price * qty;

            const cell = row.querySelector('.subtotal');
            if (cell) cell.innerText = rowSubtotal.toFixed(2);

            subtotal += rowSubtotal;
        });

        document.getElementById('subtotalAmount').innerText = subtotal.toFixed(2);
        document.getElementById('bill_subtotal').value = subtotal.toFixed(2);

        const deliveryFee = parseFloat(document.getElementById('deliveryFee').value || 0);
        const total = subtotal + deliveryFee;

        document.getElementById('totalAmount').innerText = total.toFixed(2);
        document.getElementById('bill_total').value = total.toFixed(2);
    }

    // Live updates
    document.getElementById('orderProductsContainer').addEventListener('input', function (e) {
        if (e.target.classList.contains('qtyInput')) {
            calculateTotal();
        }
    });
    document.getElementById('deliveryFee').addEventListener('input', calculateTotal);
</script>




<div>
    <livewire:partials.navigation />

    <livewire:shared.page-header :page="'Shopping Cart'" :heading="'Shopping Cart'" />

    <!-- Cart Content -->
    <div class="container mx-auto px-6 py-12">
        <div class="flex flex-col lg:flex-row">
            <!-- Cart Items -->
            <div class="w-full lg:w-2/3 lg:pr-12 mb-12 lg:mb-0">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <!-- Table Header (Desktop) -->
                    <div class="hidden md:flex border-b border-gray-200 pb-4 mb-6">
                        <div class="w-1/4 text-gray-600 font-medium">Product</div>
                        <div class="w-1/4 text-gray-600 font-medium">Price</div>
                        <div class="w-1/4 text-gray-600 font-medium">Quantity</div>
                        <div class="w-1/4 text-gray-600 font-medium">Total</div>
                    </div>

                    @forelse ($cart_items as $item)
                        <div class="flex flex-col md:flex-row items-center border-b border-gray-200 py-6"
                            wire:key="cart-item-{{ $item['product_id'] }}">
                            <!-- Product Info -->
                            <div class="w-full md:w-1/4 mb-4 md:mb-0">
                                <div class="flex items-center">
                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}"
                                        class="w-20 h-20 object-cover rounded mr-4">
                                    <div>
                                        <h3 class="font-medium text-gray-800">
                                            {{ $item['name'] }}
                                            @if (!empty($item['attributes']))
                                                ({{ implode(', ', $item['attributes']) }})
                                            @endif
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <!-- Unit Price -->
                            <div class="w-full md:w-1/4 text-center mb-4 md:mb-0">
                                <p class="text-gray-800 font-medium">
                                    {{ Number::currency($item['unit_amount'], 'LKR') }}
                                </p>
                            </div>

                            <!-- Quantity Controls -->
                            <div class="w-full md:w-1/4 text-center mb-4 md:mb-0">
                                <div class="flex items-center justify-center">
                                    <button wire:click="decreaseQty({{ $item['product_id'] }})"
                                        class="bg-gray-200 text-gray-700 px-3 py-1 rounded-l hover:bg-gray-300"
                                        aria-label="Decrease Quantity">-</button>

                                    <input type="text" value="{{ $item['quantity'] }}" readonly
                                        class="w-12 text-center border-t border-b border-gray-200">

                                    <button wire:click="increaseQty({{ $item['product_id'] }})"
                                        class="bg-gray-200 text-gray-700 px-3 py-1 rounded-r hover:bg-gray-300"
                                        aria-label="Increase Quantity">+</button>
                                </div>
                            </div>

                            <!-- Total & Remove -->
                            <button 
                                wire:click="removeItem(
                                    {{ $item['product_id'] }}, 
                                    {{ $item['variant_id'] ?? 'null' }}
                                )"
                                class="text-red-500 hover:text-red-700 text-sm mt-2 cursor-pointer"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <span wire:loading.remove wire:target="removeItem({{ $item['product_id'] }}, {{ $item['variant_id'] ?? 'null' }})">Remove</span>
                                <span wire:loading wire:target="removeItem({{ $item['product_id'] }}, {{ $item['variant_id'] ?? 'null' }})">Removing...</span>
                            </button>
                        </div>
                    @empty
                        <div class="text-center py-6 text-xl font-semibold text-slate-500">
                            No items available in the cart!
                        </div>
                    @endforelse
                </div>

                <!-- Continue Shopping Button -->
                <div class="mt-8 text-center">
                    <a href="/products"
                        class="inline-block bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                        </svg>
                        Continue Shopping
                    </a>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Order Summary</h2>

                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="text-gray-800 font-medium">{{ Number::currency($grand_total, 'LKR') }}</span>
                    </div>

                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-600">Shipping</span>
                        <span class="text-gray-800 font-medium">{{ Number::currency(0, 'LKR') }}</span>
                    </div>

                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-600">Tax</span>
                        <span class="text-gray-800 font-medium">{{ Number::currency($grand_total, 'LKR') }}</span>
                    </div>

                    <div class="border-t border-gray-200 my-4"></div>

                    <div class="flex justify-between items-center mb-6">
                        <span class="text-lg font-bold text-gray-800">Total</span>
                        <span
                            class="text-lg font-bold text-gray-800">{{ Number::currency($grand_total, 'LKR') }}</span>
                    </div>

                    {{-- <div class="mb-6">
                        <label for="coupon" class="block text-gray-700 font-medium mb-2">Coupon Code</label>
                        <div class="flex">
                            <input type="text" id="coupon" placeholder="Enter coupon code"
                                class="flex-grow px-4 py-3 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <button
                                class="bg-indigo-600 text-white px-4 py-3 rounded-r-lg hover:bg-indigo-700 transition duration-300">Apply</button>
                        </div>
                    </div> --}}

                    @if (Auth::check())
                        <a href="/checkout"
                            class="w-full block bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 transition duration-300 text-center font-medium">Proceed
                            to Checkout</a>
                    @else
                        <a href="/login"
                            class="w-full block bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 transition duration-300 text-center font-medium">Proceed
                            to Checkout</a>
                    @endif

                    {{-- <div class="mt-6 text-center">
                        <p class="text-sm text-gray-500">Or</p>
                        <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm mt-2 inline-block">Pay
                            with PayPal</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <livewire:shared.newsletter />

    <livewire:partials.footer />
</div>

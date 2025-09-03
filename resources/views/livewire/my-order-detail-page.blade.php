<div>

    <livewire:partials.navigation />

    <div class="container mx-auto px-6 py-12">
        <div class="max-w-6xl mx-auto">
            <!-- Back Button -->
            <a href="/my-orders"
                class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-6 transition duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to My Orders
            </a>

            <!-- Order Header -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Order #{{ $order->id }}</h1>
                        <p class="text-gray-500 mt-1">Placed on {{ $order->created_at->format('d-m-Y H:i:s') }}</p>
                    </div>
                    <div class="mt-4 lg:mt-0 flex flex-col items-start lg:items-end">

                        @php
                            switch ($order->status) {
                                case 'pending':
                                    $statusColor = 'yellow';
                                    break;

                                case 'paid':
                                    $statusColor = 'blue';
                                    break;

                                case 'shipped':
                                case 'delivered':
                                    $statusColor = 'green';
                                    break;

                                case 'cancelled':
                                    $statusColor = 'red';
                                    break;

                                default:
                                    $statusColor = 'black';
                                    break;
                            }
                        @endphp

                        <span
                            class="px-3 py-1 text-sm capitalize font-semibold rounded-full bg-{{$statusColor}}-100 text-{{$statusColor}}-800">{{ $order->status }}</span>
                        {{-- <p class="text-gray-500 text-sm mt-2">Delivered on October 12, 2023</p> --}}
                    </div>
                </div>
            </div>

            <!-- Order Progress Tracker -->
            {{-- <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Order Status</h2>
                <div class="relative">
                    <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                    <div class="absolute left-4 top-0 h-32 w-0.5 bg-indigo-600"></div>

                    <div class="space-y-6">
                        <!-- Step 1 -->
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center z-10">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="font-medium text-gray-800">Order Confirmed</p>
                                <p class="text-gray-500 text-sm">October 10, 2023 at 2:45 PM</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center z-10">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="font-medium text-gray-800">Order Processed</p>
                                <p class="text-gray-500 text-sm">October 10, 2023 at 6:30 PM</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center z-10">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="font-medium text-gray-800">Shipped</p>
                                <p class="text-gray-500 text-sm">October 11, 2023 at 9:15 AM</p>
                                <p class="text-indigo-600 text-sm">Tracking: UPS123456789</p>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center z-10">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="font-medium text-gray-800">Delivered</p>
                                <p class="text-gray-500 text-sm">October 12, 2023 at 3:20 PM</p>
                                <p class="text-gray-500 text-sm">Package left at front door</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Order Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Order Items</h2>
                        <div class="space-y-6">
                            @foreach ($order_items as $item)
                                <div class="flex items-start space-x-4 p-4 border border-gray-200 rounded-lg">

                                    @if ($item->variant_id == null)
                                        @foreach ($item->product->images as $image)
                                            @if ($image->is_primary == 1)
                                                <img src="{{ asset($image->image_url) }}"
                                                    alt="{{ $item->product->name }}"
                                                    class="w-20 h-20 object-cover rounded-lg">
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach ($item->variant->images as $image)
                                            @if ($image->is_primary == 1)
                                                <img src="{{ asset($image->image_url) }}"
                                                    alt="{{ $item->product->name }}"
                                                    class="w-20 h-20 object-cover rounded-lg">
                                            @endif
                                        @endforeach
                                    @endif

                                    <div class="flex-grow">
                                        <h3 class="font-semibold text-gray-800">{{ $item->product->name }}</h3>
                                        {{-- <p class="text-gray-600 text-sm">Wireless noise-cancelling headphones with 30-hour
                                            battery life</p> --}}
                                        <div class="flex items-center mt-2">
                                            @if ($item->variant_id != null)
                                                @foreach ($item->variant->attributes as $attrib)
                                                    <span class="text-gray-600 text-sm">{{ $attrib->attribute_name }} -
                                                        {{ $attrib->attribute_value }}</span>
                                                    <span class="mx-2 text-gray-400">•</span>
                                                @endforeach
                                            @endif
                                            <span class="text-gray-600 text-sm">Qty: {{ $item->quantity }}</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-gray-800">
                                            {{ Number::currency($item->price_at_time * $item->quantity, 'LKR') }}
                                        </p>
                                        <a href="/product/{{ $item->product->slug }}"
                                            class="text-indigo-600 hover:text-indigo-800 text-sm">View Product</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary & Details -->
                <div class="space-y-6">
                    <!-- Order Summary -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Summary</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span>{{ Number::currency($order->total_amount, 'LKR') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span>{{ Number::currency($order->delivery_fee, 'LKR') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Tax</span>
                                <span>{{ Number::currency(0, 'LKR') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Discount</span>
                                <span class="text-green-600">{{ Number::currency(0, 'LKR') }}</span>
                            </div>
                            <hr class="my-4">
                            <div class="flex justify-between font-bold text-gray-800 text-lg">
                                <span>Total</span>
                                <span>{{ Number::currency($order->total_amount, 'LKR') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Shipping Address</h3>
                        <div class="text-gray-600 space-y-1">
                            <p class="font-medium text-gray-800">{{ $address->full_name }}</p>
                            <p>{{ $address->street_address }}</p>
                            <p>{{ $address->city }}</p>
                            <p>{{ $address->state }}</p>
                            <p>{{ $address->zip }}</p>
                            <p class="mt-3 text-sm">Phone: {{ $address->phone }}</p>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    {{-- <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Payment Method</h3>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-6 bg-blue-600 rounded"></div>
                            <div>
                                <p class="text-gray-800">Visa ending in 1234</p>
                                <p class="text-gray-500 text-sm">Charged on October 10, 2023</p>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Shipping Method -->
                    {{-- <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Shipping Method</h3>
                        <div class="text-gray-600">
                            <p class="font-medium text-gray-800">Standard Shipping</p>
                            <p class="text-sm">5-7 business days</p>
                            <p class="text-sm mt-2">Tracking Number: UPS123456789</p>
                            <a href="/track/UPS123456789" class="text-indigo-600 hover:text-indigo-800 text-sm">Track
                                Package</a>
                        </div>
                    </div> --}}
                </div>
            </div>

            <!-- Action Buttons -->
            {{-- <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/track/UPS123456789"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300 text-center">
                    Track Shipment
                </a>
                <a href="/order/123456789/invoice"
                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300 text-center">
                    Download Invoice
                </a>
                <a href="/contact"
                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300 text-center">
                    Contact Support
                </a>
                <a href="/order/123456789/return"
                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300 text-center">
                    Return Items
                </a>
            </div> --}}
        </div>
    </div>

    <livewire:partials.footer />

</div>

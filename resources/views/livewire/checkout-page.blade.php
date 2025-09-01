<div>
    <livewire:partials.navigation />

    <!-- Checkout Section -->
    <div class="container mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Secure Checkout</h1>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Column: Shipping & Payment -->
            <div class="lg:w-2/3 bg-white p-6 rounded-lg shadow-lg">

                <form wire:submit.prevent="placeOrder">

                    <!-- Shipping Address -->
                    <section>
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 111.414-1.414L9 13.414V3h1c.553 0 1 .447 1 1v2h1a1 1 0 001-1V3a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 01-1 1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H5a1 1 0 00-1 1v4a1 1 0 001 1h1" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L6 12M6 12l-3 3m3-3l3-3" />
                            </svg>
                            Shipping Address
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="fullName" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" id="fullName" wire:model.defer="fullName" placeholder="John Doe"
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('fullName')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email
                                    Address</label>
                                <input type="email" id="email" wire:model.defer="email"
                                    placeholder="you@example.com"
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label for="address1" class="block text-sm font-medium text-gray-700">Address Line
                                    1</label>
                                <input type="text" id="address1" wire:model.defer="address1"
                                    placeholder="123 Main Street"
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('address1')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label for="address2" class="block text-sm font-medium text-gray-700">Address Line 2
                                    (Optional)</label>
                                <input type="text" id="address2" wire:model.defer="address2"
                                    placeholder="Apartment, Suite, Building (optional)"
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                <input type="text" id="city" wire:model.defer="city" placeholder="Colombo 01"
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('city')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="state" class="block text-sm font-medium text-gray-700">State /
                                    Province</label>
                                <input type="text" id="state" wire:model.defer="state" placeholder="Western"
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('state')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="zip" class="block text-sm font-medium text-gray-700">Zip / Postal
                                    Code</label>
                                <input type="text" id="zip" wire:model.defer="zip" placeholder="00100"
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('zip')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone
                                    Number</label>
                                <input type="tel" id="phone" wire:model.defer="phone"
                                    placeholder="(07#) 123-4567"
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('phone')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </section>

                    <!-- Payment Method -->
                    <section class="mt-8">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h10m-4-4v8m-4-4v4m-4-4v4M5 7h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2z" />
                            </svg>
                            Payment Method
                        </h2>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio" class="form-radio text-indigo-600 h-5 w-5"
                                        wire:model="paymentMethod" value="creditCard" checked>
                                    <span class="ml-3 text-gray-700 font-medium">Credit or Debit Card</span>
                                </label>
                            </div>
                            <div class="ml-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div class="sm:col-span-2">
                                    <label for="cardNumber" class="block text-sm font-medium text-gray-700">Card
                                        Number</label>
                                    <input type="text" id="cardNumber" wire:model.defer="cardNumber"
                                        placeholder="XXXX XXXX XXXX XXXX"
                                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @error('cardNumber')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="expiryDate"
                                        class="block text-sm font-medium text-gray-700">Expiry</label>
                                    <input type="text" id="expiryDate" wire:model.defer="expiryDate"
                                        placeholder="MM/YY"
                                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="cvv" class="block text-sm font-medium text-gray-700">CVV</label>
                                    <input type="text" id="cvv" wire:model.defer="cvv" placeholder="XXX"
                                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="cardName" class="block text-sm font-medium text-gray-700">Name on
                                        Card</label>
                                    <input type="text" id="cardName" wire:model.defer="cardName"
                                        placeholder="John Doe"
                                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio" class="form-radio text-indigo-600 h-5 w-5"
                                        wire:model="paymentMethod" value="paypal">
                                    <span class="ml-3 text-gray-700 font-medium flex items-center">
                                        PayPal
                                        <img src="https://img.icons8.com/color/48/000000/paypal.png" alt="PayPal Logo"
                                            class="h-5 w-auto ml-2">
                                    </span>
                                </label>
                            </div>
                        </div>
                    </section>

                    <!-- Checkout Button -->
                    <div class="mt-8">
                        <button type="submit"
                            class="w-full bg-indigo-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-indigo-700 transition duration-300 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6-2h8m-8-6h8m-8-6h8a2 2 0 012 2v10a2 2 0 01-2 2h-8a2 2 0 01-2-2v-10a2 2 0 012-2z" />
                            </svg>
                            Place Order Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Column: Order Summary -->
            <aside class="lg:w-1/3">
                <div class="bg-white p-6 rounded-lg shadow-lg sticky top-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2 flex items-center"> <svg
                            xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 11v1a2 2 0 01-2 2H4a2 2 0 01-2-2v-1l1-11z" />
                        </svg> Order Summary </h2>
                    <div class="space-y-4 mb-6">
                        @foreach ($cart_items as $item)
                            <div class="flex items-center"> <img src="{{ asset($item['image']) }}"
                                    alt="{{ $item['name'] }}"
                                    class="w-16 h-16 object-cover rounded mr-4 flex-shrink-0">
                                <div class="flex-grow">
                                    <h3 class="font-semibold text-gray-800">{{ $item['name'] }}</h3>
                                    <p class="text-gray-500 text-sm">Quantity: {{ $item['quantity'] }}</p>
                                </div> <span
                                    class="font-medium text-gray-800">{{ Number::currency($item['total_amount'], 'LKR') }}</span>
                            </div>
                        @endforeach
                    </div> <!-- Price Breakdown -->
                    <div class="border-t pt-4">
                        <div class="flex justify-between text-gray-600 mb-2"> <span>Subtotal</span>
                            <span>{{ Number::currency($grand_total, 'LKR') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600 mb-2"> <span>Shipping</span>
                            <span>{{ Number::currency(0, 'LKR') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600 mb-4"> <span>Estimated Taxes</span>
                            <span>{{ Number::currency(0, 'LKR') }}</span>
                        </div>
                        <div class="flex justify-between font-bold text-gray-800 text-xl mt-4 pt-4 border-t">
                            <span>Total</span> <span>{{ Number::currency($grand_total, 'LKR') }}</span>
                        </div>
                    </div> 
                    
                    <!-- Checkout Button --> 
                    {{-- <button
                        class="mt-8 w-full bg-indigo-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-indigo-700 transition duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6-2h8m-8-6h8m-8-6h8a2 2 0 012 2v10a2 2 0 01-2 2h-8a2 2 0 01-2-2v-10a2 2 0 012-2z" />
                        </svg> Place Order Now </button>
                    <p class="text-center text-xs text-gray-500 mt-4">By clicking "Place Order Now", you agree to our
                        <a href="/terms" class="text-indigo-600 hover:underline">Terms of Service</a> and <a
                            href="/privacy" class="text-indigo-600 hover:underline">Privacy Policy</a>.
                    </p> --}}
                </div>
            </aside>

            <!-- Right Column: Order Summary -->
            {{-- @include('partials.checkout-summary', ['cart_items' => $cart_items, 'grand_total' => $grand_total]) --}}
        </div>
    </div>

    <livewire:partials.footer />
</div>

<div>
    <livewire:partials.navigation />
    
    <!-- Order Success Section -->
    <div class="container mx-auto px-6 py-12">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Order Successful!</h1>
            <p class="text-gray-600 mb-8">Thank you for your purchase. Your order has been placed successfully.</p>
            <div class="bg-gray-100 p-6 rounded-lg mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Order Details</h2>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Order Number:</span>
                        <span class="font-medium text-gray-800">#123456789</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Date:</span>
                        <span class="font-medium text-gray-800">October 10, 2023</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Amount:</span>
                        <span class="font-medium text-gray-800">$760.16</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Payment Method:</span>
                        <span class="font-medium text-gray-800">Credit Card</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping Address:</span>
                        <span class="font-medium text-gray-800">123 Main Street, San Francisco, CA 94107</span>
                    </div>
                </div>
            </div>
            <p class="text-gray-600 mb-4">Your order will be shipped within 2-3 business days. You will receive a shipping confirmation email with tracking information once your order has been shipped.</p>
            <a href="/" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-300">Continue Shopping</a>
        </div>
    </div>

    <livewire:partials.footer />
</div>

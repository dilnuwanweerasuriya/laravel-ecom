<div>
    <livewire:partials.navigation />

    <livewire:shared.page-header :page="'Contact Us'" :heading="'Contact Us'" />

    <!-- Contact Content -->
    <div class="container mx-auto px-6 py-12">
        <div class="flex flex-col lg:flex-row">
            <!-- Contact Information -->
            <div class="w-full lg:w-1/3 mb-12 lg:mb-0">
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Contact Information</h2>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Address</h3>
                        <p class="text-gray-600">123 Main Street<br>New York, NY 10001<br>United States</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Phone</h3>
                        <p class="text-gray-600">+1 (555) 123-4567</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Email</h3>
                        <p class="text-gray-600">support@shopease.com</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Business Hours</h3>
                        <p class="text-gray-600">Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM<br>Sunday: Closed</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Follow Us</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-600 hover:text-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.073 0C18.646 0 24 5.354 24 11.987c0 6.573-5.354 11.927-11.927 11.927S.146 18.5.146 11.927C.146 5.354 5.5.146 12.073.146zm0 2.195c-5.373 0-9.732 4.359-9.732 9.732 0 5.373 4.359 9.732 9.732 9.732 5.373 0 9.732-4.359 9.732-9.732 0-5.373-4.359-9.732-9.732z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="w-full lg:w-2/3 lg:pl-12">
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Get In Touch</h2>
                    <p class="text-gray-600 mb-8">Have a question or need assistance? Fill out the form below and we'll get back to you as soon as possible.</p>

                    <form>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first-name" class="block text-gray-700 font-medium mb-2">First Name</label>
                                <input type="text" id="first-name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="last-name" class="block text-gray-700 font-medium mb-2">Last Name</label>
                                <input type="text" id="last-name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                            <input type="email" id="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div class="mt-6">
                            <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                            <input type="tel" id="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div class="mt-6">
                            <label for="subject" class="block text-gray-700 font-medium mb-2">Subject</label>
                            <select id="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option>Select a subject</option>
                                <option>General Inquiry</option>
                                <option>Product Information</option>
                                <option>Order Status</option>
                                <option>Technical Support</option>
                                <option>Feedback</option>
                            </select>
                        </div>

                        <div class="mt-6">
                            <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                            <textarea id="message" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                        </div>

                        <div class="mt-8">
                            <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 transition duration-300">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-800 mb-8">Frequently Asked Questions</h2>
            <div class="bg-white rounded-lg shadow-md">
                <!-- FAQ Item 1 -->
                <div class="border-b border-gray-200">
                    <button class="w-full flex justify-between items-center py-4 px-6 text-left">
                        <span class="text-gray-800 font-medium">How do I track my order?</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="px-6 pb-4">
                        <p class="text-gray-600">Once your order has shipped, you will receive an email with tracking information. You can also track your order by logging into your account and viewing your order history.</p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="border-b border-gray-200">
                    <button class="w-full flex justify-between items-center py-4 px-6 text-left">
                        <span class="text-gray-800 font-medium">What is your return policy?</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="px-6 pb-4">
                        <p class="text-gray-600">We offer a 30-day return policy on most items. Products must be in their original condition and packaging. Some items may have different return policies, so please check the product page for details.</p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="border-b border-gray-200">
                    <button class="w-full flex justify-between items-center py-4 px-6 text-left">
                        <span class="text-gray-800 font-medium">How long does shipping take?</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="px-6 pb-4">
                        <p class="text-gray-600">Standard shipping typically takes 3-5 business days. Expedited shipping options are available at checkout. Shipping times may vary during peak seasons.</p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="border-b border-gray-200">
                    <button class="w-full flex justify-between items-center py-4 px-6 text-left">
                        <span class="text-gray-800 font-medium">Do you offer international shipping?</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="px-6 pb-4">
                        <p class="text-gray-600">Currently, we only ship within the United States. We're working on expanding our shipping options and hope to offer international shipping in the future.</p>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div>
                    <button class="w-full flex justify-between items-center py-4 px-6 text-left">
                        <span class="text-gray-800 font-medium">How can I contact customer service?</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="px-6 pb-4">
                        <p class="text-gray-600">You can contact our customer service team by phone at +1 (555) 123-4567, by email at support@shopease.com, or by using the contact form on this page. Our team is available Monday through Friday from 9:00 AM to 6:00 PM EST.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <livewire:shared.newsletter />

    <livewire:partials.footer />
</div>

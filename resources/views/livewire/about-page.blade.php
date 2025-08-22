<div>
    <livewire:partials.navigation />

    <livewire:shared.page-header :page="'About Us'" :heading="'About ShopEase'" />

    <!-- About Us Content -->
    <div class="container mx-auto px-6 py-12">
        <!-- Our Story Section -->
        <div class="mb-16">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Story</h2>
                    <p class="text-gray-600 mb-4">Founded in 2015, ShopEase began as a small family business with a big dream: to make high-quality products accessible to everyone. What started in a garage with just a handful of products has grown into a trusted online retailer serving thousands of customers worldwide.</p>
                    <p class="text-gray-600 mb-4">Our journey has been guided by a simple philosophy - put the customer first in everything we do. From carefully selecting our products to providing exceptional customer service, we strive to create a shopping experience that's enjoyable, convenient, and reliable.</p>
                    <p class="text-gray-600">Today, ShopEase is proud to be recognized as a leader in e-commerce, known for our commitment to quality, value, and customer satisfaction.</p>
                </div>
                <div class="md:w-1/2">
                    <img src="https://images.unsplash.com/photo-1522542550221-31fd19575a2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Our Story" class="rounded-lg shadow-xl">
                </div>
            </div>
        </div>

        <!-- Our Mission Section -->
        <div class="mb-16 bg-indigo-50 rounded-lg p-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <img src="https://images.unsplash.com/photo-1522202176988-68f71f787ddf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Our Mission" class="rounded-lg shadow-xl">
                </div>
                <div class="md:w-1/2 md:pl-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Mission</h2>
                    <p class="text-gray-600 mb-4">At ShopEase, our mission is to provide customers with an exceptional shopping experience by offering high-quality products at competitive prices, backed by outstanding customer service.</p>
                    <p class="text-gray-600 mb-4">We believe in:</p>
                    <ul class="list-disc pl-6 mb-4 text-gray-600">
                        <li>Curating products that meet our high standards for quality and value</li>
                        <li>Creating a seamless and enjoyable shopping experience</li>
                        <li>Building lasting relationships with our customers</li>
                        <li>Continuously improving and innovating our offerings</li>
                        <li>Operating with integrity and transparency</li>
                    </ul>
                    <p class="text-gray-600">We're committed to making your shopping experience as easy and pleasant as possible, because we believe that happy customers are the foundation of our success.</p>
                </div>
            </div>
        </div>

        <!-- Our Team Section -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">Meet Our Team</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <!-- Team Member 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden text-center">
                    <img src="https://images.unsplash.com/photo-1560250097-0b92475a284f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Team Member" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-1">Sarah Johnson</h3>
                        <p class="text-indigo-600 mb-4">CEO & Founder</p>
                        <p class="text-gray-600">Sarah brings over 15 years of retail experience to ShopEase. Her vision and leadership have been instrumental in growing the company from a small startup to the successful business it is today.</p>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden text-center">
                    <img src="https://images.unsplash.com/photo-1560250097-0b92475a284f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Team Member" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-1">Michael Chen</h3>
                        <p class="text-indigo-600 mb-4">Operations Manager</p>
                        <p class="text-gray-600">Michael oversees all aspects of our operations, ensuring that our customers receive their orders quickly and efficiently. His expertise in logistics has helped us build a reputation for fast, reliable shipping.</p>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden text-center">
                    <img src="https://images.unsplash.com/photo-1560250097-0b92475a284f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Team Member" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-1">Emily Rodriguez</h3>
                        <p class="text-indigo-600 mb-4">Customer Service Director</p>
                        <p class="text-gray-600">Emily leads our customer service team, ensuring that every ShopEase customer has a positive experience. Her dedication to customer satisfaction has helped us maintain our excellent reputation.</p>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden text-center">
                    <img src="https://images.unsplash.com/photo-1560250097-0b92475a284f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Team Member" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-1">David Kim</h3>
                        <p class="text-indigo-600 mb-4">Product Specialist</p>
                        <p class="text-gray-600">David is responsible for selecting the high-quality products we offer. His keen eye for quality and value ensures that our customers always get products that meet our high standards.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials Section -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">What Our Customers Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">"ShopEase has become my go-to for all my shopping needs. The quality of their products is consistently excellent, and their customer service is top-notch. I've recommended them to all my friends!"</p>
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1560250097-0b92475a284f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Customer" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-gray-800">Jessica M.</h4>
                            <p class="text-sm text-gray-500">Verified Customer</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">"I was hesitant to shop online for electronics, but ShopEase made it so easy. Their product descriptions are accurate, shipping was fast, and when I had a question, their customer service was quick to respond and very helpful."</p>
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1560250097-0b92475a284f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Customer" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-gray-800">Robert T.</h4>
                            <p class="text-sm text-gray-500">Verified Customer</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">"The prices at ShopEase are unbeatable. I've compared their products with other retailers, and they consistently offer better value. Plus, their website is so easy to navigate - I can always find what I'm looking for quickly."</p>
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1560250097-0b92475a284f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Customer" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-gray-800">Lisa K.</h4>
                            <p class="text-sm text-gray-500">Verified Customer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Values Section -->
        <div class="bg-gray-100 rounded-lg p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">Our Values</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Value 1 -->
                <div class="text-center">
                    <div class="bg-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.654 0 3-4.03 3-9s-1.346-9-3-9-3 4.03-3 9 1.346 9 3 9zm0 2c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.654 0-3 2.315-3 5s1.346 5 3 5 3-2.315 3-5-1.346-5-3-5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Quality</h3>
                    <p class="text-gray-600">We carefully select each product to ensure it meets our high standards for quality and value.</p>
                </div>

                <!-- Value 2 -->
                <div class="text-center">
                    <div class="bg-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Security</h3>
                    <p class="text-gray-600">Your security is our priority. We use the latest encryption technology to protect your information.</p>
                </div>

                <!-- Value 3 -->
                <div class="text-center">
                    <div class="bg-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Fast Shipping</h3>
                    <p class="text-gray-600">We know you want your products quickly. That's why we offer fast, reliable shipping options.</p>
                </div>

                <!-- Value 4 -->
                <div class="text-center">
                    <div class="bg-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.418v3.818a1 1 0 0 1-1.447.894l-2.722-1.106a1 1 0 0 0-1.156 0l-2.723 1.106A1 1 0 0 1 3.994 15.818V11.994a1 1 0 0 1 .994-.994c.542-.104.994-.54.994-1.418 0-1.343-1.278-2.575-3.006-2.907C5.198 8.54 6.679 8 8.228 9z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Customer Service</h3>
                    <p class="text-gray-600">Our dedicated customer service team is always ready to assist you with any questions or concerns.</p>
                </div>
            </div>
        </div>
    </div>

    <livewire:shared.newsletter />

    <livewire:partials.footer />
</div>

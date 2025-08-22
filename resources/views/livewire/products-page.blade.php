<div>
    <livewire:partials.navigation />

    <livewire:shared.page-header :page="'Products'" :heading="'All Products'" />

    <div class="container mx-auto px-6 py-12">
        <div class="flex flex-col lg:flex-row">
            <!-- Sidebar Filters -->
            <div class="w-full lg:w-1/4 pr-0 lg:pr-8 mb-8 lg:mb-0">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Filters</h3>

                    <!-- Category Filter -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold text-gray-700 mb-4">Categories</h4>
                        <div class="space-y-2">
                            @foreach ($categories as $category)
                                <div class="flex items-center" wire:key='{{ $category->id }}'>
                                    <input type="checkbox" wire:model.live="selected_categories"
                                        id="category-{{ $category->slug }}"
                                        class="h-4 w-4 rounded text-indigo-600 focus:ring-indigo-500"
                                        value="{{ $category->id }}">
                                    <label for="category-{{ $category->slug }}"
                                        class="ml-2 text-gray-700">{{ $category->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Brand Filter -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold text-gray-700 mb-4">Brands</h4>
                        <div class="space-y-2">
                            @foreach ($brands as $brand)
                                <div class="flex items-center" wire:key='{{ $brand->id }}'>
                                    <input type="checkbox" wire:model.live="selected_brands"
                                        id="brand-{{ $brand->slug }}"
                                        class="h-4 w-4 rounded text-indigo-600 focus:ring-indigo-500"
                                        value="{{ $brand->id }}">
                                    <label for="brand-{{ $brand->slug }}"
                                        class="ml-2 text-gray-700">{{ $brand->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Filter -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold text-gray-700 mb-4">Price Range</h4>
                        <div class="flex items-center space-x-2 mb-4">
                            <input type="number" placeholder="Min" wire:model.live="price_start"
                                class="w-1/2 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <span class="text-gray-500">to</span>
                            <input type="number" placeholder="Max" wire:model.live="price_end"
                                class="w-1/2 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        {{-- <button
                            class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition duration-300">Apply</button> --}}
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="w-full lg:w-3/4">
                <!-- Sorting and View Options -->
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <span class="text-gray-700 mr-2">Sort by:</span>
                            <select wire:model.live='sort' name="" id=""
                                class="px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="latest">Latest</option>
                                <option value="price">Price</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-700">Showing 1-12 of 48 products</span>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($products as $product)
                        <div
                            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                            <div class="relative">
                                @foreach ($product->images as $image)
                                    @if ($image->is_primary == 1)
                                        <img src="{{ asset($image->image_url) }}" alt="Product 1"
                                            class="w-full h-64 object-cover">
                                    @endif
                                @endforeach
                                {{-- <span
                                    class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">Sale</span> --}}
                                <div class="absolute top-2 left-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 text-gray-400 hover:text-red-500 cursor-pointer" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm mt-2">Wireless noise-cancelling headphones with 30-hour
                                    battery life</p>
                                <div class="flex items-center mt-2">
                                    <div class="flex text-yellow-400">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                        </svg>
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                        </svg>
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                        </svg>
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                        </svg>
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 text-sm ml-2">(4.5)</span>
                                </div>
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        @if ($product->has_variants)
                                            @php
                                                $minPrice = $product->variants->min('price');
                                                $maxPrice = $product->variants->max('price');
                                            @endphp
                                            <span class="text-lg font-bold text-gray-800">
                                                LKR {{ number_format($minPrice, 2) }}
                                                @if ($minPrice != $maxPrice)
                                                    - LKR {{ number_format($maxPrice, 2) }}
                                                @endif
                                            </span>
                                        @else
                                            <span class="text-lg font-bold text-gray-800">
                                                LKR {{ number_format($product->price, 2) }}
                                            </span>
                                        @endif
                                        {{-- <span class="text-sm text-gray-500 line-through">$199.99</span> --}}
                                    </div>
                                    @if ($product->has_variants)
                                        <a href=""
                                            class="bg-indigo-600 text-white text-center px-3 py-1 rounded text-sm hover:bg-indigo-700 cursor-pointer">
                                            Select Options
                                        </a>
                                    @else
                                        <button
                                            class="bg-indigo-600 text-white px-3 py-1 rounded text-sm hover:bg-indigo-700 cursor-pointer">
                                            Add to Cart
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    <nav class="flex items-center space-x-1">
                        <a href="#"
                            class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-indigo-600 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#"
                            class="px-3 py-1 rounded border border-indigo-600 bg-indigo-600 text-white">1</a>
                        <a href="#"
                            class="px-3 py-1 rounded border border-gray-300 hover:bg-indigo-600 hover:text-white">2</a>
                        <a href="#"
                            class="px-3 py-1 rounded border border-gray-300 hover:bg-indigo-600 hover:text-white">3</a>
                        <a href="#"
                            class="px-3 py-1 rounded border border-gray-300 hover:bg-indigo-600 hover:text-white">4</a>
                        <a href="#"
                            class="px-3 py-1 rounded border border-gray-300 hover:bg-indigo-600 hover:text-white">5</a>
                        <a href="#"
                            class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-indigo-600 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 3.293a1 1 0 01-1.414 1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L13 10.414l-3.293 3.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <livewire:shared.newsletter />

    <livewire:partials.footer />
</div>

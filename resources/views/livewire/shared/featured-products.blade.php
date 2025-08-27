<div class="container mx-auto px-6 py-12">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Featured Products</h2>
        <a href="products?sort=featured" class="text-indigo-600 hover:text-indigo-800">View All</a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach ($featured as $item)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                <div class="relative">
                    @foreach ($item->images as $image)
                        @if ($image->is_primary == 1)
                            <a href="/products/{{ $item->slug }}">
                                <img src="{{ asset($image->image_url) }}" alt="{{ $item->name }}"
                                    class="w-full h-64 object-cover">
                            </a>
                        @endif
                    @endforeach
                    {{-- <span class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">Sale</span> --}}
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
                    <h3 class="font-semibold text-gray-800">{{ $item->name }}</h3>
                    <p class="text-gray-600 text-sm mt-2">{{ $item->short_description }}</p>
                    @if ($item->reviews)
                        <div class="flex items-center mt-2">
                            @php
                                $avgRating = $item->reviews->where('is_approved', 1)->avg('rating') ?? 0;
                                $fullStars = floor($avgRating);
                                $halfStar = $avgRating - $fullStars >= 0.5 ? 1 : 0;
                                $emptyStars = 5 - ($fullStars + $halfStar);
                            @endphp

                            <div class="flex text-yellow-400">
                                {{-- Full Stars --}}
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                @endfor

                                {{-- Half Star --}}
                                @if ($halfStar)
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <defs>
                                            <linearGradient id="half">
                                                <stop offset="50%" stop-color="currentColor" />
                                                <stop offset="50%" stop-color="transparent" />
                                            </linearGradient>
                                        </defs>
                                        <path fill="url(#half)"
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                @endif

                                {{-- Empty Stars --}}
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <svg class="w-4 h-4 text-gray-300" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                @endfor
                            </div>

                            <span class="text-gray-600 text-sm ml-2">({{ number_format($avgRating, 1) }})</span>
                        </div>
                    @endif
                    <div class="mt-4 flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            @if ($item->has_variants)
                                @php
                                    $minPrice = $item->variants->min('price');
                                    $maxPrice = $item->variants->max('price');
                                @endphp
                                <span class="text-lg font-bold text-gray-800">
                                    LKR {{ number_format($minPrice, 2) }}
                                    @if ($minPrice != $maxPrice)
                                        - LKR {{ number_format($maxPrice, 2) }}
                                    @endif
                                </span>
                            @else
                                <span class="text-lg font-bold text-gray-800">
                                    LKR {{ number_format($item->price, 2) }}
                                </span>
                            @endif
                            {{-- <span class="text-sm text-gray-500 line-through">$199.99</span> --}}
                        </div>
                        <button class="bg-indigo-600 text-white px-3 py-1 rounded text-sm hover:bg-indigo-700">Add to
                            Cart</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

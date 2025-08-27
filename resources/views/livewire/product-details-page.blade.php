<div>
    <livewire:partials.navigation />

    <div class="container mx-auto px-6 py-4">
        <nav class="text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a class="hover:text-indigo-600" href="/products">Product</a></li>
                <li>/</li>
                <li>
                    <a class="hover:text-indigo-600"
                        href="/products?selected_categories[0]={{ $product->category_id }}">{{ $product->category->name }}</a>
                </li>
                <li>/</li>
                <li aria-current="page" class="text-gray-800 font-medium">
                    {{ $product->name }}
                </li>
            </ol>
        </nav>
    </div>

    <!-- Product Detail -->
    <main class="container mx-auto px-6 py-8">
        <div class="grid lg:grid-cols-2 gap-10">
            <!-- Gallery -->
            <section class="lg:sticky lg:top-24">
                {{-- Main Image --}}
                <div
                    class="relative bg-white border border-gray-200 rounded-lg overflow-hidden aspect-square flex items-center justify-center">
                    <img src="{{ asset($selectedImage) }}" alt="{{ $product->name }}"
                        class="object-contain w-full h-full" />
                </div>

                {{-- Thumbnails --}}
                <div class="mt-4 grid grid-cols-4 gap-3">
                    {{-- Main product images --}}
                    @foreach ($product->images as $image)
                        <button wire:click="$set('selectedImage','{{ $image->image_url }}')"
                            class="relative bg-white border border-gray-200 rounded-lg overflow-hidden aspect-square
                    {{ $selectedImage === $image->image_url ? 'ring-2 ring-indigo-600' : '' }}">
                            <img src="{{ asset($image->image_url) }}" alt="{{ $product->name }}"
                                class="object-cover w-full h-full" />
                        </button>
                    @endforeach

                    {{-- Variant images --}}
                    @foreach ($product->variants as $variant)
                        @foreach ($variant->images as $image)
                            <button wire:click="$set('selectedImage','{{ $image->image_url }}')"
                                class="relative bg-white border border-gray-200 rounded-lg overflow-hidden aspect-square
                        {{ $selectedImage === $image->image_url ? 'ring-2 ring-indigo-600' : '' }}">
                                <img src="{{ asset($image->image_url) }}" alt="{{ $product->name }}"
                                    class="object-cover w-full h-full" />
                            </button>
                        @endforeach
                    @endforeach
                </div>
            </section>

            <!-- Details -->
            <section>
                <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>

                <div class="mt-2 flex items-center flex-wrap gap-3">
                    {{-- <div class="flex text-yellow-400">
                        <svg class="w-4 h-4 fill-current">
                            <path
                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                        </svg>
                        <svg class="w-4 h-4 fill-current">
                            <path
                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                        </svg>
                        <svg class="w-4 h-4 fill-current">
                            <path
                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                        </svg>
                        <svg class="w-4 h-4 fill-current">
                            <path
                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                        </svg>
                        <svg class="w-4 h-4 text-gray-300 fill-current">
                            <path
                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                        </svg>
                    </div>
                    <a href="#reviews" class="text-gray-600 text-sm hover:text-indigo-600">(1,234 reviews)</a> --}}

                    @if ($product->reviews)
                        @php
                            $avgRating = $product->reviews->where('is_approved', 1)->avg('rating') ?? 0;
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

                        <span
                            class="text-gray-600 text-sm hover:text-indigo-600">({{ number_format($avgRating, 1) }})</span>
                    @endif

                    <span class="text-gray-300">|</span>
                    <span class="text-sm text-green-600 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        In stock
                    </span>

                    @if ($product->has_variants != 1)
                        <span class="text-gray-300">|</span>
                        <span class="text-sm text-gray-500">SKU: {{ $product->sku }}</span>
                    @endif
                </div>

                <div class="mt-4 flex items-end gap-3">
                    {{-- <div class="text-3xl font-bold text-gray-800">LKR {{ number_format($product->price, 2) }}</div> --}}

                    @if ($product->has_variants)
                        @php
                            $minPrice = $product->variants->min('price');
                            $maxPrice = $product->variants->max('price');
                        @endphp
                        <span class="text-3xl font-bold text-gray-800">
                            LKR {{ number_format($minPrice, 2) }}
                            @if ($minPrice != $maxPrice)
                                - LKR {{ number_format($maxPrice, 2) }}
                            @endif
                        </span>
                    @else
                        <span class="text-3xl font-bold text-gray-800">
                            LKR {{ number_format($product->price, 2) }}
                        </span>
                    @endif
                    {{-- <div class="text-gray-500 line-through">$199.99</div>
                    <span class="text-xs font-semibold text-green-700 bg-green-100 px-2 py-1 rounded">Save 10%</span> --}}
                </div>

                <p class="mt-4 text-gray-600">
                    {{ $product->short_description }}
                </p>

                <!-- Perks -->
                {{-- <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-3 text-sm">
                    <div class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h.01M3 6h18M7 21h.01" />
                        </svg>
                        Free shipping over $50
                    </div>
                    <div class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4h4" />
                        </svg>
                        30‑day returns
                    </div>
                    <div class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        1‑year warranty
                    </div>
                </div> --}}

                <!-- Options -->
                <div class="mt-6 space-y-6">
                    @php
                        // Collect unique attributes
                        $attributesGrouped = [];
                        foreach ($product->variants as $variant) {
                            foreach ($variant->attributes as $attribute) {
                                $name = $attribute->attribute_name;
                                $value = $attribute->attribute_value;
                                $attributesGrouped[$name][$value] = $value; // unique values only
                            }
                        }
                    @endphp

                    @foreach ($attributesGrouped as $name => $values)
                        @if (strtolower($name) === 'color')
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label class="font-medium text-gray-800">{{ $name }}</label>
                                    <span
                                        class="text-sm text-gray-500">{{ $selectedAttributes['color'] ?? 'None selected' }}</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    @foreach ($values as $color)
                                        <button type="button"
                                            wire:click="selectAttribute('color','{{ $color }}')"
                                            class="w-9 h-9 rounded-full border border-gray-300 {{ tailwindColor($color) }}
                        ring-offset-2 hover:ring-2 hover:ring-indigo-300
                        {{ isset($selectedAttributes['color']) && $selectedAttributes['color'] === $color ? 'ring-2 ring-indigo-600' : '' }}">
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div>
                                <label class="block font-medium text-gray-800 mb-2">{{ $name }}</label>
                                <div class="grid grid-cols-2 sm:flex gap-3">
                                    @foreach ($values as $value)
                                        <button type="button"
                                            wire:click="selectAttribute('{{ $name }}','{{ $value }}')"
                                            class="px-4 py-2 rounded-lg border border-gray-300 hover:border-indigo-400 hover:text-indigo-700
                        {{ isset($selectedAttributes[strtolower($name)]) && $selectedAttributes[strtolower($name)] === $value ? 'bg-indigo-100' : '' }}">
                                            {{ $value }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <!-- Quantity -->
                    <div>
                        <label class="block font-medium text-gray-800 mb-2">Quantity</label>
                        <div class="inline-flex items-center border border-gray-300 rounded-lg overflow-hidden">
                            <button id="decrement" type="button" class="w-10 h-10 text-gray-600 hover:bg-gray-100">
                                −
                            </button>
                            <input id="quantity" type="number" inputmode="numeric" min="1" value="1"
                                class="w-12 h-10 text-center focus:outline-none" />
                            <button id="increment" type="button" class="w-10 h-10 text-gray-600 hover:bg-gray-100">
                                +
                            </button>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button id="addToCart"
                            class="flex-1 bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
                            Add to Cart
                        </button>
                        <button
                            class="flex-1 bg-white border border-indigo-600 text-indigo-600 px-6 py-3 rounded-lg hover:bg-indigo-50 transition">
                            Buy Now
                        </button>
                    </div>

                    <!-- Secure + Payments -->
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Secure checkout
                        </div>
                        <div class="flex items-center space-x-2">
                            <img src="https://via.placeholder.com/40x25/6B7280/ffffff?text=VISA" alt="Visa"
                                class="h-5" />
                            <img src="https://via.placeholder.com/40x25/6B7280/ffffff?text=MC" alt="Mastercard"
                                class="h-5" />
                            <img src="https://via.placeholder.com/40x25/6B7280/ffffff?text=AMEX"
                                alt="American Express" class="h-5" />
                            <img src="https://via.placeholder.com/40x25/6B7280/ffffff?text=PP" alt="PayPal"
                                class="h-5" />
                        </div>
                    </div>
                </div>

                <!-- Accordion: Details -->
                <div class="mt-8 space-y-4">
                    <details class="bg-white rounded-lg border border-gray-200 p-4" open>
                        <summary class="cursor-pointer font-semibold text-gray-800">
                            Product Description
                        </summary>
                        <div class="mt-3 text-gray-600 leading-relaxed">
                            {!! $product->description !!}
                        </div>
                    </details>

                    {{-- <details class="bg-white rounded-lg border border-gray-200 p-4">
                        <summary class="cursor-pointer font-semibold text-gray-800">
                            Specifications
                        </summary>
                        <div class="mt-3">
                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-3 text-sm">
                                <div class="flex justify-between border-b border-gray-100 pb-2">
                                    <dt class="text-gray-500">Driver size</dt>
                                    <dd class="text-gray-800 font-medium">40 mm</dd>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-2">
                                    <dt class="text-gray-500">Battery life</dt>
                                    <dd class="text-gray-800 font-medium">Up to 30 hrs</dd>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-2">
                                    <dt class="text-gray-500">Charging</dt>
                                    <dd class="text-gray-800 font-medium">USB‑C, 2 hrs full</dd>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-2">
                                    <dt class="text-gray-500">Weight</dt>
                                    <dd class="text-gray-800 font-medium">250 g</dd>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-2">
                                    <dt class="text-gray-500">Codecs</dt>
                                    <dd class="text-gray-800 font-medium">SBC, AAC, aptX</dd>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-2">
                                    <dt class="text-gray-500">Warranty</dt>
                                    <dd class="text-gray-800 font-medium">12 months</dd>
                                </div>
                            </dl>
                        </div>
                    </details>

                    <details class="bg-white rounded-lg border border-gray-200 p-4">
                        <summary class="cursor-pointer font-semibold text-gray-800">
                            Shipping & Returns
                        </summary>
                        <div class="mt-3 text-gray-600 text-sm">
                            <p>
                                Free standard shipping on orders over $50. Expedited options
                                available at checkout. 30‑day hassle‑free returns. Return
                                shipping is free for defective items.
                            </p>
                        </div>
                    </details> --}}
                </div>
            </section>
        </div>

        <!-- Highlights / What's in the box -->
        {{-- <section class="mt-12 grid md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Highlights</h3>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex">
                        <span class="text-indigo-600 mr-2">•</span>Active Noise Cancelling
                        (ANC)
                    </li>
                    <li class="flex">
                        <span class="text-indigo-600 mr-2">•</span>30‑hour battery + quick
                        charge
                    </li>
                    <li class="flex">
                        <span class="text-indigo-600 mr-2">•</span>Bluetooth 5.2 with
                        multi‑point
                    </li>
                    <li class="flex">
                        <span class="text-indigo-600 mr-2">•</span>Comfort fit memory foam
                        cushions
                    </li>
                    <li class="flex">
                        <span class="text-indigo-600 mr-2">•</span>Foldable, travel‑ready
                        design
                    </li>
                </ul>
            </div>
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">
                    What's in the box
                </h3>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex">
                        <span class="text-indigo-600 mr-2">•</span>Premium Headphones
                    </li>
                    <li class="flex">
                        <span class="text-indigo-600 mr-2">•</span>USB‑C charging cable
                    </li>
                    <li class="flex">
                        <span class="text-indigo-600 mr-2">•</span>3.5mm audio cable
                    </li>
                    <li class="flex">
                        <span class="text-indigo-600 mr-2">•</span>Quick start guide
                    </li>
                    <li class="flex">
                        <span class="text-indigo-600 mr-2">•</span>Carry case (select
                        bundles)
                    </li>
                </ul>
            </div>
        </section> --}}

        <!-- Reviews -->
        <section id="reviews" class="mt-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Customer Reviews</h2>
                <button
                    class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:border-indigo-400 hover:text-indigo-700">
                    Write a review
                </button>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Summary -->
                    @php
                        $approvedReviews = $product->reviews->where('is_approved', 1);
                        $avgRating = $approvedReviews->avg('rating') ?? 0;
                        $reviewCount = $approvedReviews->count();

                        $fullStars = floor($avgRating);
                        $halfStar = $avgRating - $fullStars >= 0.5 ? 1 : 0;
                        $emptyStars = 5 - ($fullStars + $halfStar);

                        // Histogram data
                        $starCounts = [
                            5 => $approvedReviews->where('rating', 5)->count(),
                            4 => $approvedReviews->where('rating', 4)->count(),
                            3 => $approvedReviews->where('rating', 3)->count(),
                            2 => $approvedReviews->where('rating', 2)->count(),
                            1 => $approvedReviews->where('rating', 1)->count(),
                        ];
                    @endphp

                    <div class="md:w-1/3">
                        <div class="text-5xl font-extrabold text-gray-800">{{ number_format($avgRating, 1) }}</div>
                        <div class="mt-1 flex text-yellow-400">
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
                        <div class="text-gray-500 mt-1">Based on {{ $reviewCount }} reviews</div>
                    </div>

                    <!-- Histogram -->
                    <div class="md:flex-1">
                        <ul class="space-y-2 text-sm">
                            @foreach ([5, 4, 3, 2, 1] as $star)
                                @php
                                    $count = $starCounts[$star];
                                    $percentage = $reviewCount > 0 ? round(($count / $reviewCount) * 100) : 0;
                                    $color = match ($star) {
                                        5 => 'bg-green-500',
                                        4 => 'bg-green-400',
                                        3 => 'bg-yellow-400',
                                        2 => 'bg-orange-400',
                                        1 => 'bg-red-500',
                                    };
                                @endphp
                                <li class="flex items-center gap-3">
                                    <span class="w-10 text-gray-600">{{ $star }}★</span>
                                    <div class="flex-1 h-2 rounded bg-gray-200 overflow-hidden">
                                        <div class="h-2 {{ $color }}" style="width: {{ $percentage }}%">
                                        </div>
                                    </div>
                                    <span class="w-12 text-right text-gray-600">{{ $percentage }}%</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Review list -->
                <div class="mt-8">
                    <div class="flex items-center justify-between mb-4">
                        <div class="text-gray-700 text-sm">
                            Showing {{ $reviews->count() }} of {{ $reviewCount }} reviews
                        </div>
                        <select wire:model.live='sort'
                            class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="recent">Most recent</option>
                            <option value="highest_rating">Highest rating</option>
                            <option value="lowest_rating">Lowest rating</option>
                        </select>
                    </div>

                    <div class="space-y-6">
                        @foreach ($reviews as $review)
                            <article class="border-t border-gray-100 pt-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-semibold">
                                            {{ strtoupper(substr($review->user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-800">{{ $review->user->name }}</div>
                                            <div class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($review->created_at)->format('M d, Y') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex text-yellow-400">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg
                                                class="w-4 h-4 fill-current {{ $i <= $review->rating ? '' : 'text-gray-300' }}">
                                                <path
                                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <h4 class="mt-3 font-semibold text-gray-800">
                                    {{ $review->title }}
                                </h4>
                                <p class="mt-2 text-gray-700">
                                    {{ $review->comment }}
                                </p>
                                {{-- <div class="mt-3 text-xs text-gray-500 flex items-center gap-4">
                        <button class="hover:text-indigo-600">Helpful ({{ $review->helpful_count }})</button>
                        <button class="hover:text-indigo-600">Report</button>
                    </div> --}}
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>

        </section>

        <!-- Related Products -->
        <section class="mt-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">You May Also Like</h2>
                <a href="/products?selected_categories[0]={{ $product->category_id }}" class="text-indigo-600 hover:text-indigo-800">View All</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @if ($related_products->isNotEmpty())
                    @foreach ($related_products as $related)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            @foreach ($related->images as $image)
                                @if ($image->is_primary == 1)
                                    <img src="{{ asset($image->image_url) }}" alt="{{ $related->name }}"
                                        class="w-full h-56 object-cover" />
                                @endif
                            @endforeach
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800">{{ $related->name }}</h3>
                                <div class="mt-2 flex items-center justify-between">
                                    @if ($related->has_variants)
                                        @php
                                            $minPrice = $related->variants->min('price');
                                            $maxPrice = $related->variants->max('price');
                                        @endphp
                                        <span class="text-lg font-bold text-gray-800">
                                            LKR {{ number_format($minPrice, 2) }}
                                            @if ($minPrice != $maxPrice)
                                                - LKR {{ number_format($maxPrice, 2) }}
                                            @endif
                                        </span>
                                    @else
                                        <span class="text-lg font-bold text-gray-800">
                                            LKR {{ number_format($related->price, 2) }}
                                        </span>
                                    @endif
                                    <a href="/products/{{ $related->slug }}"
                                        class="text-sm bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>There are no products</p>
                @endif
            </div>
        </section>
    </main>

    <!-- Mobile Sticky Add to Cart -->
    <div class="md:hidden fixed bottom-0 inset-x-0 bg-white border-t border-gray-200 p-3">
        <div class="container mx-auto px-3 flex items-center justify-between">
            <div>
                <div class="text-xs text-gray-500">Total</div>
                <div class="text-lg font-bold text-gray-800">$179.99</div>
            </div>
            <button id="mobileAddToCart" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">
                Add to Cart
            </button>
        </div>
    </div>

    <!-- Toast -->
    <div id="toast"
        class="hidden fixed top-5 right-5 bg-gray-900 text-white text-sm px-4 py-3 rounded-lg shadow-lg z-50">
        Added to cart
    </div>

    <livewire:partials.footer />
</div>

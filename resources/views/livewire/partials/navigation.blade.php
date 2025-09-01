<nav class="bg-white shadow-lg">
    <div class="container mx-auto px-6 py-3">
        <div class="flex items-center justify-between">
            <!-- Left: Brand + Desktop links -->
            <div class="flex items-center">
                <a href="/" class="text-2xl font-bold text-indigo-600">ShopEase</a>

                <!-- Desktop links -->
                <div class="hidden md:flex ml-10 space-x-8">
                    <a href="/" class="text-gray-700 wire:navigate {{ request()->is('/') ? 'text-indigo-600' : 'text-gray-500' }} hover:text-indigo-600">Home</a>
                    <a href="/products" class="text-gray-700 wire:navigate {{ request()->is('products') ? 'text-indigo-600' : 'text-gray-500' }} hover:text-indigo-600">Products</a>
                    {{-- <a href="/categories" class="text-gray-700 wire:navigate {{ request()->is('categories') ? 'text-indigo-600' : 'text-gray-500' }} hover:text-indigo-600">Categories</a> --}}
                    <a href="/about" class="text-gray-700 wire:navigate {{ request()->is('about') ? 'text-indigo-600' : 'text-gray-500' }} hover:text-indigo-600">About</a>
                    <a href="/contact" class="text-gray-700 wire:navigate {{ request()->is('contact') ? 'text-indigo-600' : 'text-gray-500' }} hover:text-indigo-600">Contact</a>
                </div>
            </div>

            <!-- Right: Search + Cart + Account/Login + Mobile toggle -->
            <div class="flex items-center space-x-4">
                <!-- Search (desktop) -->
                <form action="/products" method="GET" class="hidden md:flex">
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Search products..."
                        class="px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-lg hover:bg-indigo-700" aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </form>

                <!-- Cart -->
                <a href="/cart" class="relative" aria-label="View cart">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span class="absolute -top-2 -right-2 bg-indigo-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                        {{ $total_count }}
                    </span>
                </a>

                <!-- Account / Login (desktop) -->
                @auth
                    <a href="/profile" class="text-gray-700 wire:navigate {{ request()->is('profile') ? 'text-indigo-600' : 'text-gray-500' }} hover:text-indigo-600 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="hidden sm:inline font-medium">{{ Auth::user()->name }}</span>
                    </a>
                @endauth

                @guest
                    <div class="hidden md:flex items-center gap-3">
                        <a href="/login" class="text-gray-700 wire:navigate {{ request()->is('login') ? 'text-indigo-600' : 'text-gray-500' }} hover:text-indigo-600">Login</a>
                        <a href="/signup" class="bg-indigo-600 text-white px-3 py-1 rounded-lg hover:bg-indigo-700">Sign up</a>
                    </div>
                @endguest

                <!-- Mobile menu toggle (Livewire) -->
                <button
                    type="button"
                    wire:click="toggleMobileMenu"
                    class="md:hidden focus:outline-none"
                    aria-controls="mobile-menu"
                    aria-expanded="{{ $mobileMenuOpen ? 'true' : 'false' }}"
                    aria-label="Toggle menu"
                >
                    @if(!$mobileMenuOpen)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    @endif
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden {{ $mobileMenuOpen ? '' : 'hidden' }} bg-white border-t">
        <div class="container mx-auto px-6 py-4 space-y-4">
            <!-- Search (mobile) -->
            <form action="/products" method="GET" class="flex">
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Search products..."
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-lg hover:bg-indigo-700" aria-label="Search">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </form>

            <!-- Links -->
            <div class="grid gap-3">
                <a href="/" class="text-gray-700 hover:text-indigo-600">Home</a>
                <a href="/products" class="text-gray-700 hover:text-indigo-600">Products</a>
                {{-- <a href="/categories" class="text-gray-700 hover:text-indigo-600">Categories</a> --}}
                <a href="/about" class="text-gray-700 hover:text-indigo-600">About</a>
                <a href="/contact" class="text-gray-700 hover:text-indigo-600">Contact</a>

                <a href="/cart" class="flex items-center gap-2 text-gray-700 hover:text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span>Cart</span>
                    <span class="ml-auto inline-flex items-center justify-center bg-indigo-600 text-white text-xs rounded-full h-5 w-5">
                        {{ $total_count }}
                    </span>
                </a>
            </div>

            <!-- Account / Login (mobile) -->
            @auth
                <div class="border-t pt-4 flex items-center justify-between">
                    <a href="/profile" class="flex items-center gap-2 text-gray-700 hover:text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                    <form method="POST" action="">
                        @csrf
                        <button type="submit" class="text-sm text-gray-500 hover:text-red-600">Logout</button>
                    </form>
                </div>
            @else
                <div class="border-t pt-4 flex items-center gap-3">
                    <a href="/login" class="text-gray-700 wire:navigate {{ request()->is('login') ? 'text-indigo-600' : 'text-gray-500' }} hover:text-indigo-600">Login</a>
                    <a href="/signup" class="bg-indigo-600 text-white px-3 py-1 rounded-lg hover:bg-indigo-700">Sign up</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
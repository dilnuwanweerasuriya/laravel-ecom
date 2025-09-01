<div>
    <livewire:partials.navigation />

    <!-- Account Page Content -->
    <div class="container mx-auto px-6 py-8 flex flex-col md:flex-row gap-8">

        <!-- Sidebar Navigation -->
        <aside class="md:w-1/4 bg-gray-50 p-4 rounded-lg shadow-sm h-fit">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">Account</h3>
            <nav class="flex flex-col space-y-2" aria-label="Account Navigation">
                <a href="/profile"
                    class="nav-link block px-3 py-2 rounded-md hover:bg-indigo-100 hover:text-indigo-600 transition duration-150 ease-in-out {{ request()->is('profile') ? 'bg-indigo-100 text-indigo-600 font-semibold' : 'text-gray-700' }}">
                    Profile Information
                </a>
                <a href="/my-orders"
                    class="nav-link block px-3 py-2 rounded-md hover:bg-indigo-100 hover:text-indigo-600 transition duration-150 ease-in-out {{ request()->is('my-orders') ? 'bg-indigo-100 text-indigo-600 font-semibold' : 'text-gray-700' }}">
                    My Orders
                </a>

                <a href="/logout"
                    class="nav-link block w-full text-left px-3 py-2 rounded-md text-red-600 hover:bg-red-100 hover:text-red-700 transition duration-150 ease-in-out mt-4">
                    Logout
                </a>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="md:w-3/4 bg-white p-6 rounded-lg shadow-md">
            <!-- Profile Information Section -->
            <section id="profile" class="mb-8">
                <h2 class="text-2xl font-bold mb-5 text-gray-800">Profile Information</h2>

                @if (session()->has('profile_success'))
                    <div class="mb-4 text-green-600 font-semibold">
                        {{ session('profile_success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="fullName" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" wire:model.defer="fullName" id="fullName" name="fullName"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('fullName')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            readonly>
                    </div>
                </div>

                <div class="mt-6">
                    <button wire:click="updateFullName" wire:loading.attr="disabled"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <span wire:loading.remove>Update Profile</span>
                        <span wire:loading>Updating...</span>
                    </button>
                </div>
            </section>

            <hr class="my-8 border-gray-200">

            <!-- Addresses Section -->
            <section id="addresses" class="mb-8">
                <h2 class="text-2xl font-bold mb-5 text-gray-800">My Addresses</h2>
                @if (session()->has('address_success'))
                    <div class="mb-4 text-green-600 font-semibold">
                        {{ session('address_success') }}
                    </div>
                @endif
                <div class="space-y-4">
                    @if ($user->address != null)
                        <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                            <div class="flex justify-between items-center mb-3">
                                <h4 class="text-lg font-semibold text-gray-800">Default Shipping Address</h4>
                                <button wire:click="openAddressModal('{{ $user->address }}')"
                                    class="text-sm text-indigo-600 hover:underline">
                                    Edit
                                </button>
                            </div>
                            <p class="text-gray-700">{{ $user->address }}</p>
                            {{-- <p class="text-gray-700">123 Main Street</p>
                        <p class="text-gray-700">Anytown, CA 91234</p>
                        <p class="text-gray-700">United States</p> --}}
                        </div>
                    @else
                        <div class="mt-5">
                            <button wire:click="openAddressModal()"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Add New Address
                            </button>
                        </div>
                    @endif
                </div>
            </section>

            <hr class="my-8 border-gray-200">

            <!-- Change Password Section -->
            <section id="password" class="mb-8">
                <h2 class="text-2xl font-bold mb-5 text-gray-800">Change Password</h2>

                @if (session()->has('password_success'))
                    <div class="mb-4 text-green-600 font-semibold">
                        {{ session('password_success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label for="currentPassword" class="block text-sm font-medium text-gray-700">Current
                            Password</label>
                        <input type="password" wire:model.defer="currentPassword" id="currentPassword"
                            name="currentPassword"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('currentPassword')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="newPassword" class="block text-sm font-medium text-gray-700">New Password</label>
                        <input type="password" wire:model.defer="newPassword" id="newPassword" name="newPassword"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('newPassword')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirm New
                            Password</label>
                        <input type="password" wire:model.defer="confirmPassword" id="confirmPassword"
                            name="confirmPassword"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('confirmPassword')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <button wire:click="updatePassword" wire:loading.attr="disabled"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <span wire:loading.remove>Update Password</span>
                        <span wire:loading>Updating...</span>
                    </button>
                </div>
            </section>
        </main>
    </div>


    @if ($showAddressModal)
        <div class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h3 class="text-xl font-semibold mb-4">{{ $address ? 'Edit Address' : 'Add New Address' }}</h3>

                <textarea wire:model.defer="address" rows="4"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                @error('address')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <div class="mt-6 flex justify-end gap-3">
                    <button wire:click="closeAddressModal"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">
                        Cancel
                    </button>
                    <button wire:click="saveAddress"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Save
                    </button>
                </div>
            </div>
        </div>
    @endif


    <livewire:partials.footer />
</div>

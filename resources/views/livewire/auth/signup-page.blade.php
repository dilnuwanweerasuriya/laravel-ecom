<div>
    <livewire:partials.navigation />

    <!-- Sign Up Section -->
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-lg">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Create your account</h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Already have an account?
                    <a href="/login" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Sign in
                    </a>
                </p>
            </div>
            <form wire:submit.prevent="register" class="mt-8 space-y-6">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div class="grid grid-cols-1 gap-y-6">

                        <!-- Full Name -->
                        <div class="col-span-1">
                            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" wire:model="name" id="name"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                            @error('name')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-span-1">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                            <input type="email" wire:model="email" id="email"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                            @error('email')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="col-span-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" wire:model="password" id="password"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                            <p class="mt-1 text-xs text-gray-500">Password must be at least 8 characters and include a
                                number and a special character.</p>
                            @error('password')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-span-1">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                                password</label>
                            <input type="password" wire:model="password_confirmation" id="password_confirmation"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border">
                            @error('password_confirmation')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Terms -->
                <div class="flex items-center">
                    <input type="checkbox" wire:model="terms" id="terms"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="terms" class="ml-2 block text-sm text-gray-900">
                        I agree to the
                        <a href="/terms" class="font-medium text-indigo-600 hover:text-indigo-500">Terms of Service</a>
                        and
                        <a href="/privacy" class="font-medium text-indigo-600 hover:text-indigo-500">Privacy Policy</a>
                    </label>
                    @error('terms')
                        <span class="text-red-500 text-xs ml-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Create Account
                    </button>
                </div>
            </form>

            {{-- <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Or sign up with</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <div>
                        <a href="#"
                            class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 0C4.477 0 0 4.477 0 10c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.342-3.369-1.342-.454-1.155-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.933.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C17.14 18.163 20 14.418 20 10c0-5.523-4.477-10-10-10z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>

                    <div>
                        <a href="#"
                            class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 0C4.477 0 0 4.477 0 10c0 5.523 4.477 10 10 10 5.523 0 10-4.477 10-10 0-5.523-4.477-10-10-10zm6.536 6.464c-.5-.5-1.172-.78-1.879-.78-.707 0-1.379.28-1.879.78l-2.778 2.778-2.778-2.778c-.5-.5-1.172-.78-1.879-.78-.707 0-1.379.28-1.879.78-.5.5-.78 1.172-.78 1.879 0 .707.28 1.379.78 1.879l2.778 2.778-2.778 2.778c-.5.5-.78 1.172-.78 1.879 0 .707.28 1.379.78 1.879.5.5 1.172.78 1.879.78.707 0 1.379-.28 1.879-.78l2.778-2.778 2.778 2.778c.5.5 1.172.78 1.879.78.707 0 1.379-.28 1.879-.78.5-.5.78-1.172.78-1.879 0-.707-.28-1.379-.78-1.879l-2.778-2.778 2.778-2.778c.5-.5.78-1.172.78-1.879 0-.707-.28-1.379-.78-1.879z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <livewire:partials.footer />
</div>

<div class="bg-white py-12">
    <div class="container mx-auto px-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Trusted Brands</h2>
        <div class="overflow-x-auto brands-scroll">
            <div class="flex space-x-12 items-center justify-center min-w-max px-4">
                @foreach ($brands as $brand)
                    @if ($brand->id != 1)
                        <div class="flex-shrink-0">
                            <img src="{{ $brand->image }}" alt="{{ $brand->name }}"
                                class="h-12 grayscale hover:grayscale-0 transition duration-300">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

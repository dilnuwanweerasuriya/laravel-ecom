<?php

namespace App\Livewire\Shared;

use Livewire\Component;

use App\Models\Product;

class FeaturedProducts extends Component
{
    public function render()
    {
        return view('livewire.shared.featured-products', [
            'featured' => Product::where('is_featured', 1)->paginate(4),
        ]);
    }
}

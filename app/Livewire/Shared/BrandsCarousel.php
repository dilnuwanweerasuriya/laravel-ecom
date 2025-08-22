<?php

namespace App\Livewire\Shared;

use Livewire\Component;
use App\Models\Brand;

class BrandsCarousel extends Component
{
    public function render()
    {
        $brands = Brand::where('is_active', 1)->get();

        return view('livewire.shared.brands-carousel', [
            'brands' => $brands,
        ]);
    }
}

<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use Livewire\Attributes\On;

class Navigation extends Component
{
    public $total_count = 0;

    public function updateCartCount($total_count){
        $this->total_count = $total_count;
    }

    public function render()
    {
        return view('livewire.partials.navigation');
    }
}

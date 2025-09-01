<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CartManagement;
use Livewire\Attributes\On;

class Navigation extends Component
{
    public $mobileMenuOpen = false;
    public $total_count = 0;

    public function mount(){
        $this->total_count = Auth::check() ? count(CartManagement::getCartItemsFromDatabase()) : count(CartManagement::getCartItemsFromCookie());
    }

    #[On('update-cart-count')]
    public function updateCartCount($total_count){
        $this->total_count = $total_count;
    }

    public function toggleMobileMenu(){
        $this->mobileMenuOpen = ! $this->mobileMenuOpen;
    }

    public function render()
    {
        return view('livewire.partials.navigation');
    }
}

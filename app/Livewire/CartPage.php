<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navigation;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

#[Title('Cart - ShopEase')]
class CartPage extends Component
{
    public $cart_items = [];
    public $grand_total;

    public function mount(){
        $this->cart_items = Auth::check() ? CartManagement::getCartItemsFromDatabase() : CartManagement::getCartItemsFromCookie();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function removeItem($product_id, $variant_id = null){
        $this->cart_items = Auth::check() ? CartManagement::removeCartItemFromDatabase($product_id,  $variant_id) : CartManagement::removeCartItemFromCookie($product_id, $variant_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);

        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navigation::class);

        LivewireAlert::title('Product removed from the cart!')
            ->success()
            ->toast()
            ->position('bottom-end')
            ->show();
    }

    public function increaseQty($product_id){
        $this->cart_items = CartManagement::increaseQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function decreaseQty($product_id){
        $this->cart_items = CartManagement::decreaseQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}

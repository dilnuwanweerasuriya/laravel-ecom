<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use App\Models\Order;

#[Title('Order Success - ShopEase')]
class SuccessPage extends Component
{
    #[Url]
    public $session_id;

    public function render()
    {
        $latest_order = Order::with('payment', 'address')->where('user_id', auth()->user()->id)->latest()->first();

        return view('livewire.success-page', [
            'order' => $latest_order
        ]);
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Contact Us - ShopEase')]
class ContactPage extends Component
{
    public function render()
    {
        return view('livewire.contact-page');
    }
}

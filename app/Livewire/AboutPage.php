<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('About Us - ShopEase')]
class AboutPage extends Component
{
    public function render()
    {
        return view('livewire.about-page');
    }
}

<?php

namespace App\Livewire\Shared;

use Livewire\Component;

class PageHeader extends Component
{
    public $page;
    public $heading;

    public function mount($page = 'ShopEase', $heading = '')
    {
        $this->page = $page;
        $this->heading = $heading;
    }

    public function render()
    {
        return view('livewire.shared.page-header');
    }
}

<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class MyOrder extends Component
{
    #[Computed]
    public function orders()
    {
        return auth()->user()->orders;
    }

    public function render()
    {
        return view('livewire.my-order');
    }
}

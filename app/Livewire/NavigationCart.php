<?php

namespace App\Livewire;

use App\Factories\CartFactory;
use Livewire\Attributes\Computed;
use Livewire\Component;

class NavigationCart extends Component
{
    protected $listeners = [
        '$refresh'
    ];

    #[Computed]
    public function cartItemCount()
    {
        return CartFactory::make()?->cartItems()->sum('quantity') ?? 0;
    }

    public function render()
    {
        return view('livewire.navigation-cart');
    }
}

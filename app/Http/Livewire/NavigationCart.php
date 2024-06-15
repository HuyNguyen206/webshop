<?php

namespace App\Http\Livewire;

use App\Factories\CartFactory;
use Livewire\Component;

class NavigationCart extends Component
{
    protected $listeners = [
        '$refresh'
    ];

    public function getCartItemCountProperty()
    {
        return CartFactory::make()?->cartItems()->sum('quantity') ?? 0;
    }

    public function render()
    {
        return view('livewire.navigation-cart');
    }
}

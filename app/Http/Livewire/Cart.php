<?php

namespace App\Http\Livewire;

use App\Factories\CartFactory;
use Livewire\Component;

class Cart extends Component
{
    public function getCartProperty()
    {
        return CartFactory::make()->load(['cartItems.productVariant.product.featureImage']);
    }

    public function render()
    {
        return view('livewire.cart');
    }
}

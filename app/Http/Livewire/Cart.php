<?php

namespace App\Http\Livewire;

use App\Factories\CartFactory;
use App\Models\CartItem;
use Livewire\Component;

class Cart extends Component
{
    public function getCartProperty()
    {
        return CartFactory::make()->load(['cartItems.productVariant.product.featureImage']);
    }

    public function delete(int $cartItemId)
    {
        CartItem::where('id', $cartItemId)->delete();
        $this->emitTo(NavigationCart::class, '$refresh');
    }

    public function changeQuantity(int $cartItemId, string $type = 'add')
    {
        $cartItem = CartItem::where('id', $cartItemId)->first();

        if ($type === 'remove') {
            if ($cartItem->quantity === 1) {
                $cartItem->delete();
            } else {
                $cartItem->decrement('quantity');
            }
        } else {
            $cartItem->increment('quantity');
        }

        $this->emitTo(NavigationCart::class, '$refresh');
    }

    public function render()
    {
        return view('livewire.cart');
    }
}

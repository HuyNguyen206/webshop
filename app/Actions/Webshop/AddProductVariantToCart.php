<?php

namespace App\Actions\Webshop;

use App\Models\Cart;

class AddProductVariantToCart
{
    public function add(int $variantId)
    {
        $user = auth()->user();
        /**
         * @var Cart $cart
         */
        if ($user) {
            $cart = $user->cart ?? $user->cart()->create();
        } else {
            $cart = Cart::firstOrCreate([
                'session_id' => session()->getId()
            ]);
        }

        $cart->cartItems()->create(['product_variant_id' => $variantId, 'quantity' => 1]);
    }
}

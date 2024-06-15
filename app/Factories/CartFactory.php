<?php

namespace App\Factories;

use App\Models\Cart;

class CartFactory
{
    public static function make()
    {
        $user = auth()->user();
        if ($user) {
            $cart = $user->cart ?? $user->cart()->create();
        } else {
            $cart = Cart::firstOrCreate([
                'session_id' => session()->getId()
            ]);
        }

        return $cart;
    }
}

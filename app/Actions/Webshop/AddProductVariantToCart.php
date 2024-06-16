<?php

namespace App\Actions\Webshop;

use App\Factories\CartFactory;

class AddProductVariantToCart
{
    public function add(int $variantId)
    {
        $cartItemsQuery = CartFactory::make()->cartItems();
        $cartItem = $cartItemsQuery->where('product_variant_id', $variantId)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            $cartItemsQuery->create(['product_variant_id' => $variantId]);
        }
    }
}

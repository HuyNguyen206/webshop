<?php

namespace App\Actions\Webshop;

use App\Factories\CartFactory;

class AddProductVariantToCart
{
    public function add(int $variantId)
    {
        CartFactory::make()->cartItems()->create(['product_variant_id' => $variantId, 'quantity' => 1]);
    }
}

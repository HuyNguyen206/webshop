<?php

namespace App\Actions\Webshop;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;

class MigrateSessionCart
{
    public function migrate(Cart $sessionCart, Cart $userCart)
    {
        $userProductVariants = $userCart->cartItems()->get(['product_variant_id', 'cart_items.id', 'quantity']);
        $sessionProductVariants = $sessionCart->cartItems()->get(['product_variant_id', 'cart_items.id', 'quantity']);

        $userProductVariantIds = $userProductVariants->pluck('product_variant_id');
        $sessionProductVariantIds = $sessionProductVariants->pluck('product_variant_id');

        $mergeProductVariantIds = $userProductVariantIds->intersect($sessionProductVariantIds);

        $userProductVariantsMap = $userProductVariants->mapWithKeys(function ($item) {
            return [$item->product_variant_id => $item];
        });

        $sessionProductVariantsMap = $sessionProductVariants->mapWithKeys(function ($item) {
            return [$item->product_variant_id => $item];
        });

        foreach ($mergeProductVariantIds as $mergeProductVariantId) {
            $sessionCartItem = $sessionProductVariantsMap->get($mergeProductVariantId);
            $userCartItem = $userProductVariantsMap->get($mergeProductVariantId);
            $userCartItem->quantity += $sessionCartItem->quantity;

            $userCartItem->save();

            $sessionCartItem->delete();
        }

        $newUserCartItems = $sessionProductVariants->filter(function ($sessionProductVariant) use ($mergeProductVariantIds) {
            return !$mergeProductVariantIds->contains($sessionProductVariant->product_variant_id);
         });

        $sessionCart->delete();

        CartItem::query()->whereIn('id', $newUserCartItems->pluck('id')->toArray())->update(['cart_id' => $userCart->id]);
    }
}

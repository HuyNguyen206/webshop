<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Money\Money;

class Cart extends Model
{
    use HasFactory;

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function total(): Attribute
    {
        return Attribute::get(function () {
           return $this->cartItems->reduce(function (Money $total, CartItem $cartItem) {
                return $total->add($cartItem->subtotal);
            }, new \Money\Money(0, new \Money\Currency('USD')));
        }
        );
    }
}

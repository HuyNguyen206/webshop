<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Money\Currency;
use Money\Money;

class Product extends Model
{
    use HasFactory;

    public function productVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function featureImage()
    {
        return $this->hasOne(Image::class)->ofMany('is_main_feature');
    }

    public function price(): Attribute
    {
        return Attribute::make(
            get:  fn($value) => new Money($value, new Currency('USD')),
            set:  function ($value) {
                if ($value instanceof Money) {
                    return $value->getAmount();
                }

                return $value * 100;
            },
        );
    }
}

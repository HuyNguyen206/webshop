<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::factory(4)->create()->each(function(Product $product) {
            $productVariants = ProductVariant::factory(random_int(2, 5))->for($product)->make();
            $productVariants->each(function(ProductVariant $variant) {
               ProductVariant::query()->firstOrCreate($keys = ['product_id' => $variant->product_id, 'size' => $variant->size, 'color' => $variant->color], Arr::except($variant->toArray(), $keys));
            });

            Image::factory(4)->sequence(function (Sequence $sequence) {
                return ['is_main_feature' => $sequence->index === 0];
            })->for($product)->create();
        });
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

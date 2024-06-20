<?php

namespace App\Livewire;

use App\Actions\Webshop\AddProductVariantToCart;
use App\Models\Product as ProductModel;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Product extends Component
{
    use InteractsWithBanner;

    public ProductModel $product;

    public $variant;

    public function mount()
    {
       $this->variant = $this->product->productVariants()->value('id');
    }

    protected function rules()
    {
        return [
            'variant' =>'required|exists:product_variants,id'
        ];
    }

    #[Computed]
    public function product()
    {
        return $this->product;
    }

    public function addToCart(AddProductVariantToCart $addProductVariantToCart)
    {
        $this->validate();
        $addProductVariantToCart->add($this->variant);
        $this->dispatch( '$refresh')->to(NavigationCart::class);
        $this->banner('Your product has been added to cart!');
    }

    public function render()
    {
        return view('livewire.product');
    }
}

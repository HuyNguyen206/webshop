<?php

namespace App\Http\Livewire;

use App\Actions\Webshop\AddProductVariantToCart;
use App\Models\Product as ProductModel;
use Livewire\Component;

class Product extends Component
{
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

    public function getProductProperty()
    {
        return $this->product;
    }

    public function addToCart(AddProductVariantToCart $addProductVariantToCart)
    {
        $this->validate();
        $addProductVariantToCart->add($this->variant);
    }

    public function render()
    {
        return view('livewire.product');
    }
}

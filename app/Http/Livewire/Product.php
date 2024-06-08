<?php

namespace App\Http\Livewire;

use App\Models\Product as ProductModel;
use Livewire\Component;

class Product extends Component
{
    public ProductModel $product;

    public function getProductProperty()
    {
        return $this->product;
    }

    public function render()
    {
        return view('livewire.product');
    }
}

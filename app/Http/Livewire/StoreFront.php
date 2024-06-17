<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class StoreFront extends Component
{
    public function getProductsProperty()
    {
        return Product::all();
    }
    public function render()
    {
        return view('livewire.store-front');
    }
}

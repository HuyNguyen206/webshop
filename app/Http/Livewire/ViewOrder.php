<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ViewOrder extends Component
{
    public $orderId;

    public function mount($orderId)
    {
        $this->orderId = $orderId;
    }

    public function getOrderProperty()
    {
        return auth()->user()->orders()->where('orders.id', $this->orderId)->with(['orderItems.productVariant.product'])->first();
    }

    public function render()
    {
        return view('livewire.view-order');
    }
}

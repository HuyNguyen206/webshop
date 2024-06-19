<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class CartCheck extends Component
{
    public $sessionId;
    public function mount()
    {
        $this->sessionId = request()->get('session_id');
    }

    public function getOrderProperty()
    {
        return Order::query()->where('stripe_checkout_session_id', $this->sessionId)->first();
    }

    public function render()
    {
        return view('livewire.cart-check');
    }
}

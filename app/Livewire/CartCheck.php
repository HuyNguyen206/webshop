<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Computed;
use Livewire\Component;

class CartCheck extends Component
{
    public $sessionId;
    public function mount()
    {
        $this->sessionId = request()->get('session_id');
    }

    #[Computed]
    public function order()
    {
        return Order::query()->where('stripe_checkout_session_id', $this->sessionId)->first();
    }

    public function render()
    {
        return view('livewire.cart-check');
    }
}

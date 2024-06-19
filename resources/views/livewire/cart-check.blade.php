<div>
    @if($this->order)
        Thank you for your order #{{$this->order->id}}!
    @else
        <p wire:poll>
            Order is pending
        </p>
    @endif
</div>

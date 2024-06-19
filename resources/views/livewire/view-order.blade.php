<x-panel title="Your order #{{$this->order->id}}">
    <table class="table table-row">
        <thead>
        <tr>
            <th>
                Product
            </th>
            <th>
                Size
            </th>
            <th>
                Color
            </th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($this->order->orderItems as $orderItem)
            <tr class="my-4 text-center">
                <td class="w-1/5">
                    <img src="{{$orderItem->productVariant->product->featureImage->path}}" alt="">
                    <p>{{$orderItem->productVariant->product->name}}</p>
                </td>
                <td>
                    {{$orderItem->productVariant->size}}
                </td>
                <td>
                    {{$orderItem->productVariant->color}}
                </td>
                <td>
                    <div class="flex justify-center gap-x-4">

                        <button wire:click="changeQuantity({{$orderItem->id}})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-4 cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                            </svg>
                        </button>

                        <p>Quantity: {{$orderItem->quantity}}</p>

                        <button wire:click="changeQuantity({{$orderItem->id}}, 'remove')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-4 cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/>
                            </svg>
                        </button>

                    </div>
                </td>
                <td>
                    <p>Price: {{$orderItem->productVariant->product->price}}</p>
                </td>
                <td>
                    <p>Total: {{$orderItem->amount_subtotal}}</p>
                </td>

            </tr>
        @endforeach
        </tbody>
        <tfoot>
        @if($this->order->amount_shipping->getAmount() > 0)
            <tr>
                <td colspan="5" style="text-align: right"> Shipping cost</td>
                <td>
                    {{$this->order->amount_shipping}}
                </td>
            </tr>
        @endif
        @if($this->order->amount_discount->getAmount() > 0)
            <tr>
                <td colspan="5" style="text-align: right"> Discount</td>
                <td>
                    {{$this->order->amount_discount}}
                </td>
            </tr>
        @endif
        @if($this->order->amount_tax->getAmount() > 0)
            <tr>
                <td colspan="5" style="text-align: right"> Tax</td>
                <td>
                    {{$this->order->amount_tax}}
                </td>
            </tr>
        @endif
        @if($this->order->amount_subtotal->getAmount() > 0)
            <tr>
                <td colspan="5" style="text-align: right">Subtotal: </td>
                <td>
                    {{$this->order->amount_subtotal}}
                </td>
            </tr>
        @endif
        @if($this->order->amount_total->getAmount() > 0)
            <tr>
                <td colspan="5" style="text-align: right">Total</td>
                <td>
                    {{$this->order->amount_total}}
                </td>
            </tr>
        @endif
        </tfoot>
    </table>

</x-panel>
<div class="grid grid-cols-2">
    <x-panel class="col-span-1" title="Billing information">
        @foreach($this->order->billing_address->filter() as $value)
            {{$value}} <br>
        @endforeach
    </x-panel>
    <x-panel class="col-span-1" title="Shipping information">
        @foreach($this->order->shipping_address->filter() as $value)
            {{$value}} <br>
        @endforeach
    </x-panel>
</div>

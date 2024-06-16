<div class="bg-white shadow p-4 flex gap-2">
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
        @foreach($this->cart->cartItems as $cartItem)
            <tr class="my-4 text-center">
                <td class="w-1/5">
                    <img src="{{$cartItem->productVariant->product->featureImage->path}}" alt="">
                    <p>{{$cartItem->productVariant->product->name}}</p>
                </td>
                <td>
                    {{$cartItem->productVariant->size}}
                </td>
                <td>
                    {{$cartItem->productVariant->color}}
                </td>
                <td>
                    <div class="flex justify-center gap-x-4">

                        <button wire:click="changeQuantity({{$cartItem->id}})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-4 cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                            </svg>
                        </button>

                        <p>Quantity: {{$cartItem->quantity}}</p>

                        <button wire:click="changeQuantity({{$cartItem->id}}, 'remove')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-4 cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/>
                            </svg>
                        </button>

                    </div>
                </td>
                <td>
                    <p>Price: {{$cartItem->productVariant->product->price}}</p>
                </td>
                <td>
                    <p>Total: {{$cartItem->subtotal}}</p>
                </td>
                <td>
                    <button wire:click="delete({{$cartItem->id}})">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                        </svg>
                    </button>
                </td>

            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="6">

            </td>
            <td>
                {{
                    $this->cart->total
                }}
            </td>
        </tr>
        </tfoot>
    </table>
    <div class="rounded-lg shadow">
        @guest()
            <div>Please <a class="text-blue-600" href="{{route('register')}}">register</a> or  <a class="text-blue-600" href="{{route('login')}}">login</a> to continue</div>
        @endguest
        @auth()
            <x-button wire:click="checkout">
                Checkout
            </x-button>
        @endauth
    </div>

</div>

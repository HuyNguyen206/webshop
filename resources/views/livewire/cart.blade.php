<div class="bg-white shadow p-4">
    <table class="table table-row">
        <thead>
          <tr>
              <th>
                  Product
              </th>
              <th>Quantity</th>
          </tr>
          <tbody>
        @foreach($this->cart->cartItems as $cartItem)
            <tr class="my-4">
                <td>
                    <img src="{{$cartItem->productVariant->product->featureImage->path}}" alt="">
                    {{$cartItem->productVariant->product->name}} -  {{$cartItem->productVariant->size}} - {{$cartItem->productVariant->color}}
                </td>
                <td>
                    <p>Quantity: {{$cartItem->quantity}}</p>
                    <p>Price: {{$cartItem->productVariant->product->price}}</p>
                </td>
            </tr>
        @endforeach
        </tbody>

        </thead>
    </table>

</div>

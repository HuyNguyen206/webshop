@component('mail::message')
<p>
Hey {{$order->user->name}}
</p>

<p>
Thank you for your order.
</p>


<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" style="width: 100%">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Item
            </th>
            <th scope="col" class="px-6 py-3">
                Price
            </th>
            <th scope="col" class="px-6 py-3">
                Quantity
            </th>
            <th scope="col" class="px-6 py-3">
                Amount Tax
            </th>
            <th scope="col" class="px-6 py-3">
                Total
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->orderItems as $orderItem)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$orderItem->name}}
                </th>
                <td class="px-6 py-4">
                    {{$orderItem->price}}
                </td>
                <td class="px-6 py-4">
                    {{$orderItem->quantity}}
                </td>
                <td class="px-6 py-4">
                    {{$orderItem->amount_tax}}
                </td>
                <td class="px-6 py-4">
                    {{$orderItem->amount_total}}
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        @if($order->amount_shipping->getAmount() > 0)
            <tr>
                <td colspan="4" style="text-align: right"> Shipping cost</td>
                <td>
                    {{$order->amount_shipping}}
                </td>
            </tr>
        @endif
        @if($order->amount_discount->getAmount() > 0)
            <tr>
                <td colspan="4" style="text-align: right"> Discount</td>
                <td>
                    {{$order->amount_discount}}
                </td>
            </tr>
        @endif
        @if($order->amount_tax->getAmount() > 0)
            <tr>
                <td colspan="4" style="text-align: right"> Tax</td>
                <td>
                    {{$order->amount_tax}}
                </td>
            </tr>
        @endif
        @if($order->amount_subtotal->getAmount() > 0)
            <tr>
                <td colspan="4" style="text-align: right">Subtotal: </td>
                <td>
                    {{$order->amount_subtotal}}
                </td>
            </tr>
        @endif
        @if($order->amount_total->getAmount() > 0)
            <tr>
                <td colspan="4" style="text-align: right">Total</td>
                <td>
                    {{$order->amount_total}}
                </td>
            </tr>
        @endif
        </tfoot>
    </table>
</div>
@component('mail::button', ['url' => route('view-order', $order), 'color' => 'success'])
    View Order
@endcomponent
@endcomponent

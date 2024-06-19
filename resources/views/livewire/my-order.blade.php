<x-panel class="mt-4">
    <table class="table w-full">
        <thead>
        <tr>
            <th>
                Order id
            </th>
            <th>
                Total
            </th>
            <th>
                Ordered at
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($this->orders as $order)
            <tr class="my-4 text-center">
                <td class="w-1/5">
                    <p>{{$order->id}}</p>
                </td>
                <td>
                    {{$order->amount_total}}
                </td>
                <td>
                    {{$order->created_at->diffForHumans()}}
                </td>
                <td>
                    <a href="{{route('view-order', $order->id)}}" class="text-blue-600 underline">Detail</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-panel>

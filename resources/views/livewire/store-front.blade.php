<div class="grid grid-cols-4 gap-4 mt-4">
    @forelse($this->products as $product)
        <div class="bg-white rounded-lg shadow p-4 font-medium text-lg">
            <img src="{{$product->featureImage->path}}" alt="">
            {{$product->name}}
            <span class="text-gray-600 text-sm">{{$product->price}}</span>

        </div>
    @empty

    @endforelse
</div>

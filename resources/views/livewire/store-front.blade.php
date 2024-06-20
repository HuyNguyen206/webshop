<div>
    <div class="flex justify-between mt-4">
        <p>Our products:</p>
        <x-input wire:model.live.debounce="search" type="search"/>
    </div>
    <div class="grid grid-cols-4 gap-4 mt-4">
        @forelse($this->products as $product)
            <div class="bg-white relative rounded-lg shadow p-4 font-medium text-lg">
                <a wire:navigate href="{{route('product', $product)}}" class="absolute inset-0 w-full h-full"></a>
                <img src="{{$product->featureImage->path}}" alt="">
                {{$product->name}}
                <span class="text-gray-600 text-sm">{{$product->price}}</span>

            </div>
        @empty
        @endforelse
    </div>
    <div class="mx-auto mt-6">
        {{ $this->products->links() }}
    </div>
</div>


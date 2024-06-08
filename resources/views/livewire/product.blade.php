<div class="grid grid-cols-2 gap-10 mt-5">
    <div class="space-y-2">
        <div>
            <img src="{{$product->featureImage->path}}" alt="">
        </div>
        <div class="grid grid-cols-4 gap-4">
            @foreach($product->images as $image)
                <img src="{{$image->path}}" class="rounded" alt="">
            @endforeach
        </div>
    </div>
    <div>
        <span class="text-3xl">{{$product->name}}</span>
        <div class="text-xl text-gray-600">{{$product->price}}</div>
        <div class="mt-4">{{$product->description}}</div>
        <select name="variant" id="">
            @foreach($product->productVariants as $variant)
                <option value="{{$variant->id}}"> {{$variant->color}} / {{$variant->size}}</option>
            @endforeach
        </select>
        <x-button>Add to cart</x-button>
    </div>
</div>

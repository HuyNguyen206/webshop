<div class="grid grid-cols-2 gap-10 mt-5">
    <div class="space-y-2" x-data="{image: '{{$product->featureImage->path}}'}">
        <div>
            <img :src="image" alt="">
        </div>
        <div class="grid grid-cols-4 gap-4">
            @foreach($product->images as $image)
                <img src="{{$image->path}}" class="rounded" alt="" @click="image = '{{$image->path}}'">
            @endforeach
        </div>
    </div>
    <div>
        <span class="text-3xl">{{$product->name}}</span>
        <div class="text-xl text-gray-600">{{$product->price}}</div>
        <div class="mt-4">{{$product->description}}</div>
        <select wire:model.live="variant">
            @foreach($product->productVariants as $variant)
                <option value="{{$variant->id}}"> {{$variant->color}} / {{$variant->size}}</option>
            @endforeach
        </select>
        <div class="mt-2">
            <x-button wire:click="addToCart">Add to cart</x-button>
            @error('variant')
            <span class="text-red-500 block mt-2">{{$message}}</span>
            @enderror
        </div>

    </div>
</div>

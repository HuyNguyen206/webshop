<x-nav-link href="{{route('cart')}}" :active="request()->routeIs('cart')">
    {{ __('Your cart') }} ({{$this->cartItemCount}})
</x-nav-link>

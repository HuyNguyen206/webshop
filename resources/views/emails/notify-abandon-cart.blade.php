<x-mail::message>
# Remind

Hey {{$cart->user->name}}, It seem you forgot to check out this cart below.
Please login if you haven't already.

<x-mail::button :url="route('cart')">
Continue to checkout
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

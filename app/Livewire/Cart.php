<?php

namespace App\Livewire;

use App\Factories\CartFactory;
use App\Models\CartItem;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Cart extends Component
{
    #[Computed]
    public function cart()
    {
        return CartFactory::make()->load(['cartItems.productVariant.product.featureImage']);
    }

    public function delete(int $cartItemId)
    {
        CartItem::where('id', $cartItemId)->delete();
        $this->dispatch( '$refresh')->to(NavigationCart::class);
    }

    public function changeQuantity(int $cartItemId, string $type = 'add')
    {
        $cartItem = CartItem::where('id', $cartItemId)->first();

        if ($type === 'remove') {
            if ($cartItem->quantity === 1) {
                $cartItem->delete();
            } else {
                $cartItem->decrement('quantity');
            }
        } else {
            $cartItem->increment('quantity');
        }

        $this->dispatch( '$refresh')->to(NavigationCart::class);
    }

    public function checkout()
    {
        if (auth()->guest()) {
            $this->dispatch('banner-message', [
                'style' => 'success',
                'message' => 'Your product has been added to cart!'
            ]);

            return $this->redirect(route('login'));
        }

        $cartItems = $this->cart->cartItems->loadMissing(['productVariant.product']);

        return $this->cart->user->allowPromotionCodes()->checkout($this->formatCartItems($cartItems),
        [
            'customer_update' => [
                'shipping' => 'auto'
            ],
            'shipping_address_collection' => [
                'allowed_countries' => ['US', 'VN', 'NL']
            ],
            'metadata' => [
                'user_id' => $this->cart->user_id,
                'cart_id' => $this->cart->id
            ],
            'success_url' => route('checkout-status'). '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cart'),
        ]);
    }

    public function render()
    {
        return view('livewire.cart');
    }

    /**
     * @param $cartItems
     * @return mixed
     */
    private function formatCartItems($cartItems)
    {
        return $cartItems->map(function (CartItem $cartItem) {
            return [
                'price_data' => [
                    'currency' => 'USD',
                    'unit_amount' => $cartItem->productVariant->product->price->getAmount(),
                    'product_data' => [
                        'name' => $cartItem->productVariant->product->name,
                        'description' => 'Size: ' . $cartItem->productVariant->size . ', color: ' . $cartItem->productVariant->color,
                        'metadata' => [
                            'product_id' => $cartItem->productVariant->product_id,
                            'product_variant_id' => $cartItem->product_variant_id
                        ]
                    ]
                ],
                'quantity' => $cartItem->quantity,
            ];
        })->toArray();
    }
}

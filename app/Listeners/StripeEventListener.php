<?php

namespace App\Listeners;

use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Events\WebhookReceived;
use Stripe\LineItem;

class StripeEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WebhookReceived $event): void
    {
        if ($event->payload['type'] === 'checkout.session.completed') {
            $sessionId = $event->payload['data']['object']['id'];
            DB::transaction(function () use ($sessionId) {
                $session = Cashier::stripe()->checkout->sessions->retrieve($sessionId);
                $user = User::find($session->metadata->user_id);

                CartItem::query()->where('cart_id', $session->metadata->cart_id)->delete();
                \App\Models\Cart::query()->where('id', $session->metadata->cart_id)->delete();

                $order = $user->orders()->create([
                    'stripe_checkout_session_id' => $session->id,
                    'amount_shipping' => $session->total_details->amount_shipping,
                    'amount_discount' => $session->total_details->amount_discount,
                    'amount_tax' => $session->total_details->amount_tax,
                    'amount_subtotal' => $session->amount_subtotal,
                    'amount_total' => $session->amount_total,
                    'billing_address' => [
                        'name' => $session->customer_details->address->name,
                        'city' => $session->customer_details->address->city,
                        'country' => $session->customer_details->address->country,
                        'line1' => $session->customer_details->address->line1,
                        'line2' => $session->customer_details->address->line2,
                        'postal_code' => $session->customer_details->address->postal_code,
                        'state' => $session->customer_details->address->state,
                    ],
                    'shipping_address' => [
                        'name' => $session->shipping_details->address->name,
                        'city' => $session->shipping_details->address->city,
                        'country' => $session->shipping_details->address->country,
                        'line1' => $session->shipping_details->address->line1,
                        'line2' => $session->shipping_details->address->line2,
                        'postal_code' => $session->shipping_details->address->postal_code,
                        'state' => $session->shipping_details->address->state,
                    ],
                ]);

                $lineItems = Cashier::stripe()->checkout->sessions->allLineItems($sessionId);

                $orderItems = collect($lineItems->all())->map(function (LineItem $lineItem) {
                    $product = Cashier::stripe()->products->retrieve($lineItem->price->product);

                    return new OrderItem([
                        'product_variant_id' => $product->metadata->product_variant_id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'price' => $lineItem->price->unit_amount,
                        'quantity' => $lineItem->quantity,
                        'amount_discount' => $lineItem->amount_discount,
                        'amount_subtotal' => $lineItem->amount_subtotal,
                        'amount_tax' => $lineItem->amount_tax,
                        'amount_total' => $lineItem->amount_total,
                    ]);
                });

                $order->orderItems()->saveMany($orderItems);
            });
        }

    }
}

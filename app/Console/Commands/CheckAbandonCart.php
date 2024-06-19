<?php

namespace App\Console\Commands;

use App\Mail\NotifyAbandonCartEmail;
use App\Models\Cart;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckAbandonCart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-abandon-cart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Look for abandoned cart and notify their owner';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Cart::query()->whereRaw("datediff(now(), updated_at) >= 30")->with('user')->get()->each(function(Cart $cart) {
            $this->info('Processing...');

            if ($user = $cart->user) {
               Mail::to($user)->send(new NotifyAbandonCartEmail($cart));
           }  else {
               $cart->cartItems()->delete();
               $cart->delete();
           }
        });

        $this->info('Done...');

        return self::SUCCESS;
    }
}

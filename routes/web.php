<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', \App\Livewire\StoreFront::class)->name('home');
Route::get('/product/{product}', \App\Livewire\Product::class)->name('product');
Route::get('cart', \App\Livewire\Cart::class)->name('cart');


Route::get('preview', function (){
    return new \App\Mail\NotifyAbandonCartEmail(\App\Models\Cart::first());
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('checkout-status', \App\Livewire\CartCheck::class)->name('checkout-status');
    Route::get('order/{orderId}', \App\Livewire\ViewOrder::class)->name('view-order');
    Route::get('my-orders', \App\Livewire\MyOrder::class)->name('my-orders');
});

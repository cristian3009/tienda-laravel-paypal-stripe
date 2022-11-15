<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CartManager;

class Checkout extends Component
{
    public $cart;

    public function mount(CartManager $cart)
    {
        $this->cart = $cart->getCart();
    }
    public function render()
    {
        return view('livewire.checkout', [
            'products' => $this->cart->products
        ])
            ->extends('layouts.app')
            ->section('content');
    }

    public function deleteProduct(CartManager $cart, $productId)
    {
        $cart->deleteProduct($productId);
        session()->flash('message', 'Product deleted');
        $this->emitTo('cart', 'addToCart');
    }

    public function hydrate()
    {
        $this->cart = (app(CartManager::class))->getCart();
    }
}

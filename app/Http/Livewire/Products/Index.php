<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use App\Models\CartManager;

class Index extends Component
{
    public function render()
    {
        return view('livewire.products.index', [
            'products' => Product::all()
        ]);
    }

    public function addToCart(CartManager $cart, $productId)
    {
        $cart->addToCart($productId);
        session()->flash('message', 'product added to your shopping cart');
        $this->emitTo('cart', 'addToCart');
    }
}

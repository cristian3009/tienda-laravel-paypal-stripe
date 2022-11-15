<?php

namespace App\Models;

class CartManager
{
    private string $sessionName = 'shopping_cart_id';
    private $cart;

    public function __construct()
    {
        $this->cart = $this->findOrCreate($this->findSession());
    }

    private function findOrCreate($cartId)
    {
        $cart = null;
        if (is_null($cartId))
        {
            $cart = ShoppingCart::create();
        } else {
            $cart = ShoppingCart::find($cartId);
            if (is_null($cart))
            {
                $cart = ShoppingCart::create();
            }
        }

        session([$this->sessionName => $cart->id]);

        return $cart;
    }

    private function findSession()
    {
        return session($this->sessionName);
    }

    public function getCart()
    {
        return $this->cart;
    }

    public function addToCart($productId): void
    {
        $product = $this->getProduct($productId);
        $this->cart->products()->attach($product->id);
    }

    public function getProduct($productId)
    {
        return Product::where('slug', $productId)->first();
    }
}
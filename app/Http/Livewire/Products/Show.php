<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;

class Show extends Component
{
    public $product;

    public function render()
    {
        return view('livewire.products.show')
            ->extends('layouts.app')
            ->section('content');
    }

    public function mount(Product $product)
    {
        $this->product = $product;
    }
}

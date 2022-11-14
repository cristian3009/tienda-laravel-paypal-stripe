<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;

class Index extends Component
{
    public function render()
    {
        return view('livewire.products.index', [
            'products' => Product::all()
        ]);
    }
}

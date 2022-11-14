<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    public $name, $description, $price, $thumbnail;
    use WithFileUploads;

    public function render()
    {
        return view('livewire.products.create')->extends('layouts.app')->section('content');
    }

    public function save()
    {
        $validate = $this->validate([
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required'],
            'thumbnail' => ['required', 'image', 'max:1024']
        ]);

        $validate['thumbnail'] = $this->thumbnail->store('images');
        Product::create($validate);

        return redirect('/');
    }
}

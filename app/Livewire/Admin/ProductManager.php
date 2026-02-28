<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;

class ProductManager extends Component
{
    use WithFileUploads;

    public $name, $description, $price, $stock, $image;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|image|max:2048'
    ];

    public function save()
    {
        $this->validate();

        $imagePath = null;

        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        }

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $imagePath
        ]);

        $this->reset();

        session()->flash('success', 'Produk berhasil ditambahkan.');
    }

    public function render()
    {
        return view('livewire.admin.product-manager');
    }
}
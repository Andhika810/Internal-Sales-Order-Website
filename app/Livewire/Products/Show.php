<?php

namespace App\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Show extends Component
{
    public Product $product;
    public int $qty = 1;

    public function mount(Product $product): void
    {
        $this->product = $product;
    }

    public function addToCart(): void
    {
        if (!Auth::check()) {
            $this->redirect(route('login'), navigate: true);
            return;
        }

        $qty = max(1, (int) $this->qty);

        // Ambil / buat cart milik user
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        // Kalau item sudah ada, tambah qty
        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $this->product->id)
            ->first();

        if ($item) {
            $item->update(['quantity' => $item->quantity + $qty]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $this->product->id,
                'quantity' => $qty,
            ]);
        }

        LivewireAlert::title('Berhasil')->text('Produk ditambahkan ke keranjang.')->success()->show();

        // kalau mau langsung ke keranjang, aktifkan:
        // $this->redirect(route('keranjang.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.products.show');
    }
}
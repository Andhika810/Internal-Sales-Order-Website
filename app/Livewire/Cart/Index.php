<?php

namespace App\Livewire\Cart;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $items = [];

    public function mount(): void
    {
        $this->loadCart();
    }

    public function loadCart(): void
    {
        $cart = Cart::with(['items.product'])
            ->where('user_id', Auth::id())
            ->first();

        // Simpan collection (Livewire aman untuk render & foreach)
        $this->items = $cart?->items ?? collect();
    }

    protected function findMyItem(int $itemId): CartItem
    {
        // Pastikan item ini milik user yang sedang login
        return CartItem::with('product', 'cart')
            ->where('id', $itemId)
            ->whereHas('cart', fn ($q) => $q->where('user_id', Auth::id()))
            ->firstOrFail();
    }

    public function inc(int $itemId): void
    {
        $item = $this->findMyItem($itemId);

        // Optional stok check
        if ($item->product && isset($item->product->stock)) {
            $stock = (int) $item->product->stock;
            if (($item->quantity + 1) > $stock) {
                session()->flash('error', 'Qty melebihi stok.');
                return;
            }
        }

        $item->increment('quantity');
        $this->loadCart();
    }

    public function dec(int $itemId): void
    {
        $item = $this->findMyItem($itemId);

        if ($item->quantity <= 1) {
            return;
        }

        $item->decrement('quantity');
        $this->loadCart();
    }

    public function remove(int $itemId): void
    {
        $item = $this->findMyItem($itemId);

        $item->delete();
        $this->loadCart();

        session()->flash('success', 'Item dihapus dari keranjang.');
    }

    public function clear(): void
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        if ($cart) {
            $cart->items()->delete();
        }

        $this->loadCart();
        session()->flash('success', 'Keranjang dikosongkan.');
    }

    public function goCheckout()
    {
        // kalau keranjang kosong, jangan lanjut
        $count = is_countable($this->items) ? count($this->items) : $this->items->count();
        if ($count === 0) {
            session()->flash('error', 'Keranjang masih kosong.');
            return;
        }

        return $this->redirect(route('checkout'), navigate: true);
    }

    public function render()
    {
        return view('livewire.cart.index', [
            'items' => $this->items,
        ]);
    }
} 
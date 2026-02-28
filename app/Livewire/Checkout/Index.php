<?php

namespace App\Livewire\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public string $recipient_name = '';
    public string $recipient_phone = '';
    public string $shipping_address = '';
    public ?string $notes = null;

    public function mount(): void
    {
        $u = Auth::user();
        $this->recipient_name = (string) ($u->name ?? '');
        $this->recipient_phone = (string) ($u->phone ?? '');
        $this->shipping_address = (string) ($u->address ?? '');
    }

    public function placeOrder(): void
    {
        try {
            $this->validate([
                'recipient_name' => ['required', 'string', 'min:2'],
                'recipient_phone' => ['nullable', 'string', 'max:30'],
                'shipping_address' => ['required', 'string', 'min:5'],
                'notes' => ['nullable', 'string', 'max:255'],
            ]);

            $userId = Auth::id();

            DB::transaction(function () use ($userId) {
                $cart = Cart::with(['items.product'])
                    ->where('user_id', $userId)
                    ->lockForUpdate()
                    ->first();

                if (!$cart || $cart->items->count() === 0) {
                    throw new \Exception('Keranjang kosong.');
                }

                $items = $cart->items;

                // 1) Validasi stok + lock product
                foreach ($items as $item) {
                    $product = Product::where('id', $item->product_id)
                        ->lockForUpdate()
                        ->firstOrFail();

                    if ((int) $product->stock < (int) $item->quantity) {
                        throw new \Exception("Stok {$product->name} tidak cukup.");
                    }
                }

                // 2) Total
                $total = 0;
                foreach ($items as $item) {
                    $total += ((int)($item->product->price ?? 0)) * (int)($item->quantity ?? 1);
                }

                // 3) Buat order
                $order = Order::create([
                    'user_id' => $userId,
                    'status' => 'pending',
                    'total_amount' => $total,
                    'shipping_address' => $this->shipping_address,
                    'recipient_name' => $this->recipient_name,
                    'recipient_phone' => $this->recipient_phone ?: '-',
                    'notes' => $this->notes, // kalau kolom ada
                ]);

                // 4) Buat item + kurangi stok
                foreach ($items as $item) {
                    $product = Product::where('id', $item->product_id)
                        ->lockForUpdate()
                        ->firstOrFail();

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => (int) $item->quantity,
                        'price' => (int) ($product->price ?? 0),
                    ]);

                    $product->decrement('stock', (int) $item->quantity);
                }

                // 5) Kosongkan cart
                $cart->items()->delete();
            });

            // ✅ notif sukses (ditangkap JS global di layout)
            $this->dispatch('toast', [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Pesanan berhasil dibuat.',
                'redirect' => route('pesanan.riwayat'),
            ]);

        } catch (\Throwable $e) {
            $this->dispatch('toast', [
                'type' => 'error',
                'title' => 'Gagal',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function render()
    {
        $cart = Cart::with(['items.product'])
            ->where('user_id', Auth::id())
            ->first();

        $items = $cart?->items ?? collect();

        $total = 0;
        foreach ($items as $ci) {
            $total += ((int)($ci->product->price ?? 0)) * (int)($ci->quantity ?? 1);
        }

        return view('livewire.checkout.index', compact('cart', 'items', 'total'));
    }
}
<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ADMIN (PERMANENT)
        |--------------------------------------------------------------------------
        | updateOrCreate memastikan:
        | - kalau belum ada → dibuat
        | - kalau sudah ada → diupdate (termasuk password)
        */

        $admin = User::updateOrCreate(
            ['email' => 'admin@caturmala.test'],
            [
                'name' => 'Admin PT Caturmala',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'address' => 'Jl. Mawar No. 1, Jakarta',
                'phone' => '081234567890',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | CUSTOMER DUMMY
        |--------------------------------------------------------------------------
        */

        $customer = User::updateOrCreate(
            ['email' => 'customer@tokobunga.test'],
            [
                'name' => 'Pelanggan',
                'password' => Hash::make('customer123'),
                'role' => 'customer',
                'address' => 'Jl. Melati No. 2, Bandung',
                'phone' => '082345678901',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | PRODUCTS
        |--------------------------------------------------------------------------
        */

        if (Product::count() === 0) {
            Product::factory(10)->create();
        }

        /*
        |--------------------------------------------------------------------------
        | CART DUMMY
        |--------------------------------------------------------------------------
        */

        $cart = Cart::firstOrCreate(['user_id' => $customer->id]);

        $products = Product::inRandomOrder()->take(3)->get();

        foreach ($products as $product) {
            CartItem::firstOrCreate([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
            ], [
                'quantity' => rand(1, 5),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | ORDERS DUMMY
        |--------------------------------------------------------------------------
        */

        if (Order::where('user_id', $customer->id)->count() === 0) {
            for ($i = 0; $i < 3; $i++) {

                $order = Order::create([
                    'user_id' => $customer->id,
                    'total_amount' => rand(100000, 500000),
                    'status' => 'completed',
                    'shipping_address' => $customer->address,
                    'recipient_name' => $customer->name,
                    'recipient_phone' => $customer->phone,
                ]);

                foreach (Product::inRandomOrder()->take(2)->get() as $product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => rand(1, 3),
                        'price' => $product->price,
                    ]);
                }
            }
        }
    }
}
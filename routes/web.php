<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;

use App\Livewire\Admin\Users as AdminUsers;
use App\Livewire\Admin\Products as AdminProducts;
use App\Livewire\Admin\Orders as AdminOrders;

use App\Livewire\Cart\Index as CartIndex;
use App\Livewire\Orders\History as OrderHistory;
use App\Livewire\Orders\Track as OrderTrack;

use App\Livewire\Products\Index as ProductsIndex;
use App\Livewire\Products\Show as ProductsShow;

use App\Livewire\Checkout\Index as CheckoutIndex;

Route::get('/', function () {
    return view('welcome');
})->name('home');

/**
 * Dashboard (khusus admin jika middleware RedirectPropperRole kamu memang begitu)
 */
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', \App\Http\Middleware\RedirectPropperRole::class])
    ->name('dashboard');

/**
 * Settings
 */
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

/**
 * Produk (public)
 */
Route::get('/produk', ProductsIndex::class)->name('produk.index');
Route::get('/produk/{product}', ProductsShow::class)->name('produk.show');

/**
 * Customer routes (wajib login)
 */
Route::middleware(['auth'])->group(function () {
    Route::get('/keranjang', CartIndex::class)->name('keranjang.index');

    Route::get('/checkout', CheckoutIndex::class)->name('checkout');

    Route::get('/pesanan/riwayat', OrderHistory::class)->name('pesanan.riwayat');
    Route::get('/pesanan/lacak', OrderTrack::class)->name('pesanan.lacak');
});

/**
 * Admin routes
 */
Route::middleware(['auth', \App\Http\Middleware\RedirectPropperRole::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/pengguna', AdminUsers::class)->name('pengguna');
        Route::get('/produk', AdminProducts::class)->name('produk');
        Route::get('/pesanan', AdminOrders::class)->name('pesanan');
    });

require __DIR__.'/auth.php';
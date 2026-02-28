<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Login extends Component
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $this->validate();
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $user = Auth::user();

        // Default: user/customer masuk ke halaman produk
        $targetRoute = route('produk.index', absolute: false);

        // Admin masuk ke dashboard (atau bisa langsung ke /admin/produk kalau kamu mau)
        if ($user?->isAdmin()) {
            $targetRoute = route('dashboard', absolute: false);
            // alternatif:
            // $targetRoute = route('admin.produk', absolute: false);
        }

        // Kalau kamu mau user langsung ke keranjang, aktifkan ini:
        // if ($user?->isCustomer()) {
        //     $targetRoute = route('keranjang.index', absolute: false);
        // }

        // Kalau sebelumnya ada intended URL (misal user akses halaman protected),
        // Laravel akan arahkan ke sana. Tapi kita "kunci" sesuai role agar konsisten:
        $this->redirect($targetRoute, navigate: true);
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));
        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}
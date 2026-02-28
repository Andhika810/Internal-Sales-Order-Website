<div class="flex flex-col gap-6">

    <x-auth-header
        :title="__('Log in to your account')"
        :description="__('Secure access • PT Caturmala')" />

    <x-auth-session-status class="text-center text-sm text-white/70" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-5">

        <!-- EMAIL -->
        <div>
            <label class="block text-sm font-medium text-white/80 mb-2">
                {{ __('Email address') }}
            </label>

            <input
                wire:model="email"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="email@example.com"
                class="w-full rounded-xl border border-white/10
                       bg-slate-900/70
                       px-4 py-3
                       text-white
                       placeholder:text-white/40
                       outline-none transition
                       focus:border-blue-500/60
                       focus:ring-2 focus:ring-blue-500/20"
            />

            @error('email')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- PASSWORD -->
        <div>
            <div class="flex justify-between mb-2">
                <label class="text-sm font-medium text-white/80">
                    {{ __('Password') }}
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       wire:navigate
                       class="text-sm text-blue-400 hover:text-blue-300 transition">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <input
                wire:model="password"
                type="password"
                required
                autocomplete="current-password"
                placeholder="{{ __('Password') }}"
                class="w-full rounded-xl border border-white/10
                       bg-slate-900/70
                       px-4 py-3
                       text-white
                       placeholder:text-white/40
                       outline-none transition
                       focus:border-blue-500/60
                       focus:ring-2 focus:ring-blue-500/20"
            />

            @error('password')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- REMEMBER -->
        <div class="flex items-center justify-between text-sm text-white/70">
            <label class="inline-flex items-center gap-2">
                <input
                    wire:model="remember"
                    type="checkbox"
                    class="rounded border-white/20 bg-slate-800 text-blue-500 focus:ring-blue-500/30"
                />
                {{ __('Remember me') }}
            </label>

            <span class="text-xs text-white/40">
                Protected by company policy
            </span>
        </div>

        <!-- BUTTON -->
        <button
            type="submit"
            class="w-full rounded-xl
                   bg-gradient-to-r from-blue-700 to-blue-600
                   py-3 font-semibold text-white
                   shadow-lg shadow-blue-900/40
                   transition hover:brightness-110">
            {{ __('Log in') }}
        </button>

    </form>

    @if (Route::has('register'))
        <div class="text-center text-sm text-white/60">
            {{ __("Don't have an account?") }}
            <a href="{{ route('register') }}"
               wire:navigate
               class="font-semibold text-blue-400 hover:text-blue-300">
                {{ __('Sign up') }}
            </a>
        </div>
    @endif

</div>
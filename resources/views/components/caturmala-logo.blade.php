@props([
    'class' => 'h-10 w-10',
    'variant' => 'badge', // badge | mark
])

@php
    $isBadge = $variant === 'badge';
@endphp

<div {{ $attributes->merge(['class' => 'inline-flex items-center justify-center rounded-xl bg-white/5 ring-1 ring-white/10 '.$class]) }}>
    <svg viewBox="0 0 64 64" class="h-7 w-7" fill="none" aria-hidden="true">
        <!-- outer -->
        <path d="M12 16.5C12 13.462 14.462 11 17.5 11h29C49.538 11 52 13.462 52 16.5v31C52 50.538 49.538 53 46.5 53h-29C14.462 53 12 50.538 12 47.5v-31Z"
              stroke="currentColor" stroke-width="2" class="text-slate-200/90"/>

        <!-- aluminum bars -->
        <path d="M20 41.5 32 20 44 41.5" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"
              class="text-blue-300"/>
        <path d="M24.5 41.5 32 28 39.5 41.5" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"
              class="text-cyan-200/90"/>

        <!-- Caturmala cut -->
        <path d="M19.5 23.5h10.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="text-slate-200/80"/>
        <path d="M34 23.5h10.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="text-slate-200/80"/>

        <!-- small dot accent -->
        <circle cx="48.5" cy="16.5" r="2" class="fill-blue-400"/>
    </svg>
</div>
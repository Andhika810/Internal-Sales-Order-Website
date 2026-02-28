<div class="min-h-[calc(100vh-0px)] w-full bg-[#070D18]">
    <section
        class="relative w-full overflow-hidden rounded-[28px]
               border border-white/10 bg-gradient-to-b from-[#0E1A2E] via-[#0B1426] to-[#070D18]
               shadow-[0_30px_80px_rgba(0,0,0,.45)]"
    >
        {{-- soft grid + glow --}}
        <div class="pointer-events-none absolute inset-0 opacity-[0.18]"
             style="background-image: linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px); background-size: 56px 56px;">
        </div>
        <div class="pointer-events-none absolute -top-28 -left-28 h-[420px] w-[420px] rounded-full bg-sky-500/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-28 -right-28 h-[420px] w-[420px] rounded-full bg-indigo-500/10 blur-3xl"></div>

        <div class="relative mx-auto w-full max-w-6xl px-4 py-6 md:px-8 md:py-8">
            {{-- Header --}}
            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-semibold tracking-tight text-white">
                        Manajemen Pengguna
                    </h1>
                    <p class="mt-1 text-sm md:text-base text-white/70">
                        Tambah, ubah role, dan kelola data user internal.
                    </p>
                </div>

                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-2 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-3 py-1 text-xs font-medium text-emerald-200">
                        <span class="h-2 w-2 rounded-full bg-emerald-300 shadow-[0_0_0_4px_rgba(16,185,129,.15)]"></span>
                        Sistem aktif
                    </span>
                </div>
            </div>

            {{-- Toolbar --}}
            <div class="mt-6 grid gap-3 md:grid-cols-12">
                <div class="md:col-span-8">
                    <label class="block text-xs font-medium text-white/70 mb-2">Cari pengguna</label>
                    <div class="relative">
                        <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-white/45">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                <path d="M21 21L16.65 16.65M10.5 18C14.6421 18 18 14.6421 18 10.5C18 6.35786 14.6421 3 10.5 3C6.35786 3 3 6.35786 3 10.5C3 14.6421 6.35786 18 10.5 18Z"
                                      stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </span>

                        <input
                            type="text"
                            wire:model.live.debounce.500ms="search"
                            placeholder="Cari nama / email..."
                            class="w-full rounded-xl border border-white/10 bg-white/5 pl-10 pr-4 py-3 text-white placeholder:text-white/35
                                   outline-none transition focus:border-sky-400/40 focus:ring-4 focus:ring-sky-500/10"
                        />
                    </div>
                </div>

                <div class="md:col-span-4 md:justify-self-end">
                    <label class="block text-xs font-medium text-white/70 mb-2">Tampilkan</label>
                    <select
                        wire:model="perPage"
                        class="w-full md:w-[160px] rounded-xl border border-white/10 bg-white/5 px-3 py-3 text-white
                               outline-none transition focus:border-sky-400/40 focus:ring-4 focus:ring-sky-500/10"
                    >
                        <option class="bg-[#0B1426]" value="5">5</option>
                        <option class="bg-[#0B1426]" value="10">10</option>
                        <option class="bg-[#0B1426]" value="25">25</option>
                        <option class="bg-[#0B1426]" value="50">50</option>
                    </select>
                </div>
            </div>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="mt-4 rounded-2xl border border-rose-400/20 bg-rose-500/10 px-4 py-3 text-rose-100">
                    <div class="text-sm font-semibold mb-1">Periksa input:</div>
                    <ul class="list-disc pl-5 text-sm text-rose-100/90">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Card --}}
            <div class="mt-6 rounded-[22px] border border-white/10 bg-white/[0.04] shadow-[0_20px_60px_rgba(0,0,0,.35)]">
                <div class="p-5 md:p-7">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <div class="text-sm font-semibold text-white">
                                {{ $isEdit ? 'Edit Pengguna' : 'Tambah Pengguna' }}
                            </div>
                            <div class="text-xs text-white/55">
                                Isi data dengan benar untuk menjaga konsistensi sistem.
                            </div>
                        </div>

                        @if($isEdit)
                            <span class="inline-flex items-center rounded-full border border-sky-400/20 bg-sky-500/10 px-3 py-1 text-xs font-medium text-sky-200">
                                Mode edit aktif
                            </span>
                        @endif
                    </div>

                    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="mt-5 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1 text-xs font-medium text-white/70">Nama</label>
                                <input type="text" wire:model.defer="name"
                                       class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder:text-white/35
                                              outline-none transition focus:border-sky-400/40 focus:ring-4 focus:ring-sky-500/10"
                                       placeholder="Nama lengkap" required>
                            </div>

                            <div>
                                <label class="block mb-1 text-xs font-medium text-white/70">Email</label>
                                <input type="email" wire:model.defer="email"
                                       class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder:text-white/35
                                              outline-none transition focus:border-sky-400/40 focus:ring-4 focus:ring-sky-500/10"
                                       placeholder="email@company.com" required>
                            </div>

                            <div>
                                <label class="block mb-1 text-xs font-medium text-white/70">Role</label>
                                <select wire:model.defer="role"
                                        class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white
                                               outline-none transition focus:border-sky-400/40 focus:ring-4 focus:ring-sky-500/10">
                                    <option class="bg-[#0B1426]" value="admin">Admin</option>
                                    <option class="bg-[#0B1426]" value="customer">Customer</option>
                                </select>
                            </div>

                            <div>
                                <label class="block mb-1 text-xs font-medium text-white/70">Telepon</label>
                                <input type="text" wire:model.defer="phone"
                                       class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder:text-white/35
                                              outline-none transition focus:border-sky-400/40 focus:ring-4 focus:ring-sky-500/10"
                                       placeholder="08xxxxxxxxxx">
                            </div>
                        </div>

                        <div>
                            <label class="block mb-1 text-xs font-medium text-white/70">Alamat</label>
                            <textarea wire:model.defer="address" rows="3"
                                      class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder:text-white/35
                                             outline-none transition focus:border-sky-400/40 focus:ring-4 focus:ring-sky-500/10"
                                      placeholder="Alamat lengkap"></textarea>
                        </div>

                        @if(!$isEdit)
                            <div>
                                <label class="block mb-1 text-xs font-medium text-white/70">Password</label>
                                <input type="password" wire:model.defer="password"
                                       class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder:text-white/35
                                              outline-none transition focus:border-sky-400/40 focus:ring-4 focus:ring-sky-500/10"
                                       placeholder="Minimal 8 karakter" required>
                            </div>
                        @endif

                        <div class="flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between pt-2">
                            <div class="text-[11px] text-white/45">
                                Tips: gunakan role <span class="text-white/70 font-medium">Admin</span> hanya untuk akun internal.
                            </div>

                            <div class="flex gap-2 justify-end">
                                <button type="submit"
                                        class="inline-flex items-center justify-center rounded-xl bg-sky-500/15 px-5 py-3 text-sm font-semibold text-sky-200
                                               ring-1 ring-sky-400/25 transition hover:bg-sky-500/20 focus:outline-none focus:ring-4 focus:ring-sky-500/15">
                                    {{ $isEdit ? 'Perbarui' : 'Tambah' }} Pengguna
                                </button>

                                @if($isEdit)
                                    <button type="button" wire:click="resetForm"
                                            class="inline-flex items-center justify-center rounded-xl border border-white/12 bg-white/5 px-5 py-3 text-sm font-semibold text-white/85
                                                   transition hover:bg-white/10 hover:border-white/20 focus:outline-none focus:ring-4 focus:ring-sky-500/10">
                                        Batal
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="mt-6 rounded-[22px] border border-white/10 bg-white/[0.04] shadow-[0_20px_60px_rgba(0,0,0,.35)] overflow-hidden">
                <div class="flex items-center justify-between px-5 py-4 md:px-7 border-b border-white/10">
                    <div>
                        <div class="text-sm font-semibold text-white">Daftar Pengguna</div>
                        <div class="text-xs text-white/55">Data ditampilkan sesuai pencarian & pagination.</div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-white/[0.03] text-white/70">
                            <tr class="text-left text-xs">
                                <th class="px-5 py-3 md:px-7">Nama</th>
                                <th class="px-5 py-3 md:px-7">Email</th>
                                <th class="px-5 py-3 md:px-7">Role</th>
                                <th class="px-5 py-3 md:px-7">Telepon</th>
                                <th class="px-5 py-3 md:px-7 text-right">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-white/10">
                            @forelse($users as $user)
                                <tr class="text-sm text-white/85 hover:bg-white/[0.04] transition">
                                    <td class="px-5 py-4 md:px-7">
                                        <div class="font-medium text-white">{{ $user->name }}</div>
                                    </td>

                                    <td class="px-5 py-4 md:px-7 text-white/75">
                                        {{ $user->email }}
                                    </td>

                                    <td class="px-5 py-4 md:px-7">
                                        @php $role = strtolower($user->role ?? 'customer'); @endphp
                                        @if($role === 'admin')
                                            <span class="inline-flex items-center gap-2 rounded-full border border-emerald-400/20 bg-emerald-500/10 px-2.5 py-1 text-[11px] font-medium text-emerald-200">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-300"></span>
                                                Admin
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-2 rounded-full border border-sky-400/20 bg-sky-500/10 px-2.5 py-1 text-[11px] font-medium text-sky-200">
                                                <span class="h-1.5 w-1.5 rounded-full bg-sky-300"></span>
                                                Customer
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-4 md:px-7 text-white/75">
                                        {{ $user->phone ?? '—' }}
                                    </td>

                                    <td class="px-5 py-4 md:px-7">
                                        <div class="flex items-center justify-end gap-2">
                                            <button
                                                wire:click="edit({{ $user->id }})"
                                                class="inline-flex items-center justify-center rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-xs font-medium text-white/85
                                                       transition hover:bg-white/10 hover:border-white/20 focus:outline-none focus:ring-4 focus:ring-sky-500/10"
                                            >
                                                Edit
                                            </button>

                                            <button
                                                x-data
                                                @click.prevent="Swal.fire({
                                                    title: 'Yakin hapus pengguna ini?',
                                                    text: 'Tindakan ini tidak dapat dibatalkan.',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Hapus',
                                                    cancelButtonText: 'Batal',
                                                    reverseButtons: true,
                                                }).then((result) => {
                                                    if (result.isConfirmed) { $wire.delete({{ $user->id }}); }
                                                });"
                                                class="inline-flex items-center justify-center rounded-lg border border-rose-400/15 bg-rose-500/10 px-3 py-2 text-xs font-medium text-rose-100
                                                       transition hover:bg-rose-500/15 hover:border-rose-400/25 focus:outline-none focus:ring-4 focus:ring-rose-500/15"
                                            >
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-10 md:px-7 text-center text-sm text-white/60">
                                        Tidak ada data pengguna.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-5 py-4 md:px-7 border-t border-white/10">
                    <div class="text-white/70">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between text-[11px] text-white/45">
                <span>© {{ date('Y') }} PT Caturmala · Aluminium & Solutions</span>
                <span>Navy-metal theme · Users</span>
            </div>
        </div>
    </section>
</div>
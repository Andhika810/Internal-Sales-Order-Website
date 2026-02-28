<div class="relative min-h-screen w-full">
    <div class="fixed inset-0 -z-10 bg-[#070D18]"></div>

    <div class="mx-auto max-w-4xl px-6 py-10">
        <div class="rounded-2xl border border-white/10 bg-white/5 p-8 shadow-lg">

            <h1 class="text-2xl font-semibold text-white mb-6">
                Tambah Produk Baru
            </h1>

            @if(session()->has('success'))
                <div class="mb-4 p-3 rounded-lg bg-emerald-500/10 text-emerald-200 border border-emerald-400/20">
                    {{ session('success') }}
                </div>
            @endif

            <form wire:submit.prevent="save" class="space-y-5">

                <div>
                    <label class="text-sm text-white/70">Nama Produk</label>
                    <input type="text" wire:model="name"
                        class="mt-1 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-4 focus:ring-sky-500/10 outline-none">
                    @error('name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="text-sm text-white/70">Deskripsi</label>
                    <textarea wire:model="description"
                        class="mt-1 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-4 focus:ring-sky-500/10 outline-none"></textarea>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-white/70">Harga</label>
                        <input type="number" wire:model="price"
                            class="mt-1 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-4 focus:ring-sky-500/10 outline-none">
                    </div>

                    <div>
                        <label class="text-sm text-white/70">Stok</label>
                        <input type="number" wire:model="stock"
                            class="mt-1 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-4 focus:ring-sky-500/10 outline-none">
                    </div>
                </div>

                <div>
                    <label class="text-sm text-white/70">Gambar Produk</label>
                    <input type="file" wire:model="image"
                        class="mt-1 w-full text-white">
                </div>

                <button type="submit"
                    class="w-full rounded-xl bg-sky-500/20 border border-sky-400/30 px-5 py-3 text-white font-semibold hover:bg-sky-500/30 transition">
                    Simpan Produk
                </button>

            </form>
        </div>
    </div>
</div>
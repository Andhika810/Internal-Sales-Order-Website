<div class="relative min-h-screen w-full">
    {{-- Force navy background --}}
    <div class="fixed inset-0 -z-10 bg-[#070D18]"></div>

    <div class="relative mx-auto max-w-7xl px-6 py-10">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-semibold text-white">Manajemen Produk</h1>
                <p class="text-white/60 text-sm mt-1">
                    Tambah, edit, dan kelola katalog aluminium PT Caturmala.
                </p>
            </div>
        </div>

        {{-- SEARCH & FILTER --}}
        <div class="flex flex-col sm:flex-row gap-4 mb-8">
            <input type="text"
                wire:model.live.debounce.500ms="search"
                placeholder="Cari produk..."
                class="w-full sm:w-80 rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder:text-white/40
                       focus:border-sky-400/40 focus:ring-4 focus:ring-sky-500/10 outline-none transition" />

            <select wire:model="perPage"
                class="w-full sm:w-40 rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white
                       focus:border-sky-400/40 focus:ring-4 focus:ring-sky-500/10 outline-none transition">
                <option class="bg-[#0B1426]" value="5">5</option>
                <option class="bg-[#0B1426]" value="10">10</option>
                <option class="bg-[#0B1426]" value="25">25</option>
                <option class="bg-[#0B1426]" value="50">50</option>
            </select>
        </div>

        {{-- FORM CARD --}}
        <div class="rounded-2xl border border-white/10 bg-white/5 p-8 mb-10 shadow-lg">

            <h2 class="text-xl font-semibold text-white mb-6">
                {{ $isEdit ? 'Edit Produk' : 'Tambah Produk Baru' }}
            </h2>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-rose-500/10 border border-rose-400/20 text-rose-200 rounded-lg">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-y-6" enctype="multipart/form-data">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm text-white/70">Nama Produk</label>
                        <input type="text" wire:model.defer="name"
                            class="mt-2 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-4 focus:ring-sky-500/10 outline-none">
                    </div>

                    <div>
                        <label class="text-sm text-white/70">Harga</label>
                        <input type="number" wire:model.defer="price"
                            class="mt-2 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-4 focus:ring-sky-500/10 outline-none">
                    </div>

                    <div>
                        <label class="text-sm text-white/70">Stok</label>
                        <input type="number" wire:model.defer="stock"
                            class="mt-2 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-4 focus:ring-sky-500/10 outline-none">
                    </div>

                    <div>
                        <label class="text-sm text-white/70">Tersedia?</label>
                        <select wire:model.defer="is_available"
                            class="mt-2 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-4 focus:ring-sky-500/10 outline-none">
                            <option class="bg-[#0B1426]" value="1">Ya</option>
                            <option class="bg-[#0B1426]" value="0">Tidak</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="text-sm text-white/70">Deskripsi</label>
                    <textarea wire:model.defer="description"
                        class="mt-2 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-4 focus:ring-sky-500/10 outline-none"></textarea>
                </div>

                <div>
                    <label class="text-sm text-white/70">Thumbnail Produk</label>
                    <input type="file" wire:model="thumbnail"
                        class="mt-2 w-full text-white">

                    @if($thumbnail)
                        <img src="{{ $thumbnail->temporaryUrl() }}" class="h-24 mt-4 rounded-xl border border-white/10">
                    @elseif($image)
                        <img src="{{ asset('storage/'.$image) }}" class="h-24 mt-4 rounded-xl border border-white/10">
                    @endif
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="px-6 py-3 rounded-xl bg-sky-500/20 border border-sky-400/30 text-white font-semibold hover:bg-sky-500/30 transition">
                        {{ $isEdit ? 'Perbarui' : 'Tambah' }} Produk
                    </button>

                    @if($isEdit)
                        <button type="button"
                            wire:click="resetForm"
                            class="px-5 py-3 rounded-xl border border-white/10 text-white hover:bg-white/10 transition">
                            Batal
                        </button>
                    @endif
                </div>

            </form>
        </div>

        {{-- TABLE --}}
        <div class="rounded-2xl border border-white/10 bg-white/5 overflow-hidden shadow-lg">
            <table class="min-w-full text-sm">
                <thead class="bg-white/10 text-white/70">
                    <tr>
                        <th class="px-6 py-4 text-left">Produk</th>
                        <th class="px-6 py-4 text-left">Harga</th>
                        <th class="px-6 py-4 text-left">Stok</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="border-t border-white/10 hover:bg-white/5 transition">
                            <td class="px-6 py-4 flex items-center gap-3">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}"
                                         class="h-10 w-10 rounded-lg object-cover">
                                @endif
                                <span class="text-white">{{ $product->name }}</span>
                            </td>

                            <td class="px-6 py-4 text-white">
                                Rp{{ number_format($product->price,0,',','.') }}
                            </td>

                            <td class="px-6 py-4 text-white">
                                {{ $product->stock }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                    {{ $product->is_available ? 'bg-emerald-500/15 text-emerald-300 border border-emerald-400/20' : 'bg-rose-500/15 text-rose-300 border border-rose-400/20' }}">
                                    {{ $product->is_available ? 'Available' : 'Unavailable' }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <button wire:click="edit({{ $product->id }})"
                                    class="text-sky-300 hover:underline mr-3">
                                    Edit
                                </button>

                                <button wire:click="delete({{ $product->id }})"
                                    class="text-rose-300 hover:underline">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-6 border-t border-white/10">
                {{ $products->links() }}
            </div>
        </div>

    </div>
</div>
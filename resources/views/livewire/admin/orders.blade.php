<div class="min-h-screen w-full bg-[#070D18]">
    <section
        class="relative w-full overflow-hidden rounded-[28px]
               border border-[#13233B]
               bg-gradient-to-b from-[#0B1A2F] via-[#081426] to-[#060C18]
               shadow-[0_30px_80px_rgba(0,0,0,.6)]"
    >
        <div class="relative mx-auto w-full max-w-6xl px-6 py-8">

            {{-- Header --}}
            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-semibold text-sky-200">
                        Manajemen Pesanan
                    </h1>
                    <p class="mt-1 text-sm text-sky-300/70">
                        Kelola status dan monitoring pesanan pelanggan.
                    </p>
                </div>

                <span class="inline-flex items-center gap-2 rounded-full
                             border border-emerald-500/30
                             bg-emerald-500/15
                             px-3 py-1 text-xs font-medium text-emerald-300">
                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                    Sistem aktif
                </span>
            </div>

            {{-- Toolbar --}}
            <div class="mt-6 grid gap-4 md:grid-cols-12">

                <div class="md:col-span-8">
                    <label class="block text-xs text-sky-300/70 mb-2">
                        Cari pesanan
                    </label>

                    <input
                        type="text"
                        wire:model.live.debounce.500ms="search"
                        placeholder="Cari pesanan..."
                        class="w-full rounded-xl
                               border border-[#1C2F4A]
                               bg-[#0C182B]
                               px-4 py-3 text-sky-100
                               placeholder:text-sky-400/40
                               focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30
                               outline-none transition"
                    />
                </div>

                <div class="md:col-span-4 md:justify-self-end">
                    <label class="block text-xs text-sky-300/70 mb-2">
                        Tampilkan
                    </label>

                    <select
                        wire:model="perPage"
                        class="w-full md:w-[160px] rounded-xl
                               border border-[#1C2F4A]
                               bg-[#0C182B]
                               px-4 py-3 text-sky-100
                               focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30
                               outline-none transition"
                    >
                        <option class="bg-[#0C182B]" value="5">5</option>
                        <option class="bg-[#0C182B]" value="10">10</option>
                        <option class="bg-[#0C182B]" value="25">25</option>
                        <option class="bg-[#0C182B]" value="50">50</option>
                    </select>
                </div>
            </div>

            {{-- Edit Status --}}
            @if($isEdit)
            <div class="mt-8 rounded-2xl border border-[#13233B] bg-[#0A1627] p-6 shadow-lg">
                <h2 class="text-lg font-semibold text-sky-200 mb-4">
                    Perbarui Status Pesanan
                </h2>

                <form wire:submit.prevent="update" class="space-y-4">
                    <select wire:model.defer="status"
                            class="w-full rounded-xl
                                   border border-[#1C2F4A]
                                   bg-[#0C182B]
                                   px-4 py-3 text-sky-100
                                   focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30
                                   outline-none transition">
                        <option value="pending">Pending</option>
                        <option value="processing">Diproses</option>
                        <option value="completed">Selesai</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>

                    <div class="flex justify-end gap-3 pt-3">
                        <button type="submit"
                                class="px-6 py-3 rounded-xl
                                       bg-sky-600 hover:bg-sky-500
                                       text-white font-semibold transition">
                            Perbarui Status
                        </button>

                        <button type="button"
                                wire:click="$set('isEdit', false)"
                                class="px-6 py-3 rounded-xl
                                       border border-[#1C2F4A]
                                       text-sky-300 hover:bg-[#0C182B] transition">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
            @endif

            {{-- Table --}}
            <div class="mt-8 rounded-2xl border border-[#13233B] bg-[#0A1627] overflow-hidden">
                <table class="min-w-full text-sm">
                    <thead class="bg-[#0F1F35] text-sky-300">
                        <tr>
                            <th class="px-6 py-3 text-left">Pelanggan</th>
                            <th class="px-6 py-3 text-left">Total</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Alamat</th>
                            <th class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[#13233B] text-sky-100">
                        @foreach($orders as $order)
                            <tr class="hover:bg-[#0C182B] transition">
                                <td class="px-6 py-4">
                                    {{ $order->user->name ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    Rp{{ number_format($order->total_amount,0,',','.') }}
                                </td>

                                <td class="px-6 py-4">
                                    @php $status = $order->status; @endphp

                                    @if($status === 'pending')
                                        <span class="px-3 py-1 rounded-full text-xs bg-yellow-500/20 text-yellow-300 border border-yellow-500/30">
                                            Pending
                                        </span>
                                    @elseif($status === 'processing')
                                        <span class="px-3 py-1 rounded-full text-xs bg-blue-500/20 text-blue-300 border border-blue-500/30">
                                            Diproses
                                        </span>
                                    @elseif($status === 'completed')
                                        <span class="px-3 py-1 rounded-full text-xs bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs bg-rose-500/20 text-rose-300 border border-rose-500/30">
                                            Dibatalkan
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    {{ $order->shipping_address }}
                                </td>

                                <td class="px-6 py-4 text-right space-x-3">
                                    <button wire:click="edit({{ $order->id }})"
                                            class="text-sky-400 hover:text-sky-300">
                                        Edit
                                    </button>

                                    <button
                                        x-data
                                        @click.prevent="Swal.fire({
                                            title: 'Yakin hapus pesanan ini?',
                                            icon: 'warning',
                                            showCancelButton: true
                                        }).then((r) => {
                                            if (r.isConfirmed) $wire.delete({{ $order->id }});
                                        });"
                                        class="text-rose-400 hover:text-rose-300">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-6 border-t border-[#13233B]">
                    {{ $orders->links() }}
                </div>
            </div>

        </div>
    </section>
</div>
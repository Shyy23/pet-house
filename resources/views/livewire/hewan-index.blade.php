<div class="relative">
    {{-- Container utama dibuat relative, TAPI overflow-hidden dipindahkan ke div dekorasi di bawah --}}

    {{-- 1. DECORATIVE BACKGROUND (Dipisah agar tidak memotong Modal) --}}
    <div
        class="absolute inset-0 bg-gradient-to-br from-orange-50 via-white to-yellow-50 rounded-2xl shadow-lg border border-orange-100 overflow-hidden -z-10">
        <div
            class="absolute top-0 right-0 w-64 h-64 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
        </div>
        <div
            class="absolute bottom-0 left-0 w-64 h-64 bg-yellow-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
        </div>
    </div>

    {{-- WRAPPER CONTENT (Padding) --}}
    <div class="p-4 md:p-6">

        {{-- 2. HEADER --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 relative z-10">
            <div class="flex items-center gap-3">
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-3 rounded-xl shadow-lg">
                    <i class="fa-solid fa-paw text-white text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                        Daftar Hewan
                    </h2>
                    <p class="text-sm text-gray-600 font-medium mt-0.5">
                        <i class="fa-solid fa-home text-orange-500 mr-1"></i>
                        Padalarang Pet House
                    </p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                {{-- Filter Jenis --}}
                <select wire:model.live="jenisFilter"
                    class="w-full md:w-auto border-2 border-orange-200 rounded-xl shadow-sm px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 cursor-pointer bg-white hover:border-orange-300 transition-all duration-200 font-medium text-gray-700">
                    <option value="">🐾 Semua Jenis</option>
                    @foreach($list_jenis as $jenis)
                    <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis }}</option>
                    @endforeach
                </select>

                {{-- Search --}}
                <div class="relative w-full md:w-auto group">
                    <input wire:model.live.debounce.300ms="search" type="text"
                        class="w-full md:w-72 border-2 border-orange-200 rounded-xl shadow-sm pl-11 pr-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 hover:border-orange-300 transition-all duration-200 bg-white font-medium"
                        placeholder="Cari nama hewan...">
                    <i
                        class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-orange-400 group-hover:text-orange-500 transition-colors"></i>
                </div>

                {{-- Tombol Tambah --}}
                <button wire:click="create"
                    class="w-full md:w-auto bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:from-orange-600 hover:to-orange-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Hewan</span>
                </button>
            </div>
        </div>

        {{-- 3. TAMPILAN DESKTOP (TABEL) --}}
        <div
            class="hidden md:block overflow-hidden border-2 border-orange-100 rounded-2xl shadow-md bg-white relative z-10">
            <table class="min-w-full divide-y divide-orange-100 text-sm">
                <thead class="bg-gradient-to-r from-orange-50 to-yellow-50">
                    <tr>
                        <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase text-xs tracking-wider">
                            <i class="fa-solid fa-paw mr-2 text-orange-500"></i>Hewan
                        </th>
                        <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase text-xs tracking-wider">
                            <i class="fa-solid fa-tag mr-2 text-orange-500"></i>Kategori
                        </th>
                        <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase text-xs tracking-wider">
                            <i class="fa-solid fa-calendar mr-2 text-orange-500"></i>Umur
                        </th>
                        <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase text-xs tracking-wider">
                            <i class="fa-solid fa-info-circle mr-2 text-orange-500"></i>Keterangan
                        </th>
                        <th class="px-6 py-4 text-right font-bold text-gray-700 uppercase text-xs tracking-wider">
                            <i class="fa-solid fa-cog mr-2 text-orange-500"></i>Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-orange-50">
                    @forelse($hewans as $hewan)
                    <tr
                        class="hover:bg-gradient-to-r hover:from-orange-50 hover:to-yellow-50 transition-all duration-200 group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="h-14 w-14 shrink-0 relative">
                                    @if($hewan->foto)
                                    <img class="h-14 w-14 rounded-xl object-cover border-2 border-orange-200 shadow-md group-hover:border-orange-400 transition-all duration-200"
                                        src="{{ asset('storage/'.$hewan->foto) }}" alt="{{ $hewan->nama }}">
                                    @else
                                    <div
                                        class="h-14 w-14 rounded-xl bg-gradient-to-br from-orange-100 to-yellow-100 flex items-center justify-center text-orange-600 font-bold text-lg border-2 border-orange-200 shadow-md group-hover:scale-105 transition-transform">
                                        {{ substr($hewan->nama, 0, 1) }}
                                    </div>
                                    @endif
                                    <div class="absolute -bottom-1 -right-1 bg-white rounded-full p-1 shadow-md">
                                        <i
                                            class="fa-solid {{ $hewan->jenis_kelamin == 'Jantan' ? 'fa-mars text-blue-500' : 'fa-venus text-pink-500' }} text-xs"></i>
                                    </div>
                                </div>
                                <div>
                                    <div
                                        class="font-bold text-gray-900 text-base group-hover:text-orange-600 transition-colors">
                                        {{ $hewan->nama }}</div>
                                    <div class="text-xs text-gray-500 flex items-center gap-2 mt-1">
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full {{ $hewan->jenis_kelamin == 'Jantan' ? 'bg-blue-50 text-blue-600' : 'bg-pink-50 text-pink-600' }} font-medium">
                                            <i
                                                class="fa-solid {{ $hewan->jenis_kelamin == 'Jantan' ? 'fa-mars' : 'fa-venus' }}"></i>
                                            {{ $hewan->jenis_kelamin }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-bold bg-gradient-to-r from-orange-100 to-yellow-100 text-gray-800 border border-orange-200 shadow-sm">
                                <i class="fa-solid fa-tag mr-1.5 text-orange-500"></i>
                                {{ $hewan->jenis->nama_jenis }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-gray-700 font-semibold">{{ $hewan->umur_bulan }}</span>
                            <span class="text-gray-500 text-xs ml-1">Bulan</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 max-w-[250px] truncate text-sm"
                            title="{{ $hewan->keterangan }}">
                            {{ $hewan->keterangan ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap text-sm font-medium space-x-2">
                            <button wire:click="edit({{ $hewan->id }})"
                                class="inline-flex items-center justify-center w-9 h-9 text-orange-600 hover:text-white bg-orange-50 hover:bg-orange-500 rounded-lg transition-all duration-200 cursor-pointer hover:shadow-md transform hover:-translate-y-0.5"
                                title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button wire:click="confirmDelete({{ $hewan->id }})"
                                class="inline-flex items-center justify-center w-9 h-9 text-red-600 hover:text-white bg-red-50 hover:bg-red-500 rounded-lg transition-all duration-200 cursor-pointer hover:shadow-md transform hover:-translate-y-0.5"
                                title="Hapus">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="bg-gradient-to-br from-orange-100 to-yellow-100 p-6 rounded-full mb-4">
                                    <i class="fa-solid fa-inbox text-orange-400 text-4xl"></i>
                                </div>
                                <p class="text-gray-500 font-medium">Belum ada data hewan</p>
                                <p class="text-gray-400 text-sm mt-1">Klik tombol "Tambah Hewan" untuk menambahkan data
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- 4. TAMPILAN MOBILE (CARD LIST) --}}
        <div class="md:hidden grid grid-cols-1 gap-4 relative z-10">
            @forelse($hewans as $hewan)
            <div
                class="bg-white p-5 rounded-2xl shadow-md border-2 border-orange-100 flex gap-4 items-start relative overflow-hidden hover:shadow-lg transition-all duration-200 hover:border-orange-300">

                {{-- Border Kiri warna-warni sesuai gender --}}
                <div
                    class="absolute left-0 top-0 bottom-0 w-1.5 {{ $hewan->jenis_kelamin == 'Jantan' ? 'bg-gradient-to-b from-blue-400 to-blue-600' : 'bg-gradient-to-b from-pink-400 to-pink-600' }}">
                </div>

                {{-- Foto --}}
                <div class="shrink-0 relative">
                    @if($hewan->foto)
                    <img class="h-20 w-20 rounded-xl object-cover border-2 border-orange-200 shadow-md"
                        src="{{ asset('storage/'.$hewan->foto) }}" alt="{{ $hewan->nama }}">
                    @else
                    <div
                        class="h-20 w-20 rounded-xl bg-gradient-to-br from-orange-100 to-yellow-100 flex items-center justify-center text-orange-600 font-bold text-2xl border-2 border-orange-200 shadow-md">
                        {{ substr($hewan->nama, 0, 1) }}
                    </div>
                    @endif
                    <div
                        class="absolute -bottom-2 -right-2 bg-white rounded-full p-1.5 shadow-lg border-2 border-orange-100">
                        <i
                            class="fa-solid {{ $hewan->jenis_kelamin == 'Jantan' ? 'fa-mars text-blue-500' : 'fa-venus text-pink-500' }} text-sm"></i>
                    </div>
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 truncate">{{ $hewan->nama }}</h3>
                            <div class="flex flex-wrap gap-2 mt-1.5">
                                <span
                                    class="inline-flex items-center gap-1 text-xs bg-gradient-to-r from-orange-100 to-yellow-100 text-gray-700 px-2.5 py-1 rounded-lg font-semibold border border-orange-200">
                                    <i class="fa-solid fa-tag text-orange-500"></i>
                                    {{ $hewan->jenis->nama_jenis }}
                                </span>
                                <span
                                    class="inline-flex items-center gap-1 text-xs bg-gray-100 text-gray-700 px-2.5 py-1 rounded-lg font-semibold">
                                    <i class="fa-solid fa-calendar text-gray-500"></i>
                                    {{ $hewan->umur_bulan }} Bulan
                                </span>
                            </div>
                        </div>
                    </div>

                    <p class="text-xs text-gray-600 line-clamp-2 mb-3 leading-relaxed">
                        <i class="fa-solid fa-quote-left text-orange-300 text-[8px] mr-1"></i>
                        {{ $hewan->keterangan ?? 'Tidak ada keterangan' }}
                    </p>

                    <div class="flex items-center justify-end gap-2">
                        <button wire:click="edit({{ $hewan->id }})"
                            class="flex-1 text-xs bg-gradient-to-r from-orange-500 to-orange-600 text-white px-4 py-2.5 rounded-xl font-bold border-2 border-orange-600 hover:from-orange-600 hover:to-orange-700 transition-all duration-200 shadow-md hover:shadow-lg cursor-pointer flex items-center justify-center gap-1.5">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Edit
                        </button>
                        <button wire:click="confirmDelete({{ $hewan->id }})"
                            class="text-xs bg-white text-red-600 px-4 py-2.5 rounded-xl font-bold border-2 border-red-200 hover:bg-red-50 hover:border-red-300 transition-all duration-200 shadow-md cursor-pointer flex items-center justify-center gap-1.5">
                            <i class="fa-solid fa-trash-can"></i>
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-16 bg-white rounded-2xl border-2 border-dashed border-orange-200">
                <div class="bg-gradient-to-br from-orange-100 to-yellow-100 p-6 rounded-full mb-4 inline-block">
                    <i class="fa-solid fa-inbox text-orange-400 text-4xl"></i>
                </div>
                <p class="text-gray-500 font-medium">Belum ada data hewan</p>
                <p class="text-gray-400 text-sm mt-1">Klik tombol "Tambah Hewan" untuk menambahkan data</p>
            </div>
            @endforelse
        </div>

        <div class="mt-6 relative z-10">
            {{ $hewans->links() }}
        </div>
    </div>

    {{-- 5. MODAL FORM --}}
    @if($showModal)
    <div class="fixed inset-0 z-[999] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">

        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm transition-opacity cursor-pointer"
            wire:click="closeModal"></div>

        {{-- Modal Panel --}}
        <div
            class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0 pointer-events-none">
            <div
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg pointer-events-auto border-2 border-orange-100">

                <form wire:submit.prevent="save">
                    <div class="bg-gradient-to-br from-orange-50 via-white to-yellow-50 px-6 pb-6 pt-6">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b-2 border-orange-100">
                            <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-3 rounded-xl shadow-lg">
                                <i
                                    class="fa-solid fa-{{ $isEditMode ? 'pen-to-square' : 'plus' }} text-white text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900" id="modal-title">
                                {{ $isEditMode ? 'Edit Data Hewan' : 'Tambah Hewan Baru' }}
                            </h3>
                        </div>

                        <div class="space-y-5">
                            {{-- Nama Hewan --}}
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fa-solid fa-paw text-orange-500 mr-1"></i> Nama Hewan
                                </label>
                                <input type="text" wire:model="nama"
                                    class="block w-full rounded-xl border-2 border-orange-200 shadow-sm focus:border-orange-500 focus:ring-2 focus:ring-orange-500 sm:text-sm px-4 py-2.5 transition-all duration-200 hover:border-orange-300"
                                    placeholder="Contoh: Max, Bella">
                                @error('nama') <span class="text-red-500 text-xs mt-1 flex items-center gap-1"><i
                                        class="fa-solid fa-circle-exclamation"></i>{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                {{-- Jenis --}}
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">
                                        <i class="fa-solid fa-tag text-orange-500 mr-1"></i> Jenis
                                    </label>
                                    <select wire:model="jenis_hewan_id"
                                        class="block w-full rounded-xl border-2 border-orange-200 shadow-sm focus:border-orange-500 focus:ring-2 focus:ring-orange-500 sm:text-sm px-4 py-2.5 cursor-pointer transition-all duration-200 hover:border-orange-300">
                                        <option value="">Pilih...</option>
                                        @foreach($list_jenis as $jenis)
                                        <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenis_hewan_id') <span
                                        class="text-red-500 text-xs mt-1 flex items-center gap-1"><i
                                            class="fa-solid fa-circle-exclamation"></i>{{ $message }}</span> @enderror
                                </div>

                                {{-- Umur --}}
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">
                                        <i class="fa-solid fa-calendar text-orange-500 mr-1"></i> Umur (Bulan)
                                    </label>
                                    <input type="number" wire:model="umur_bulan"
                                        class="block w-full rounded-xl border-2 border-orange-200 shadow-sm focus:border-orange-500 focus:ring-2 focus:ring-orange-500 sm:text-sm px-4 py-2.5 transition-all duration-200 hover:border-orange-300"
                                        placeholder="0">
                                    @error('umur_bulan') <span
                                        class="text-red-500 text-xs mt-1 flex items-center gap-1"><i
                                            class="fa-solid fa-circle-exclamation"></i>{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-3">
                                    <i class="fa-solid fa-venus-mars text-orange-500 mr-1"></i> Jenis Kelamin
                                </label>
                                <div class="flex gap-4">
                                    <label class="flex-1 cursor-pointer group">
                                        <input type="radio" wire:model="jenis_kelamin" value="Jantan"
                                            class="peer sr-only">
                                        <div
                                            class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl border-2 border-blue-200 bg-blue-50 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-checked:text-white transition-all duration-200 hover:border-blue-300 font-semibold text-sm">
                                            <i class="fa-solid fa-mars"></i> <span>Jantan</span>
                                        </div>
                                    </label>
                                    <label class="flex-1 cursor-pointer group">
                                        <input type="radio" wire:model="jenis_kelamin" value="Betina"
                                            class="peer sr-only">
                                        <div
                                            class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl border-2 border-pink-200 bg-pink-50 peer-checked:border-pink-500 peer-checked:bg-pink-500 peer-checked:text-white transition-all duration-200 hover:border-pink-300 font-semibold text-sm">
                                            <i class="fa-solid fa-venus"></i> <span>Betina</span>
                                        </div>
                                    </label>
                                </div>
                                @error('jenis_kelamin') <span
                                    class="text-red-500 text-xs mt-1 flex items-center gap-1"><i
                                        class="fa-solid fa-circle-exclamation"></i>{{ $message }}</span> @enderror
                            </div>

                            {{-- Keterangan --}}
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fa-solid fa-info-circle text-orange-500 mr-1"></i> Keterangan
                                </label>
                                <textarea wire:model="keterangan" rows="3"
                                    class="block w-full rounded-xl border-2 border-orange-200 shadow-sm focus:border-orange-500 focus:ring-2 focus:ring-orange-500 sm:text-sm px-4 py-2.5 transition-all duration-200 hover:border-orange-300 resize-none"
                                    placeholder="Tambahkan catatan..."></textarea>
                            </div>

                            {{-- Foto --}}
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fa-solid fa-image text-orange-500 mr-1"></i> Foto Hewan
                                </label>
                                <div class="relative">
                                    <input type="file" wire:model="foto" id="foto-input" class="hidden">
                                    <label for="foto-input"
                                        class="flex items-center justify-center gap-2 w-full px-4 py-3 border-2 border-dashed border-orange-300 rounded-xl cursor-pointer hover:border-orange-500 transition-all duration-200 bg-orange-50 hover:bg-orange-100 group">
                                        <i
                                            class="fa-solid fa-cloud-arrow-up text-orange-500 text-xl group-hover:scale-110 transition-transform"></i>
                                        <span class="text-sm font-semibold text-gray-700">Pilih Foto</span>
                                    </label>
                                </div>
                                <div wire:loading wire:target="foto"
                                    class="text-xs text-orange-600 mt-2 flex items-center gap-2 font-medium">
                                    <i class="fa-solid fa-spinner fa-spin"></i> Mengupload foto...
                                </div>
                                @if ($foto)
                                <div class="mt-3 relative inline-block">
                                    <img src="{{ $foto->temporaryUrl() }}"
                                        class="h-24 w-24 object-cover rounded-xl border-2 border-orange-300 shadow-md">
                                    <div
                                        class="absolute -top-2 -right-2 bg-green-500 text-white rounded-full p-1 shadow-lg">
                                        <i class="fa-solid fa-check text-xs"></i>
                                    </div>
                                </div>
                                @elseif ($foto_lama)
                                <div class="mt-3 relative inline-block">
                                    <img src="{{ asset('storage/'.$foto_lama) }}"
                                        class="h-24 w-24 object-cover rounded-xl border-2 border-gray-300 shadow-md opacity-60">
                                    <div
                                        class="absolute inset-0 flex items-center justify-center bg-black opacity-40 rounded-xl">
                                        <span class="text-white text-xs font-bold">Foto Lama</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Footer Buttons --}}
                    <div
                        class="bg-gray-50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-end gap-3 border-t-2 border-orange-100">
                        <button type="button" wire:click="closeModal"
                            class="w-full sm:w-auto inline-flex justify-center items-center gap-2 rounded-xl bg-white px-6 py-2.5 text-sm font-bold text-gray-700 shadow-sm ring-2 ring-inset ring-gray-300 hover:bg-gray-50 transition-all duration-200 cursor-pointer hover:ring-gray-400">
                            <i class="fa-solid fa-xmark"></i> Batal
                        </button>
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex justify-center items-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-2.5 text-sm font-bold text-white shadow-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-200 cursor-pointer hover:shadow-xl transform hover:-translate-y-0.5">
                            <i class="fa-solid fa-check"></i> {{ $isEditMode ? 'Update Data' : 'Simpan Data' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

</div>

@push('styles')
<style>
    @keyframes blob {
        0% {
            transform: translate(0px, 0px) scale(1);
        }

        33% {
            transform: translate(30px, -50px) scale(1.1);
        }

        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }

        100% {
            transform: translate(0px, 0px) scale(1);
        }
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }

    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #fef3c7;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #f97316, #ea580c);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #ea580c, #c2410c);
    }
</style>
@endpush

@push('scripts')
<script>
    window.addEventListener('swal:success', event => {
        Swal.fire({ icon: 'success', title: event.detail.title, text: event.detail.text, showConfirmButton: false, timer: 1500 });
    });
    window.addEventListener('swal:confirm', event => {
        Swal.fire({
            title: 'Yakin hapus data ini?', text: "Data tidak bisa dikembalikan!", icon: 'warning',
            showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#3085d6', confirmButtonText: 'Ya, Hapus!', cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) { Livewire.dispatch('deleteConfirmed', { id: event.detail.id }); }
        });
    });
</script>
@endpush
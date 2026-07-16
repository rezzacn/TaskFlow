@extends('layouts.app')

@section('title', 'Edit Task')
@section('page-title', 'Edit Task')
@section('page-subtitle', 'Perbarui data task')

@section('breadcrumb')
    <li><i class='bx bx-chevron-right text-dark-400'></i></li>
    <li><a href="{{ route('task') }}" class="text-dark-500 hover:text-primary-600 transition-colors">Data Task</a></li>
    <li><i class='bx bx-chevron-right text-dark-400'></i></li>
    <li class="text-primary-600 font-medium">Edit Task</li>
@endsection

@section('content')
    <div class="glass-card rounded-2xl border border-dark-200/50 overflow-hidden">
        <div class="px-6 py-4 border-b border-dark-100 bg-dark-50/30 flex items-center gap-2">
            <i class='bx bx-edit text-primary-600 text-xl'></i>
            <h3 class="text-base font-bold text-dark-800">Form Edit Task</h3>
        </div>

        <div class="p-6">
            <form action="{{ route('task.update', $task->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Nama Project --}}
                    <div>
                        <label for="nama_project" class="block text-sm font-medium text-dark-700 mb-1.5">Nama
                            Project</label>
                        <input type="text" name="nama_project" id="nama_project" value="{{ old('nama_project', $task->nama_project) }}"
                            class="block w-full px-4 py-2.5 border border-dark-200 rounded-xl bg-dark-50/50 focus:bg-white text-dark-800 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                            required>
                        @error('nama_project')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Client --}}
                    <div>
                        <label for="client_id" class="block text-sm font-medium text-dark-700 mb-1.5">Client</label>
                        <select name="client_id" id="client_id"
                            class="block w-full px-4 py-2.5 border border-dark-200 rounded-xl bg-dark-50/50 focus:bg-white text-dark-800 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                            required>
                            <option value="">Pilih Client</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id', $task->client_id) == $client->id ? 'selected' : '' }}>
                                    {{ $client->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Harga --}}
                    <div>
                        <label for="harga_display" class="block text-sm font-medium text-dark-700 mb-1.5">Harga (Rp)</label>
                        <input type="text" id="harga_display" value="{{ old('harga', $task->harga) }}"
                            class="block w-full px-4 py-2.5 border border-dark-200 rounded-xl bg-dark-50/50 focus:bg-white text-dark-800 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                            required>
                        <input type="hidden" name="harga" id="harga" value="{{ old('harga', $task->harga) }}">
                        @error('harga')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pembayaran Tipe --}}
                    <div>
                        <label for="pembayaran_tipe" class="block text-sm font-medium text-dark-700 mb-1.5">Tipe
                            Pembayaran</label>
                        <select name="pembayaran_tipe" id="pembayaran_tipe"
                            class="block w-full px-4 py-2.5 border border-dark-200 rounded-xl bg-dark-50/50 focus:bg-white text-dark-800 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                            required>
                            <option value="">Pilih Tipe</option>
                            <option value="DP" {{ old('pembayaran_tipe', $task->pembayaran_tipe) == 'DP' ? 'selected' : '' }}>DP</option>
                            <option value="Full" {{ old('pembayaran_tipe', $task->pembayaran_tipe) == 'Full' ? 'selected' : '' }}>Full</option>
                            <option value="Lunas" {{ old('pembayaran_tipe', $task->pembayaran_tipe) == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                        </select>
                        @error('pembayaran_tipe')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal Mulai --}}
                    <div>
                        <label for="tgl_mulai" class="block text-sm font-medium text-dark-700 mb-1.5">Tanggal Mulai</label>
                        <input type="date" name="tgl_mulai" id="tgl_mulai" value="{{ old('tgl_mulai', $task->tgl_mulai) }}"
                            class="block w-full px-4 py-2.5 border border-dark-200 rounded-xl bg-dark-50/50 focus:bg-white text-dark-800 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                            required>
                        @error('tgl_mulai')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deadline --}}
                    <div>
                        <label for="deadline" class="block text-sm font-medium text-dark-700 mb-1.5">Deadline</label>
                        <input type="date" name="deadline" id="deadline" value="{{ old('deadline', $task->deadline) }}"
                            class="block w-full px-4 py-2.5 border border-dark-200 rounded-xl bg-dark-50/50 focus:bg-white text-dark-800 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                            required>
                        @error('deadline')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status" class="block text-sm font-medium text-dark-700 mb-1.5">Status</label>
                        <select name="status" id="status"
                            class="block w-full px-4 py-2.5 border border-dark-200 rounded-xl bg-dark-50/50 focus:bg-white text-dark-800 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                            required>
                            <option value="ToDo" {{ old('status', $task->status) == 'ToDo' ? 'selected' : '' }}>ToDo</option>
                            <option value="InProgress" {{ old('status', $task->status) == 'InProgress' ? 'selected' : '' }}>InProgress</option>
                            <option value="Done" {{ old('status', $task->status) == 'Done' ? 'selected' : '' }}>Done</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Bukti Transfer (Opsional) --}}
                    <div>
                        <label for="bukti_tf" class="block text-sm font-medium text-dark-700 mb-1.5">Bukti Transfer
                            (Opsional)</label>
                        <input type="file" name="bukti_tf" id="bukti_tf" accept="image/*"
                            class="block w-full px-3 py-2 border border-dark-200 rounded-xl bg-dark-50/50 focus:bg-white text-dark-800 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200">
                        @if ($task->bukti_tf)
                            <div class="mt-2 text-xs text-dark-500">
                                Sudah ada bukti transfer: <a href="{{ asset($task->bukti_tf) }}" target="_blank" class="text-primary-600 hover:underline">Lihat file</a>
                            </div>
                        @endif
                        @error('bukti_tf')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="mt-6">
                    <label for="deskripsi" class="block text-sm font-medium text-dark-700 mb-1.5">Deskripsi Singkat</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                        class="block w-full px-4 py-2.5 border border-dark-200 rounded-xl bg-dark-50/50 focus:bg-white text-dark-800 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                        required>{{ old('deskripsi', $task->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="mt-8 flex items-center justify-end gap-3 border-t border-dark-100 pt-6">
                    <a href="{{ route('task') }}"
                        class="px-5 py-2.5 border border-dark-200 rounded-xl text-dark-600 bg-white hover:bg-dark-50 hover:text-dark-800 font-medium transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-medium rounded-xl shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 transition-all duration-200 flex items-center gap-2">
                        <i class='bx bx-save text-lg'></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const hargaDisplay = document.getElementById('harga_display');
        const hargaInput = document.getElementById('harga');

        if(hargaDisplay && hargaInput) {
            hargaDisplay.addEventListener('input', function(e) {
                let rawValue = this.value.replace(/[^0-9]/g, '');
                hargaInput.value = rawValue;
                
                if (rawValue !== '') {
                    this.value = formatRupiah(rawValue);
                } else {
                    this.value = '';
                }
            });

            function formatRupiah(angka) {
                let number_string = Math.floor(angka).toString(),
                    sisa = number_string.length % 3,
                    rupiah = number_string.substr(0, sisa),
                    ribuan = number_string.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                return rupiah;
            }

            // Init on load
            if (hargaInput.value) {
                hargaDisplay.value = formatRupiah(hargaInput.value);
            }
        }
    </script>
@endpush

@extends('layouts.app')

@section('title', 'Manajemen Client')
@section('page-title', 'Manajemen Client')
@section('page-subtitle', 'Kelola data Client sistem')

@section('breadcrumb')
    <li><i class='bx bx-chevron-right text-dark-400'></i></li>
    <li class="text-primary-600 font-medium">Data Client</li>
@endsection

@section('page-header')
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-dark-800">Daftar Client</h2>
            <p class="text-sm text-dark-400 mt-1">Kelola data Client.</p>
        </div>
        <button type="button" onclick="openModal('createModal')"
            class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white text-sm font-medium rounded-xl shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 transition-all duration-200 hover:-translate-y-0.5">
            <i class='bx bx-plus text-lg'></i>
            Tambah Client
        </button>
    </div>
@endsection

@section('content')
    <div class="glass-card rounded-2xl border border-dark-200/50 overflow-hidden">
        {{-- Filter Bar --}}
        <div class="px-6 py-4 border-b border-dark-100 bg-dark-50/30">
            <form action="{{ route('client') }}" method="GET" class="flex flex-col sm:flex-row items-end gap-3">
                <div class="flex-1 w-full">
                    <label class="block text-xs font-medium text-dark-600 mb-1">Cari Client</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class='bx bx-search text-dark-400'></i>
                        </div>
                        <input type="text" name="search" value="{{ $search }}"
                            class="block w-full pl-9 pr-3 py-2 border border-dark-200 rounded-xl bg-white text-sm text-dark-800 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all"
                            placeholder="Nama / Email / No. HP...">
                    </div>
                </div>

                <button type="submit"
                    class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-xl transition-colors flex items-center gap-1.5 whitespace-nowrap">
                    <i class='bx bx-search'></i> Cari
                </button>
                @if ($search)
                    <a href="{{ route('client') }}"
                        class="px-4 py-2 border border-dark-200 rounded-xl text-sm text-dark-600 hover:bg-dark-50 transition-colors whitespace-nowrap">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- Table Container --}}
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-dark-50/50 border-b border-dark-200/50">
                        <th class="px-6 py-4 text-xs font-semibold text-dark-500 uppercase tracking-wider w-16 text-center">No</th>
                        <th class="px-6 py-4 text-xs font-semibold text-dark-500 uppercase tracking-wider">Nama Client</th>
                        <th class="px-6 py-4 text-xs font-semibold text-dark-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-xs font-semibold text-dark-500 uppercase tracking-wider">No. HP</th>
                        <th class="px-6 py-4 text-xs font-semibold text-dark-500 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-4 text-xs font-semibold text-dark-500 uppercase tracking-wider text-center w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-200/50">
                    @forelse ($clients as $c)
                        <tr class="hover:bg-dark-50/50 transition-colors duration-200">
                            <td class="px-6 py-4 text-sm text-dark-600 text-center">{{ $clients->firstItem() + $loop->index }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-dark-800">{{ $c->nama }}</td>
                            <td class="px-6 py-4 text-sm text-dark-600">{{ $c->email ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-dark-600">{{ $c->no_hp ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-dark-600">
                                {{ \Illuminate\Support\Str::limit($c->alamat ?? '-', 30) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button"
                                        onclick="openEditModal({{ $c->id }}, '{{ addslashes($c->nama) }}', '{{ addslashes($c->email ?? '') }}', '{{ addslashes($c->no_hp ?? '') }}', '{{ addslashes($c->alamat ?? '') }}')"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-indigo-600 bg-indigo-50 hover:bg-indigo-100 hover:text-indigo-700 transition-colors duration-200"
                                        title="Edit Data">
                                        <i class='bx bx-edit-alt text-lg'></i>
                                    </button>
                                    <form action="{{ route('client.delete', ['id' => $c->id]) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="button"
                                            class="delete-confirm inline-flex items-center justify-center w-8 h-8 rounded-lg text-rose-600 bg-rose-50 hover:bg-rose-100 hover:text-rose-700 transition-colors duration-200"
                                            title="Hapus Data">
                                            <i class='bx bx-trash text-lg'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 mb-4 rounded-full bg-dark-100 flex items-center justify-center">
                                        <i class='bx bx-user-pin text-3xl text-dark-400'></i>
                                    </div>
                                    <h3 class="text-sm font-medium text-dark-900">Belum ada data client</h3>
                                    <p class="mt-1 text-sm text-dark-500">Silakan tambah data client baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($clients->hasPages())
            <div class="px-6 py-4 border-t border-dark-100 bg-dark-50/30">
                {{ $clients->links() }}
            </div>
        @endif
    </div>
@endsection

@push('modals')
    {{-- Modal Tambah Client --}}
    <div id="createModal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-dark-900/60 backdrop-blur-sm transition-opacity opacity-0" id="createModalBackdrop" onclick="closeModal('createModal')"></div>
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div id="createModalPanel" class="relative bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-lg w-full scale-95 opacity-0">
                <form action="{{ route('client.store') }}" method="POST">
                    @csrf
                    <div class="bg-white px-6 pt-5 pb-6">
                        <div class="flex items-center justify-between mb-5 pb-4 border-b border-dark-100">
                            <h3 class="text-lg leading-6 font-bold text-dark-900">Tambah Client Baru</h3>
                            <button type="button" onclick="closeModal('createModal')" class="text-dark-400 hover:text-dark-600 transition-colors">
                                <i class='bx bx-x text-2xl'></i>
                            </button>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">Nama Client <span class="text-rose-500">*</span></label>
                                <input type="text" name="nama" required
                                    class="block w-full px-4 py-2 border border-dark-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">Email (Opsional)</label>
                                <input type="email" name="email"
                                    class="block w-full px-4 py-2 border border-dark-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">No. HP (Opsional)</label>
                                <input type="text" name="no_hp"
                                    class="block w-full px-4 py-2 border border-dark-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">Alamat (Opsional)</label>
                                <textarea name="alamat" rows="3"
                                    class="block w-full px-4 py-2 border border-dark-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="bg-dark-50 px-6 py-4 flex items-center justify-end gap-3 border-t border-dark-100">
                        <button type="button" onclick="closeModal('createModal')"
                            class="px-5 py-2.5 border border-dark-200 rounded-xl text-dark-600 bg-white hover:bg-dark-50 font-medium transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-5 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-xl shadow-lg shadow-primary-500/30 transition-colors">
                            Simpan Client
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit Client --}}
    <div id="editModal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-dark-900/60 backdrop-blur-sm transition-opacity opacity-0" id="editModalBackdrop" onclick="closeModal('editModal')"></div>
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div id="editModalPanel" class="relative bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-lg w-full scale-95 opacity-0">
                <form id="editForm" method="POST">
                    @csrf
                    <div class="bg-white px-6 pt-5 pb-6">
                        <div class="flex items-center justify-between mb-5 pb-4 border-b border-dark-100">
                            <h3 class="text-lg leading-6 font-bold text-dark-900">Edit Data Client</h3>
                            <button type="button" onclick="closeModal('editModal')" class="text-dark-400 hover:text-dark-600 transition-colors">
                                <i class='bx bx-x text-2xl'></i>
                            </button>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">Nama Client <span class="text-rose-500">*</span></label>
                                <input type="text" name="nama" id="edit_nama" required
                                    class="block w-full px-4 py-2 border border-dark-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">Email (Opsional)</label>
                                <input type="email" name="email" id="edit_email"
                                    class="block w-full px-4 py-2 border border-dark-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">No. HP (Opsional)</label>
                                <input type="text" name="no_hp" id="edit_no_hp"
                                    class="block w-full px-4 py-2 border border-dark-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-dark-700 mb-1.5">Alamat (Opsional)</label>
                                <textarea name="alamat" id="edit_alamat" rows="3"
                                    class="block w-full px-4 py-2 border border-dark-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="bg-dark-50 px-6 py-4 flex items-center justify-end gap-3 border-t border-dark-100">
                        <button type="button" onclick="closeModal('editModal')"
                            class="px-5 py-2.5 border border-dark-200 rounded-xl text-dark-600 bg-white hover:bg-dark-50 font-medium transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-lg shadow-indigo-500/30 transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            const backdrop = document.getElementById(id + 'Backdrop');
            const panel = document.getElementById(id + 'Panel');
            
            modal.classList.remove('hidden');
            
            // Trigger reflow
            void modal.offsetWidth;
            
            backdrop.classList.remove('opacity-0');
            panel.classList.remove('opacity-0', 'scale-95');
            panel.classList.add('opacity-100', 'scale-100');
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            const backdrop = document.getElementById(id + 'Backdrop');
            const panel = document.getElementById(id + 'Panel');
            
            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');
            
            panel.classList.remove('opacity-100', 'scale-100');
            panel.classList.add('opacity-0', 'scale-95');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Wait for transition
        }

        function openEditModal(id, nama, email, noHp, alamat) {
            const form = document.getElementById('editForm');
            // Ganti action form sesuai id
            form.action = `/client/update/${id}`;
            
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_no_hp').value = noHp;
            document.getElementById('edit_alamat').value = alamat;
            
            openModal('editModal');
        }

        document.querySelectorAll('.delete-confirm').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: 'Hapus Data Client?',
                    text: "Semua Task yang terkait dengan client ini juga akan dihapus. Lanjutkan?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'font-inter rounded-2xl',
                        confirmButton: 'rounded-xl',
                        cancelButton: 'rounded-xl'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush

@extends('layouts.app')

@section('title', 'Manajemen Task')
@section('page-title', 'Manajemen Task')
@section('page-subtitle', 'Kelola data Task sistem')

@section('breadcrumb')
    <li><i class='bx bx-chevron-right text-dark-400'></i></li>
    <li class="text-primary-600 font-medium">Data Task</li>
@endsection

@section('page-header')
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-dark-800">Daftar Task</h2>
            <p class="text-sm text-dark-400 mt-1">Kelola data Task dan akses sistem.</p>
        </div>
        <a href="{{ route('task.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white text-sm font-medium rounded-xl shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 transition-all duration-200 hover:-translate-y-0.5">
            <i class='bx bx-plus text-lg'></i>
            Tambah Task
        </a>
    </div>
@endsection

@section('content')
    <div class="glass-card rounded-2xl border border-dark-200/50 overflow-hidden">
        {{-- Filter Bar --}}
        <div class="px-6 py-4 border-b border-dark-100 bg-dark-50/30">
            <form action="{{ route('task') }}" method="GET" class="flex flex-col sm:flex-row items-end gap-3">
                <div class="flex-1 w-full">
                    <label class="block text-xs font-medium text-dark-600 mb-1">Cari Task</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class='bx bx-search text-dark-400'></i>
                        </div>
                        <input type="text" name="search" value="{{ $search }}"
                            class="block w-full pl-9 pr-3 py-2 border border-dark-200 rounded-xl bg-white text-sm text-dark-800 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all"
                            placeholder="Nama Project...">
                    </div>
                </div>
                <div class="w-full sm:w-44">
                    <label class="block text-xs font-medium text-dark-600 mb-1">Status Pengerjaan</label>
                    <select name="status"
                        class="block w-full px-3 py-2 border border-dark-200 rounded-xl bg-white text-sm text-dark-800 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all">
                        <option value="">Semua Status</option>
                        <option value="ToDo" {{ $filter_status == 'ToDo' ? 'selected' : '' }}>ToDo</option>
                        <option value="InProgress" {{ $filter_status == 'InProgress' ? 'selected' : '' }}>InProgress
                        </option>
                        <option value="Done" {{ $filter_status == 'Done' ? 'selected' : '' }}>Done</option>
                    </select>
                </div>

                <button type="submit"
                    class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-xl transition-colors flex items-center gap-1.5 whitespace-nowrap">
                    <i class='bx bx-search'></i> Cari
                </button>
                @if ($search || $filter_status)
                    <a href="{{ route('task') }}"
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
                        <th class="px-6 py-4 text-xs font-semibold text-dark-500 uppercase tracking-wider w-16 text-center">
                            No</th>
                        <th class="px-6 py-4 text-xs font-semibold text-dark-500 uppercase tracking-wider">Nama Project</th>
                        <th class="px-6 py-4 text-xs font-semibold text-dark-500 uppercase tracking-wider">Client</th>
                        <th class="px-6 py-4 text-xs font-semibold text-dark-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-4 text-xs font-semibold text-dark-500 uppercase tracking-wider">Deadline</th>
                        <th class="px-6 py-4 text-xs font-semibold text-dark-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-dark-500 uppercase tracking-wider text-center w-28">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-200/50">
                    @forelse ($tasks as $t)
                        <tr class="hover:bg-dark-50/50 transition-colors duration-200">
                            <td class="px-6 py-4 text-sm text-dark-600 text-center">{{ $tasks->firstItem() + $loop->index }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-dark-800">
                                {{ $t->nama_project }}
                            </td>
                            <td class="px-6 py-4 text-sm text-dark-600">{{ $t->client->nama ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-dark-600">Rp {{ number_format($t->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm text-dark-600">
                                {{ \Carbon\Carbon::parse($t->deadline)->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if ($t->status == 'ToDo')
                                    <span
                                        class="px-2 py-1 bg-amber-50 text-amber-600 rounded-md text-xs font-medium border border-amber-200">ToDo</span>
                                @elseif($t->status == 'InProgress')
                                    <span
                                        class="px-2 py-1 bg-blue-50 text-blue-600 rounded-md text-xs font-medium border border-blue-200">InProgress</span>
                                @else
                                    <span
                                        class="px-2 py-1 bg-emerald-50 text-emerald-600 rounded-md text-xs font-medium border border-emerald-200">Done</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button"
                                        class="update-status-btn inline-flex items-center justify-center w-8 h-8 rounded-lg text-amber-600 bg-amber-50 hover:bg-amber-100 hover:text-amber-700 transition-colors duration-200"
                                        title="Update Status" data-id="{{ $t->id }}"
                                        data-status="{{ $t->status }}">
                                        <i class='bx bx-cog text-lg'></i>
                                    </button>
                                    <form action="{{ route('task.update_status', $t->id) }}" method="POST"
                                        id="status-form-{{ $t->id }}" class="hidden">
                                        @csrf
                                        <input type="hidden" name="status" id="status-input-{{ $t->id }}">
                                    </form>
                                    <a href="{{ route('task.show', $t->id) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-emerald-600 bg-emerald-50 hover:bg-emerald-100 hover:text-emerald-700 transition-colors duration-200"
                                        title="Detail Data">
                                        <i class='bx bx-info-circle text-lg'></i>


                                    </a>
                                    <a href="{{ route('task.edit', $t->id) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-indigo-600 bg-indigo-50 hover:bg-indigo-100 hover:text-indigo-700 transition-colors duration-200"
                                        title="Edit Data">
                                        <i class='bx bx-edit-alt text-lg'></i>
                                    </a>
                                    <form action="{{ route('task.delete', ['id' => $t->id]) }}" method="POST"
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
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 mb-4 rounded-full bg-dark-100 flex items-center justify-center">
                                        <i class='bx bx-list-check text-3xl text-dark-400'></i>
                                    </div>
                                    <h3 class="text-sm font-medium text-dark-900">Belum ada data task</h3>
                                    <p class="mt-1 text-sm text-dark-500">Silakan tambah data task baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($tasks->hasPages())
            <div class="px-6 py-4 border-t border-dark-100 bg-dark-50/30">
                {{ $tasks->links() }}
            </div>
        @endif
    </div>

    @push('modals')
    @endpush

@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.update-status-btn').forEach(button => {
            button.addEventListener('click', function() {
                const taskId = this.getAttribute('data-id');
                const currentStatus = this.getAttribute('data-status');
                const form = document.getElementById(`status-form-${taskId}`);
                const input = document.getElementById(`status-input-${taskId}`);

                Swal.fire({
                    title: 'Update Status Task',
                    text: 'Pilih status terbaru untuk task ini:',
                    input: 'select',
                    inputOptions: {
                        'ToDo': 'ToDo',
                        'InProgress': 'InProgress',
                        'Done': 'Done'
                    },
                    inputValue: currentStatus,
                    showCancelButton: true,
                    confirmButtonColor: '#4f46e5',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Update Status',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'font-inter rounded-2xl',
                        confirmButton: 'rounded-xl',
                        cancelButton: 'rounded-xl'
                    }
                }).then((result) => {
                    if (result.isConfirmed && result.value !== currentStatus) {
                        input.value = result.value;
                        form.submit();
                    }
                });
            });
        });

        document.querySelectorAll('.delete-confirm').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: 'Hapus Data Task?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
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

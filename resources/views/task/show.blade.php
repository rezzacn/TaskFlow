@extends('layouts.app')

@section('title', 'Detail Task')
@section('page-title', 'Detail Task')
@section('page-subtitle', 'Informasi lengkap mengenai task ini')

@section('breadcrumb')
    <li><i class='bx bx-chevron-right text-dark-400'></i></li>
    <li><a href="{{ route('task') }}" class="text-dark-500 hover:text-primary-600 transition-colors">Data Task</a></li>
    <li><i class='bx bx-chevron-right text-dark-400'></i></li>
    <li class="text-primary-600 font-medium">Detail Task</li>
@endsection

@section('content')
    <div class="glass-card rounded-2xl border border-dark-200/50 overflow-hidden max-w-4xl mx-auto">
        <div class="px-6 py-4 border-b border-dark-100 bg-dark-50/30 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class='bx bx-info-circle text-primary-600 text-xl'></i>
                <h3 class="text-base font-bold text-dark-800">Detail Task: {{ $task->nama_project }}</h3>
            </div>
            
            <span class="px-3 py-1 rounded-full text-xs font-semibold 
                {{ $task->status === 'Done' ? 'bg-emerald-100 text-emerald-700' : 
                  ($task->status === 'InProgress' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700') }}">
                {{ $task->status }}
            </span>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Informasi Utama --}}
                <div class="space-y-4">
                    <div>
                        <h4 class="text-xs font-semibold text-dark-400 uppercase tracking-wider mb-1">Nama Project</h4>
                        <p class="text-sm font-medium text-dark-900">{{ $task->nama_project }}</p>
                    </div>

                    <div>
                        <h4 class="text-xs font-semibold text-dark-400 uppercase tracking-wider mb-1">Klien</h4>
                        <p class="text-sm font-medium text-dark-900">
                            {{ $task->client->nama ?? 'Tidak ada' }}
                        </p>
                    </div>

                    <div>
                        <h4 class="text-xs font-semibold text-dark-400 uppercase tracking-wider mb-1">Harga</h4>
                        <p class="text-sm font-medium text-emerald-600">
                            Rp {{ number_format($task->harga, 0, ',', '.') }}
                        </p>
                    </div>

                    <div>
                        <h4 class="text-xs font-semibold text-dark-400 uppercase tracking-wider mb-1">Tipe Pembayaran</h4>
                        <p class="text-sm font-medium text-dark-900">{{ $task->pembayaran_tipe }}</p>
                    </div>
                </div>

                {{-- Informasi Jadwal --}}
                <div class="space-y-4">
                    <div>
                        <h4 class="text-xs font-semibold text-dark-400 uppercase tracking-wider mb-1">Tanggal Mulai</h4>
                        <p class="text-sm font-medium text-dark-900">
                            {{ \Carbon\Carbon::parse($task->tgl_mulai)->translatedFormat('d F Y') }}
                        </p>
                    </div>

                    <div>
                        <h4 class="text-xs font-semibold text-dark-400 uppercase tracking-wider mb-1">Deadline</h4>
                        <p class="text-sm font-medium text-dark-900">
                            {{ \Carbon\Carbon::parse($task->deadline)->translatedFormat('d F Y') }}
                        </p>
                    </div>

                    <div>
                        <h4 class="text-xs font-semibold text-dark-400 uppercase tracking-wider mb-1">Dibuat Oleh</h4>
                        <p class="text-sm font-medium text-dark-900">
                            {{ $task->user->name ?? 'Sistem' }}
                        </p>
                    </div>
                </div>

                {{-- Deskripsi Penuh --}}
                <div class="col-span-1 md:col-span-2 mt-2">
                    <h4 class="text-xs font-semibold text-dark-400 uppercase tracking-wider mb-2">Deskripsi</h4>
                    <div class="bg-dark-50/50 p-4 rounded-xl border border-dark-100 text-sm text-dark-800 whitespace-pre-wrap">{{ $task->deskripsi }}</div>
                </div>

                {{-- Bukti Transfer --}}
                @if ($task->bukti_tf)
                <div class="col-span-1 md:col-span-2 mt-2">
                    <h4 class="text-xs font-semibold text-dark-400 uppercase tracking-wider mb-2">Bukti Transfer</h4>
                    <div class="mt-2">
                        <img src="{{ asset($task->bukti_tf) }}" alt="Bukti Transfer" class="max-w-xs md:max-w-md rounded-xl shadow-md border border-dark-200">
                    </div>
                </div>
                @endif
            </div>

            <div class="mt-8 flex justify-end gap-3 pt-6 border-t border-dark-100">
                <a href="{{ route('task') }}"
                    class="px-5 py-2.5 bg-dark-100 hover:bg-dark-200 text-dark-700 text-sm font-medium rounded-xl transition-colors">
                    Kembali
                </a>
                <a href="{{ route('task.edit', $task->id) }}"
                    class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl transition-colors shadow-lg shadow-indigo-500/30">
                    <i class='bx bx-edit-alt mr-1'></i> Edit Task
                </a>
            </div>
        </div>
    </div>
@endsection

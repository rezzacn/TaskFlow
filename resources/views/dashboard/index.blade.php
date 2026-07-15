@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'TaskFlow')

@section('content')

    {{-- Welcome Banner --}}
    <div
        class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-primary-600 via-primary-700 to-primary-800 p-6 sm:p-8 mb-8 shadow-lg shadow-primary-500/20">
        <div class="absolute top-0 right-0 w-64 h-64 opacity-10">
            <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="100" cy="100" r="80" stroke="white" stroke-width="2" />
                <circle cx="100" cy="100" r="60" stroke="white" stroke-width="2" />
                <circle cx="100" cy="100" r="40" stroke="white" stroke-width="2" />
                <circle cx="100" cy="100" r="20" stroke="white" stroke-width="2" />
            </svg>
        </div>
        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/5 rounded-full blur-2xl"></div>
        <div class="absolute -top-10 -left-10 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>

        <div class="relative z-10">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h1 class="text-white text-xl sm:text-2xl font-bold tracking-tight">
                        Selamat Datang, {{ Auth::user()->username ?? 'User' }}!
                    </h1>
                    <p class="text-primary-200 mt-1 text-sm sm:text-base max-w-xl">
                        Sistem Manajement Tugas
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <div class="px-4 py-2 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
                        <p class="text-primary-200 text-[11px] font-medium uppercase tracking-wider">Tanggal Hari Ini</p>
                        <p class="text-white font-semibold text-sm mt-0.5">
                            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- Admin Statistics Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6">
        <div class="glass-card rounded-2xl p-5 border border-dark-200/50 bg-gradient-to-br from-indigo-50 to-white">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-indigo-600 text-xs font-semibold uppercase tracking-wider">Total Admin</p>
                    {{-- <h3 class="text-3xl font-bold text-dark-800 mt-2">{{ $stats['total_admin'] }}</h3> --}}
                </div>
                <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center">
                    <i class='bx bx-shield-quarter text-2xl'></i>
                </div>
            </div>
        </div>


    </div>




@endsection

@push('scripts')
    <script>
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('clock').textContent = hours + ':' + minutes;
        }
        setInterval(updateClock, 1000);

        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const clockElement = document.getElementById('clock');
            if (clockElement) {
                clockElement.textContent = `${hours}:${minutes}:${seconds}`;
            }
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
@endpush

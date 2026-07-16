@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan Statistik TaskFlow')

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
                        Pantau keseluruhan ringkasan data, project, dan pendapatan Anda di sini.
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <div class="px-4 py-2 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20 text-center">
                        <p class="text-primary-200 text-[11px] font-medium uppercase tracking-wider">Tanggal Hari Ini</p>
                        <p class="text-white font-semibold text-sm mt-0.5">
                            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Utama (Users, Clients, All Tasks) --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-6">
        <div
            class="glass-card rounded-2xl p-5 border border-dark-200/50 bg-white hover:-translate-y-1 transition-transform duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-dark-500 text-xs font-bold uppercase tracking-wider mb-1">Total Klien</p>
                    <h3 class="text-3xl font-bold text-dark-900">{{ number_format($totalClient) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <i class='bx bx-user-pin text-2xl'></i>
                </div>
            </div>
        </div>

        <div
            class="glass-card rounded-2xl p-5 border border-dark-200/50 bg-white hover:-translate-y-1 transition-transform duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-dark-500 text-xs font-bold uppercase tracking-wider mb-1">Total Admin / User</p>
                    <h3 class="text-3xl font-bold text-dark-900">{{ number_format($totalUser) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                    <i class='bx bx-shield-quarter text-2xl'></i>
                </div>
            </div>
        </div>

        <div
            class="glass-card rounded-2xl p-5 border border-dark-200/50 bg-white hover:-translate-y-1 transition-transform duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-dark-500 text-xs font-bold uppercase tracking-wider mb-1">Total Keseluruhan Task</p>
                    <h3 class="text-3xl font-bold text-dark-900">{{ number_format($totalTask) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                    <i class='bx bx-task text-2xl'></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Status Task --}}
    <h3 class="text-sm font-bold text-dark-800 uppercase tracking-wide mb-3 mt-8">Berdasarkan Status Task</h3>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-6">
        <div
            class="glass-card rounded-2xl p-5 border border-amber-200/50 bg-gradient-to-br from-amber-50/50 to-white hover:shadow-lg hover:shadow-amber-500/10 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center flex-shrink-0">
                    <i class='bx bx-list-ul text-2xl'></i>
                </div>
                <div>
                    <p class="text-amber-600 text-xs font-bold uppercase tracking-wider">To Do</p>
                    <h3 class="text-2xl font-bold text-dark-900 mt-1">{{ number_format($taskToDo) }} <span
                            class="text-sm font-normal text-dark-500">Task</span></h3>
                </div>
            </div>
        </div>

        <div
            class="glass-card rounded-2xl p-5 border border-blue-200/50 bg-gradient-to-br from-blue-50/50 to-white hover:shadow-lg hover:shadow-blue-500/10 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">
                    <i class='bx bx-loader-circle text-2xl animate-spin-slow'></i>
                </div>
                <div>
                    <p class="text-blue-600 text-xs font-bold uppercase tracking-wider">In Progress</p>
                    <h3 class="text-2xl font-bold text-dark-900 mt-1">{{ number_format($taskInProgress) }} <span
                            class="text-sm font-normal text-dark-500">Task</span></h3>
                </div>
            </div>
        </div>

        <div
            class="glass-card rounded-2xl p-5 border border-emerald-200/50 bg-gradient-to-br from-emerald-50/50 to-white hover:shadow-lg hover:shadow-emerald-500/10 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <i class='bx bx-check-double text-2xl'></i>
                </div>
                <div>
                    <p class="text-emerald-600 text-xs font-bold uppercase tracking-wider">Done</p>
                    <h3 class="text-2xl font-bold text-dark-900 mt-1">{{ number_format($taskDone) }} <span
                            class="text-sm font-normal text-dark-500">Task</span></h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Pendapatan (Revenue) --}}
    <h3 class="text-sm font-bold text-dark-800 uppercase tracking-wide mb-3 mt-8">Statistik Pendapatan</h3>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 mb-8">
        {{-- Kartu Pendapatan --}}
        <div class="col-span-1 flex flex-col gap-4 sm:gap-6">
            <div
                class="glass-card rounded-2xl p-5 border border-dark-200/50 bg-white hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-emerald-500/10 rounded-full blur-xl"></div>
                <div class="relative z-10 flex items-start justify-between">
                    <div>
                        <p class="text-dark-500 text-xs font-bold uppercase tracking-wider mb-1">Pendapatan Harian</p>
                        <h3 class="text-xl sm:text-2xl font-bold text-emerald-600">Rp
                            {{ number_format($pendapatanHarian, 0, ',', '.') }}</h3>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <i class='bx bx-wallet text-xl'></i>
                    </div>
                </div>
            </div>

            <div
                class="glass-card rounded-2xl p-5 border border-dark-200/50 bg-white hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-indigo-500/10 rounded-full blur-xl"></div>
                <div class="relative z-10 flex items-start justify-between">
                    <div>
                        <p class="text-dark-500 text-xs font-bold uppercase tracking-wider mb-1">Pendapatan Bulanan</p>
                        <h3 class="text-xl sm:text-2xl font-bold text-indigo-600">Rp
                            {{ number_format($pendapatanBulanan, 0, ',', '.') }}</h3>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <i class='bx bx-bar-chart-alt-2 text-xl'></i>
                    </div>
                </div>
            </div>

            <div
                class="glass-card rounded-2xl p-5 border border-dark-200/50 bg-white hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-primary-500/10 rounded-full blur-xl"></div>
                <div class="relative z-10 flex items-start justify-between">
                    <div>
                        <p class="text-dark-500 text-xs font-bold uppercase tracking-wider mb-1">Pendapatan Tahunan</p>
                        <h3 class="text-xl sm:text-2xl font-bold text-primary-600">Rp
                            {{ number_format($pendapatanTahunan, 0, ',', '.') }}</h3>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-primary-50 text-primary-600 flex items-center justify-center">
                        <i class='bx bx-line-chart text-xl'></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grafik --}}
        <div class="col-span-1 lg:col-span-2 glass-card rounded-2xl border border-dark-200/50 bg-white p-5 flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-base font-bold text-dark-800">Grafik Pendapatan</h3>
                    <p class="text-xs text-dark-500 mt-0.5">Tahun {{ \Carbon\Carbon::now()->year }}</p>
                </div>
                <div class="w-8 h-8 rounded-lg bg-dark-50 text-dark-500 flex items-center justify-center">
                    <i class='bx bx-trending-up text-lg'></i>
                </div>
            </div>
            <div class="flex-1 w-full relative">
                <div id="revenueChart" class="w-full h-full min-h-[300px]"></div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const chartData = @json($chartData);

            // Format IDR untuk Tooltip dan Y-Axis
            const formatIDR = (value) => {
                return 'Rp ' + value.toLocaleString('id-ID');
            };

            const options = {
                series: [{
                    name: 'Pendapatan',
                    data: chartData
                }],
                chart: {
                    type: 'area',
                    height: '100%',
                    fontFamily: 'inherit',
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    }
                },
                colors: ['#4f46e5'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.45,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov',
                        'Des'
                    ],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: '#64748b',
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            if (value >= 1000000) {
                                return 'Rp ' + (value / 1000000).toFixed(1) + 'Jt';
                            } else if (value >= 1000) {
                                return 'Rp ' + (value / 1000).toFixed(0) + 'Rb';
                            }
                            return 'Rp ' + value;
                        },
                        style: {
                            colors: '#64748b',
                            fontSize: '12px'
                        }
                    }
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return formatIDR(val);
                        }
                    },
                    theme: 'light'
                },
                markers: {
                    size: 4,
                    colors: ['#fff'],
                    strokeColors: '#4f46e5',
                    strokeWidth: 2,
                    hover: {
                        size: 6
                    }
                }
            };

            const chart = new ApexCharts(document.querySelector("#revenueChart"), options);
            chart.render();
        });
    </script>
@endpush

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClient = Client::count();
        $totalUser = User::count();

        $totalTask = Task::count();
        $taskToDo = Task::where('status', 'ToDo')->count();
        $taskInProgress = Task::where('status', 'InProgress')->count();
        $taskDone = Task::where('status', 'Done')->count();

        $hariIni = Carbon::today();
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $pendapatanHarian = Task::whereDate('created_at', $hariIni)->sum('harga');
        $pendapatanBulanan = Task::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->sum('harga');
        $pendapatanTahunan = Task::whereYear('created_at', $tahunIni)->sum('harga');
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $sum = Task::whereMonth('created_at', $i)
                ->whereYear('created_at', $tahunIni)
                ->sum('harga');
            $chartData[] = $sum;
        }

        return view('dashboard.index', compact(
            'totalClient',
            'totalUser',
            'totalTask',
            'taskToDo',
            'taskInProgress',
            'taskDone',
            'pendapatanHarian',
            'pendapatanBulanan',
            'pendapatanTahunan',
            'chartData'
        ));
    }
}

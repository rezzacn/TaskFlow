<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::with('client');

        if ($request->filled('search')) {
            $query->where('nama_project', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }


        $tasks = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->query());
        return view('task.index', compact('tasks') + [
            'search' => $request->search ?? '',
            'filter_status' => $request->status ?? '',
        ]);
    }

    public function create()
    {
        $clients = Client::orderBy('nama', 'asc')->get();
        return view('task.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'nama_project' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'pembayaran_tipe' => 'required|string',
            'status' => 'required|in:ToDo,InProgress,Done',
            'tgl_mulai' => 'required|date',
            'deadline' => 'required|date|after_or_equal:tgl_mulai',
            'bukti_tf' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['bukti_tf']);
        $data['user_id'] = Auth::id();

        if ($request->hasFile('bukti_tf')) {
            $file = $request->file('bukti_tf');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/task'), $filename);
            $data['bukti_tf'] = 'uploads/task/' . $filename;
        }

        Task::create($data);

        return redirect()->route('task')->with('success', 'Task berhasil ditambahkan.');
    }

    public function show($id)
    {
        $task = Task::with(['client', 'user'])->findOrFail($id);
        return view('task.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $clients = Client::orderBy('nama', 'asc')->get();
        return view('task.edit', compact('task', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'nama_project' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'pembayaran_tipe' => 'required|string',
            'status' => 'required|in:ToDo,InProgress,Done',
            'tgl_mulai' => 'required|date',
            'deadline' => 'required|date|after_or_equal:tgl_mulai',
            'bukti_tf' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['bukti_tf']);

        if ($request->hasFile('bukti_tf')) {
            $file = $request->file('bukti_tf');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/task'), $filename);
            $data['bukti_tf'] = 'uploads/task/' . $filename;
            
            if ($task->bukti_tf && file_exists(public_path($task->bukti_tf))) {
                unlink(public_path($task->bukti_tf));
            }
        }

        $task->update($data);

        return redirect()->route('task')->with('success', 'Task berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        
        if ($task->bukti_tf && file_exists(public_path($task->bukti_tf))) {
            unlink(public_path($task->bukti_tf));
        }
        
        $task->delete();

        return redirect()->route('task')->with('success', 'Task berhasil dihapus.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:ToDo,InProgress,Done'
        ]);

        $task = Task::findOrFail($id);
        $task->update(['status' => $request->status]);

        return back()->with('success', 'Status Task berhasil diperbarui.');
    }
}

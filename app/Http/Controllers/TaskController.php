<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;



class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index')->with('tasks', $tasks);
    }


    public function create()
    {
        return view('tasks.create');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        Task::create($input);
        return redirect('task')->with('flash_message', 'Task Added!');
    }

    public function show()
    {
        $tasks = Task::all();

        $filename = 'tasks.csv';

        $handle = fopen('php://memory', 'w');

        fputcsv($handle, ['ID', 'Title', 'Description', 'Status', 'Created At', 'Updated At']);

        $id = 1;

        foreach ($tasks as $task) {
            fputcsv($handle, [
                $id++,
                $task->title,
                $task->description,
                $task->status,
                $task->created_at->format('Y-m-d H:i:s'),
                $task->updated_at->format('Y-m-d H:i:s'),
            ]);
        }

        rewind($handle);

        return response()->streamDownload(function () use ($handle) {
            fpassthru($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks.edit')->with('task', $task);
    }
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $input = $request->all();
        $task->update($input);
        return redirect('task')->with('flash_message', 'Task Updated!');
    }
    public function destroy($id)
    {
        Task::destroy($id);
        return redirect('task')->with('flash_message', 'Task deleted!');
    }
}

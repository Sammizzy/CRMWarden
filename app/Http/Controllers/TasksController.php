<?php

namespace App\Http\Controllers;

use App\Models\tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index(Request $request)
    {
        $query = tasks::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%');
        }

        $tasks = $query->orderBy('name')->get();

        return view ('tasks.index', ['tasks' => $tasks]);
    }

    public function create(Request $request)
    {
        $list_id = $request->list_id;
        return view('tasks.create', compact('list_id'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'priority' => 'required',
            'status' => 'required',
            'assigned_to' => 'required',
            'description' => 'required',
            'list_id' => ''

        ]);

                $task = [...$validated ];
                  tasks::create($task);


        return redirect()->route('lists.index')->with('success', 'Task created successfully');
    }

    public function edit(tasks $tasks)
    {
        $tasks = tasks::findOrFail($tasks);
        return view('tasks.edit', compact('tasks'));
    }

    public function show($id)
    {
        $task = tasks::findOrFail($id);
        return view('tasks.show', compact('task'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'priority' => 'required',
            'status' => 'required',
            'assigned_to' => 'required',
        ]);

        $task = tasks::findOrFail($id);
        $task->update($request->only(['name', 'category', 'priority', 'status', 'assigned_to']));

        return redirect()->route('tasks.index')->with('success', 'List updated successfully');
    }

    public function destroy($id)
    {
        $task = tasks::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'List deleted successfully');
    }
}

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
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $tasks = $query->orderBy('name')->get();

        return view('tasks.index', compact('tasks'));
    }


    public function create(Request $request)
    {
        $list_id = $request->list_id;
        return view('tasks.create', compact('list_id'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required',
            'category'    => 'required',
            'priority'    => 'required',
            'status'      => 'required',
            'assigned_to' => 'required',
            'description' => 'required',
            'list_id'     => 'required|exists:lists,id'
        ]);

        tasks::create($validated);

        return redirect()
            ->route('lists.show', $validated['list_id'])
            ->with('success', 'Task created successfully');
    }


    public function edit(tasks $task)
    {
        return view('tasks.edit', compact('task'));
    }


    public function complete(tasks $task)
    {
        $task->update([
            'color'  => 'green',
            'status' => 'Completed',
        ]);

        return redirect()
            ->route('tasks.show', $task->id)
            ->with('success', 'Task marked as complete!');
    }


    public function show(tasks $task)
    {

        return view('tasks.show', compact('task'));
    }


    public function update(Request $request, tasks $task)
    {
        $validated = $request->validate([
            'name'        => 'required',
            'category'    => 'required',
            'description' => 'required',
            'priority'    => 'required',
            'status'      => 'required',
            'assigned_to' => 'required',
        ]);

        $task->update($validated);

        return redirect()
            ->route('tasks.show', $task->id)
            ->with('success', 'Task updated successfully');
    }


    public function destroy(tasks $task)
    {
        $listId = $task->list_id;
        $task->delete();

        return redirect()
            ->route('lists.show', $listId)
            ->with('success', 'Task deleted successfully');
    }
}

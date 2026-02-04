<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\Category;
use App\Models\Lists;

class TasksController extends Controller
{
    /**
     * Display all tasks
     */
    public function index(Request $request)
    {
        $query = Tasks::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $tasks = $query->orderBy('name')->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form to create a new task
     */
    public function create(Lists $list)
    {
        $categories = Category::where('user_id', auth()->id())
            ->orderBy('name')
            ->get();

        return view('tasks.create', [
            'categories' => $categories,
            'list_id'    => $list->id,
        ]);
    }

    /**
     * Store a new task
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'description'  => 'required|string|max:1000',
            'priority'     => 'required|integer',
            'status'       => 'required|string|max:255',
            'assigned_to'  => 'required|string|max:255',
            'category_id'  => 'nullable', // either existing or new
            'new_category' => 'nullable|string|max:255',
            'list_id'      => 'required|exists:lists,id',
        ]);

        // Handle new category creation
        if ($request->category_id === 'new' && $request->new_category) {
            $category = Category::firstOrCreate([
                'name'    => $request->new_category,
                'user_id' => auth()->id(),
            ]);
        } else {
            $category = Category::find($request->category_id);
        }

        Tasks::create([
            'name'        => $validated['name'],
            'description' => $validated['description'],
            'priority'    => $validated['priority'],
            'status'      => $validated['status'],
            'assigned_to' => $validated['assigned_to'],
            'list_id'     => $validated['list_id'],
            'category_id' => $category?->id, // nullable safe
        ]);

        return redirect()->route('lists.show', $validated['list_id'])
            ->with('success', 'Task created successfully.');
    }

    /**
     * Show form to edit task
     */
    public function edit(Tasks $task)
    {
        $categories = Category::where('user_id', auth()->id())
            ->orderBy('name')
            ->get();

        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update a task
     */
    public function update(Request $request, Tasks $task)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'description'  => 'required|string|max:1000',
            'priority'     => 'required|integer',
            'status'       => 'required|string|max:255',
            'assigned_to'  => 'required|string|max:255',
            'category_id'  => 'nullable',
            'new_category' => 'nullable|string|max:255',
        ]);

        // Handle category
        if ($request->category_id === 'new' && $request->new_category) {
            $category = Category::firstOrCreate([
                'name'    => $request->new_category,
                'user_id' => auth()->id(),
            ]);
        } else {
            $category = Category::find($request->category_id);
        }

        $task->update([
            'name'        => $validated['name'],
            'description' => $validated['description'],
            'priority'    => $validated['priority'],
            'status'      => $validated['status'],
            'assigned_to' => $validated['assigned_to'],
            'category_id' => $category?->id,
        ]);

        return redirect()->route('tasks.show', $task->id)
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Delete a task
     */
    public function destroy(Tasks $task)
    {
        $listId = $task->list_id;
        $task->delete();

        return redirect()->route('lists.show', $listId)
            ->with('success', 'Task deleted successfully.');
    }

    /**
     * Show single task
     */
    public function show(Tasks $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Mark a task as completed
     */
    public function complete(Tasks $task)
    {
        $task->update([
            'status' => 'Completed',
        ]);

        return redirect()->route('tasks.show', $task->id)
            ->with('success', 'Task marked as complete!');
    }
}

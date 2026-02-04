<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lists;
use App\Models\Category;

class ListsController extends Controller
{
    /**
     * Display a list of all lists
     */
    public function index(Request $request)
    {
        $query = Lists::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $lists = $query->orderBy('name')->get();

        return view('lists.index', compact('lists'));
    }

    /**
     * Show the form for creating a new list
     */
    public function create()
    {
        // Get all categories belonging to the authenticated user
        $categories = Category::where('user_id', auth()->id())
            ->orderBy('name')
            ->get();

        return view('lists.create', compact('categories'));
    }

    /**
     * Store a newly created list
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'category'    => 'required|string|max:255',
            'new_category'=> 'nullable|string|max:255',
        ]);

        // Handle new category creation
        if ($request->category === 'new' && $request->new_category) {
            $category = Category::firstOrCreate(
                ['name' => $request->new_category, 'user_id' => auth()->id()]
            );

            $categoryName = $category->name;
        } else {
            $categoryName = $request->category;
        }

        // Create the list
        Lists::create([
            'name'        => $validated['name'],
            'description' => $validated['description'],
            'category'    => $categoryName,
            'user_id'     => auth()->id(),
            'priority'    => 1,
            'status'      => 'WIP',
        ]);

        return redirect()->route('lists.index')
            ->with('success', 'List created successfully.');
    }

    /**
     * Show the form for editing a list
     */
    public function edit(Lists $list)
    {
        $categories = Category::where('user_id', auth()->id())
            ->orderBy('name')
            ->get();

        return view('lists.edit', compact('list', 'categories'));
    }

    /**
     * Update the list
     */
    public function update(Request $request, Lists $list)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'category'    => 'required|string|max:255',
        ]);

        $list->update([
            'name'        => $validated['name'],
            'description' => $validated['description'],
            'category'    => $validated['category'],
        ]);

        return redirect()->route('lists.index')
            ->with('success', 'List updated successfully.');
    }

    /**
     * Delete a list
     */
    public function destroy(Lists $list)
    {
        $list->delete();

        return redirect()->route('lists.index')
            ->with('success', 'List deleted successfully.');
    }

    /**
     * Show a single list
     */
    public function show(Lists $list)
    {
        return view('lists.show', compact('list'));
    }
}

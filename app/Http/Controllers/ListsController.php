<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Lists;

class ListsController extends Controller
{
    public function index(Request $request)
    {
        $query = lists::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%');
        }

        $lists = $query->orderBy('name')->get();

        return view ('lists.index', ['lists' => $lists]);
    }

    public function create()
    {
        $list = lists::all();
        return view ('lists.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        Lists::create($validated);

    return redirect()->route('lists.index')->with('success', 'List created successfully');
}

    public function edit(Lists $list)
    {
        $list = lists::findOrFail($list);
        return view('lists.edit', compact('list'));
    }

    public function show($id)
    {
        $list = lists::findOrFail($id);
    return view('lists.show', compact('list'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
        ]);

        $list = lists::findOrFail($id);
        $list->update($request->only(['name', 'category']));

        return redirect()->route('lists.index')->with('success', 'List updated successfully');
    }

    public function destroy($id)
    {
        $list = Lists::findOrFail($id);
    $list->delete();

    return redirect()->route('lists.index')->with('success', 'List deleted successfully');
}



}

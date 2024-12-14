<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nominee;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NomineeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get all categories for the filter dropdown
        $categories = Category::all();

        // If a category filter is applied
        if ($request->has('category_id') && $request->category_id != '') {
            $nominees = Nominee::whereHas('categories', function ($query) use ($request) {
                $query->where('categories.id', $request->category_id);
            })->get();
        } else {
            // If no filter, show all nominees
            $nominees = Nominee::all();
        }

        return view('admin.nominees.index', compact('nominees', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve categories to display in the dropdown
        $categories = Category::all();
        return view('admin.nominees.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_ids' => 'required|array', // Ensure categories are selected
            'category_ids.*' => 'exists:categories,id', // Ensure each selected category ID exists
        ]);

        // Create the nominee
        $nominee = Nominee::create([
            'name' => $validated['name'],
        ]);

        // Attach the selected categories to the nominee
        $nominee->categories()->attach($validated['category_ids']);

        // Redirect back or to another route with a success message
        return redirect()->route('admin.nominees.index')->with('success', 'Nominee created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Nominee $nominee)
    {
        // Return a view to display a single nominee's details
        return view('admin.nominees.show', compact('nominee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nominee $nominee)
    {
        // Retrieve categories to display in the dropdown
        $categories = Category::all();
        return view('admin.nominees.edit', compact('nominee', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nominee $nominee)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        // Update nominee's name
        $nominee->update([
            'name' => $request->name,
        ]);

        // Sync the categories with the nominee
        $nominee->categories()->sync($request->category_ids);

        // Redirect to the nominee list with a success message
        return redirect()->route('admin.nominees.index')->with('success', 'Nominee updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nominee $nominee)
    {
        // Detach the nominee from all associated categories
        $nominee->categories()->detach();

        // Delete the nominee record from the database
        $nominee->delete();

        // Redirect to the nominee list with a success message
        return redirect()->route('admin.nominees.index')->with('success', 'Nominee deleted successfully!');
    }

}

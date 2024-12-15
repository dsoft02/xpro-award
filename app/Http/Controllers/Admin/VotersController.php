<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VotersController extends Controller
{
    public function index()
    {
        $voters = Voter::all(); // Fetch all categories
        return view('admin.voters.index', compact('voters'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('admin.voters.create'); // Return the create form
    }

    public function store(Request $request)
    {
        // Validate that the combination of username and team_name is unique
        $request->validate([
            'username' => 'required|string|max:255',
            'team_name' => 'required|string|max:255',
            'username,team_name' => 'unique:voters,username,team_name',
        ]);

        // Create the voter record
        Voter::create([
            'username' => $request->username,
            'team_name' => $request->team_name,
        ]);

        return redirect()->route('admin.voters.index')->with('success', 'Voter information has been saved successfully!');
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $voter = Voter::findOrFail($id); // Fetch the category by ID
        return view('admin.voters.edit', compact('voter'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        // Find the voter by ID
        $voter = Voter::findOrFail($id);

        // Validate the request data
        $request->validate([
            'username' => 'required|string|max:255|unique:voters,username,' . $voter->id,
            'team_name' => 'required|string|max:255|unique:voters,team_name,' . $voter->id,
        ]);

        // Update the voter's information
        $voter->update([
            'username' => $request->username,
            'team_name' => $request->team_name,
        ]);

        // Redirect with success message
        return redirect()->route('admin.voters.index')->with('success', 'Voter updated successfully.');
    }


    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $voter = Voter::findOrFail($id);

        $voter->delete();

        return redirect()->route('admin.voters.index')->with('success', 'Voter deleted successfully.');
    }

}

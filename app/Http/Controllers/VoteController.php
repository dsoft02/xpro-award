<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Voter;
use App\Models\Category;
use App\Models\Nominee;
use Illuminate\Validation\ValidationException;
use App\Rules\AllowedEmailDomain;

class VoteController extends Controller
{
    public function store_old($nomineeId, $categoryId, Request $request)
    {
        try {
            // Validate the email with custom rule
            $validatedData = $request->validate([
                'email' => ['required', 'email', new AllowedEmailDomain],
            ]);
        } catch (ValidationException $e) {
            // Return back with the first validation error as a flash message
            return back()->with('error', $e->validator->errors()->first('email'));
        }

        // Check if the user has already voted based on email or IP address
        $existingVote = Vote::where('category_id', $categoryId)
            ->where(function ($query) use ($request) {
                $query->where('email', $request->email)
                    ->orWhere('ip_address', $request->ip());
            })
            ->first();

        // Prevent multiple votes in the same category
        if ($existingVote) {
            return back()->with('error', 'You have already voted in this category.');
        }

        // Create a new vote
        $vote = new Vote();
        $vote->nominee_id = $nomineeId;
        $vote->category_id = $categoryId;
        $vote->email = $request->email; // Use the email address to track the vote
        $vote->ip_address = $request->ip(); // Use the IP address to prevent duplicate votes
        $vote->save();

        return back()->with('success', 'Thank you for voting!');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string',
            'team_name' => 'required|string',
            'votes' => 'required|array', // Ensure votes is an array
            'votes.*' => 'nullable|exists:nominees,id', // Validate each nominee exists
        ]);

        // Find the voter using the username and team name
        $voter = Voter::where('username', $validatedData['username'])
            ->where('team_name', $validatedData['team_name'])
            ->first();

        // Check if the voter exists
        if (!$voter) {
            return redirect()->back()->with('error', 'Invalid username or team name.');
        }

        $savedVotes = 0;
        $skippedVotes = 0;

        // Loop through each category vote
        foreach ($validatedData['votes'] as $categoryId => $nomineeId) {
            if (!$nomineeId) {
                continue; // Skip empty selections
            }

            // Check if the voter or the IP address has already voted in this category
            $existingVote = Vote::where(function ($query) use ($voter, $categoryId, $request) {
                $query->where('voter_id', $voter->id)
                    ->orWhere('ip_address', $request->ip());
            })
                ->where('category_id', $categoryId)
                ->exists();

            if ($existingVote) {
                $skippedVotes++;
                continue; // Skip this category if already voted
            }

            // Create the vote
            Vote::create([
                'voter_id' => $voter->id,
                'ip_address' => $request->ip(),
                'nominee_id' => $nomineeId,
                'category_id' => $categoryId,
            ]);

            $savedVotes++;
        }

         // Check if no votes were saved
        if ($savedVotes === 0 || empty($savedVotes)) {
            return redirect()->back()->with('error', 'Sorry you have already voted in all categories.');
        }

        // Return response with saved and skipped counts
        return redirect()->back()->with('success', "Your votes have been submitted successfully!");
    }


    public function showVotes(Request $request)
    {
        $categories = Category::all();
        // Retrieve all votes along with the nominee they voted for
        $votes = Vote::with('nominee', 'category')
            ->when($request->category_id, function ($query) use ($request) {
                return $query->where('category_id', $request->category_id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.votes.index', compact('votes', 'categories'));
    }

    public function resetVotes()
    {
        // Delete all votes
        Vote::truncate();  // This will delete all rows from the 'votes' table

        return redirect()->route('admin.votes.index')->with('success', 'All votes have been reset.');
    }

    public function showWinners_old()
    {
        $categories = Category::with(['nominees' => function ($query) {
            $query->withCount('votes')
                ->orderBy('votes_count', 'desc');
        }])->get();

        return view('admin.winners.index', compact('categories'));
    }

    public function showWinners()
    {
        $categories = Category::with(['nominees' => function ($query) {
            $query->withCount(['votes as votes_count' => function ($subQuery) {
                $subQuery->whereColumn('votes.category_id', 'category_nominee.category_id');
            }])
                ->orderBy('votes_count', 'desc');
        }])->get();

        return view('admin.winners.index', compact('categories'));
    }


}

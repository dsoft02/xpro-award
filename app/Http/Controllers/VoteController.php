<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Nominee;
use Illuminate\Validation\ValidationException;
use App\Rules\AllowedEmailDomain;

class VoteController extends Controller
{
    public function store($nomineeId, $categoryId, Request $request)
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

}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting;

class CheckVotingStatus
{
    public function handle(Request $request, Closure $next)
    {
        // Check if voting is enabled
        if (!Setting::isVotingEnabled()) {
            return redirect()->route('home')->with('error', 'Voting is currently disabled.');
        }

        // Check if the winner has been declared
        if (Setting::isDeclareWinnerEnabled()) {
            return redirect()->route('home')->with('error', 'The winners have already been declared.');
        }

        // Check if voting has ended (voting_end_time is a setting)
        $votingEndTime = Setting::getValue('voting_end_time');
        if ($votingEndTime && strtotime($votingEndTime) < time()) {
            return redirect()->route('home')->with('error', 'Voting has ended.');
        }

        // Allow the request to proceed if all conditions are met
        return $next($request);
    }
}


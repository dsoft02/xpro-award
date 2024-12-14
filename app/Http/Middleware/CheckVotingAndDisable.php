<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckVotingAndDisable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Call the function to check and disable voting if necessary
        checkAndDisableVoting();

        // Continue the request
        return $next($request);
    }
}

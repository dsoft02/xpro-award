<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Setting;

class CheckDeclareWinnerEnabled
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
        // Check if 'declare_winner' setting is enabled
        $declareWinner = Setting::isDeclareWinnerEnabled();

        // If declare_winner is not enabled, redirect or abort
        if (!$declareWinner) {
            return redirect()->route('home')->with('error', 'Winner has not yet been declared or the voting is still ongoing.');
        }

        // Continue the request if the setting is enabled
        return $next($request);
    }
}

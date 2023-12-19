<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        if (auth()->check()) {
            $user = auth()->user()->role;
            if ($user == 'admin') {
                return $next($request);
            }
        }
        // Redirect or respond with an error if the user doesn't have the required role
        return redirect()->route('jobseeker.index')->with('error', 'Unauthorized access');
        // Or return a JSON response or any other action as needed
    
    }
}

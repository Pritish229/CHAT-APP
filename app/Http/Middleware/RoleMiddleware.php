<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
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
        // Check if the user is logged in (session has 'user_id')
        if (!$request->session()->has('user_id')) {
            return redirect('/Login')->with('error', 'You must log in first.');
        }

        // Retrieve user role from session
        $userRole = $request->session()->get('user_role');

        // Define role-based access
        $adminRoutesPrefix = '/Admin'; 
        $userRoutesPrefix = '/User'; 

        // Get the current request path
        $currentPath = $request->path();

        // Check access based on role
        if (
            ($userRole == 0 && str_starts_with($currentPath, ltrim($adminRoutesPrefix, '/'))) ||
            ($userRole == 1 && str_starts_with($currentPath, ltrim($userRoutesPrefix, '/')))
        ) {
            return $next($request); // Allow access
        }

        // Deny access if the user role does not match the route prefix
        return redirect('/')->with('error', 'Access denied.');
    }
}

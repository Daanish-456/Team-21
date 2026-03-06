<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Check if the user is an admin
class IsAdminUserVerifier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('UserID') || ! $request->session()->has('UserName')) {
            return redirect('login');
        }

        $user = User::where('UserID', '=', $request->session()->get('UserID'))->first();

        if (! $user) {
            $request->session()->invalidate();

            return redirect('login');
        }

        if (strtolower((string) $user->Role) !== 'admin') {
            return redirect('/');
        }

        return $next($request);
    }
}

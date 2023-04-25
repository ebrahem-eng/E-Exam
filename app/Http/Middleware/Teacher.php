<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Teacher
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
        try {
            if (!Auth::guard('teacher')->check()) {
                return redirect()->route('teacher.login.page')->with('error_login_message', 'Check Your email or password');
            }
            return $next($request);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna sudah login
        if (Auth::check()) {
            // Jika sudah login, periksa apakah perannya adalah 'admin'
            if (Auth::user()->role === 'admin') {
                return $next($request);
            }
        }

        // Jika tidak login atau bukan admin, arahkan ke halaman login
        // dengan pesan error yang jelas.
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('error', 'Akses ditolak. Anda tidak memiliki izin admin.');
    }
}


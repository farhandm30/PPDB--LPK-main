<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SiswaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->role !== 'siswa') {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Tidak diizinkan.'], 403);
            }

            return redirect()->route('siswa.login')->with('error', 'Anda harus login sebagai siswa untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}

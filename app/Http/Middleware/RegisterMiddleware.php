<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;

class RegisterMiddleware
{
    /**
     * Handle an incoming request.
     * 
     * Middleware ini mengatur akses ke halaman pendaftaran:
     * - Jika tidak ada tahun ajaran aktif, redirect ke home dengan pesan error
     * - Jika user sudah login sebagai siswa, redirect ke dashboard siswa
     * - Jika pendaftaran ditutup, redirect ke home dengan pesan error
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah ada tahun ajaran aktif
        $tahunAjaranAktif = TahunAjaran::where('status_tahun_ajaran', 'Aktif')->first();

        if (!$tahunAjaranAktif) {
            return redirect()->route('home')->with('error', 'Pendaftaran belum dibuka. Silahkan cek kembali nanti.');
        }

        // Cek apakah pendaftaran dibuka
        $pengaturan = \App\Models\Pengaturan::first();
        if ($pengaturan && isset($pengaturan->status_pendaftaran) && $pengaturan->status_pendaftaran === 'tutup') {
            return redirect()->route('home')->with('error', 'Pendaftaran saat ini ditutup. Silahkan cek kembali nanti.');
        }

        // Jika user sudah login sebagai siswa, redirect ke dashboard siswa
        if (Auth::check() && Auth::user()->role === 'siswa') {
            return redirect()->route('siswa.dashboard')->with('info', 'Anda sudah terdaftar dan login sebagai siswa.');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Pendaftaran;
use App\Models\Jurusan;
use App\Models\TahunAjaran;
use App\Models\OrangtuaWali;
use App\Models\Berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            if (Auth::user()->role === 'admin' || Auth::user()->is_admin) {
                return redirect()->route('filament.admin.pages.dashboard')
                    ->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
            } else {
                return redirect()->route('siswa.dashboard')
                    ->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan tidak valid.',
        ])->onlyInput('email');
    }

    /**
     * Show the registration form.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nik' => ['required', 'string', 'min:16', 'max:16', 'unique:pendaftarans,nik_siswa'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'jenis_kelamin' => ['required', 'string', 'in:Laki-laki,Perempuan'],
            'no_hp' => ['required', 'string', 'max:15'],
            'asal_sekolah' => ['required', 'string', 'max:255'],
            'jurusan' => ['required', 'exists:jurusans,id'],
        ]);

        // Store the original password to display in the PDF
        $originalPassword = $request->password;
        session(['original_password' => $originalPassword]);

        // Get the selected jurusan
        $selectedJurusan = Jurusan::findOrFail($request->jurusan);

        // Get the first active tahun ajaran
        $tahunAjaran = TahunAjaran::where('status_tahun_ajaran', 'Aktif')->first();
        if (!$tahunAjaran) {
            // If no active tahun ajaran exists, use the first one or create a default
            $tahunAjaran = TahunAjaran::first();
            if (!$tahunAjaran) {
                $tahunAjaran = TahunAjaran::create([
                    'nama_tahun_ajaran' => date('Y') . '/' . (date('Y') + 1),
                    'status_tahun_ajaran' => 'Aktif',
                ]);
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        // Create pendaftaran record (main record for registration process)
        $pendaftaran = Pendaftaran::create([
            'user_id' => $user->id,
            'no_daftar' => 'PPDB-' . date('Ymd') . '-' . str_pad($user->id, 4, '0', STR_PAD_LEFT),
            'tgl_daftar' => now(),
            'id_jurusan' => $selectedJurusan->id,
            'id_tahun_ajaran' => $tahunAjaran->id,
            'nama_siswa' => $request->name,
            'nik_siswa' => $request->nik,
            'jk_siswa' => $request->jenis_kelamin,
            'asal_sekolah' => $request->asal_sekolah,
            'tempat_lahir_siswa' => 'Belum diisi',
            'tgl_lahir_siswa' => now(),
            'agama_siswa' => 'Belum diisi',
            'alamat_siswa' => 'Belum diisi',
            'email_siswa' => $request->email,
            'nohp_siswa' => $request->no_hp,
            'foto_siswa' => 'default.jpg',
            // Parent information
            'nik_ayah' => '0000000000000000',
            'nama_ayah' => 'Belum diisi',
            'tgl_lahir_ayah' => now(),
            'pendidikan_terakhir_ayah' => 'Belum diisi',
            'pekerjaan_ayah' => 'Belum diisi',
            'penghasilan_ayah' => '0',
            'nik_ibu' => '0000000000000000',
            'nama_ibu' => 'Belum diisi',
            'tgl_lahir_ibu' => now(),
            'pendidikan_terakhir_ibu' => 'Belum diisi',
            'pekerjaan_ibu' => 'Belum diisi',
            'penghasilan_ibu' => '0',
            'nik_wali' => '0000000000000000',
            'nama_wali' => 'Belum diisi',
            'tgl_lahir_wali' => now(),
            'pendidikan_terakhir_wali' => 'Belum diisi',
            'pekerjaan_wali' => 'Belum diisi',
            'penghasilan_wali' => '0',
            'alamat_orangtua' => 'Belum diisi',
            'no_hp_orangtua' => 'Belum diisi',
            // Status fields
            'status_data_diri' => 'Belum Lengkap',
            'status_data_orangtua' => 'Belum Lengkap',
            'status_berkas' => 'Belum Lengkap',
            'status_pendaftaran' => 'Menunggu Verifikasi',
        ]);

        event(new Registered($user));

        // Get the pengaturan
        $pengaturan = \App\Models\Pengaturan::first();

        // Generate bukti pendaftaran PDF with the original password
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('siswa.dashboard.bukti_pendaftaran', compact('user', 'pendaftaran', 'pengaturan', 'originalPassword', 'selectedJurusan'));

        // Save to storage
        $fileName = 'bukti_pendaftaran_' . $pendaftaran->no_daftar . '.pdf';
        $path = 'siswa/berkas/bukti_pendaftaran/' . $fileName;
        \Illuminate\Support\Facades\Storage::disk('public')->put($path, $pdf->output());

        // Update pendaftaran record with bukti pendaftaran
        $pendaftaran->bukti_pendaftaran = $path;
        $pendaftaran->save();

        // Store file path in session for download
        session()->flash('pdf_path', $path);
        session()->flash('pdf_filename', $fileName);
        session()->flash('success', true);

        // Return view with success message
        return view('auth.register');
    }

    /**
     * Download bukti pendaftaran after registration.
     */
    public function downloadBuktiPendaftaran()
    {
        if (!session()->has('pdf_path') || !session()->has('pdf_filename')) {
            return redirect()->route('auth.register')->with('error', 'File bukti pendaftaran tidak ditemukan.');
        }

        $path = session('pdf_path');
        $filename = session('pdf_filename');

        // Get the full path to the file
        $fullPath = storage_path('app/public/' . $path);

        // Check if file exists
        if (!file_exists($fullPath)) {
            return redirect()->route('auth.register')->with('error', 'File bukti pendaftaran tidak ditemukan.');
        }

        // Return file download response
        return response()->download($fullPath, $filename, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

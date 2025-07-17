<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Pengaturan;
use App\Models\Siswa;
use App\Models\OrangtuaWali;
use App\Models\Berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Schema;

class SiswaDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Middleware sudah didefinisikan di routes/web.php
    }

    /**
     * Display the siswa dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $pendaftaran = $user->pendaftaran;
        $pengaturan = Pengaturan::first();

        return view('siswa.dashboard.index', compact('user', 'pendaftaran', 'pengaturan'));
    }

    /**
     * Display the data diri form.
     */
    public function dataDiri()
    {
        $user = Auth::user();
        $pendaftaran = $user->pendaftaran;

        if (!$pendaftaran) {
            return redirect()->route('siswa.dashboard')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        return view('siswa.dashboard.data-diri', compact('user', 'pendaftaran'));
    }

    /**
     * Update data diri - now updates pendaftaran table directly.
     */
    public function updateDataDiri(Request $request)
    {
        $user = Auth::user();
        $pendaftaran = $user->pendaftaran;

        if (!$pendaftaran) {
            return redirect()->route('siswa.dashboard')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'nama_siswa' => 'required|string|max:100',
            'nik_siswa' => 'required|string|max:16',
            'tempat_lahir_siswa' => 'required|string|max:100',
            'tgl_lahir_siswa' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama_siswa' => 'required|string|max:20',
            'alamat_siswa' => 'required|string',
            'nohp_siswa' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:100',
            'foto_siswa' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update pendaftaran record with new data
        $pendaftaran->nama_siswa = $request->nama_siswa;
        $pendaftaran->nik_siswa = $request->nik_siswa;
        $pendaftaran->tempat_lahir_siswa = $request->tempat_lahir_siswa;
        $pendaftaran->tgl_lahir_siswa = $request->tgl_lahir_siswa;
        $pendaftaran->jk_siswa = $request->jenis_kelamin;
        $pendaftaran->agama_siswa = $request->agama_siswa;
        $pendaftaran->alamat_siswa = $request->alamat_siswa;
        $pendaftaran->nohp_siswa = $request->nohp_siswa;
        $pendaftaran->asal_sekolah = $request->asal_sekolah;

        // Handle foto upload
        if ($request->hasFile('foto_siswa')) {
            if ($pendaftaran->foto_siswa && $pendaftaran->foto_siswa !== 'default.jpg') {
                Storage::disk('public')->delete($pendaftaran->foto_siswa);
            }
            $foto = $request->file('foto_siswa');
            $fotoPath = $foto->store('siswa/foto', 'public');
            $pendaftaran->foto_siswa = $fotoPath;
        }
        // Don't set foto_siswa to null if no file uploaded

        // Ensure foto_siswa is never null before saving
        if (!$pendaftaran->foto_siswa) {
            $pendaftaran->foto_siswa = 'default.jpg';
        }

        // Update status data diri
        $pendaftaran->status_data_diri = 'Lengkap';
        $pendaftaran->save();

        return redirect()->route('siswa.data-diri')->with('success', 'Data diri berhasil diperbarui.');
    }

    /**
     * Display the data orangtua form.
     */
    public function dataOrangtua()
    {
        $user = Auth::user();
        $pendaftaran = $user->pendaftaran;

        if (!$pendaftaran) {
            return redirect()->route('siswa.dashboard')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        return view('siswa.dashboard.data-orangtua', compact('user', 'pendaftaran'));
    }

    /**
     * Update data orangtua - now updates pendaftaran table directly.
     */
    public function updateDataOrangtua(Request $request)
    {
        $user = Auth::user();
        $pendaftaran = $user->pendaftaran;

        if (!$pendaftaran) {
            return redirect()->route('siswa.dashboard')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'nama_ayah' => 'required|string|max:100',
            'nik_ayah' => 'required|string|max:20',
            'tgl_lahir_ayah' => 'required|date',
            'pendidikan_terakhir_ayah' => 'required|string|max:100',
            'pekerjaan_ayah' => 'required|string|max:100',
            'penghasilan_ayah' => 'required|string|max:100',
            'nama_ibu' => 'required|string|max:100',
            'nik_ibu' => 'required|string|max:20',
            'tgl_lahir_ibu' => 'required|date',
            'pendidikan_terakhir_ibu' => 'required|string|max:100',
            'pekerjaan_ibu' => 'required|string|max:100',
            'penghasilan_ibu' => 'required|string|max:100',
            'nama_wali' => 'nullable|string|max:100',
            'nik_wali' => 'nullable|string|max:20',
            'tgl_lahir_wali' => 'nullable|date',
            'pendidikan_terakhir_wali' => 'nullable|string|max:100',
            'pekerjaan_wali' => 'nullable|string|max:100',
            'penghasilan_wali' => 'nullable|string|max:100',
            'alamat_orangtua' => 'required|string',
            'no_hp_orangtua' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update pendaftaran record with parent data
        // Father data
        $pendaftaran->nama_ayah = $request->nama_ayah;
        $pendaftaran->nik_ayah = $request->nik_ayah;
        $pendaftaran->tgl_lahir_ayah = $request->tgl_lahir_ayah;
        $pendaftaran->pendidikan_terakhir_ayah = $request->pendidikan_terakhir_ayah;
        $pendaftaran->pekerjaan_ayah = $request->pekerjaan_ayah;
        $pendaftaran->penghasilan_ayah = $request->penghasilan_ayah;

        // Mother data
        $pendaftaran->nama_ibu = $request->nama_ibu;
        $pendaftaran->nik_ibu = $request->nik_ibu;
        $pendaftaran->tgl_lahir_ibu = $request->tgl_lahir_ibu;
        $pendaftaran->pendidikan_terakhir_ibu = $request->pendidikan_terakhir_ibu;
        $pendaftaran->pekerjaan_ibu = $request->pekerjaan_ibu;
        $pendaftaran->penghasilan_ibu = $request->penghasilan_ibu;

        // Guardian data
        $pendaftaran->nama_wali = $request->nama_wali;
        $pendaftaran->nik_wali = $request->nik_wali;
        $pendaftaran->tgl_lahir_wali = $request->tgl_lahir_wali;
        $pendaftaran->pendidikan_terakhir_wali = $request->pendidikan_terakhir_wali ?? 'Belum diisi';
        $pendaftaran->pekerjaan_wali = $request->pekerjaan_wali;
        $pendaftaran->penghasilan_wali = $request->penghasilan_wali;

        // Contact information
        $pendaftaran->alamat_orangtua = $request->alamat_orangtua;
        $pendaftaran->no_hp_orangtua = $request->no_hp_orangtua;

        // Update status data orangtua
        $pendaftaran->status_data_orangtua = 'Lengkap';
        $pendaftaran->save();

        return redirect()->route('siswa.data-orangtua')->with('success', 'Data orangtua/wali berhasil diperbarui.');
    }

    /**
     * Display the berkas upload form.
     */
    public function berkas()
    {
        $user = Auth::user();
        $pendaftaran = $user->pendaftaran;
        $pengaturan = Pengaturan::first();

        return view('siswa.dashboard.berkas', compact('user', 'pendaftaran', 'pengaturan'));
    }

    /**
     * Upload berkas.
     */
    public function uploadBerkas(Request $request)
    {
        $user = Auth::user();
        $pendaftaran = $user->pendaftaran;

        if (!$pendaftaran) {
            return redirect()->route('siswa.data-diri')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'ijazah_terakhir' => 'required|file|mimes:pdf|max:2048',
            'ktp_sim_paspor' => 'required|file|mimes:pdf|max:2048',
            'berkas_lain_1' => 'nullable|file|mimes:pdf|max:2048',
            'berkas_lain_2' => 'nullable|file|mimes:pdf|max:2048',
            'berkas_lain_3' => 'nullable|file|mimes:pdf|max:2048',
            'berkas_lain_4' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Upload ijazah terakhir
        if ($request->hasFile('ijazah_terakhir')) {
            if ($pendaftaran->ijazah_terakhir) {
                Storage::disk('public')->delete($pendaftaran->ijazah_terakhir);
            }
            $file = $request->file('ijazah_terakhir');
            $path = $file->store('siswa/berkas/ijazah', 'public');
            $pendaftaran->ijazah_terakhir = $path;
        }

        // Upload KTP/SIM/Paspor
        if ($request->hasFile('ktp_sim_paspor')) {
            if ($pendaftaran->ktp_sim_paspor) {
                Storage::disk('public')->delete($pendaftaran->ktp_sim_paspor);
            }
            $file = $request->file('ktp_sim_paspor');
            $path = $file->store('siswa/berkas/identitas', 'public');
            $pendaftaran->ktp_sim_paspor = $path;
        }

        // Upload berkas lain 1
        if ($request->hasFile('berkas_lain_1')) {
            if ($pendaftaran->berkas_lain_1) {
                Storage::disk('public')->delete($pendaftaran->berkas_lain_1);
            }
            $file = $request->file('berkas_lain_1');
            $path = $file->store('siswa/berkas/lainnya', 'public');
            $pendaftaran->berkas_lain_1 = $path;
        }

        // Upload berkas lain 2
        if ($request->hasFile('berkas_lain_2')) {
            if ($pendaftaran->berkas_lain_2) {
                Storage::disk('public')->delete($pendaftaran->berkas_lain_2);
            }
            $file = $request->file('berkas_lain_2');
            $path = $file->store('siswa/berkas/lainnya', 'public');
            $pendaftaran->berkas_lain_2 = $path;
        }

        // Upload berkas lain 3
        if ($request->hasFile('berkas_lain_3')) {
            if ($pendaftaran->berkas_lain_3) {
                Storage::disk('public')->delete($pendaftaran->berkas_lain_3);
            }
            $file = $request->file('berkas_lain_3');
            $path = $file->store('siswa/berkas/lainnya', 'public');
            $pendaftaran->berkas_lain_3 = $path;
        }

        // Upload berkas lain 4
        if ($request->hasFile('berkas_lain_4')) {
            if ($pendaftaran->berkas_lain_4) {
                Storage::disk('public')->delete($pendaftaran->berkas_lain_4);
            }
            $file = $request->file('berkas_lain_4');
            $path = $file->store('siswa/berkas/lainnya', 'public');
            $pendaftaran->berkas_lain_4 = $path;
        }

        $pendaftaran->save();

        return redirect()->route('siswa.berkas')->with('success', 'Berkas berhasil diupload.');
    }

    /**
     * View berkas file in new tab.
     */
    public function viewBerkas(Request $request, $type)
    {
        $user = Auth::user();
        $pendaftaran = $user->pendaftaran;

        if (!$pendaftaran) {
            abort(404, 'Data pendaftaran tidak ditemukan.');
        }

        $allowedTypes = ['ijazah_terakhir', 'ktp_sim_paspor', 'bukti_pendaftaran', 'surat_pernyataan', 'berkas_lain_1', 'berkas_lain_2', 'berkas_lain_3', 'berkas_lain_4'];

        if (!in_array($type, $allowedTypes)) {
            abort(404, 'Tipe berkas tidak valid.');
        }

        $filePath = $pendaftaran->$type;
        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        $fullPath = storage_path('app/public/' . $filePath);
        $mimeType = mime_content_type($fullPath);

        return response()->file($fullPath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"'
        ]);
    }

    /**
     * Download berkas file.
     */
    public function downloadBerkas(Request $request, $type)
    {
        $user = Auth::user();
        $pendaftaran = $user->pendaftaran;

        if (!$pendaftaran) {
            abort(404, 'Data pendaftaran tidak ditemukan.');
        }

        $allowedTypes = ['ijazah_terakhir', 'ktp_sim_paspor', 'bukti_pendaftaran', 'surat_pernyataan', 'berkas_lain_1', 'berkas_lain_2', 'berkas_lain_3', 'berkas_lain_4'];

        if (!in_array($type, $allowedTypes)) {
            abort(404, 'Tipe berkas tidak valid.');
        }

        $filePath = $pendaftaran->$type;
        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        $fullPath = storage_path('app/public/' . $filePath);
        $fileName = $this->getBerkasDisplayName($type) . '_' . $pendaftaran->no_daftar . '.' . pathinfo($filePath, PATHINFO_EXTENSION);

        return response()->download($fullPath, $fileName);
    }

    /**
     * Get display name for berkas type.
     */
    private function getBerkasDisplayName($type)
    {
        $names = [
            'ijazah_terakhir' => 'Ijazah_Terakhir',
            'ktp_sim_paspor' => 'KTP_SIM_Paspor',
            'bukti_pendaftaran' => 'Bukti_Pendaftaran',
            'surat_pernyataan' => 'Surat_Pernyataan',
            'berkas_lain_1' => 'Berkas_Lain_1',
            'berkas_lain_2' => 'Berkas_Lain_2',
            'berkas_lain_3' => 'Berkas_Lain_3',
            'berkas_lain_4' => 'Berkas_Lain_4',
        ];

        return $names[$type] ?? $type;
    }

    /**
     * Display the hasil pendaftaran.
     */
    public function hasil()
    {
        $user = Auth::user();
        $pendaftaran = $user->pendaftaran;

        if (!$pendaftaran) {
            return redirect()->route('siswa.dashboard')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        return view('siswa.dashboard.hasil', compact('user', 'pendaftaran'));
    }

    /**
     * Generate and save bukti pendaftaran PDF.
     */
    public function generateBuktiPendaftaran()
    {
        $user = Auth::user();
        $pendaftaran = $user->pendaftaran;
        $pengaturan = Pengaturan::first();

        if (!$pendaftaran) {
            return back()->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        // Get jurusan data
        $selectedJurusan = $pendaftaran->jurusan;

        $pdf = PDF::loadView('siswa.dashboard.bukti_pendaftaran', compact('user', 'pendaftaran', 'pengaturan', 'selectedJurusan'));

        // Save to storage
        $fileName = 'bukti_pendaftaran_' . $pendaftaran->no_daftar . '.pdf';
        $path = 'siswa/berkas/bukti_pendaftaran/' . $fileName;
        Storage::disk('public')->put($path, $pdf->output());

        // Update pendaftaran record with bukti pendaftaran path
        $pendaftaran->bukti_pendaftaran = $path;
        $pendaftaran->save();

        return $pdf->download($fileName);
    }

    /**
     * Generate and save surat pernyataan PDF.
     */
    public function generateSuratPernyataan()
    {
        $user = Auth::user();
        $pendaftaran = $user->pendaftaran;
        $pengaturan = Pengaturan::first();

        if (!$pendaftaran) {
            return back()->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        if ($pendaftaran->status_pendaftaran != 'Diterima') {
            return back()->with('error', 'Surat pernyataan hanya tersedia untuk pendaftaran yang sudah diterima.');
        }

        $pdf = PDF::loadView('siswa.dashboard.surat_pernyataan', compact('user', 'pendaftaran', 'pengaturan'));

        // Save to storage
        $fileName = 'surat_pernyataan_' . $pendaftaran->no_daftar . '.pdf';
        $path = 'siswa/berkas/surat_pernyataan/' . $fileName;
        Storage::disk('public')->put($path, $pdf->output());

        return $pdf->download($fileName);
    }

    /**
     * Upload signed surat pernyataan.
     */
    public function uploadSuratPernyataan(Request $request)
    {
        $user = Auth::user();
        $pendaftaran = $user->pendaftaran;

        if (!$pendaftaran) {
            return back()->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        if ($pendaftaran->status_pendaftaran != 'Diterima') {
            return back()->with('error', 'Anda tidak dapat mengupload surat pernyataan karena pendaftaran belum diterima.');
        }

        $validator = Validator::make($request->all(), [
            'surat_pernyataan' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Upload surat pernyataan to pendaftaran record
        if ($request->hasFile('surat_pernyataan')) {
            if ($pendaftaran->surat_pernyataan) {
                Storage::disk('public')->delete($pendaftaran->surat_pernyataan);
            }
            $file = $request->file('surat_pernyataan');
            $path = $file->store('siswa/berkas/surat_pernyataan', 'public');
            $pendaftaran->surat_pernyataan = $path;
            $pendaftaran->save();
        }

        return redirect()->route('siswa.hasil')->with('success', 'Surat pernyataan berhasil diupload.');
    }
}

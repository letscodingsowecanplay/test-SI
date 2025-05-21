<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Soal;
use App\Models\Kkm;
use App\Models\JawabanSoal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EvaluasiController extends Controller
{
    public function index()
    {
        $kuisId = 'evaluasi-1';
        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 7;

        // Soal tetap ditampilkan walau belum lulus
        $soals = \App\Models\Soal::with('jawaban')->get();
        return view('admin.evaluasi.index', compact('soals', 'kkm'));
    }


    public function simpan(Request $request)
    {
        try {
            $validated = $request->validate([
                'jawaban' => 'required|array',
                'jawaban.*' => 'nullable|string|size:1',
            ]);

            $jawaban = $validated['jawaban'];
            $userId = auth()->id();
            $kuisId = 'evaluasi-1';

            // Ambil nilai KKM dari tabel kkm
            $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 7;

            $kunci = [
                '1' => 'A', '2' => 'C', '3' => 'C', '4' => 'C', '5' => 'C',
                '6' => 'C', '7' => 'C', '8' => 'C', '9' => 'C', '10' => 'C',
            ];

            $benar = 0;
            foreach ($kunci as $nomor => $jawabanBenar) {
                if (isset($jawaban[$nomor]) && strtoupper($jawaban[$nomor]) === $jawabanBenar) {
                    $benar++;
                }
            }

            $status = $benar >= $kkm ? 'lulus' : 'tidak_lulus';

            // Simpan menggunakan model agar Observer aktif
            \App\Models\Nilai::updateOrCreate(
                ['user_id' => $userId, 'kuis_id' => $kuisId],
                [
                    'skor' => $benar,
                    'total_soal' => count($kunci),
                    'jawaban' => $jawaban, // langsung array (gunakan cast di model)
                    'status' => $status,
                    'updated_at' => now(),
                    'created_at' => now()
                ]
            );

            return response()->json([
                'success' => true,
                'skor' => $benar,
                'skor_persen' => round(($benar / count($kunci)) * 100),
                'total_soal' => count($kunci),
                'status' => $status,
            ]);

        } catch (\Exception $e) {
            \Log::error('Gagal menyimpan evaluasi: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'errors' => method_exists($e, 'errors') ? $e->errors() : null
            ], 500);
        }
    }


    public function reset()
    {
        \App\Models\Nilai::where('user_id', auth()->id())
            ->where('kuis_id', 'evaluasi-1')
            ->delete();

        return redirect()->route('admin.evaluasi.index')
            ->with('success', 'Kuis evaluasi berhasil direset.');
    }


    public function petunjuk()
    {
        $user = Auth::user();
        $kuisId = 'evaluasi-1';

        // Gunakan model Nilai agar konsisten
        $hasil = \App\Models\Nilai::where('user_id', $user->id)
            ->where('kuis_id', $kuisId)
            ->first();

        $bisaMulaiKuis = !$hasil || ($hasil && $hasil->status === 'tidak_lulus');

        // Ambil kkm dari tabel kkm jika ingin ditampilkan
        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? null;

        return view('admin.evaluasi.petunjuk', [
            'user' => $user,
            'hasil' => $hasil,
            'bisaMulaiKuis' => $bisaMulaiKuis,
            'kkm' => $kkm,
        ]);
    }



}

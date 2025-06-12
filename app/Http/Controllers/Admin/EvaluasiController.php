<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Kkm;
use Illuminate\Support\Facades\Auth;

class EvaluasiController extends Controller
{
    public function index()
    {
        // Tidak perlu passing variabel ke view, semua soal di JS
        return view('admin.evaluasi.index');
    }

    public function simpan(Request $request)
    {
        $validated = $request->validate([
            'jawaban' => 'required|array',
            'jawaban.*' => 'nullable|string|size:1',
        ]);

        $userId = auth()->id();
        $kuisId = 'evaluasi-1';

        // Kunci jawaban
        $kunci = [
            1 => 'A',
            2 => 'C',
            3 => 'C',
            4 => 'B',
            5 => 'B',
            6 => 'B',
            7 => 'C',
            8 => 'B',
            9 => 'A',
            10 => 'C',
        ];

        $benar = 0;
        foreach ($kunci as $nomor => $jawabanBenar) {
            if (
                isset($validated['jawaban'][$nomor]) &&
                strtoupper($validated['jawaban'][$nomor]) === $jawabanBenar
            ) {
                $benar++;
            }
        }

        $bobot = 10; // Bobot per soal
        $totalSoal = count($kunci);
        $nilaiAkhir = $benar * $bobot;

        // Ambil KKM, misal KKM 70 berarti harus dapat nilai 70 untuk lulus (bisa custom tiap evaluasi)
        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 70;
        $status = $nilaiAkhir >= $kkm ? 'lulus' : 'tidak_lulus';

        \App\Models\Nilai::updateOrCreate(
            ['user_id' => $userId, 'kuis_id' => $kuisId],
            [
                'skor' => $nilaiAkhir,
                'total_soal' => $totalSoal,
                'jawaban' => $validated['jawaban'],
                'status' => $status,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        return response()->json([
            'success' => true,
            'skor' => $nilaiAkhir,
            'skor_persen' => round(($nilaiAkhir / ($totalSoal * $bobot)) * 100),
            'total_soal' => $totalSoal,
            'status' => $status,
        ]);
    }


    public function reset()
    {
        Nilai::where('user_id', auth()->id())
            ->where('kuis_id', 'evaluasi-1')
            ->delete();

        return redirect()->route('admin.evaluasi.index')
            ->with('success', 'Kuis evaluasi berhasil direset.');
    }

    public function petunjuk()
    {
        $user = Auth::user();
        $kuisEvaluasiId = 'evaluasi-1';

        $hasil = \App\Models\Nilai::where('user_id', $user->id)
            ->where('kuis_id', $kuisEvaluasiId)
            ->first();

        // Tentukan jumlah soal dan bobot per soal HARUS sesuai dengan logic saat simpan!
        $jumlahSoal = 10;
        $bobot = 10; // Bobot per soal, sesuaikan jika berubah
        $skorMaksimal = $jumlahSoal * $bobot;

        if ($hasil) {
            // Untuk backward compatibility, gunakan total_soal jika ada, kalau tidak, default 10
            $totalSoal = $hasil->total_soal ?: $jumlahSoal;
            $skorMaksimalAktual = $totalSoal * $bobot;
            $skorUser = $hasil->skor ?? 0;
            $hasil->skor_persen = $skorMaksimalAktual > 0 ? round(($skorUser / $skorMaksimalAktual) * 100) : 0;
        }

        $kkm = \App\Models\Kkm::where('kuis_id', $kuisEvaluasiId)->value('kkm') ?? null;

        // Daftar kuis prasyarat
        $kuisWajib = [
            'ayo-mencoba-1' => 'Ayo Mencoba 1',
            'ayo-berlatih-1' => 'Ayo Berlatih 1',
            'ayo-mencoba-2' => 'Ayo Mencoba 2',
            'ayo-berlatih-2' => 'Ayo Berlatih 2',
            'ayo-mencoba-3' => 'Ayo Mencoba 3',
            'ayo-berlatih-3' => 'Ayo Berlatih 3',
        ];

        $nilaiKuis = \App\Models\Nilai::where('user_id', $user->id)
            ->whereIn('kuis_id', array_keys($kuisWajib))
            ->get();

        $kuisBelumLulus = [];
        foreach ($kuisWajib as $kuisId => $namaKuis) {
            $nilai = $nilaiKuis->firstWhere('kuis_id', $kuisId);
            if (!$nilai || $nilai->status !== 'lulus') {
                $kuisBelumLulus[$kuisId] = $namaKuis;
            }
        }

        $bisaMulaiEvaluasi = (!$hasil || $hasil->status === 'tidak_lulus') && count($kuisBelumLulus) === 0;

        return view('admin.evaluasi.petunjuk', [
            'user' => $user,
            'hasil' => $hasil,
            'kkm' => $kkm,
            'bisaMulaiKuis' => $bisaMulaiEvaluasi,
            'kuisBelumSelesai' => $kuisBelumLulus,
        ]);
    }


}

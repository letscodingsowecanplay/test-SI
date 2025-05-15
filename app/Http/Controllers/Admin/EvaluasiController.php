<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\Nilai;

class EvaluasiController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $sudah = Nilai::where('user_id', $user->id)
            ->where('kuis_id', 'evaluasi-1')
            ->exists();

        if ($sudah) {
            return redirect()->route('admin.evaluasi.petunjuk')
                ->with('error', 'Anda sudah mengerjakan kuis ini.');
        }

        $soals = Soal::with('jawaban')->get();
        return view('admin.evaluasi.index', compact('soals'));
    }

    public function simpan(Request $request)
    {
        try {
            $validated = $request->validate([
                'jawaban' => 'required|array',
                'jawaban.*' => 'nullable|string|size:1',
            ]);

            \Log::info('Data jawaban diterima:', $validated);

            $jawabanUser = $validated['jawaban'];
            $kunciJawaban = [
                '1' => 'A',
                '2' => 'C',
                '3' => 'C',
                '4' => 'C',
                '5' => 'C',
                '6' => 'C',
                '7' => 'C',
                '8' => 'C',
                '9' => 'C',
                '10' => 'C',
                // ... lengkapi semua kunci jawaban
            ];

            $skor = 0;
            foreach ($kunciJawaban as $idSoal => $kunci) {
                if (isset($jawabanUser[$idSoal])) {
                    $jawabanUser[$idSoal] = strtoupper($jawabanUser[$idSoal]);
                    if ($jawabanUser[$idSoal] === $kunci) {
                        $skor++;
                    }
                }
            }

            $nilai = Nilai::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'kuis_id' => 'evaluasi-1'
                ],
                [
                    'skor' => $skor,
                    'total_soal' => count($kunciJawaban),
                    'jawaban' => json_encode($jawabanUser)
                ]
            );

            return response()->json([
                'success' => true,
                'skor' => $skor,
                'skor_persen' => round(($skor / count($kunciJawaban)) * 100),
                'total_soal' => count($kunciJawaban)
            ]);

        } catch (\Exception $e) {
            \Log::error('Error simpan jawaban: '.$e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'errors' => $e->errors() ?? null
            ], 500);
        }
    }

    public function petunjuk()
    {
        $user = Auth::user();

        $hasil = Nilai::where('user_id', $user->id)
            ->where('kuis_id', 'evaluasi-1')
            ->first();

        return view('admin.evaluasi.petunjuk', [
            'user' => $user,
            'hasil' => $hasil
        ]);
    }


}

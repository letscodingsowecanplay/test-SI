<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Nilai;

class MateriController extends Controller
{
    public function index()
    {
        return view('admin.materi.index');
    }

    public function halamanDua()
    {
        return view('admin.materi.halaman2');
    }

    public function halamanTiga()
    {
        return view('admin.materi.halaman3');
    }

    public function halamanEmpat()
    {
        $userId = auth()->id();
        $kuisId = 'kuis-1';
        $kkm = 3; // Contoh KKM, bisa sesuaikan

        $nilai = Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $sudahMenjawab = $nilai ? true : false;
        $skor = $nilai ? $nilai->skor : 0;

        return view('admin.materi.halaman4', compact('sudahMenjawab', 'skor', 'kkm'));
    }

    public function simpanHalamanEmpat(Request $request)
    {
        $request->validate([
            'jawaban.soal1' => 'required',
            'jawaban.soal2' => 'required',
            'jawaban.soal3' => 'required',
            'jawaban.soal4' => 'required',
        ]);

        $benar = 0;
        $jawaban = $request->input('jawaban');

        $kunci = [
            'soal1' => 'a', // misal: a itu gambar lebih panjang
            'soal2' => 'b', // misal: b itu gambar lebih pendek
            'soal3' => 'a',
            'soal4' => 'b',
        ];

        foreach ($kunci as $soal => $jawabanBenar) {
            if (isset($jawaban[$soal]) && $jawaban[$soal] === $jawabanBenar) {
                $benar++;
            }
        }

        Nilai::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'kuis_id' => 'kuis-1',
            ],
            [
                'skor' => $benar,
                'total_soal' => count($kunci),
            ]
        );

        return redirect()->route('admin.materi.halaman4')->with('success', "Skor berhasil disimpan! Nilai Anda: $benar dari " . count($kunci));
    }

    public function resetHalamanEmpat()
    {
        $userId = auth()->id();
        $kuisId = 'kuis-1';

        Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->delete();

        return redirect()->route('admin.materi.halaman4');
    }

    public function HalamanLima()
    {
        $userId = auth()->id();
        $kuisId = 'kuis-2';
        $kkm = 3; // minimal benar untuk lulus

        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $sudahMenjawab = $nilai !== null;
        $skor = $nilai?->skor ?? 0;

        $kunci = [
            'soal1' => 'panjang',
            'soal2' => 'kecil',
            'soal3' => 'tinggi',
            'soal4' => 'kecil'
        ];

        return view('admin.materi.halaman5', compact('sudahMenjawab', 'skor', 'kkm', 'kunci'));
    }

    public function simpanHalamanLima(Request $request)
    {
        $request->validate([
            'jawaban' => 'required|array',
            'jawaban.*' => 'required|string|in:panjang,pendek,tinggi,rendah,besar,kecil',
        ]);

        $jawaban = $request->input('jawaban');
        $userId = auth()->id();
        $kuisId = 'kuis-2';

        // Kunci jawaban
        $kunci = [
            'soal1' => 'panjang',
            'soal2' => 'kecil',
            'soal3' => 'tinggi',
            'soal4' => 'kecil'
        ];

        $skor = 0;
        foreach ($kunci as $soal => $kunciJawaban) {
            if (isset($jawaban[$soal]) && strtolower($jawaban[$soal]) === $kunciJawaban) {
                $skor++;
            }
        }

        // Simpan skor
        \App\Models\Nilai::updateOrCreate(
            ['user_id' => $userId, 'kuis_id' => $kuisId],
            [
                'skor' => $skor,
                'total_soal' => count($kunci),
                'jawaban' => json_encode($jawaban),
            ]
        );

        return redirect()->route('admin.materi.halaman5')->with('success', "Jawaban berhasil disimpan. Nilai Anda: $skor dari " . count($kunci));
    }


    public function resetHalaman5()
    {
        \App\Models\Nilai::where('user_id', auth()->id())
            ->where('kuis_id', 'kuis-2')
            ->delete();

        return redirect()->route('admin.materi.halaman5')->with('success', 'Kuis berhasil direset. Silakan mulai ulang.');
    }

    public function halamanEnam()
    {
        return view('admin.materi.halaman6');
    }

}

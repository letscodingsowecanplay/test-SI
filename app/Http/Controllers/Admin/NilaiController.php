<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function simpanHalaman4(Request $request)
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
                'kuis_id' => 'halaman4',
            ],
            [
                'skor' => $benar,
                'total_soal' => count($kunci),
            ]
        );

        return redirect()->route('admin.materi.halaman4')->with('success', "Skor berhasil disimpan! Nilai Anda: $benar dari " . count($kunci));
    }
}

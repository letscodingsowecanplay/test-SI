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
        // Cek dari database apakah user sudah mengisi nilai kuis halaman 4
        $sudahMenjawab = Nilai::where('user_id', auth()->id())
                            ->where('kuis_id', 'halaman4')
                            ->exists();

        return view('admin.materi.halaman4', compact('sudahMenjawab'));
    }

    public function simpanHalamanEmpat(Request $request)
    {
        // Cek apakah sudah pernah menyimpan
        $sudahAda = Nilai::where('user_id', auth()->id())
                         ->where('kuis_id', 'halaman4')
                         ->exists();

        if (!$sudahAda) {
            Nilai::create([
                'user_id' => auth()->id(),
                'kuis_id' => 'halaman4',
                'nilai' => 100, // Nilai bisa dihitung dari $request
            ]);
        }

        return redirect()->route('admin.materi.halaman4')->with('success', 'Jawaban berhasil disimpan!');
    }

    public function HalamanLima()
    {
        $soal = [
            [
                'id' => 1,
                'pertanyaan' => 'Urutan miniatur rumah banjar dari yang paling tinggi adalah ...',
                'opsi' => [
                    'a' => 'Anno 1925 - Bubungan Tinggi - Gajah Manyusu',
                    'b' => 'Bubungan Tinggi - Anno 1925 - Gajah Manyusu',
                    'c' => 'Gajah Manyusu - Bubungan Tinggi - Anno 1925',
                ],
                'gambar' => 'soal1.png'
            ],
            [
                'id' => 2,
                'pertanyaan' => 'Urutan tas khas Kalimantan dari yang tergantung paling rendah adalah ...',
                'opsi' => [
                    'a' => 'Tas anyaman hitam - Tas anyaman putih - Tas ecoprint',
                    'b' => 'Tas ecoprint - Tas anyaman putih - Tas anyaman hitam',
                    'c' => 'Tas anyaman putih - Tas anyaman hitam - Tas ecoprint',
                ],
                'gambar' => 'soal2.png'
            ],
            [
                'id' => 3,
                'pertanyaan' => 'Urutan kerajinan fiber glass patung dayak dimulai dari yang paling panjang adalah ...',
                'opsi' => [
                    'a' => 'b-c-a',
                    'b' => 'b-a-c',
                    'c' => 'c-a-b',
                ],
                'gambar' => 'soal3.png'
            ],
            [
                'id' => 4,
                'pertanyaan' => 'Urutan vas bunga akar keladi dimulai dari yang paling pendek adalah ...',
                'opsi' => [
                    'a' => 'a-c-b',
                    'b' => 'c-b-a',
                    'c' => 'c-a-b',
                ],
                'gambar' => 'soal4.png'
            ],
        ];

        return view('admin.materi.halaman5', compact('soal'));
    }

    public function simpanHalaman5(Request $request)
    {
        $jawabanBenar = [
            1 => 'a',
            2 => 'c',
            3 => 'a',
            4 => 'b',
        ];

        $skor = 0;
        $total = count($jawabanBenar);
        foreach ($jawabanBenar as $nomor => $benar) {
            if (($request->jawaban[$nomor] ?? null) === $benar) {
                $skor++;
            }
        }

        \App\Models\Nilai::create([
            'user_id' => auth()->id(),
            'kuis_id' => 'urutan',
            'skor' => $skor,
            'total_soal' => $total,
        ]);

        return redirect()->route('admin.materi.halaman5')->with('success', "Kuis disimpan. Skor Anda: $skor/$total");
    }

}

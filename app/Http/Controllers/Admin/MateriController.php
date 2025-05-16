<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Nilai;
use Illuminate\Support\Facades\DB;

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

    public function halamanLima()
    {
        $userId = auth()->id();
        $kuisId = 'kuis-2';
        $kkm = 3;

        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $sudahMenjawab = $nilai !== null;
        $skor = $nilai?->skor ?? 0;

        $kunci = [
            'soal1' => 'pendek',
            'soal2' => 'panjang',
            'soal3' => 'tinggi',
            'soal4' => 'rendah'
        ];

        $jawabanUser = [];
        if ($nilai && $nilai->jawaban) {
            $jawabanUser = json_decode($nilai->jawaban, true);
        } elseif (session()->has('jawaban_terakhir')) {
            $jawabanUser = session()->get('jawaban_terakhir');
            session()->forget('jawaban_terakhir');
        }

        return view('admin.materi.halaman5', compact('sudahMenjawab', 'skor', 'kkm', 'kunci', 'jawabanUser'));
    }

    public function simpanHalamanLima(Request $request)
    {
        $request->validate([
            'jawaban' => 'required|array',
            'jawaban.*' => 'required|string|in:panjang,pendek,tinggi,rendah',
        ]);

        $jawaban = $request->input('jawaban');
        $userId = auth()->id();
        $kuisId = 'kuis-2';

        $kunci = [
            'soal1' => 'pendek',
            'soal2' => 'panjang',
            'soal3' => 'tinggi',
            'soal4' => 'rendah'
        ];

        $skor = 0;
        $kkm = 3;
        foreach ($kunci as $soal => $jawabanBenar) {
            if (isset($jawaban[$soal]) && strtolower($jawaban[$soal]) === $jawabanBenar) {
                $skor++;
            }
        }

        \App\Models\Nilai::updateOrCreate(
            ['user_id' => $userId, 'kuis_id' => $kuisId],
            [
                'skor' => $skor,
                'total_soal' => count($kunci),
                'jawaban' => json_encode($jawaban),
            ]
        );

        if ($skor < $kkm) {
            session(['jawaban_terakhir' => $jawaban]);
        }

        return redirect()->route('admin.materi.halaman5')->with('success', "Jawaban berhasil disimpan. Nilai Anda: $skor dari " . count($kunci));
    }

    public function resetHalamanLima()
    {
        $nilai = \App\Models\Nilai::where('user_id', auth()->id())
            ->where('kuis_id', 'kuis-2')
            ->first();

        if ($nilai && $nilai->jawaban) {
            session(['jawaban_terakhir' => json_decode($nilai->jawaban, true)]);
        }

        \App\Models\Nilai::where('user_id', auth()->id())
            ->where('kuis_id', 'kuis-2')
            ->delete();

        return redirect()->route('admin.materi.halaman5')->with('success', 'Kuis berhasil direset. Silakan mulai ulang.');
    }

    public function halamanEnam()
    {
        return view('admin.materi.halaman6');
    }

    private function getSoalHalaman7()
    {
        return [
            [
                'pertanyaan' => '1. Urutan miniatur rumah banjar dari yang paling tinggi adalah ....',
                'gambar' => 'soal1.png',
                'audio' => 'audio0.mp3',
                'pilihan' => [
                    'a' => 'Anno 1925 - Bubungan Tinggi - Gajah Manyusu',
                    'b' => 'Bubungan Tinggi - Anno 1925 - Gajah Manyusu',
                    'c' => 'Gajah Manyusu - Bubungan Tinggi - Anno 1925'
                ],
                'jawaban' => 'a',
            ],
            [
                'pertanyaan' => '2. Urutan tas kerajinan khas Kalimantan dari yang digantung paling rendah adalah ....',
                'gambar' => 'soal2.png',
                'audio' => 'audio0.mp3',
                'pilihan' => [
                    'a' => 'Tas anyaman hitam - Tas anyaman putih - Tas ecoprint',
                    'b' => 'Tas ecoprint - Tas anyaman putih - Tas anyaman Hitam',
                    'c' => 'Tas anyaman putih - Tas anyaman hitam - Tas ecoprint'
                ],
                'jawaban' => 'b',
            ],
            [
                'pertanyaan' => '3. Urutan kerajinan fiber glass patung dayak dimulai dari yang paling panjang adalah ....',
                'gambar' => 'soal3.png',
                'audio' => 'audio0.mp3',
                'pilihan' => [
                    'a' => 'b-c-a',
                    'b' => 'b-a-c',
                    'c' => 'c-a-b'
                ],
                'jawaban' => 'b',
            ],
            [
                'pertanyaan' => '4. Urutan vas bunga akar keladi dimulai dari yang paling pendek adalah ....',
                'gambar' => 'soal4.png',
                'audio' => 'audio0.mp3',
                'pilihan' => [
                    'a' => 'a-c-b',
                    'b' => 'c-b-a',
                    'c' => 'a-b-c'
                ],
                'jawaban' => 'b',
            ],
            [
                'pertanyaan' => '5. Urutan kain sasirangan dimulai dari yang paling panjang adalah ....',
                'gambar' => 'soal5.png',
                'audio' => 'audio0.mp3',
                'pilihan' => [
                    'a' => 'a-b-c',
                    'b' => 'c-b-a',
                    'c' => 'a-c-b'
                ],
                'jawaban' => 'c',
            ],
        ];
    }

    public function halaman7(Request $request)
    {
        $kkm = 75;
        $soal = $this->getSoalHalaman7();

        $skor = $request->session()->get('skor_halaman7', null);
        $status = $request->session()->get('status_halaman7', null);

        if ($status !== null) {
            $kunciJawaban = array_column($soal, 'jawaban');
            $jawabanUser = $request->session()->get('jawaban_halaman7', []);
            return view('admin.materi.halaman7', compact(
                'soal', 'kkm', 'skor', 'status',
                'kunciJawaban', 'jawabanUser'
            ));
        }

        return view('admin.materi.halaman7', compact('soal', 'kkm', 'skor', 'status'));
    }

    public function submitHalaman7(Request $request)
    {
        $soal = $this->getSoalHalaman7();

        // Validasi: semua jawaban wajib diisi dan harus sesuai pilihan
        $rules = [];
        foreach ($soal as $index => $item) {
            $rules["jawaban_$index"] = 'required|in:' . implode(',', array_keys($item['pilihan']));
        }
        $request->validate($rules);

        $totalSoal = count($soal);
        $skor = 0;

        foreach ($soal as $index => $item) {
            $jawabanUser = $request->input("jawaban_$index");
            if ($jawabanUser === $item['jawaban']) {
                $skor++;
            }
        }

        $kkm = 75;
        $skorMinimal = ceil($kkm * $totalSoal / 100);
        $status = $skor >= $skorMinimal ? 'lulus' : 'tidak_lulus';

        // Simpan ke session
        $request->session()->put('skor_halaman7', $skor);
        $request->session()->put('status_halaman7', $status);
        $request->session()->put('jawaban_halaman7', array_map(fn($idx) => $request->input("jawaban_$idx"), array_keys($soal)));

        // Simpan ke database
        Nilai::updateOrCreate([
            'user_id' => Auth::id(),
            'kuis_id' => 'halaman7',
        ], [
            'skor' => $skor,
            'total_soal' => $totalSoal,
            'updated_at' => now(),
            'created_at' => now(),
        ]);

        return redirect()->route('admin.materi.halaman7');
    }

    public function resetHalaman7(Request $request)
    {
        $request->session()->forget(['skor_halaman7', 'status_halaman7', 'jawaban_halaman7']);
        return redirect()->route('admin.materi.halaman7');
    }

    public function halaman8()
    {
        return view('admin.materi.halaman8');
    }


}

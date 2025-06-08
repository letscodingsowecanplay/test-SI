<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Nilai;
use App\Models\Kkm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class MateriController extends Controller
{
    public function index()
    {
        return view('admin.materi.index', [
            'nomorHalaman' => 1,
        ]);
        
    }

    public function halamanDua()
    {
        return view('admin.materi.halaman2', [
            'nomorHalaman' => 2,
        ]);
    }

    public function halamanTiga()
    {
        return view('admin.materi.halaman3', [
            'nomorHalaman' => 3,
        ]);
    }

    public function halamanEmpat()
    {
        $nomorHalaman = 4;
        $userId = auth()->id();
        $kuisId = 'ayo-mencoba-1';

        // Ambil KKM dari tabel
        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 3;

        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $sudahMenjawab = $nilai !== null;
        $skor = $nilai->skor ?? 0;
        $status = $nilai->status ?? null;

        $kunci = [
            'soal1' => 'b',
            'soal2' => 'a',
            'soal3' => 'b',
            'soal4' => 'a',
        ];

        $jawabanUser = is_array($nilai?->jawaban) ? $nilai->jawaban : [];

        return view('admin.materi.halaman4', compact(
            'sudahMenjawab', 'skor', 'kkm', 'status', 'jawabanUser', 'kunci', 'nomorHalaman'
        ));
    }

    public function simpanHalamanEmpat(Request $request)
    {
        $request->validate([
            'jawaban.soal1' => 'required',
            'jawaban.soal2' => 'required',
            'jawaban.soal3' => 'required',
            'jawaban.soal4' => 'required',
        ]);

        $jawaban = $request->input('jawaban');
        if (!is_array($jawaban)) {
            return back()->with('error', 'Format jawaban tidak valid.');
        }

        $userId = auth()->id();
        $kuisId = 'ayo-mencoba-1';

        $kunci = [
            'soal1' => 'b',
            'soal2' => 'a',
            'soal3' => 'b',
            'soal4' => 'a',
        ];

        $benar = 0;
        foreach ($kunci as $soal => $jawabanBenar) {
            if (isset($jawaban[$soal]) && $jawaban[$soal] === $jawabanBenar) {
                $benar++;
            }
        }

        // Ambil nilai KKM dari tabel kkm
        $kkmRecord = \App\Models\Kkm::where('kuis_id', $kuisId)->first();
        $kkm = $kkmRecord?->kkm ?? 3; // fallback ke 3 jika belum ada kkm-nya

        $status = $benar >= $kkm ? 'lulus' : 'tidak_lulus';
        $now = now();

        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        if ($nilai) {
            $nilai->update([
                'skor' => $benar,
                'total_soal' => count($kunci),
                'jawaban' => $jawaban,
                'status' => $status,
                'updated_at' => $now,
            ]);
        } else {
            \App\Models\Nilai::create([
                'user_id' => $userId,
                'kuis_id' => $kuisId,
                'skor' => $benar,
                'total_soal' => count($kunci),
                'jawaban' => $jawaban,
                'status' => $status,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        return redirect()->route('admin.materi.halaman4')
            ->with('success', "Skor berhasil disimpan! Nilai Anda: $benar dari " . count($kunci) . ". KKM: $kkm");
    }


    public function resetHalamanEmpat()
    {
        \App\Models\Nilai::where('user_id', auth()->id())
            ->where('kuis_id', 'ayo-mencoba-1')
            ->delete(); // observer akan jalan di sini

        return redirect()->route('admin.materi.halaman4')
            ->with('success', 'Kuis berhasil direset. Silakan mulai ulang.');
    }

    public function halamanLima()
    {
        $nomorHalaman = 5;
        $userId = auth()->id();
        $kuisId = 'ayo-berlatih-1';

        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 3;

        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $sudahMenjawab = $nilai !== null;
        $skor = $nilai->skor ?? 0;

        $kunci = [
            'soal1' => 'pendek',
            'soal2' => 'panjang',
            'soal3' => 'tinggi',
            'soal4' => 'rendah'
        ];

        $jawabanUser = is_array($nilai?->jawaban) ? $nilai->jawaban : [];

        return view('admin.materi.halaman5', compact('sudahMenjawab', 'skor', 'kkm', 'kunci', 'jawabanUser', 'nomorHalaman'));
    }

    public function simpanHalamanLima(Request $request)
    {
        $request->validate([
            'jawaban' => 'required|array',
            'jawaban.*' => 'required|string|in:panjang,pendek,tinggi,rendah',
        ]);

        $jawaban = $request->input('jawaban');
        $userId = auth()->id();
        $kuisId = 'ayo-berlatih-1';

        $kunci = [
            'soal1' => 'pendek',
            'soal2' => 'panjang',
            'soal3' => 'tinggi',
            'soal4' => 'rendah'
        ];

        $skor = 0;
        foreach ($kunci as $soal => $jawabanBenar) {
            if (isset($jawaban[$soal]) && strtolower($jawaban[$soal]) === $jawabanBenar) {
                $skor++;
            }
        }

        // Ambil nilai KKM dari tabel kkm
        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 3;
        $status = $skor >= $kkm ? 'lulus' : 'tidak_lulus';
        $now = now();

        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        if ($nilai) {
            $nilai->update([
                'skor' => $skor,
                'total_soal' => count($kunci),
                'jawaban' => $jawaban,
                'status' => $status,
                'updated_at' => $now,
            ]);
        } else {
            \App\Models\Nilai::create([
                'user_id' => $userId,
                'kuis_id' => $kuisId,
                'skor' => $skor,
                'total_soal' => count($kunci),
                'jawaban' => $jawaban,
                'status' => $status,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        return redirect()->route('admin.materi.halaman5')
            ->with('success', "Jawaban berhasil disimpan. Nilai Anda: $skor dari " . count($kunci) . ". KKM: $kkm");
    }


    public function resetHalamanLima()
    {
        \App\Models\Nilai::where('user_id', auth()->id())
            ->where('kuis_id', 'ayo-berlatih-1')
            ->delete();


        return redirect()->route('admin.materi.halaman5')
            ->with('success', 'Kuis berhasil direset. Silakan mulai ulang.');
    }


    public function halamanEnam()
    {
        return view('admin.materi.halaman6', [
            'nomorHalaman' => 6,
        ]);
    }

    public function halaman7()
    {
        return view('admin.materi.halaman7', [
            'nomorHalaman' => 7,
        ]);
    }

    public function halaman8()
    {
        return view('admin.materi.halaman8', [
            'nomorHalaman' => 8,
        ]);
    }

    public function halaman9()
    {
        $nomorHalaman = 9;
        $userId = auth()->id();
        $kuisId = 'ayo-mencoba-2';

        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 3;

        $nilaiRecord = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $sudahMenjawab = !is_null($nilaiRecord);
        $skor = $nilaiRecord->skor ?? 0;
        $status = $nilaiRecord->status ?? null;

        $kunciJawaban = [
            'soal1' => 'b',
            'soal2' => 'a',
            'soal3' => 'a',
            'soal4' => 'a',
        ];

        $jawabanUser = is_array($nilaiRecord?->jawaban) ? $nilaiRecord->jawaban : [];

        return view('admin.materi.halaman9', compact(
            'sudahMenjawab', 'skor', 'kkm', 'jawabanUser', 'status', 'kunciJawaban', 'nomorHalaman'
        ));
    }


    public function simpanHalaman9(Request $request)
    {
        
        $request->validate([
            'jawaban.soal1' => 'required',
            'jawaban.soal2' => 'required',
            'jawaban.soal3' => 'required',
            'jawaban.soal4' => 'required',
        ]);

        $jawaban = $request->input('jawaban');
        if (!is_array($jawaban)) {
            return redirect()->back()->with('error', 'Format jawaban tidak valid.');
        }

        $kunci = [
            'soal1' => 'b',
            'soal2' => 'a',
            'soal3' => 'a',
            'soal4' => 'a',
        ];

        $benar = 0;
        foreach ($kunci as $soal => $kunciJawaban) {
            if (isset($jawaban[$soal]) && $jawaban[$soal] === $kunciJawaban) {
                $benar++;
            }
        }

        $kuisId = 'ayo-mencoba-2';
        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 3;
        $status = $benar >= $kkm ? 'lulus' : 'tidak_lulus';
        $now = now();

        $nilai = \App\Models\Nilai::where('user_id', auth()->id())
            ->where('kuis_id', $kuisId)
            ->first();

        $data = [
            'skor' => $benar,
            'total_soal' => count($kunci),
            'jawaban' => $jawaban,
            'status' => $status,
            'updated_at' => $now,
        ];

        try {
            if ($nilai) {
                $nilai->update($data);
            } else {
                \App\Models\Nilai::create(array_merge([
                    'user_id' => auth()->id(),
                    'kuis_id' => $kuisId,
                    'created_at' => $now,
                ], $data));
            }
        } catch (\Exception $e) {
            \Log::error("Exception saving nilai halaman9: " . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan.');
        }

        return redirect()->route('admin.materi.halaman9')
            ->with('success', "Skor berhasil disimpan! Nilai Anda: $benar. KKM: $kkm");
    }


    public function resetHalaman9()
    {
        \App\Models\Nilai::where('user_id', auth()->id())
            ->where('kuis_id', 'ayo-mencoba-2')
            ->delete();

        return redirect()->route('admin.materi.halaman9')
            ->with('success', 'Kuis berhasil direset. Silakan mulai ulang.');
    }


    private function getSoalHalaman10()
    {
        return [
            [
                'pertanyaan' => '1. Urutan miniatur Rumah Banjar berdasarkan bentuk dari yang paling tinggi adalah ....',
                'gambar' => 'soal1.png',
                'audio' => 'audio0.mp3',
                'pilihan' => [
                    'a' => 'a-b-c',
                    'b' => 'b-a-c',
                    'c' => 'c-b-a'
                ],
                'jawaban' => 'a',
            ],
            [
                'pertanyaan' => '2. Urutan tas kerajinan khas Kalimantan berdasarkan ketinggiannya saat digantung, dari yang paling rendah adalah ....',
                'gambar' => 'soal2.png',
                'audio' => 'audio0.mp3',
                'pilihan' => [
                    'a' => 'c-a-b',
                    'b' => 'a-b-c',
                    'c' => 'b-c-a'
                ],
                'jawaban' => 'b',
            ],
            [
                'pertanyaan' => '3. Urutan kerajinan patung Dayak berdasarkan bentuknya, dari yang paling tinggi adalah ....',
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
                'pertanyaan' => '4. Urutan vas bunga akar keladi berdasarkan bentuknya, dari yang paling rendah adalah ....',
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
                'pertanyaan' => '5. Urutan kain sasirangan berdasarkan bentuknya, dari yang paling panjang adalah ....',
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

    public function halaman10(Request $request)
    {
        $nomorHalaman = 10;
        $kuisId = 'ayo-berlatih-2';
        $soal = $this->getSoalHalaman10();

        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 75;

        $userId = auth()->id();
        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $status = $nilai->status ?? null;
        $skor = $nilai->skor ?? null;
        $jawabanUser = is_array($nilai?->jawaban) ? $nilai->jawaban : [];

        $kunciJawaban = array_column($soal, 'jawaban');

        return view('admin.materi.halaman10', compact(
            'soal', 'kkm', 'skor', 'status',
            'kunciJawaban', 'jawabanUser', 'nomorHalaman',
        ));
    }


    public function submitHalaman10(Request $request)
    {
        $kuisId = 'ayo-berlatih-2';
        $soal = $this->getSoalHalaman10();

        $rules = [];
        foreach ($soal as $index => $item) {
            $rules["jawaban_$index"] = 'required|in:' . implode(',', array_keys($item['pilihan']));
        }
        $request->validate($rules);

        $totalSoal = count($soal);
        $skor = 0;
        $jawaban = [];

        foreach ($soal as $index => $item) {
            $jawaban[$index] = $request->input("jawaban_$index");
            if ($jawaban[$index] === $item['jawaban']) {
                $skor++;
            }
        }

        // Ambil nilai KKM dari DB sebagai jumlah soal minimal yang harus benar
        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 3;
        $status = $skor >= $kkm ? 'lulus' : 'tidak_lulus';

        \App\Models\Nilai::updateOrCreate(
            ['user_id' => auth()->id(), 'kuis_id' => $kuisId],
            [
                'skor' => $skor,
                'total_soal' => $totalSoal,
                'jawaban' => $jawaban,
                'status' => $status,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        return redirect()->route('admin.materi.halaman10')->with('success', 'Skor berhasil disimpan!');
    }

    public function resetHalaman10(Request $request)
    {
        \App\Models\Nilai::where('user_id', auth()->id())
            ->where('kuis_id', 'ayo-berlatih-2')
            ->delete();

        return redirect()->route('admin.materi.halaman10')->with('success', 'Kuis berhasil direset.');
    }


    public function halaman11()
    {
        return view('admin.materi.halaman11', [
            'nomorHalaman' => 11,
        ]);
    }

    public function halaman12()
    {
        return view('admin.materi.halaman12', [
            'nomorHalaman' => 12,
        ]);
    }

    public function halaman13()
    {
        return view('admin.materi.halaman13', [
            'nomorHalaman' => 13,
        ]);
    }

    public function halaman14()
    {
        return view('admin.materi.halaman14', [
            'nomorHalaman' => 14,
        ]);
    }

    public function halaman15()
    {
        $nomorHalaman = 15;
        $userId = auth()->id();
        $kuisId = 'ayo-mencoba-3';

        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 3;

        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $jawabanUser = is_array($nilai?->jawaban) ? $nilai->jawaban : [];
        $skor = $nilai->skor ?? null;
        $status = $nilai->status ?? null;
        $sudahMenjawab = $nilai !== null;
        $kunci = [
            'soal1' => 'salah',
            'soal2' => 'benar',
            'soal3' => 'salah',
            'soal4' => 'benar'
        ];

        return view('admin.materi.halaman15', compact('sudahMenjawab', 'skor', 'kkm', 'kunci', 'jawabanUser', 'status', 'nomorHalaman'));
    }


    public function simpanHalaman15(Request $request)
    {
        $request->validate([
            'jawaban.soal1' => 'required|in:benar,salah',
            'jawaban.soal2' => 'required|in:benar,salah',
            'jawaban.soal3' => 'required|in:benar,salah',
            'jawaban.soal4' => 'required|in:benar,salah',
        ]);

        $jawaban = $request->input('jawaban');
        $userId = auth()->id();
        $kuisId = 'ayo-mencoba-3';

        $kunci = [
            'soal1' => 'salah',
            'soal2' => 'benar',
            'soal3' => 'salah',
            'soal4' => 'benar'
        ];

        $benar = 0;
        foreach ($kunci as $soal => $kunciJawaban) {
            if (isset($jawaban[$soal]) && strtolower($jawaban[$soal]) === $kunciJawaban) {
                $benar++;
            }
        }

        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 3;
        $status = $benar >= $kkm ? 'lulus' : 'tidak_lulus';
        $now = now();

        \App\Models\Nilai::updateOrCreate(
            ['user_id' => $userId, 'kuis_id' => $kuisId],
            [
                'skor' => $benar,
                'total_soal' => count($kunci),
                'jawaban' => $jawaban, // langsung array, tidak di-encode
                'status' => $status,
                'updated_at' => $now,
                'created_at' => $now, // hanya dipakai jika insert
            ]
        );

        return redirect()->route('admin.materi.halaman15')
            ->with('success', "Skor berhasil disimpan! Nilai Anda: $benar dari " . count($kunci) . ". KKM: $kkm");
    }


    public function resetHalaman15()
    {
        \App\Models\Nilai::where('user_id', auth()->id())
            ->where('kuis_id', 'ayo-mencoba-3')
            ->delete();

        return redirect()->route('admin.materi.halaman15')
            ->with('success', 'Kuis berhasil direset. Silakan mulai ulang.');
    }




    public function halaman16()
    {
        $nomorHalaman = 16;
        $userId = auth()->id();
        $kuisId = 'ayo-berlatih-3';

        // Ambil KKM dari tabel
        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 3;

        $nilai = \App\Models\Nilai::where('user_id', $userId)
            ->where('kuis_id', $kuisId)
            ->first();

        $jawabanUser = is_array($nilai?->jawaban) ? $nilai->jawaban : [];
        $skor = $nilai->skor ?? null;
        $status = $nilai->status ?? null;
        $sudahMenjawab = $nilai !== null;

        return view('admin.materi.halaman16', compact('sudahMenjawab', 'skor', 'kkm', 'jawabanUser', 'status', 'nomorHalaman'));
    }

    public function simpanHalaman16(Request $request)
    {
        $request->validate([
            'jawaban.soal1' => 'required|numeric',
            'jawaban.soal2' => 'required|numeric',
            'jawaban.soal3' => 'required|numeric',
            'jawaban.soal4' => 'required|numeric',
            'jawaban.soal5' => 'required|numeric',
        ]);

        $jawaban = $request->input('jawaban');
        $userId = auth()->id();
        $kuisId = 'ayo-berlatih-3';

        $kunci = [
            'soal1' => 5,
            'soal2' => 5,
            'soal3' => 4,
            'soal4' => 7,
            'soal5' => 7,
        ];

        $benar = 0;
        foreach ($kunci as $soal => $jawabanBenar) {
            if (isset($jawaban[$soal]) && (int)$jawaban[$soal] === $jawabanBenar) {
                $benar++;
            }
        }

        // Ambil KKM dari tabel
        $kkm = \App\Models\Kkm::where('kuis_id', $kuisId)->value('kkm') ?? 3;
        $status = $benar >= $kkm ? 'lulus' : 'tidak_lulus';

        \App\Models\Nilai::updateOrCreate(
            ['user_id' => $userId, 'kuis_id' => $kuisId],
            [
                'skor' => $benar,
                'total_soal' => count($kunci),
                'jawaban' => $jawaban, // langsung array, bukan json
                'status' => $status,
                'updated_at' => now(),
                'created_at' => now(), // hanya digunakan saat insert
            ]
        );

        return redirect()->route('admin.materi.halaman16')
            ->with('success', "Skor berhasil disimpan! Nilai Anda: $benar dari " . count($kunci) . ". KKM: $kkm");
    }

    public function resetHalaman16()
    {
        \App\Models\Nilai::where('user_id', auth()->id())
            ->where('kuis_id', 'ayo-berlatih-3')
            ->delete();

        return redirect()->route('admin.materi.halaman16')
            ->with('success', 'Kuis berhasil direset. Silakan mulai ulang.');
    }



    public function halaman17()
    {
        return view('admin.materi.halaman17');
    }

}
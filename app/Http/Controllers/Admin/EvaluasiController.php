<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;

class EvaluasiController extends Controller
{
    public function tampilSoal($nomor)
    {
        $semuaSoal = Soal::orderBy('id')->get();
        $soalSekarang = $semuaSoal[$nomor - 1] ?? abort(404);
        
        $jawabanTerpilih = Jawaban::where('user_id', auth()->id())
            ->where('soal_id', $soalSekarang->id)
            ->value('jawaban');

        $soalDijawab = Jawaban::where('user_id', auth()->id())
            ->pluck('soal_id')->toArray();

        // Inisialisasi waktu (30 menit) di session jika belum ada
        if (!Session::has('evaluasi_timer')) {
            Session::put('evaluasi_timer', now()->addMinutes(30));
        }

        $sisaWaktu = now()->diffInSeconds(Session::get('evaluasi_timer'), false);

        return view('evaluasi.kuis', [
            'soal' => $soalSekarang,
            'nomor' => $nomor,
            'semua_soal' => $semuaSoal,
            'jawaban_terpilih' => $jawabanTerpilih,
            'soal_dijawab' => $soalDijawab,
            'sisa_waktu' => $sisaWaktu,
        ]);
    }

    public function simpanJawaban(Request $request)
    {
        $request->validate([
            'soal_id' => 'required|exists:soal,id',
            'jawaban' => 'required',
        ]);

        Jawaban::updateOrCreate(
            ['user_id' => auth()->id(), 'soal_id' => $request->soal_id],
            ['jawaban' => $request->jawaban]
        );

        // Redirect ke soal berikutnya
        $semuaSoal = Soal::orderBy('id')->get();
        $nomor = $semuaSoal->search(function ($s) use ($request) {
            return $s->id == $request->soal_id;
        });

        if ($nomor !== false && $nomor + 1 < $semuaSoal->count()) {
            return redirect()->route('evaluasi.soal', $nomor + 2);
        }

        return redirect()->route('evaluasi.selesai');
    }

    public function selesai()
    {
        Session::forget('evaluasi_timer');
        return view('evaluasi.selesai');
    }
}

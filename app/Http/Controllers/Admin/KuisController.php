<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class KuisController extends Controller
{
    private $soals = [
        1 => [
            'pertanyaan' => 'Node.js merupakan runtime yang bersifat?',
            'pilihan' => [
                'a' => 'Blocking',
                'b' => 'Non-blocking',
                'c' => 'Single-threaded',
                'd' => 'Multi-threaded'
            ],
            'jawaban' => 'b'
        ],
        // Tambahkan soal lainnya sesuai kebutuhan
    ];

    public function index(Request $request, $nomor = 1)
    {
        if (!isset($this->soals[$nomor])) {
            abort(404);
        }

        $jawabanUser = $request->session()->get('jawaban', []);

        return view('admin.kuis.index', [
            'soal' => $this->soals[$nomor],
            'nomorSoal' => $nomor,
            'totalSoal' => count($this->soals),
            'jawabanUser' => $jawabanUser,
            'waktu' => '29:45' // Timer countdown
        ]);
    }

    public function jawab(Request $request)
    {
        $nomorSoal = $request->input('nomor_soal');
        $jawaban = $request->input('jawaban');
    
        // Simpan jawaban ke session
        $jawabanUser = $request->session()->get('jawaban', []);
        $jawabanUser[$nomorSoal] = $jawaban;
        $request->session()->put('jawaban', $jawabanUser);
    
        // Cek apakah sudah soal terakhir
        if ($nomorSoal < count($this->soals)) {
            return redirect()->route('admin.kuis.index', ['nomor' => $nomorSoal + 1]);
        }
    
        // Jika sudah soal terakhir, proses hasil dan redirect ke halaman hasil
        return $this->simpanHasil($request);
    }
    
    private function simpanHasil(Request $request)
    {
        $jawabanUser = $request->session()->get('jawaban', []);
        $skor = 0;
    
        // Hitung skor
        foreach ($jawabanUser as $nomor => $jawaban) {
            if (isset($this->soals[$nomor]) && $jawaban === $this->soals[$nomor]['jawaban']) {
                $skor++;
            }
        }
    
        // Simpan ke database
        Kuis::create([
            'user_id' => Auth::id(),
            'skor' => $skor,
            'total_soal' => count($this->soals),
            'jawaban' => json_encode($jawabanUser)
        ]);
    
        // Hapus session jawaban
        $request->session()->forget('jawaban');
    
        // Redirect ke halaman hasil
        return redirect()->route('admin.kuis.hasil');
    }

    public function hasil()
    {
        $hasilTerakhir = Kuis::where('user_id', Auth::id())
            ->latest()
            ->first();

        return view('admin.kuis.hasil', [
            'skor' => $hasilTerakhir->skor,
            'totalSoal' => $hasilTerakhir->total_soal
        ]);
    }
}
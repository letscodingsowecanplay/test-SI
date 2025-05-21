<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Nilai;
use App\Models\Kkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NilaiExport;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function siswaIndex()
    {
        $siswa = User::role('siswa')->oldest()->paginate(10); // 10 siswa per halaman
        return view('admin.datasiswa.index', compact('siswa'));
    }


    public function siswaCreate()
    {
        return view('admin.datasiswa.create');
    }

    public function siswaStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nisn' => 'required|string|unique:users,nisn',
            'nip' => 'nullable|string|unique:users,nip',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nisn' => $request->nisn,
            'password' => Hash::make($request->password),
            'status' => 1,
        ]);

        $user->assignRole('siswa');

        return redirect()->route('admin.datasiswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }


    public function siswaEdit(User $user)
    {
        return view('admin.datasiswa.edit', compact('user'));
    }

    public function siswaUpdate(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nisn' => 'required|string|unique:users,nisn,' . $user->id,
            'nip' => 'nullable|string|unique:users,nip,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = $request->only('name', 'email', 'nisn');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        flash()->addSuccess('Data siswa berhasil diperbarui.');
        return redirect()->route('admin.datasiswa.index');
    }



    public function siswaDestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.datasiswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }

    public function latihanIndex(Request $request)
    {
        $kuisIds = ['ayo-mencoba-1', 'ayo-mencoba-2', 'ayo-mencoba-3'];
        $kuisDipilih = $request->input('kuis_id');

        $query = Nilai::with('user')
            ->whereIn('kuis_id', $kuisIds);

        if ($kuisDipilih) {
            $query->where('kuis_id', $kuisDipilih);
        }

        $nilai = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.datalatihan.index', compact('nilai', 'kuisIds', 'kuisDipilih'));
    }

    public function latihanEdit(Nilai $nilai) {
        return view('admin.datalatihan.edit', compact('nilai'));
    }


    public function latihanUpdate(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'kuis_id' => 'required',
            'skor' => 'required|integer',
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update([
            'user_id' => $request->user_id,
            'kuis_id' => $request->kuis_id,
            'skor' => $request->skor,
            'total_soal' => $request->total_soal ?? 0,
            'status' => $request->status,
            'jawaban' => $request->jawaban,
        ]);

        flash()->addSuccess('Data latihan siswa berhasil diperbarui.');
        return redirect()->route('admin.datalatihan.index');
    }

    public function latihanDestroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        flash()->addInfo('Data latihan siswa berhasil dihapus.');
        return redirect()->route('admin.datalatihan.index');
    }

    public function hasilBelajarIndex(Request $request)
    {
        $kuisIds = ['ayo-berlatih-1', 'ayo-berlatih-2', 'ayo-berlatih-3', 'evaluasi-1'];
        $kuisDipilih = $request->input('kuis_id');

        $query = Nilai::with('user')
            ->whereIn('kuis_id', $kuisIds);

        if ($kuisDipilih) {
            $query->where('kuis_id', $kuisDipilih);
        }

        $nilai = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.hasilbelajar.index', compact('nilai', 'kuisIds', 'kuisDipilih'));
    }

    public function hasilBelajarEdit(Nilai $nilai) {
        return view('admin.hasilbelajar.edit', compact('nilai'));
    }

    public function hasilBelajarUpdate(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'kuis_id' => 'required',
            'skor' => 'required|integer',
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update([
            'user_id' => $request->user_id,
            'kuis_id' => $request->kuis_id,
            'skor' => $request->skor,
            'total_soal' => $request->total_soal ?? 0,
            'status' => $request->status,
            'jawaban' => $request->jawaban,
        ]);

        flash()->addSuccess('Data latihan siswa berhasil diperbarui.');
        return redirect()->route('admin.hasilbelajar.index');
    }

    public function hasilBelajarDestroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        flash()->addInfo('Data latihan siswa berhasil dihapus.');
        return redirect()->route('admin.hasilbelajar.index');
    }

    public function kkmIndex()
    {
        $kkm = Kkm::orderBy('kuis_id')->paginate(10);
        return view('admin.kkm.index', compact('kkm'));
    }

    public function kkmEdit(Kkm $kkm)
    {
        return view('admin.kkm.edit', compact('kkm'));
    }

    public function kkmUpdate(Request $request, Kkm $kkm)
    {
        $request->validate([
            'kkm' => 'required|integer|min:1'
        ]);

        $kkm->update([
            'kkm' => $request->kkm
        ]);

        // Update status semua nilai yang pakai kuis ini
        Nilai::where('kuis_id', $kkm->kuis_id)->get()->each(function ($nilai) use ($kkm) {
            $statusBaru = $nilai->skor >= $kkm->kkm ? 'lulus' : 'tidak_lulus';
            if ($nilai->status !== $statusBaru) {
                $nilai->status = $statusBaru;
                $nilai->save(); // observer tidak diperlukan karena logic jelas di sini
            }
        });

        flash()->addSuccess("KKM berhasil diperbarui dan status nilai diperbarui.");
        return redirect()->route('admin.kkm.index');
    }


    public function kkmDestroy(Kkm $kkm)
    {
        $kkm->delete();
        flash()->addInfo("KKM berhasil dihapus.");
        return back();
    }

    public function export(Request $request)
    {
        $format = $request->get('format', 'excel');
        $kuis_id = $request->get('kuis_id');

        $query = \App\Models\Nilai::with('user')->orderBy('created_at', 'desc');
        if ($kuis_id) {
            $query->where('kuis_id', $kuis_id);
        }
        $data = $query->get();

        if ($format === 'excel') {
            return Excel::download(new NilaiExport($data), 'data-hasil-belajar.xlsx');
        } elseif ($format === 'pdf') {
            $pdf = Pdf::loadView('admin.hasilbelajar.export_pdf', ['nilai' => $data]);
            return $pdf->download('data-hasil-belajar.pdf');
        } else {
            abort(404);
        }
    }


}

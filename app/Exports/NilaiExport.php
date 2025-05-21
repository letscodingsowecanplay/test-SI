<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NilaiExport implements FromView
{
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('admin.hasilbelajar.export_excel', [
            'nilai' => $this->data
        ]);
    }
}

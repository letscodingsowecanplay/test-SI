<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Nilai;
use App\Models\Kkm;

class KkmSeeder extends Seeder
{
    public function run()
    {
        $kuisIds = Nilai::select('kuis_id')->distinct()->pluck('kuis_id');

        foreach ($kuisIds as $kuisId) {
            Kkm::firstOrCreate([
                'kuis_id' => $kuisId
            ], [
                'kkm' => 3 // default kkm
            ]);
        }
    }
}

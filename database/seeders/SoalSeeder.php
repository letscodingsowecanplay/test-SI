<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Soal;
use App\Models\JawabanSoal;

class SoalSeeder extends Seeder
{


    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            $soal = Soal::create([
                'pertanyaan' => "Pertanyaan ke-$i",
            ]);

            foreach (['A', 'B', 'C', 'D'] as $idx => $opt) {
                JawabanSoal::create([
                    'soal_id' => $soal->id,
                    'teks' => "Jawaban $opt",
                    'is_benar' => $idx === 0, // Jawaban A benar
                ]);
            }
        }
    }

}

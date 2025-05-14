<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanSoal extends Model
{
    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }

}

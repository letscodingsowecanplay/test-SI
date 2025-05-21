<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';

    protected $fillable = [
        'user_id',
        'kuis_id',
        'skor',
        'total_soal',
        'status',
        'jawaban',
    ];

    protected $casts = [
        'jawaban' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kkm()
    {
        return $this->belongsTo(Kkm::class, 'kuis_id', 'kuis_id');
    }

}

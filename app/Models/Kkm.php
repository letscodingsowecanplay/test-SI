<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kkm extends Model
{
    protected $table = 'kkm';
    protected $fillable = ['kuis_id', 'kkm'];
    public $timestamps = false;


    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'kuis_id', 'kuis_id');
    }

}

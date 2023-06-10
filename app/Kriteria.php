<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriterias';
    protected $fillable = [
        'name', 'bobot', 'code', 'atribut',
    ];

    // Kriteria
    public function detail_kriteria()
    {
        return $this->hasMany(Detail_kriteria::class);
    }
}

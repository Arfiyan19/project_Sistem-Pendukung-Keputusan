<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_alt extends Model
{
    protected $guarded = [];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}

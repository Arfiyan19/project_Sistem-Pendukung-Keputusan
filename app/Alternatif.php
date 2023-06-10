<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Detail_alt;

class Alternatif extends Model
{
    protected $table = 'alternatifs';
    protected $guarded = [];

    public function detail_alt()
    {
        return $this->hasMany(Detail_alt::class);
    }
}

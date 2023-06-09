<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriterias';
    protected $fillable = [
        'name','bobot','code','atribut',
    ];
}

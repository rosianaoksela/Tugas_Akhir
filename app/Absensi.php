<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table='Absensi';
    protected $primaryKey = 'id_absensi';
    
    public function mahasiswa()
    {
        return $this->belongsToMany('App\Mahasiswa');
    }
}

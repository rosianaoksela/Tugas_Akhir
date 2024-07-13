<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Mahasiswa extends Model
{
    protected $table = 'Mahasiswa';
    protected $primaryKey = 'id_mahasiswa';
    protected $fillable = ['nim','nama','jenis_kelamin','tingkat_kelas','status'];
    public $timestamps = false;
    
    public function kelas()
    {
        return $this->belongsToMany('App\Kelas', 'mahasiswa_kelas', 'mahasiswa_id', 'kelas_id');
    }
    public function absensi()
    {   
        return $this->belongsToMany('App\Kelas', 'absensi', 'mahasiswa_id', 'kelas_id')->withPivot('status', 'tanggal', 'keterangan')->wherePivot('tanggal', Carbon::now('Asia/Jakarta'));
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Kelas extends Model
{
    protected $table = 'Kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = ['tingkat_kelas', 'jurusan', 'nama_kelas', 'kuota', 'tahun_masuk', 'tahun_keluar'];
    public $timestamps = false;
    
    public function Mahasiswa()
    {
        return $this->belongsToMany('App\Mahasiswa', 'mahasiswa_kelas', 'kelas_id', 'mahasiswa_id')->withPivot('id_mahasiswa_kelas');
    }
    public function absen()
    {    
        return $this->belongsToMany('App\Mahasiswa', 'absensi', 'kelas_id', 'mahasiswa_id')->withPivot('status', 'tanggal', 'keterangan')->wherePivot('tanggal', Carbon::now('Asia/Jakarta')->format('Y-m-d'));
    }
}

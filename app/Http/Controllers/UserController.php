<?php

namespace App\Http\Controllers;

use App\User;
use App\Mahasiswa;
use App\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserController extends Controller
{
    function index(){
        if(Auth::user()->akses=="Mahasiswa" or Auth::user()->akses=="Ortu"){
            if(Auth::user()->akses=="Mahasiswa"){
                $resource = Mahasiswa::where('nim', Auth::user()->username)->firstOrFail();
            }else{
                $resource = Mahasiswa::where('id_mahasiswa', Auth::user()->id_mahasiswa)->firstOrFail();
            }
            $hadir=Absensi::where(['mahasiswa_id'=>$resource->id_mahasiswa])->where('status','Hadir')->count();
            $alfa=Absensi::where(['mahasiswa_id'=>$resource->id_mahasiswa])->where('status','Alfa')->count();
            $izin=Absensi::where(['mahasiswa_id'=>$resource->id_mahasiswa])->where('status','Izin')->count();
            $sakit=Absensi::where(['mahasiswa_id'=>$resource->id_mahasiswa])->where('status','Sakit')->count();
            $absen=array(['hadir'=>$hadir,'alfa'=>$alfa,'izin'=>$izin,'sakit'=>$sakit]);
            return view('mahasiswa/data',['resource'=>$resource, 'absen'=>$absen]);
        }
    }
}

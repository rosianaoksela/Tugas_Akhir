<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;
use App\Kelas;
use App\Mahasiswa_Kelas;

class mahasiswaKelasController extends Controller
{
    public function add($id){
        $resource=Mahasiswa::get();
        return view('Admin/mahasiswaKelas',['resource'=>$resource, 'kelas'=>$id]);
    }
    public function create(Request $request)
    {
        $check = mahasiswa_Kelas::where(['kelas_id' => $request->kelas, 'mahasiswa_id' => $request->mahasiswa])->get();
        if($check->count()>0){
            session()->flash('notif', array('success' => false, 'msgaction' => 'Tambah Data Gagal, Data Telah Ada!'));
            return redirect('/admin/kelas');
        }
        else{
            $SK = new Mahasiswa_Kelas;
            $SK->mahasiswa_id = $request->mahasiswa;
            $SK->kelas_id = $request->kelas;
            if($SK->save()){
                session()->flash('notif', array('success' => true, 'msgaction' => 'Tambah Data Berhasil!'));
            }
            else{
                session()->flash('notif', array('success' => false, 'msgaction' => 'Tambah Data Gagal, Silahkan Ulangi!'));
            }
            return redirect('/admin/kelas/'.$request->kelas);
        }
    }
    public function delete($id){
        Mahasiswa_Kelas::find($id)->delete();
        session()->flash('notif', array('success' => true, 'msgaction' => 'Hapus Data Berhasil!'));
        return redirect(url()->previous());
    }
}

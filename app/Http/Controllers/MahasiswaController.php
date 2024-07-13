<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mahasiswa;
use PDF;

class MahasiswaController extends Controller
{
    public function index(){
        $resource = Mahasiswa::paginate(10);
        return view('Admin/mahasiswa', ['resource'=>$resource]);
    }
    public function create(Request $request){
        $check = Mahasiswa::where(['nim' => $request->nim])->get();
        if($check->count()>0){
            session()->flash('notif', array('success' => false, 'msgaction' => 'Tambah Data Gagal, Data Telah Ada!'));
            return redirect('/admin/mahasiswa');
        }
        else{
            $Mahasiswa = new Mahasiswa;
            $Mahasiswa->nim = $request->nim;
            $Mahasiswa->nama = $request->nama;
            $Mahasiswa->jenis_kelamin = $request->jk;
            $Mahasiswa->tingkat_kelas = $request->tingkat_kelas;
            if($Mahasiswa->save()){
                session()->flash('notif', array('success' => true, 'msgaction' => 'Tambah Data Berhasil!'));
            }
            else{
                session()->flash('notif', array('success' => false, 'msgaction' => 'Tambah Data Gagal, Silahkan Ulangi!'));
            }
            return redirect('/admin/mahasiswa');
        }

    }
    public function update(Request $request){
        $mahasiswa = Mahasiswa::find($request->id_mahasiswa);
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->jenis_kelamin = $request->jk;
        $mahasiswa->tingkat_kelas = $request->tingkat_kelas;
        if($mahasiswa->save()){
            session()->flash('notif', array('success' => true, 'msgaction' => 'Edit Data Berhasil!'));
            
        }else{
            session()->flash('notif', array('success' => false, 'msgaction' => 'Edit Data Gagal, Silahkan Ulangi!'));
        }
        if(Auth::user()->akses=='admin'){
            return redirect('admin/mahasiswa');
        }else{
            return redirect('/admin/mahasiswa');
        }
    }
    public function delete($id){
        Mahasiswa::find($id)->delete();
        session()->flash('notif', array('success' => true, 'msgaction' => 'Hapus Data Berhasil!'));
        return redirect('/admin/mahasiswa');
    }
    public function show($id){
        $resource = Mahasiswa::find($id);
        return view('mahasiswa/profil', ['resource'=>$resource]);
    }
    public function search(Request $request){
        $key = $request->kunci;
        $tingkat = $request->kelas;
        $jk = $request->jk;
        $resource = new Mahasiswa;
        if($key != ""){
            $resource = $resource->where(function($like) use ($key){
                $like->where('nim', 'like', '%'.$key.'%');
                $like->orWhere('nama', 'like', '%'.$key.'%');
            });
        }
        if($tingkat != ""){
            $resource = $resource->where('tingkat_kelas', $tingkat);
        };
        if($jk != ""){
            $resource = $resource->where('jenis_kelamin', $jk);
        }
        $resource = $resource->paginate(10);
        if(count($resource)==0){
            echo "<td colspan='9' class='text-center'>Tidak ada data</td>";
        }
        $index = 1;
        foreach($resource as $res){
?>
<tr>
    <td><input type="checkbox" class="checkthis" /></td>
    <td class="text-center"><?php echo $index ?></td>
    <td><?php echo $res->nim ?></td>
    <td><?php echo $res->nama ?></td>
    <td class="text-center"><?php echo $res->tingkat_kelas ?></td>
    <td class="text-center"><?php if($res->jenis_kelamin=="L"){echo 'Laki-Laki';}else{echo 'Perempuan';} ?></td>
    <td class="text-center"><p data-placement="top" data-toggle="tooltip" title="Edit"><button data-aksi="mahasiswa" data-nama="<?php echo $res->nama ?>" data-id="<?php echo $res->id_mahasiswa ?>" data-status="<?php echo $res->status ?>" data-jk="<?php echo $res->jenis_kelamin ?>" data-tk="<?php echo $res->tingkat_kelas ?>" data-nim="<?php echo $res->nim ?>" class="edit-button btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td class="text-center"><p data-placement="top" data-toggle="tooltip" title="Delete"><button data-aksi="mahasiswa" data-id="<?php echo $res->id_mahasiswa ?>" class="delete-button btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button></p></td>
</tr>
<?php
            $index++;
                                  }
    }
    public function pdf(){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('A4', 'potrait');
        $pdf->loadHTML(view("layouts.pdf"));
        return $pdf->stream();
    }
}

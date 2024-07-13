@extends('layouts.master')
@section('title', 'AMTO | Data Mahasiswa')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Admin</li>
            <li class="active">Mahasiswa</li>
        </ol>
    </div><!--/.row-->
    @if(session()->exists('notif'))
    @if(session()->get('notif')['success'])
    {!! 
    '<div class="alert alert-success alert-dismissable"> 
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Sukses! </strong>'. session()->get('notif')['msgaction'] .'
    </div>' 
    !!}
    @else
    {!! 
    '<div class="alert alert-danger alert-dismissable"> 
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Gagal! </strong>'. session()->get('notif')['msgaction'] .'
    </div>' 
    !!}
    @endif
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Daftar Mahasiswa</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table id="absensi" class="table table-bordred table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="4">
                                            <input type="text" name="search" class="form-control" placeholder="Cari...">
                                        </th>
                                        <th>
                                            <select class="form-control kelas search">
                                                <option value="">--PILIH TINGKAT KELAS--</option>
                                                <option>Se 1</option>
                                                <option>Se 2</option>
                                                <option>Se 3</option>
                                                <option>Se 4</option>
                                                <option>Se 5</option>
                                                <option>Se 6</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select class="form-control jk search">
                                                <option value="">--PILIH JENIS KELAMIN--</option>
                                                <option value="L">Laki-Laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width="10px"><input type="checkbox" id="checkall" /> </th>
                                        <th width="10px" class="text-center">No</th>
                                        <th>NIM</th>
                                        <th>Nama Mahasiswa</th>
                                        <th class="text-center">Tingkat Kelas</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th width="5%" colspan="2" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="isi">
                                    @foreach ($resource as $index => $res)
                                    <tr>
                                        <td><input type="checkbox" class="checkthis" /></td>
                                        <td class="text-center">{{ $index+1 }}</td>
                                        <td>{{ $res->nim}}</td>
                                        <td><a href="/mahasiswa/{{$res->id_mahasiswa}}"> {{ $res->nama}}</a></td>
                                        <td class="text-center">{{ $res->tingkat_kelas}}</td>
                                        <td class="text-center">@if($res->jenis_kelamin=="L"){{ "Laki-Laki" }}@else{{ "Perempuan" }}@endif</td>
                                        <td class="text-center"><p data-placement="top" data-toggle="tooltip" title="Delete"><button data-aksi="mahasiswa" data-id="{{$res->id_mahasiswa}}" class="delete-button btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <ul class="pagination pull-right">
                            {!! $resource->render() !!}
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <p data-placement="top" data-toggle="tooltip" title="Add" class="pull-right"><button class="btn btn-primary btn-sm" data-title="Add" data-toggle="modal" data-target="#add" ><span class="glyphicon glyphicon-plus"></span></button></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <p class="back-link">&copy; <?php echo date('Y') ?> System Record Aircraft Maintenance</p>
            </div>
        </div><!--/.row-->
    </div>
</div>

<!-- Modal CRUD Content -->

<!-- Edit Modal -->
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="title-modal">Modal Header</h4>
            </div>
            <form action="/mahasiswa/" method="post">
                <input type="hidden" name="id_mahasiswa" id="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="nim">NIM</label>
                                <input class="form-control" type="number" id="nim" name="nim" placeholder="Nomor Induk Mahasiswa">
                            </div>
                        </div> 
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="mahasiswa">Nama Mahasiswa</label>
                                <input class="form-control" type="text" id="nama_mahasiswa" name="nama" placeholder="Nama Mahasiswa">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <select class="form-control" id="jk" name="jk">
                                    <option selected disabled>--Pilih Jenis Kelamin--</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tk">Tingkat Kelas</label>
                                <select class="form-control" id="tk" name="tingkat_kelas">
                                    <option selected disabled>--Pilih Tingkat Kelas--</option>
                                    <option>Se 1</option>
                                    <option>Se 2</option>
                                    <option>Se 3</option>
                                    <option>Se 4</option>
                                    <option>Se 5</option>
                                    <option>Se 6</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-info btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-edit"></span> Update Data</button>
                </div>
                {!! csrf_field() !!}
                {{ method_field('PUT') }}
            </form>
        </div>
    </div>
</div>
<!--/Edit Modal -->

<!-- Add Modal -->
<div id="add" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Data Mahasiswa</h4>
            </div>
            <form action="/mahasiswa/" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="nim">NIM</label>
                                <input class="form-control" type="number" name="nim" placeholder="Nomor Induk Mahasiswa">
                            </div>
                        </div> 
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="mahasiswa">Nama Mahasiswa</label>
                                <input class="form-control" type="text" name="nama" placeholder="Nama Mahasiswa">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <select class="form-control" name="jk">
                                    <option selected disabled>--Pilih Jenis Kelamin--</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tk">Tingkat Kelas</label>
                                <select class="form-control" name="tingkat_kelas">
                                    <option selected disabled>--Pilih Tingkat Kelas--</option>
                                    <option>Se 1</option>
                                    <option>Se 2</option>
                                    <option>Se 3</option>
                                    <option>Se 4</option>
                                    <option>Se 5</option>
                                    <option>Se 6</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-info btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-plus"></span> Tambah Data</button>
                </div>
                {!! csrf_field() !!}
            </form>
        </div>
    </div>
</div>
<!--/add Modal -->

<!-- Delete modal -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="delete-form" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Yakin ingin menghapus data ini?</div>

                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                </div>
                {!! csrf_field() !!}
                {{ method_field('DELETE') }}
            </form>
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>
<!--/Delete modal -->

@endsection
@section('js')
<script>
    $('input[name="search"]').keyup(function(){
        $.ajax({
            type : 'POST', 
            data :{
                kunci : $(this).val(),
                kelas : $('.kelas').val(),
                jk : $('.jk').val(),
                _method : 'POST',
                _token : $('meta[name="csrf-token"]').attr('content')
            },
            url  : '/mahasiswa/search/', 
            success : function(html){
                $('#isi').html(html)
            }
        });  
    })
    $('.search').change(function(){
        $.ajax({
            type : 'POST', 
            data :{
                kunci : $('input[name="search"]').val(),
                kelas : $('.kelas').val(),
                jk : $('.jk').val(),
                _method : 'POST',
                _token : $('meta[name="csrf-token"]').attr('content')
            },
            url  : '/mahasiswa/search/', 
            success : function(html){
                $('#isi').html(html)
            }
        });  
    })

</script>
@endsection
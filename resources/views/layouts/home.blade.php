<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>AMTO | System Record Aircraft</title>
        <link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap.min.css') !!}">
        <link href="{!! asset('css/font-awesome.min.css') !!}" rel="stylesheet">
        <link href="{!! asset('css/styles.css') !!}" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse"><span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span></button>
                    <a class="navbar-brand" href="/">System Record Aircraft <span>Maintenance</span></a>
                    <div class="collapse navbar-collapse" id="navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                        </ul>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </nav>
        <main>
            <div class="parallax">
                <div class="caption">
                    <span class="border">Absensi <span style="color:#30a5ff;">AMTO</span></span>
                    <br>
                    <a href="#tentang"><i class="fa fa-angle-double-down fa-5x"></i></a>
                </div>
            </div>
            <div id="tentang">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="panel panel-container">
                                <div class="panel-heading text-center"><h3 class="uppercase">tentang</h3></div>
                                <div class="panel-body">
                                    <p>Absensi AMTO merupakan sistem absensi Mahasiswa jurusan TPPU yang dapat mempermudah dalam proses absensi. Absensi ini memiliki banyak kelebihan.</p>
                                </div>
                            </div>
                            <div class="panel panel-container">
                                <div class="panel-heading text-center"><h3 class="uppercase">Portal</h3></div>
                                <div class="panel-body text-center">
                                    <p> Silakan klik menu Login Absensi untuk melakukan LOGIN</p>
                                    <a href="login" class="btn btn-primary">Login Absensi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <div class="container text-center">
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="/">© {{date('Y')}}. System Record Aircraft Maintenance</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <script src="{!! asset('js/jquery-3.2.1.min.js') !!}"></script>
        <script src="{!! asset('js/bootstrap.min.js') !!}"></script>
        <script src="{!! asset('js/bootstrap-datepicker.js') !!}"></script>
        <script src="{!! asset('js/smooth-scroll.js') !!}"></script>
    </body>
</html>
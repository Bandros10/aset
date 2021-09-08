@extends('layouts.app')
@section('title')
<title>Form konfirmasi pengadaan barang</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Konfirmasi Pengadaan Perangkat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Konfirmasi Pengadaan Perangkat</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Data Perangkat</h3>
                </div>
                <form action="{{route('kepala_sumber_daya.konfirmasi.barang',$konfirm->kode_perangkat)}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <!-- /.card-header -->
                                <div class="form-group">
                                    <label for="exampleInputBorder">Nama Perangkat</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{$konfirm->nama_barang}}" readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Jenis Perangkat</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{$konfirm->jenis_barang}}" readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Merek Perangkat</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{$konfirm->merk_barang}}" readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Model Perangkat</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{$konfirm->model_barang}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Tanggal Pengadaan Perangkat</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{Carbon\Carbon::parse($konfirm->tanggal_pengadaan)->translatedFormat('d F Y')}}" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Harga Perangkat</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{number_format($konfirm->harga_barang,0,",",".")}}" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Nomor Serial Produk</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{$konfirm->nomer_seri_produk}}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Keterangan</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{$konfirm->keterangan}}" readonly>
                                </div>
                            </div>
                        </div>
                        @if ($konfirm->confirmed != true)
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-sm btn-primary btn-block">KONFIRMASI</button>
                                    <a href="#" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#tolaksd">TOLAK PENGADAAN</a>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-sm btn-success btn-block" disabled>SUDAH DI KONFIRMASI</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
{{-- modal --}}
<div class="modal fade" id="tolaksd">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kepala Sumber Daya Menolak Pengadaan Perangkat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('kepala_sumber_daya.tolak',$konfirm->kode_perangkat)}}" method="POST">
            <div class="modal-body">
                    @csrf
                    <textarea name="keterangan_sumber_daya" class="form-control" placeholder="Keterangan Penolakan"></textarea>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>

@endsection

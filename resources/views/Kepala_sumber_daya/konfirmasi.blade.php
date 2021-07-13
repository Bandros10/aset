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
                    <h1 class="m-0">Konfirmasi pengadaan barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Konfirmasi pengadaan barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form data barang</h3>
                </div>
                <form action="{{route('kepala_sumber_daya.konfirmasi.barang',$konfirm->id)}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <!-- /.card-header -->
                                <div class="form-group">
                                    <label for="exampleInputBorder">Nama Barang</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{$konfirm->nama_barang}}" readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Jenis Barang</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{$konfirm->jenis_barang}}" readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Merek Barang</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{$konfirm->merk_barang}}" readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Model Barang</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{$konfirm->model_barang}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Tanggal Pengadaan Barang</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{Carbon\Carbon::parse($konfirm->tanggal_pengadaan)->translatedFormat('d F Y')}}" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Harga Barang</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{number_format($konfirm->harga_barang,0,",",".")}}" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Jumlah Barang</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{$konfirm->jumlah_pengadaan}}" readonly>
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
@endsection

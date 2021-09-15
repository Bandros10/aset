@extends('layouts.app')
@section('title')
<title>Form konfirmasi peminjaman</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Konfirmasi peminjaman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Konfirmasi peminjaman</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form data peminjaman barang</h3>
                </div>
                <form action="{{route('kepala_sumber_daya.konfirmasi_peminjaman.barang',$data_pinjam->id)}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <!-- /.card-header -->
                                <div class="form-group">
                                    <label for="exampleInputBorder">Kode Perangkat</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{$data_pinjam->kode_perangkat}}" readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Nama Peminjam</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{$data_pinjam->nama_peminjam}}" readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Jabatan Peminjam</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{$data_pinjam->jabatan_peminjam}}" readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Devisi Peminjam</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{$data_pinjam->devisi_peminjam}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Tanggal Peminjaman barang</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{Carbon\Carbon::parse($data_pinjam->tgl_peminjam)->translatedFormat('d F Y')}}" readonly>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Keperluan</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{$data_pinjam->keperluan}}" readonly>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="exampleInputBorder">Kelengkapan</label>
                                    <input type="text" class="form-control form-control-border"
                                        value="{{$data_pinjam->kelengkapan}}" readonly>
                                </div>
                            </div>
                        </div>
                        @if ($data_pinjam->status != true)
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-sm btn-primary btn-block">KONFIRMASI</button>
                                    {{-- <a href="#" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#tolaksd">TOLAK PENGADAAN</a> --}}
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
{{-- <div class="modal fade" id="tolaksd">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sumber daya tolak pengadaan barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('kepala_sumber_daya.tolak',$konfirm->kode_perangkat)}}" method="POST">
            <div class="modal-body">
                    @csrf
                    <textarea name="keterangan_sumber_daya" class="form-control" placeholder="keterangan tolak"></textarea>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div> --}}

@endsection

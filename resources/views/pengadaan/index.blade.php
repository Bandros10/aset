@extends('layouts.app')
@section('title')
    <title>Pengadaan</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengadaan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">pengadaan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <x-card>
                        @slot('title')
                        <button class="btn btn-primary btn-sm"data-toggle="modal" data-target="#pengadaanmodal">input Pengadaan</button>
                        @endslot
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Nama Barang</td>
                                        <td>Jenis Barang</td>
                                        <td>Merek Barang</td>
                                        <td>Model Barang</td>
                                        <td>Harga Barang</td>
                                        <td>Tanggal Pengadaan</td>
                                        <td>Jumlah</td>
                                        <td>keterangan</td>
                                        <td>confirmed</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($pengadaan_data as $pengadaan)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$pengadaan->nama_barang}}</td>
                                            <td>{{$pengadaan->jenis_barang}}</td>
                                            <td>{{$pengadaan->merk_barang}}</td>
                                            <td>{{$pengadaan->model_barang}}</td>
                                            <td>{{$pengadaan->harga_barang}}</td>
                                            <td>{{$pengadaan->tanggal_pengadaan}}</td>
                                            <td>{{$pengadaan->jumlah_pengadaan}}</td>
                                            <td>{{$pengadaan->keterangan}}</td>
                                            <td>
                                                @if ($pengadaan->confirmed != true)
                                                    <span class="badge bg-danger">Menunggu Konfirmasi kepala sumber daya</span>
                                                @else
                                                    <span class="badge bg-success">sudah di konfirmasi</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @slot('footer')
                        ​
                        @endslot
                    </x-card>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

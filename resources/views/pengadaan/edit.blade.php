@extends('layouts.app')
@section('title')
<title>Edit Pengadaan</title>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Pengadaan barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item">Pengadaan</li>
                        <li class="breadcrumb-item">Pengadaan Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Pengadaan</h3>
                </div>
                <form action="{{route('pengadaan.update',$peng_edit->kode_perangkat)}}" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label>Nama Barang</label>
                                    <input type="text" class="form-control" name="nama_barang"
                                        placeholder="Masukan Nama Barang" value="{{$peng_edit->nama_barang}}" required>
                                </div>
                                <div class="col-3">
                                    <label>Jenis</label>
                                    <select class="form-control" name="jenis_barang" required>
                                        <option disabled>- Jenis Barang - </option>
                                        <option value="laptop" {{$peng_edit->jenis_barang == "laptop" ? 'selected' : '' }}>Laptop</option>
                                        <option value="PC" {{$peng_edit->jenis_barang == "PC" ? 'selected' : '' }}>PC</option>
                                        <option value="monitor" {{$peng_edit->jenis_barang == "monitor" ? 'selected' : '' }}>Monitor</option>
                                        <option value="printer" {{$peng_edit->jenis_barang == "printer" ? 'selected' : '' }}>printer</option>
                                        <option value="scanner" {{$peng_edit->jenis_barang == "scanner" ? 'selected' : '' }}>Scanner</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label>Merek</label>
                                    <input type="text" class="form-control" name="merk_barang"
                                        placeholder="Merek Barang Pengadaan" value="{{$peng_edit->merk_barang}}" required>
                                </div>
                                <div class="col-3">
                                    <label>Tipe Barang</label>
                                    <input type="text" class="form-control" name="model_barang"
                                        placeholder="Model Barang Pengadaan" value="{{$peng_edit->model_barang}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Nomer Seri Produk</label>
                                            <input type="number" class="form-control" name="nomer_seri_produk"
                                                placeholder="Nomer Seri produk" value="{{$peng_edit->nomer_seri_produk}}" required>
                                        </div>
                                        <div class="col-6">
                                            <label>Harga Satuan</label>
                                            <input type="number" class="form-control" name="harga_barang"
                                                placeholder="Harga Barang" value="{{$peng_edit->harga_barang}}" required>
                                        </div>
                                    </div>
                                    <label>Tanggal Pengadaan</label>
                                    <input type="date" class="form-control" name="tanggal_pengadaan"
                                        placeholder="Harga Barang" value="{{$peng_edit->tanggal_pengadaan}}" required>
                                </div>
                                <div class="col-6">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control" rows="4" required>{{$peng_edit->keterangan}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @endsection

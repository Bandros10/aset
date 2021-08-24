@extends('layouts.app')
@section('title')
<title>Form Penambahan Aset</title>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Penambahan Aset</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Aset</li>
                        <li class="breadcrumb-item active">Tambah Aset</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">TAMBAH ASET</h3>
                        </div>
                        <form action="{{route('aset.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-3">
                                            <label>Nama Perangkat</label>
                                            <input type="text" name="nama_perangkat" class="form-control"  placeholder="Masukkan Nama Perangkat">
                                        </div>
                                        <div class="col-2">
                                            <label>Kategori</label>
                                            <select class="form-control" name="kategori" required>
                                                <option selected disabled>- Kategori Perangkat - </option>
                                                <option value="laptop">Laptop</option>
                                                <option value="PC">PC</option>
                                                <option value="monitor">Monitor</option>
                                                <option value="printer">Printer</option>
                                                <option value="scanner">Scanner</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label>Tipe</label>
                                            <input type="text" name="tipe" class="form-control"  placeholder="Masukkan Tipe Perangkat">
                                        </div>
                                        <div class="col-2">
                                            <label>Merek</label>
                                            <input type="text" name="merek" class="form-control"  placeholder="Masukkan Merek Perangkat">
                                        </div>
                                        <div class="col-2">
                                            <label>Model</label>
                                            <input type="text" name="model" class="form-control"  placeholder="Masukkan Model Perangkat">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="kondisi" value="baik" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Keadaan Perangkat Baik
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="kondisi" value="buruk" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Diperlukan Pemeliharaan
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <label>Harga Perangkat</label>
                                            <input type="text" name="harga" class="form-control"  placeholder="Masukkan Harga Perangkat">
                                        </div>
                                        <div class="col-3">
                                            <label>Nomor Seri Produk</label>
                                            <input type="text" name="nomer_seri_produk" class="form-control"  placeholder="Masukkan nomer seri produk">
                                        </div>
                                        <div class="col-3">
                                            <label>Tanggal Pembelian</label>
                                            <input type="date" name="tgl_pembelian" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" class="form-control" placeholder="Masukkan Keterangan Perangkat"></textarea>
                                        </div>
                                        <div class="col-6">
                                            <label>Kelengkapan</label>
                                            <textarea name="kelengkapan" class="form-control" placeholder="Masukkan Kelengkapan Perangkat"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File Input</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                          <label class="custom-file-label" for="exampleInputFile">Pilih Foto</label>
                                          <input type="file" name="photo" class="custom-file-input" id="exampleInputFile">
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

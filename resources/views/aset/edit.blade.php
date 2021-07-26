@extends('layouts.app')
@section('title')
<title>Form Edit Aset</title>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Edit Aset</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Aset</li>
                        <li class="breadcrumb-item active">Edit Aset</li>
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
                          <h3 class="card-title">EDIT ASET</h3>
                        </div>
                        <form action="{{route('aset.update',$asetedit->id_perangkat)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-3">
                                            <label>Nama Perangkat</label>
                                            <input type="text" name="nama_perangkat" class="form-control"  value="{{$asetedit->nama_perangkat}}">
                                        </div>
                                        <div class="col-2">
                                            <label>Kategori</label>
                                            <select class="form-control" name="kategori" required>
                                                <option value="laptop" @if(old('kategori', $asetedit->kategori) === 'laptop') selected @endif>Laptop</option>
                                                <option value="PC" @if(old('kategori', $asetedit->kategori) === 'pc') selected @endif>PC</option>
                                                <option value="monitor" @if(old('kategori', $asetedit->kategori) === 'monitor') selected @endif>Monitor</option>
                                                <option value="printer" @if(old('kategori', $asetedit->kategori) === 'printer') selected @endif>printer</option>
                                                <option value="scanner" @if(old('kategori', $asetedit->kategori) === 'scanner') selected @endif>Scanner</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label>Tipe</label>
                                            <input type="text" name="tipe" class="form-control"  value="{{$asetedit->tipe}}">
                                        </div>
                                        <div class="col-2">
                                            <label>Merek</label>
                                            <input type="text" name="merek" class="form-control"  value="{{$asetedit->merek}}">
                                        </div>
                                        <div class="col-2">
                                            <label>model</label>
                                            <input type="text" name="model" class="form-control"  value="{{$asetedit->model}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="kondisi" value="baik" {{ $asetedit->kondisi == 'baik' ? 'checked' : '' }} id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Keadaan Barang Baik
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="kondisi" value="buruk" {{ $asetedit->kondisi == 'buruk' ? 'checked' : '' }} id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Diperlukan Pemeliharaan
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label>Harga barang</label>
                                            <input type="text" name="harga" class="form-control"  value="{{$asetedit->harga}}">
                                        </div>
                                        <div class="col-3">
                                            <label>Tanggal Pembelian</label>
                                            <input type="date" name="tgl_pembelian" class="form-control" value="{{$asetedit->tgl_pembelian}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" class="form-control" placeholder="masukan keterangan perangkat">{{$asetedit->keterangan}}</textarea>
                                        </div>
                                        <div class="col-6">
                                            <label>Kelengkapan</label>
                                            <textarea name="kelengkapan" class="form-control" placeholder="masukan kelengkapan perangkat">{{$asetedit->kelengkapan}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                          <label class="custom-file-label" for="exampleInputFile">pilih Foto</label>
                                          <input type="file" name="photo" class="custom-file-input" id="exampleInputFile">
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-block">Update Data Aset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

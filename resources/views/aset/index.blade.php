@extends('layouts.app')
@section('title')
    <title>Data barang aset</title>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Aset</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data aset</li>
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
                            <a href="{{route('aset.create')}}" class="btn btn-primary btn-sm">Tambah Data barang Aset</a>
                        @endslot
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Kode Perangkat</td>
                                        <td>Nama Perangkat</td>
                                        <td>Kategori</td>
                                        <td>Tipe Jenis</td>
                                        <td>Merek</td>
                                        <td>Model</td>
                                        <td>Kondisi</td>
                                        <td>Harga</td>
                                        <td>Tanggal Pembelian</td>
                                        <td>Jumlah Saat Ini</td>
                                        <td>Kelengkapan perangkat</td>
                                        <td>Keterangan</td>
                                        <td>Foto gamabar</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($all_aset as $aset)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$aset->id_perangkat}}</td>
                                            <td>{{$aset->nama_perangkat}}</td>
                                            <td>{{$aset->kategori}}</td>
                                            <td>{{$aset->tipe}}</td>
                                            <td>{{$aset->merek}}</td>
                                            <td>{{$aset->model}}</td>
                                            <td>{{$aset->kondisi}}</td>
                                            <td>{{$aset->harga}}</td>
                                            <td>{{$aset->tgl_pembelian}}</td>
                                            <td>{{$aset->jumlah}}</td>
                                            <td>{{$aset->kelengkapan}}</td>
                                            <td>{{$aset->keterangan}}</td>
                                            <td>
                                                @if (!empty($aset->photo))
                                                    <img src="{{ asset('uploads/product/' . $aset->photo) }}"
                                                        alt="{{ $aset->name }}" width="100px" height="100px">
                                                @else
                                                    <img src="http://via.placeholder.com/50x50" alt="{{ $aset->name }}">
                                                @endif
                                            </td>
                                            <td></td>
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

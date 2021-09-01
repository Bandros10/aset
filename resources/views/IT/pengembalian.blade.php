@extends('layouts.app')
@section('title')
<title>Pengembalian</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">PENGEMBALIAN ASET</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pengembalian</li>
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
                        <h3>List Pengembalian</h3>
                        @role('IT')
                            <form action="{{route('laporan.pengembalian')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Date range:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="laporan_pengembalian" class="form-control float-right"> <button type="submit" class="form-control btn btn-sm btn-info">Cetak laporan</button>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endrole
                        @endslot
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Kode Perangkat</td>
                                        <td>Nama Peminjam</td>
                                        <td>Jabatan Peminjam</td>
                                        <td>Divisi Peminjam</td>
                                        <td>Keperluan</td>
                                        <td>Kelengkapan</td>
                                        <td>Tanggal</td>
                                        <td>Acton</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($pengembalian as $pengembalian)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$pengembalian->kode_perangkat}}</td>
                                        <td>{{$pengembalian->nama_peminjam}}</td>
                                        <td>{{$pengembalian->jabatan_peminjam}}</td>
                                        <td>{{$pengembalian->devisi_peminjam}}</td>
                                        <td>{{$pengembalian->keperluan}}</td>
                                        <td>{{$pengembalian->kelengkapan}}</td>
                                        <td>{{$pengembalian->tgl_pengembalian}}</td>
                                        <td>
                                            @if (!empty($pengembalian->kelengkapan))
                                            <a href="{{route('it.pengembalian.delete',$pengembalian->id)}}" class="btn btn-sm btn-danger">Hapus</a>
                                            <a href="{{route('it.pengembalian_cetak',$pengembalian->id)}}" class="btn btn-sm btn-primary">cetak pengembalian</a>
                                            @else
                                            <a href="{{route('it.pengembalian_aset',$pengembalian->id)}}" class="btn btn-sm btn-primary">Pengembalian Perangkat</a>
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
@push('js')
    <script>
         $('input[name="laporan_pengembalian"]').daterangepicker();
    </script>
@endpush

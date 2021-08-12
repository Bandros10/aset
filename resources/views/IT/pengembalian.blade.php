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
                    <h1 class="m-0">Pengembalian</h1>
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
                        @endslot
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Id Perangkat</td>
                                        <td>Nama Peminjam</td>
                                        <td>Jabatan Peminjam</td>
                                        <td>Devisi Peminjam</td>
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
                                        <td>{{$pengembalian->id_perangkat}}</td>
                                        <td>{{$pengembalian->nama_peminjam}}</td>
                                        <td>{{$pengembalian->jabatan_peminjam}}</td>
                                        <td>{{$pengembalian->devisi_peminjam}}</td>
                                        <td>{{$pengembalian->keperluan}}</td>
                                        <td>{{$pengembalian->kelengkapan}}</td>
                                        <td>{{$pengembalian->created_at->format('d M Y')}}</td>
                                        <td><a href="#"  data-toggle="modal" data-target="#kelengkapan-{{$pengembalian->id_perangkat}}" class="btn btn-sm btn-warning"> Pengembalian</a></td>
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
<div class="modal fade" id="kelengkapan-{{$pengembalian->id_perangkat}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pengambalian Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('it.pengembalian.aset',$pengembalian->id_perangkat)}}" method="POST">
            <div class="modal-body">
                    {{ csrf_field() }}
                    <textarea name="Kelengkapan" class="form-control" placeholder="kelengkapan perangkat"></textarea>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">pengembalian</button>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
@endsection

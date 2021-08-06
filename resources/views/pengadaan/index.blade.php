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
                    <h3>FORM PENGADAAN BARANG</h3>
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
                        @role('IT')
                            <button class="btn btn-primary btn-sm"data-toggle="modal" data-target="#pengadaanmodal">input Pengadaan</button>
                        @endrole
                        @endslot
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>Kode Perangkat</td>
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
                                    @foreach ($pengadaan_data as $pengadaan)
                                        <tr>
                                            <td>{{$pengadaan->kode_perangkat}}</td>
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
                                                    @role('IT')
                                                        @if ($pengadaan->confirmed_keuangan == true)
                                                            <span class="badge bg-danger">Menunggu Konfirmasi kepala sumber daya</span>
                                                            <span class="badge bg-success">Pengadaan telah aprov pengadaan</span>
                                                        @endif
                                                    @elserole('keuangan')
                                                        @if (!empty($pengadaan->keterangan_keuangan))
                                                            <span class="badge badge-danger" data-toggle="popover" title="Keterangan Tolak" data-content="{{$pengadaan->keterangan_keuangan}}">Permintaan pengadaan barang telah di tolak</span>
                                                        @elseif (!empty($pengadaan->keterangan_sumber_daya == true))
                                                            <span class="badge badge-danger">Pengadaan tidak di aprov kepala sumber</span>
                                                        @elseif ($pengadaan->confirmed_keuangan == true)
                                                            <span class="badge badge-success">Pengadaan di aprov oleh keuangan</span>
                                                        @else
                                                            <a href="{{route('keuangan.konfirmasi',$pengadaan->id)}}" class="btn btn-info btn-sm"><i class="fas fa-check-circle"></i> Konfirmasi keuangan</a>
                                                        @endif
                                                    @elserole('kepala sumber daya')
                                                        @if (!empty($pengadaan->keterangan_sumber_daya))
                                                            <span class="badge badge-danger" data-toggle="popover" title="Keterangan Tolak" data-content="{{$pengadaan->keterangan_keuangan}}">Permintaan pengadaan barang telah di tolak</span>
                                                        @elseif ($pengadaan->confirmed_kepala_sumber_daya == true)
                                                            <span class="badge badge-success">Pengadaan di aprov oleh kepala sumber daya</span>
                                                        @else
                                                            <a href="{{route('kepala_sumber_daya.konfirmasi',$pengadaan->id)}}" class="btn btn-info btn-sm"><i class="fas fa-check-circle"></i> Konfirmasi kepala sumber daya</a>
                                                        @endif
                                                    @endrole
                                                @else
                                                    @role('IT')
                                                        <span class="badge bg-success">Pengadaan telah aprov</span>
                                                    @elserole('keuangan')
                                                        <span class="badge bg-success">Pengadaan telah aprov</span>
                                                    @elserole('kepala sumber daya')
                                                        <span class="badge bg-success">Pengadaan telah aprov</span>
                                                    @endrole
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

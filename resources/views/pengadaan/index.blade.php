@extends('layouts.app')
@section('title')
    <title>Pengadaan</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/yearpicker.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>FORM PENGADAAN ASET</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pengadaan</li>
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
                            <button class="btn btn-primary btn-sm"data-toggle="modal" data-target="#pengadaanmodal">Input Pengadaan Aset</button>
                            <form action="{{route('laporan.pengadaan')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Laporan Per Tahun</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="tahun_laporan_pengadaan" class="yearpicker form-control" value="" /> <button type="submit" class="form-control btn btn-sm btn-info">Cetak laporan</button>
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
                                        <td>Kode Perangkat</td>
                                        <td>Nama Barang</td>
                                        <td>Jenis Barang</td>
                                        <td>Merek Barang</td>
                                        <td>Model Barang</td>
                                        <td>Nomer Seri Produk</td>
                                        <td>Harga Barang</td>
                                        <td>Tanggal Pengadaan</td>
                                        <td>keterangan</td>
                                        <td>Confirmed</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_pengadaan as $pengadaan)
                                        <tr>
                                            <td>{{$pengadaan->kode_perangkat}}</td>
                                            <td>{{$pengadaan->nama_barang}}</td>
                                            <td>{{$pengadaan->jenis_barang}}</td>
                                            <td>{{$pengadaan->merk_barang}}</td>
                                            <td>{{$pengadaan->model_barang}}</td>
                                            <td>{{$pengadaan->nomer_seri_produk}}</td>
                                            <td>{{$pengadaan->harga_barang}}</td>
                                            <td>{{$pengadaan->tanggal_pengadaan}}</td>
                                            <td>{{$pengadaan->keterangan}}</td>
                                            <td>
                                                @if ($pengadaan->confirmed != true)
                                                    @role('IT')
                                                        @if ($pengadaan->confirmed_keuangan == true && $pengadaan->confirmed_kepala_sumber_daya == true)
                                                            <span class="badge bg-success">Pengadaan telah di konfimasi</span>
                                                        @elseif (!empty($pengadaan->keterangan_keuangan) || !empty($pengadaan->keterangan_sumber_daya))
                                                            <span class="badge badge-danger" data-toggle="popover" title="Keterangan Tolak" data-content="{{$pengadaan->keterangan_keuangan}}">Pengadaan tidak disetujui</span>
                                                        @else
                                                            <a href="{{route('pengadaan.edit',$pengadaan->kode_perangkat)}}" class="btn btn-sm btn-warning">Edit pengadaan</a>
                                                        @endif
                                                    @elserole('kepala sumber daya')
                                                        @if (!empty($pengadaan->keterangan_sumber_daya))
                                                            <span class="badge badge-danger" data-toggle="popover" title="Keterangan Tolak" data-content="{{$pengadaan->keterangan_sumber_daya}}">Permintaan pengadaan aset telah ditolak kepala sumber daya</span>
                                                        @elseif ($pengadaan->confirmed_kepala_sumber_daya == true)
                                                            <span class="badge badge-success">Pengadaan disetujui oleh Sumber daya</span>
                                                        @elseif (!empty($pengadaan->keterangan_keuangan))
                                                            <span class="badge badge-danger" data-toggle="popover" title="Keterangan Tolak" data-content="{{$pengadaan->keterangan_keuangan}}">Permintaan pengadaan aset telah ditolak keuangan</span>
                                                        @else
                                                            <a href="{{route('kepala_sumber_daya.konfirmasi',$pengadaan->kode_perangkat)}}" class="btn btn-info btn-sm"><i class="fas fa-check-circle"></i> Konfirmasi Kepala Sumber Daya</a>
                                                        @endif
                                                    @elserole('keuangan')
                                                        @if (!empty($pengadaan->keterangan_keuangan))
                                                            <span class="badge badge-danger" data-toggle="popover" title="Keterangan Tolak" data-content="{{$pengadaan->keterangan_keuangan}}">Permintaan pengadaan aset telah ditolak keuangan</span>
                                                        @elseif ($pengadaan->confirmed_keuangan == true)
                                                            <span class="badge badge-success">Pengadaan disetujui keuangan</span>
                                                        @elseif (!empty($pengadaan->keterangan_sumber_daya))
                                                            <span class="badge badge-danger" data-toggle="popover" title="Keterangan Tolak" data-content="{{$pengadaan->keterangan_sumber_daya}}">Permintaan pengadaan aset telah ditolak sumber daya</span>
                                                        @elseif ($pengadaan->confirmed_kepala_sumber_daya == true)
                                                            <a href="{{route('keuangan.konfirmasi',$pengadaan->kode_perangkat)}}" class="btn btn-info btn-sm"><i class="fas fa-check-circle"></i> Konfirmasi Keuangan</a>
                                                        @else
                                                        <span class="badge badge-danger">Menunggu Konfirmasi Kepala Sumber Daya</span>
                                                        @endif
                                                    @endrole
                                                @else
                                                    @role('IT')
                                                        <span class="badge bg-success">Pengadaan telah disetujui</span>
                                                    @elserole('keuangan')
                                                        <span class="badge bg-success">Pengadaan telah disetujui</span>
                                                    @elserole('kepala sumber daya')
                                                        <span class="badge bg-success">Pengadaan telah disetujui</span>
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
@push('js')
    <script src="{{asset('js/yearpicker.js')}}"></script>
    <script>
        $(document).ready(function() {
            $(".yearpicker").yearpicker({
                year: 2021,
                startYear: 2019,
                endYear: 9999,
            });
        });
    </script>
@endpush


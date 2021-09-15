@extends('layouts.app')
@section('title')
    <title>Peminjaman</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">PEMINJAMAN ASET</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Peminjaman</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    @role('IT')
                    <x-card>
                        @slot('title')
                        <h3>Form Peminjaman Aset</h3>
                        @endslot
                        <form action="{{route('it.input.peminjaman')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-3">
                                    <label>Kode Perangkat</label>
                                    <select class="form-control search" id="kode_perangkat" onchange="autofill()" name="kode_perangkat" required>
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label>NIK</label>
                                    <select class="form-control nik" id="nik" name="nik"  onchange="autofillpegawai()" required>
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label>Jabatan Peminjam</label>
                                    <input class="form-control" name="jabatan_peminjam" id="jabatan_peminjam" placeholder="- Input Jabatan Peminjam -" required readonly>
                                </div>
                                <div class="col-3">
                                    <label>Divisi Peminjam</label>
                                    <input class="form-control" name="devisi_peminjam" id="devisi_peminjam" placeholder="- Input devisi Peminjam -" required readonly>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <textarea name="kelengkapan" class="form-control" id="kelengkapan" placeholder="- Input Kelengkapan Perangkat -" required readonly></textarea>
                                </div>
                                <div class="col-6">
                                    <textarea name="keperluan" class="form-control" placeholder="- Input Keperluan Peminjaman -" required></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-block btn-success">Ajukan Peminjaman</button>
                                </div>
                            </div>
                        </form>
                        @slot('footer')
                        ​
                        @endslot
                    </x-card>
                    @endrole
                    <x-card>
                        @slot('title')
                        <h3>List Peminjaman Aset</h3>
                        @role('IT')
                            <form action="{{route('laporan.peminjaman')}}" method="POST">
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
                                                <input type="text" name="laporan_peminjam" class="form-control float-right"> <button type="submit" class="form-control btn btn-sm btn-info">Cetak laporan</button>
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
                                        <td>Keperluan Proyek</td>
                                        <td>Tanggal</td>
                                        @role('kepala sumber daya')
                                        <td>Aksi</td>
                                        @elserole('IT')
                                        <td>Aksi</td>
                                        @endrole
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($peminjam as $peminjaman)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$peminjaman->kode_perangkat}}@if ($peminjaman->status != true)
                                            <sup class="badge bg-danger">Menunggu Konfirmasi</sup>
                                        @else
                                            <sup class="badge bg-success">Telah Dikonfirmasi</sup>
                                        @endif</td>
                                        <td>{{$peminjaman->nama_peminjam}}</td>
                                        <td>{{$peminjaman->jabatan_peminjam}}</td>
                                        <td>{{$peminjaman->devisi_peminjam}}</td>
                                        <td>{{$peminjaman->keperluan}}</td>
                                        <td>{{Carbon\carbon::parse($peminjaman->tgl_peminjaman)->format('d M Y')}}</td>
                                        @role('kepala sumber daya')
                                        @if ($peminjaman->status != true)
                                            <td><a href="{{route('kepala_sumber_daya.konfirmasi_peminjaman',$peminjaman->id)}}" class="btn btn-sm btn-success"> Konfirmasi peminjaman</a></td>
                                        @else
                                            <td><button class="btn btn-sm btn-primary" disabled> Peminjaman sudah dikonfirmasi</button></td>
                                        @endif
                                        @elserole('IT')
                                        @if ($peminjaman->status != false)
<<<<<<< Updated upstream
                                            <td><a href="{{route('it.peminjaman_delete',$peminjaman->id)}}" class="btn btn-sm btn-danger"> Hapus </a> 
                                                <a href="{{route('it.peminjaman_cetak',$peminjaman->id)}}" class="btn btn-sm btn-primary">Cetak Surat</a></td>
                                            
=======
                                            <td><a href="{{route('it.peminjaman_delete',$peminjaman->id)}}" class="btn btn-sm btn-danger"> Hapus </a> <a href="{{route('it.peminjaman_cetak',$peminjaman->id)}}" class="btn btn-sm btn-primary">Cetak Surat</a></td>
>>>>>>> Stashed changes
                                        @else
                                            <td><p class="badge bg-danger">Belum Dikonfirmasi</p></td>
                                        @endif
                                        @endrole
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
    <script type="text/javascript">
         $(document).ready(function () {
            $('.search').select2({
                placeholder: "- Kode Perangkat -",
                ajax: {
                    url: '{{ route('it.search') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (aset) {
                                return {
                                    id: aset.kode_perangkat,
                                    text: aset.kode_perangkat + ' - ' + aset.merek + ' ' + aset
                                        .tipe
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('input[name="laporan_peminjam"]').daterangepicker();

            $('.nik').select2({
                placeholder: "- pegawai -",
                ajax: {
                    url: '{{ route('it.data_pegawai') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (pegawai) {
                                return {
                                    id: pegawai.nik,
                                    text: pegawai.nik + ' - ' + pegawai.nama_depan + ' ' + pegawai
                                        .nama_belakang
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
         });
        function autofill(){
            var kode_perangkat = $("#kode_perangkat").val();
            $.ajax({
                url : '{{route('it.autofill')}}',
                data : 'kode_perangkat='+kode_perangkat,
                success: function( data ) {
                    $("#kelengkapan").val(data.kelengkapan)
                }
            });
        }
        function autofillpegawai(){
            var nik = $("#nik").val();
            $.ajax({
                url : '{{route('it.autofillpegawai')}}',
                data : 'nik='+nik,
                success: function( data ) {
                    $("#jabatan_peminjam").val(data.jabatan)
                    $("#devisi_peminjam").val(data.devisi)
                }
            });
        }
    </script>
@endpush

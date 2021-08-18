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
                    <h1 class="m-0">Peminjaman</h1>
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
                                    <select class="form-control search" name="kode_perangkat">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label>Nama peminjam</label>
                                    <input class="form-control" name="nama_peminjam" placeholder="- input nama peminjam -">
                                </div>
                                <div class="col-3">
                                    <label>Jabatan peminjam</label>
                                    <input class="form-control" name="jabatan_peminjam" placeholder="- input jabatan peminjam -">
                                </div>
                                <div class="col-3">
                                    <label>Devisi peminjam</label>
                                    <select name="devisi_peminjam" class="form-control">
                                        <option selected disabled>- pilih Devisi -</option>
                                        <option value="marketing">marketing</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <textarea name="keperluan" class="form-control" placeholder="- input keperluan peminjaman -"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-block btn-success">Ajukan peminjaman</button>
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
                        <h3>List Peminjam</h3>
                        @endslot
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Kode Perangkat</td>
                                        <td>Nama Peminjam</td>
                                        <td>Jabatan Peminjam</td>
                                        <td>Devisi Peminjam</td>
                                        <td>Keperluan</td>
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
                                            <sup class="badge bg-danger">Menunggu konfirmasi</sup>
                                        @else
                                            <sup class="badge bg-success">telah di Konfirmasi</sup>
                                        @endif</td>
                                        <td>{{$peminjaman->nama_peminjam}}</td>
                                        <td>{{$peminjaman->jabatan_peminjam}}</td>
                                        <td>{{$peminjaman->devisi_peminjam}}</td>
                                        <td>{{$peminjaman->keperluan}}</td>
                                        <td>{{$peminjaman->created_at->format('d M Y')}}</td>
                                        @role('kepala sumber daya')
                                        @if ($peminjaman->status != true)
                                            <td><a href="{{route('kepala_sumber_daya.konfirmasi_peminjaman',$peminjaman->id)}}" class="btn btn-sm btn-success"> Konfirmasi</a></td>
                                        @else
                                            <td><button class="btn btn-sm btn-primary" disabled> Peminjaman sudah di konfirmasi</button></td>
                                        @endif
                                        @elserole('IT')
                                        @if ($peminjaman->status != false)
                                            <td><a href="{{route('it.peminjaman_delete',$peminjaman->id)}}" class="btn btn-sm btn-danger"> Delete</a></td>
                                        @else
                                            <td><p class="badge bg-danger">belum di aprov</p></td>
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
                placeholder: "- Kode Barang -",
                ajax: {
                    url: '{{ route('it.search') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (aset) {
                                return {
                                    id: aset.kode_perangkat,
                                    text: aset.kode_perangkat + ' - ' + aset
                                        .nama_perangkat
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
         });
    </script>
@endpush

@extends('layouts.app')
@section('title')
    <title>Peminjama</title>
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
                    <x-card>
                        @slot('title')
                        <h3>Form Peminjaman Aset</h3>
                        @endslot
                        <form action="{{route('it.input.peminjaman')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-3">
                                    <label for="id_perangkat">ID Perangkat</label>
                                    <select class="form-control search" name="id_perangkat">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label for="id_perangkat">Nama peminjam</label>
                                    <input class="form-control" name="nama_peminjam" placeholder="- input nama peminjam -">
                                </div>
                                <div class="col-3">
                                    <label for="id_perangkat">Jabatan peminjam</label>
                                    <input class="form-control" name="jabatan_peminjam" placeholder="- input jabatan peminjam -">
                                </div>
                                <div class="col-3">
                                    <label for="id_perangkat">Devisi peminjam</label>
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
                    <x-card>
                        @slot('title')
                        <h3>List Peminjam</h3>
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
                                        <td>Tanggal</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($peminjam as $peminjaman)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$peminjaman->id_perangkat}}</td>
                                        <td>{{$peminjaman->nama_peminjam}}</td>
                                        <td>{{$peminjaman->jabatan_peminjam}}</td>
                                        <td>{{$peminjaman->devisi_peminjam}}</td>
                                        <td>{{$peminjaman->keperluan}}</td>
                                        <td>{{$peminjaman->created_at->format('d M Y')}}</td>
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
                                    id: aset.id_perangkat,
                                    text: aset.id_perangkat + ' - ' + aset
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

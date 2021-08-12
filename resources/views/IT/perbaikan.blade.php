@extends('layouts.app')
@section('title')
    <title>Perbaikan</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Perbaikan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Perbaikan</li>
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
                        <h3>Form Perbaikan Aset</h3>
                        @endslot
                        <form action="{{route('it.input.perbaikan')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-3">
                                    <label for="id_perangkat">ID Perangkat</label>
                                    <select class="form-control search" name="id_perangkat">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <textarea name="keterangan_perbaikan" class="form-control" placeholder="- input keterangan -"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-block btn-success">Ajukan Perbaikan</button>
                                </div>
                            </div>
                        </form>
                        @slot('footer')
                        ​
                        @endslot
                    </x-card>
                    <x-card>
                        @slot('title')
                        <h3>List Perbaikan</h3>
                        @endslot
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Id Perangkat</td>
                                        <td>Tanggal</td>
                                        <td>Kterangan</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($perbaikan as $perbaikan)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$perbaikan->id_perangkat}}</td>
                                        <td>{{$perbaikan->created_at->format('d M Y')}}</td>
                                        <td>{{$perbaikan->keterangan_perbaikan}}</td>
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
                    url: '{{ route('it.search_perbaikan') }}',
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
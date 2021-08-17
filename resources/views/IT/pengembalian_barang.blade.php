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
                    <h1 class="m-0">Pengembalian Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('it.pengembalian')}}"></a>Pengembalian</li>
                        <li class="breadcrumb-item active"></a>Pengembalian Barang</li>
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
                            <h3>Pengembalian Barang</h3>
                        @endslot
                        <form action="{{route('it.pengembalian_submit',$data_pengembalian->id)}}" method="POST">
                            @csrf
                            <label for="">Kelengkapan</label>
                            <input type="hidden" name="kode_perangkat" value="{{$data_pengembalian->kode_perangkat}}">
                            <textarea name="kelengkapan" class="form-control"></textarea>
                            <br>
                            <button type="submit" class="btn btn-block btn-info">Submit pengambalian barang</button>
                        </form>
                        @slot('footer')

                        @endslot
                    </x-card>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

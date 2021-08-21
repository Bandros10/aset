@extends('layouts.app')
@section('title')
<title>Data Aset</title>
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
                        <li class="breadcrumb-item active">Data Aset</li>
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
                        <a href="{{route('aset.create')}}" class="btn btn-primary btn-sm">Tambah Data Aset</a>
                        @endslot
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="laptop-tab" data-toggle="tab" href="#laptop"
                                    role="tab" aria-controls="laptop" aria-selected="true">Laptop</a>
                                <a class="nav-item nav-link" id="pc-tab" data-toggle="tab" href="#pc" role="tab"
                                    aria-controls="pc" aria-selected="true">PC</a>
                                <a class="nav-item nav-link" id="monitor-tab" data-toggle="tab" href="#monitor"
                                    role="tab" aria-controls="monitor" aria-selected="false">Monitor</a>
                                <a class="nav-item nav-link" id="printer-tab" data-toggle="tab" href="#printer"
                                    role="tab" aria-controls="printer" aria-selected="false">Printer</a>
                                <a class="nav-item nav-link" id="scanner-tab" data-toggle="tab" href="#scanner"
                                    role="tab" aria-controls="scanner" aria-selected="false">Scanner</a>
                            </div>
                        </nav>
                        <br>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane active" id="laptop" role="tabpanel"
                                aria-labelledby="laptop-tab">
                                @include('aset.laptop_table')
                            </div>
                            <div class="tab-pane" id="pc" role="tabpanel" aria-labelledby="pc-tab">
                                @include('aset.pc_table')
                            </div>
                            <div class="tab-pane" id="monitor" role="tabpanel"
                                aria-labelledby="monitor-tab">
                                @include('aset.monitor_table')
                            </div>
                            <div class="tab-pane" id="printer" role="tabpanel"
                                aria-labelledby="printer-tab">
                                @include('aset.printer_table')
                            </div>
                            <div class="tab-pane" id="scanner" role="tabpanel"
                                aria-labelledby="scanner-tab">
                                @include('aset.scanner_table')
                            </div>
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

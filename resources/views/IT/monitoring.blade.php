@extends('layouts.app')
@section('title')
<title>Monitoring</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Monitoring</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Monitoring</li>
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
                        <h3>Monitoring</h3>
                        @endslot
                        <div class="row">
                            <div class="col-4">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">Monitoring Seluruh Barang</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="donutChart"
                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="panel">
                                    <div id="keluar_masuk">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="panel">
                                    <div id="pertahun">

                                    </div>
                                </div>
                            </div>
                        </div>
                        @slot('footer')

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
    $(function(){
        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData        = {
          labels: [
              'laptop',
              'PC',
              'Monitor',
              'Printer',
              'Scanner',
          ],
          datasets: [
            {
              data: [{{$data_laptop}},{{$data_pc}},{{$data_monitor}},{{$data_printer}},{{$data_scanner}}],
              backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }
          ]
        }
        var donutOptions     = {
          maintainAspectRatio : false,
          responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
          type: 'doughnut',
          data: donutData,
          options: donutOptions
        })

        Highcharts.chart('keluar_masuk', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Data Statistic barang pinjam, pengembalian dan perbaikan'
            },
            xAxis: {
                categories: [
                    'Peminjaman',
                    'Pengembalian',
                    'Perbaikan'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'data Statistic'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} barang</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Data real',
                data: [{!! json_encode($data_peminjaman)!!},{!! json_encode($data_pengembalian)!!},{!! json_encode($data_perbaikan)!!}]
            }, {
                name: 'Data Raw',
                data: [{!! json_encode($raw_peminjaman)!!},"",{!! json_encode($raw_perbaikan)!!}]

            },]
        });
        var dl = {!!json_encode($data_aset_tahun_laptop)!!}
        var dpc = {!!json_encode($data_aset_tahun_PC)!!}
        var dm = {!!json_encode($data_aset_tahun_monitor)!!}
        var dp = {!!json_encode($data_aset_tahun_printer)!!}
        var dsc = {!!json_encode($data_aset_tahun_scanner)!!}
        console.log(dl);
        Highcharts.chart('pertahun', {

            title: {
                text: 'data statistic aset data'
            },

            yAxis: {
                title: {
                    text: 'Jumlah aset'
                }
            },

            xAxis: {
                accessibility: {
                    rangeDescription: 'tahun'
                }
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    pointStart: 2021
                }
            },

            series: [{
                name: 'Laptop',
                data: dl
            }, {
                name: 'PC',
                data: dpc
            }, {
                name: 'Monitor',
                data: dm
            }, {
                name: 'Printer',
                data: dp
            }, {
                name: 'Scanner',
                data: dsc
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 100
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    })
</script>
@endpush

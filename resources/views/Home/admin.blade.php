@extends('layouts.content')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Informasi Summary Pasien</h3>
                    </div>
                </div>
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="chart1"></div>
                        <p class="highcharts-description"></p>
                    </figure>
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var json = '{!! json_encode($summary) !!}';
            var data = JSON.parse(json);

            Highcharts.chart('chart1', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Informasi Pasien {{ date("d F Y") }}'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y} Orang</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Jumlah',
                    colorByPoint: true,
                    data: data
                }]
            });
        });
    </script>
@endsection
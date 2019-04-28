@extends('layouts.container')


@section('header','Main Page')

@section('content')
@include('components.loader')
<div class="header">
    <h2>Daftar 10 Besar Penyakit Rawat Inap</h2>
</div>
<div class="body">
    <iframe class="chartjs-hidden-iframe" __idm_frm__="180" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
    <canvas id="bar_chart" height="391" width="782" style="display: block; width: 782px; height: 391px;"></canvas>
</div>
@endsection

@push('scripts')
    <script src="../../plugins/chartjs/Chart.bundle.js"></script>

    <script src="{{asset('js/pages/charts/chartjs.js')}}"></script>
    <script>
        if(document.getElementById("bar_chart") != null){
            var chart = new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('bar'));
        }

        function getChartJs(type) {
            var config = null;

            if (type === 'bar') {
                config = {
                    type: 'bar',
                    data: {
                        labels: ["January", "February", "March", "April", "May", "June", "July"],
                        datasets: [{
                            label: "My First dataset",
                            data: [65, 59, 80, 81, 56, 55, 40,200],
                            backgroundColor: 'rgba(0, 188, 212, 0.8)'
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    }
                }
            }
            return config;
        }
    </script>
@endpush
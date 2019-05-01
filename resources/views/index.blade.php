@extends('layouts.container')


@section('header','Main Page')

@section('content')
@include('components.loader')
<div class="header">
    <h2>Daftar 10 Besar Penyakit Rawat Inap</h2>
</div>
<div class="body">
    <script src="../../plugins/chartjs/Chart.bundle.js"></script>
    <script src="{{asset('js/pages/charts/chartjs.js')}}"></script>
{!! $chartjs->render() !!}
</div>
@endsection
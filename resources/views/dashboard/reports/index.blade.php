@extends('layouts.container')

@section('header','Laporan Data Pasien Rawat Inap')
@section('content')
@include('components.loader')
<div class="body table-responsive" style="min-height:500px">
    <div class="row-clearfix"></div>
    <div class="col-xs-6 margin-0">
        <h2 class="card-inside-title">Jangka Waktu</h2>
        <div class="input-daterange input-group" id="bs_datepicker_range_container">
            <div class="form-line">
                <input type="text" class="form-control" placeholder="Date start..." name="start">
            </div>
            <span class="input-group-addon">to</span>
            <div class="form-line">
                <input type="text" class="form-control" placeholder="Date end..." name="end">
            </div>
        </div>
    </div>
    <div class="col-xs-3">
        <h2 class="card-inside-title">Ruang Perawatan</h2>
        <div class="btn-group bootstrap-select form-control show-tick">
            <select name="kamar_id" class="form-control show-tick" data-live-search="true">
                <option disabled selected>Ruang Perawatan</option>
                @forelse($kamar as $ruang)
                <option value="{{$ruang->kamar_id}}">{{$ruang->ruang_perawatan}}</option>
                @empty
                @endforelse
            </select>
        </div>
    </div>
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>No RM</th>
                <th>Nama Pasien</th>
                <th>Jenis Kelamin</th>
                <th>Usia</th>
                <th>Diagnosa</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Keluar</th>
                <th>Lama Rawat</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>

        </tbody>
    </table>
    <div class="pull-right m-t-35 m-r-10">
        <a href="" class="btn btn-wave btn-success m-r-10">Print</a>
        <a href="" class="btn btn-wave btn-primary">Save</a>
    </div>

</div>
@endsection

@push('scripts')
<script>
    //Bootstrap datepicker plugin
    $('.input-daterange').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        container: '#bs_datepicker_range_container'
    });
</script>
@endpush
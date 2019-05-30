@extends('layouts.container')

@section('header','Laporan Data Pasien Rawat Inap')
@section('content')
@include('components.loader')
<div class="body table-responsive" style="min-height:500px">
    <div class="row-clearfix"></div>
    <form action="{{url('dashboard/reports/filter')}}" method="post">
    @csrf
        <div class="col-xs-6 margin-0">
            <h2 class="card-inside-title">Jangka Waktu</h2>
            <div class="input-daterange input-group" id="bs_datepicker_range_container">
                <div class="form-line">
                    <input type="text" class="form-control" placeholder="Date start..." name="start" value="{{old('start')}}">
                </div>
                <span class="input-group-addon">to</span>
                <div class="form-line">
                    <input type="text" class="form-control" placeholder="Date end..." name="end" value="{{old('end')}}">
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <h2 class="card-inside-title">Ruang Perawatan</h2>
            <div class="btn-group bootstrap-select form-control show-tick">
                <select name="kamar_id" class="form-control show-tick" data-live-search="true">
                    <option disabled>Ruang Perawatan</option>
                    @forelse($kamar as $ruang)
                    <option value="{{$ruang->kamar_id}}">{{$ruang->ruang_perawatan}}</option>
                    @empty
                    @endforelse
                </select>
            </div>
        </div>
        <input type="submit" value="Cari" class="btn btn-primary m-t-35 m-l-35">
    </form>
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
                <th>Ruang Perawatan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $rawatInap)
            <tr>
                <th>{{$rawatInap->no_rm}}</th>
                <th>{{$rawatInap->nama_pasien}}</th>
                <th>{{$rawatInap->jenis_kelamin}}</th>
                <th>{{$rawatInap->usia}}</th>
                <th>{{$rawatInap->diagnosa_utama}}</th>
                <th>{{$rawatInap->tanggal_masuk}}</th>
                <th>{{$rawatInap->tanggal_keluar}}</th>
                <th>{{$rawatInap->lama_hari_rawat}}</th>
                <th>{{$rawatInap->kamar->ruang_perawatan}}</th>
                <th>{{($rawatInap->status==0)?"Masih di rawat":"Rawat Inap sudah selesai"}}</th>
            </tr>
            @empty
            <tr>
                <td>Data laporan masih kosong</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="pull-right m-t-35 m-r-10">
        <a href="{{url('dashboard/reports/stream')}}" class="btn btn-wave btn-success m-r-10">Print</a>
        <a href="{{url('dashboard/reports/download')}}" class="btn btn-wave btn-primary">Save</a>
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
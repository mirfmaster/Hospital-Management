@extends('layouts.container')
@section('header','Form Input Rawat Inap')
@section('content')
<div class="row clearfix">
    <div class="col-sm-8">
        @if(isset($data))
            <form class="form-horizontal form-label-left" method="POST" action="{{route('dashboard.rawatinap.update',$data->no_rm)}}">
            @method('PUT')
        @else
            <form class="form-horizontal form-label-left" method="POST" action="{{route('dashboard.rawatinap.store')}}">
        @endif
        @csrf
            <div class="col-sm-6">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" value="{{isset($data) ? $data->nama_pasien:null}}" name="nama_pasien">
                        <label class="form-label">Nama Pasien</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" value="{{isset($data) ? $data->usia:null}}" name="usia">
                        <label class="form-label">Usia</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group form-float">
                    <div class="input-group date bs_datepicker_component_container" id="bs_datepicker_component_container" style="margin-bottom:0px;">
                        <div class="form-line">
                            <input type="text" class="form-control" placeholder="Tanggal Lahir" name="tanggal_lahir" value="{{isset($data) ? $data->tanggal_lahir:null}}">
                        </div>
                        <span class="input-group-addon">
                            <i class="material-icons">date_range</i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12" >
                <div class="form-group form-float">
                <h1 class="card-inside-title" style="font-size:14px;margin-bottom:3px">Jenis Kelamin</h1>
                    <div class="input-group" style="margin-bottom:0px;">
                        <input name="jenis_kelamin" type="radio" id="pria" class="with-gap radio-col-cyan" value="Pria" checked/>
                        <label for="pria">Pria</label>
                        <input name="jenis_kelamin" type="radio" id="wanita" class="with-gap radio-col-green" value="Wanita" {{($data->jenis_kelamin=='Wanita')?'checked':null}}/>
                        <label for="wanita">Wanita</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group form-float">
                    <div class="input-group date bs_datepicker_component_container" id="bs_datepicker_component_container" style="margin-bottom:0px;">
                        <div class="form-line">
                            <input type="text" class="form-control" placeholder="Tanggal Masuk" name="tanggal_masuk" value="{{isset($data) ? $data->tanggal_masuk:null}}">
                        </div>
                        <span class="input-group-addon">
                            <i class="material-icons">date_range</i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group form-float" style="margin-bottom:0px;">
                    <div class="input-group date bs_datepicker_component_container" id="bs_datepicker_component_container" style="margin-bottom:0px;">
                        <div class="form-line">
                            <input type="text" class="form-control" placeholder="Tanggal Keluar" name="tanggal_keluar" value="{{isset($data) ? $data->tanggal_keluar:null}}">
                        </div>
                        <span class="input-group-addon">
                            <i class="material-icons">date_range</i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="number" class="form-control" value="{{isset($data) ? $data->lama_hari_rawat:null}}" name="lama_hari_rawat">
                        <label class="form-label">Lama Hari Rawat</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="btn-group bootstrap-select form-control show-tick">
                   <div class="form-group form-float">
                        <select name="dokter_id" class="form-control show-tick" data-live-search="true">
                            <option disabled selected>Nama Dokter</option>
                            @forelse($dokter as $dataDokter)
                                @if($data->dokter_id==$dataDokter->dokter_id)
                                    <option value="{{$dataDokter->dokter_id}}" selected>{{$dataDokter->nama_dokter}}</option>
                                @endif
                                <option value="{{$dataDokter->dokter_id}}">{{$dataDokter->nama_dokter}}</option>
                            @empty
                            @endforelse
                        </select>
                   </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group form-float">
                    <div class="btn-group bootstrap-select form-control show-tick">
                        <select name="kamar_id" class="form-control show-tick" data-live-search="true">
                            <option disabled selected>Ruang Perawatan</option>
                            @forelse($kamar as $dataKamar)
                                @if($data->kamar_id==$dataKamar->kamar_id)
                                    <option value="{{$dataKamar->kamar_id}}" selected>{{$dataKamar->ruang_perawatan}}</option>
                                @endif
                                <option value="{{$dataKamar->kamar_id}}">{{$dataKamar->ruang_perawatan}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" value="{{isset($data) ? $data->diagnosa_utama:null}}" name="diagnosa_utama">
                        <label class="form-label">Diagnosa Utama</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" value="{{isset($data) ? $data->diagnosa_kedua:null}}" name="diagnosa_kedua">
                        <label class="form-label">Diagnosa Kedua</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" value="{{isset($data) ? $data->nama_operasi_1:null}}" name="nama_operasi_1">
                        <label class="form-label">Nama Operasi 1</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" value="{{isset($data) ? $data->nama_operasi_2:null}}" name="nama_operasi_2">
                        <label class="form-label">Nama Operasi 2</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group form-float">
                    <div class="input-group date bs_datepicker_component_container" id="bs_datepicker_component_container" style="margin-bottom:0px;">
                        <div class="form-line">
                            <input type="text" class="form-control" placeholder="Tanggal Operasi" name="tanggal_operasi" value="{{isset($data) ? $data->tanggal_operasi:null}}">
                        </div>
                        <span class="input-group-addon">
                            <i class="material-icons">date_range</i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12" >
                <div class="form-group form-float">
                <h1 class="card-inside-title" style="font-size:14px;">Status Keadaan Keluar</h1>
                    <div class="input-group">
                        <input name="status_keadaan_keluar" type="radio" id="Pulang Hidup" class="with-gap radio-col-cyan" value="Pulang Hidup" checked/>
                        <label for="Pulang Hidup">Pulang Hidup</label>
                        <input name="status_keadaan_keluar" type="radio" id="Meninggal" class="with-gap radio-col-green" value="Meninggal" {{($data->status_keadaan_keluar=='Meninggal')?'checked':null}}/>
                        <label for="Meninggal">Meninggal</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <input type="submit" value="Submit" class="btn bg-light-blue waves-effect">
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
//Bootstrap datepicker plugin
$('.bs_datepicker_component_container').datepicker({
    // format: 'yy/mm/dd',
    autoclose: true,
    container: '#bs_datepicker_component_container'
});
</script>
@endpush
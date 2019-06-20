@extends('layouts.container')
@section('header','Form Input Kamar')
@section('content')
<h4>Form Input Kamar</h4>
<div class="row clearfix">
    <div class="col-sm-8">
        @if(isset($data))
            <form class="form-horizontal form-label-left" method="POST" action="{{route('dashboard.kamar.update',$data->kamar_id)}}">
            @method('PUT')
        @else
            <form class="form-horizontal form-label-left" method="POST" action="{{route('dashboard.kamar.store')}}">
        @endif
        @csrf
            <div class="col-sm-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" value="{{isset($data) ? $data->ruang_perawatan:null}}" name="ruang_perawatan">
                        <label class="form-label">Ruang Perawatan</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="kelas" value="{{isset($data) ? $data->kelas:null}}">
                        <label class="form-label">Kelas</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="nomor_kamar" value="{{isset($data) ? $data->nomor_kamar:null}}">
                        <label class="form-label">Nomor Kamar</label>
                    </div>
                </div>
            </div>
            <input type="submit" value="Submit" class="btn bg-light-blue waves-effect">
        </form>
    </div>
</div>
@endsection
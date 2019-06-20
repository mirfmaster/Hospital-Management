@extends('layouts.container')
@section('header','Form Input Diagnosa')
@section('content')
<h4>Form Input Kamar</h4>
<div class="row clearfix">
    <div class="col-sm-8">
        @if(isset($data))
            <form class="form-horizontal form-label-left" method="POST" action="{{route('dashboard.diagnosa.update',$data->id)}}">
            @method('PUT')
        @else
            <form class="form-horizontal form-label-left" method="POST" action="{{route('dashboard.diagnosa.store')}}">
        @endif
        @csrf
            <div class="col-sm-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" value="{{isset($data) ? $data->kode_diagnosa:null}}" name="kode_diagnosa">
                        <label class="form-label">Kode Diagnos  a</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="diagnosa" value="{{isset($data) ? $data->diagnosa:null}}">
                        <label class="form-label">Diagnosa</label>
                    </div>
                </div>
            </div>
            <input type="submit" value="Submit" class="btn bg-light-blue waves-effect">
        </form>
    </div>
</div>
@endsection
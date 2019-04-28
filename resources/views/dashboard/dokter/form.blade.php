@extends('layouts.container')
@section('header','Form Input Dokter')
@section('content')
<div class="row clearfix">
    <div class="col-sm-8">
        @if(isset($data))
            <form class="form-horizontal form-label-left" method="POST" action="{{route('dashboard.dokter.update',$data->dokter_id)}}">
            @method('PUT')
        @else
            <form class="form-horizontal form-label-left" method="POST" action="{{route('dashboard.dokter.store')}}">
        @endif
        @csrf
            <div class="col-sm-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" value="{{isset($data) ? $data->nama_dokter:null}}" name="nama_dokter">
                        <label class="form-label">Nama Dokter</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        <textarea rows="4" class="form-control no-resize" placeholder="Alamat" name="alamat">{{isset($data) ? $data->alamat:null}}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control mobile-phone-number" placeholder="Ex: (000) 000-000-000" value="{{isset($data) ? $data->nomor_telepon:null}}" name="nomor_telepon">
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="spesialisasi" value="{{isset($data) ? $data->spesialisasi:null}}">
                        <label class="form-label">Spesialisasi</label>
                    </div>
                </div>
            </div>
            <input type="submit" value="Submit" class="btn bg-light-blue waves-effect">
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
    <script>
        $(document).ready(function(){
            $(".mobile-phone-number").inputmask({"mask": "(999) 999-999-999"}); //specifying options
        });
    </script>
@endpush
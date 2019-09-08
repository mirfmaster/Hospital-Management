@extends('layouts.skeleton')

@section('container')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    @yield('header', 'Default header')
                </h2>
            </div>
            <div class="body">
                @include('components.alerts')
                @yield('content')
            </div>
        </div>
    </div>
</div>
@endsection
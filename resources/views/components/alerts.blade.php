@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong>{{ $message }}</strong>
</div>
@endif


@if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>{{ $error }}</strong>
    </div>
    @endforeach
@endif
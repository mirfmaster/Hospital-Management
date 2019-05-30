@extends('layouts.container')

@section('header','Rawat Inap Page')
@section('title', 'Hospital Management | Rawat Inap')
@section('content')
@include('components.loader')
<div class="table-responsive">
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" role="grid" aria-describedby="DataTables_Table_0_info" id="kamar-table">
                    <thead>
                        <tr role="row">
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Masuk</th>
                            <th>Ruang Perawatan</th>
                            <th>Nama Dokter</th>
                            <th width="70">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $rw)
                            <tr valign="middle">
                                <td></td>
                                <td>{{$rw->nama_pasien}}</td>
                                <td>{{$rw->tanggal_masuk}}</td>
                                <td>{{$rw->kamar->ruang_perawatan}}</td>
                                <td>{{$rw->dokter->nama_dokter}}</td>
                                <td>
                                    @if($rw->status!=1)
                                        <a href="{{route('dashboard.rawatinap.edit',$rw->no_rm)}}" title="Edit Data" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" style="float:left"><i class="material-icons" style="margin-top:3px;">edit</i></a>
                                        <a href="{{route('dashboard.rawatinap.selesai',$rw->no_rm)}}" title="Selesai" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" style="float:left"><i class="material-icons" style="margin-top:3px;">done</i></a>
                                    @else
                                        <a class="btn btn-info">Sudah selesai :)</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">We do not found any data yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <a href="{{route('dashboard.rawatinap.create')}}" class="btn bg-light-blue waves-effect" style="margin:5px 0;">Tambahkan data</a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
$(function() {
    var t = $('#kamar-table').DataTable({
        retrieve: true,
        dom: '<"col-md-6"l><"col-md-6"f><"col-md-12"rt><"col-md-6"i><"col-md-6"p>',
        responsive: true,
        columnDefs: [{
            searchable: false,
            orderable: false,
            targets: 0
        }]
    });
    t.on('order.dt search.dt', function() {
        t.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
})
</script>
@endpush
@extends('layouts.container')

@section('header','Kamar Page')
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
                            <th>ID</th>
                            <th>Ruang Perawatan</th>
                            <th>Kelas</th>
                            <th>Nomor Kamar</th>
                            <th width="70">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $kamar)
                            <tr valign="middle">
                                <td></td>
                                <td>{{$kamar->kamar_id}}</td>
                                <td>{{$kamar->ruang_perawatan}}</td>
                                <td>{{$kamar->kelas}}</td>
                                <td>{{$kamar->nomor_kamar}}</td>
                                <td>
                                    <a href="{{route('dashboard.kamar.edit',$kamar->kamar_id)}}" title="Edit Data" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" style="float:left"><i class="material-icons" style="margin-top:3px;">edit</i></a>
                                    <form action="{{route('dashboard.kamar.destroy',$kamar->kamar_id)}}" method="post" style="float:left;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn bg-red btn-circle waves-effect waves-circle waves-float" title="Delete data">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </form> 
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">We do not found any data yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <a href="{{route('dashboard.kamar.create')}}" class="btn bg-light-blue waves-effect" style="margin:5px 0;">Tambahkan Kamar</a>
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
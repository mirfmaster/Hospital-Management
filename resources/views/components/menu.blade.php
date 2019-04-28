<!-- Menu -->
<div class="menu">
    <ul class="list">
        <li class="header">MAIN NAVIGATION</li>
        <li>
            <a href="{{route('dashboard.index')}}">
                <i class="material-icons">home</i>
                <span>Home</span>
            </a>
        </li>
        <li>
            <a href="{{url('dashboard/kamar/')}}">
                <i class="material-icons">dashboard</i>
                <span>Master Kamar</span>
            </a>
        </li>
        <li>
            <a href="{{url('dashboard/dokter/')}}">
                <i class="material-icons">face</i>
                <span>Master Dokter</span>
            </a>
        </li>
        <li>
            <a href="{{url('dashboard/rawatinap/')}}">
                <i class="material-icons">local_hospital</i>
                <span>Data Rawat Inap</span>
            </a>
        </li>
        <li>
            <a href="{{url('dashboard/reports/')}}">
                <i class="material-icons">assessment</i>
                <span>Laporan</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                <i class="material-icons">view_list</i>
                <span>Tables</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="pages/tables/normal-tables.html" class=" waves-effect waves-block">Normal Tables</a>
                </li>
                <li>
                    <a href="pages/tables/jquery-datatable.html" class=" waves-effect waves-block">Jquery Datatables</a>
                </li>
                <li>
                    <a href="pages/tables/editable-table.html" class=" waves-effect waves-block">Editable Tables</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<!-- #Menu -->
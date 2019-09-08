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
            <a href="{{url('dashboard/diagnosa/')}}">
                <i class="material-icons">note_add</i>
                <span>Master Diagnosa</span>
            </a>
        </li>
        <li>
            <a href="{{url('dashboard/rawatinap/')}}">
                <i class="material-icons">tab</i>
                <span>Data Rawat Inap</span>
            </a>
        </li>
        <li>
            <a href="{{url('dashboard/rawatinap/create')}}">
                <i class="material-icons">move_to_inbox</i>
                <span>Register Rawat Inap</span>
            </a>
        </li>
        <li>
            <a href="{{url('dashboard/reports/')}}">
                <i class="material-icons">assessment</i>
                <span>Laporan</span>
            </a>
        </li>
    </ul>
</div>
<!-- #Menu -->
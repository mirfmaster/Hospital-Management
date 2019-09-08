<!DOCTYPE html>
<html lang="en">

<head>
    <title>TALENT Reports</title>
    <style>
        body {
            font-family: sans-serif;
            font-weight: normal;
        }

        table {
            font-size: 12px;
            width: 100%;
            vertical-align: top;
        }

        .table tr td,
        .table tr th {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th style="width:20%;padding: 0px;"> <img src="{{ public_path('images/logo.png') }}"
                        style="height:13%;width: 12%; margin:0 0 0 3%"> </th>
                <th>
                    <br>
                    HOSPITAL MANAGEMENT <br>
                    Intergrated Hospital Management Based On Website <br> <br>
                </th>
            </tr>
        </thead>
    </table>
    <div style="border: 2px solid transparent; background: black; margin-top: 5px; margin-bottom: 20px;"></div>

    <table class="table" cellspacing="0">
        <tr>
            <th>No RM</th>
            <th>Nama Pasien</th>
            <th>Jenis Kelamin</th>
            <th>Usia</th>
            <th>Diagnosa</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
            <th>Lama Rawat</th>
            <th>Ruang Perawatan</th>
            <th>Status</th>
        </tr>
        <tr>
            @forelse($dataReports as $data)
        <tr>
            <th>{{$data->no_rm}}</th>
            <th>{{$data->nama_pasien}}</th>
            <th>{{$data->jenis_kelamin}}</th>
            <th>{{$data->usia}}</th>
            <th>{{$data->diagnosa_utama}}</th>
            <th>{{$data->tanggal_masuk}}</th>
            <th>{{$data->tanggal_keluar}}</th>
            <th>{{$data->lama_hari_rawat}}</th>
            <th>{{$data->kamar->ruang_perawatan}}</th>
            <th>{{($data->status==0)?"Masih di rawat":"Rawat Inap sudah selesai"}}</th>
        </tr>
        @empty
        <tr>
            <td>Data laporan masih kosong</td>
        </tr>
        @endforelse
        </tr>
    </table>
</body>

</html>
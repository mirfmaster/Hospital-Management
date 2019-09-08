<?php

namespace App\Http\Controllers;

use App\Model\RawatInap;
use Illuminate\Http\Request;
use App\Model\Kamar;
use App\Model\Dokter;
use App\Model\Diagnose;
use Illuminate\Support\Carbon;

class RawatInapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RawatInap::with('dokter')->with('kamar')->where('selesai', 0)->get();

        foreach ($data as $object) {
            $object->status = "Belum Selesai";
            if ($object->selesai == 0) {
                $object->status = "Selesai";
            }
        }

        return view('dashboard.rawatinap.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kamar = Kamar::all(['kamar_id', 'ruang_perawatan']);
        $dokter = Dokter::all(['dokter_id', 'nama_dokter']);
        $diagnosa = Diagnose::all(['id', 'kode_diagnosa', 'diagnosa']);
        return view('dashboard.rawatinap.form', compact('kamar', 'dokter', 'diagnosa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tanggal['tanggal_masuk'] = Carbon::parse(strtotime($request->all()['tanggal_masuk']));
        $tanggal['tanggal_keluar'] = Carbon::parse(strtotime($request->all()['tanggal_keluar']));
        $tanggal['tanggal_operasi'] = Carbon::parse(strtotime($request->all()['tanggal_operasi']));
        $request->merge($tanggal);

        $request->validate([
            'nama_pasien'           => "required|max:50",
            'dokter_id'             => "required",
            'kamar_id'              => "required",
            'usia'                  => "required|max:3",
            'jenis_kelamin'         => "required",
            'tanggal_masuk'         => "required",
            'tanggal_keluar'        => "sometimes|date",
            'diagnosa_utama'        => "required|max:50",
            'diagnosa_kedua'        => "max:50",
            'nama_operasi_1'        => "max:50",
            'nama_operasi_2'        => "max:50",
            'status_keadaan_keluar' => "required"
        ]);

        RawatInap::create($request->all());
        return redirect()->route('dashboard.rawatinap.index')->with('success', 'Your request succesfully executed.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\RawatInap  $rawatInap
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rawatInap = RawatInap::where('created_at', $request->created_at)->delete();
        if ($rawatInap) {
            return redirect()->route('dashboard.rawatinap.index')->with('warning', 'Your request successfully   executed');
        }
        echo "fail";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\RawatInap  $rawatInap
     * @return \Illuminate\Http\Response
     */
    public function edit($no_rm, RawatInap $rawatInap)
    {
        $kamar = Kamar::all(['kamar_id', 'ruang_perawatan']);
        $dokter = Dokter::all(['dokter_id', 'nama_dokter']);
        $data = $rawatInap->findOrFail($no_rm);
        $diagnosa = Diagnose::all(['id', 'kode_diagnosa', 'diagnosa']);

        return view('dashboard.rawatinap.form', compact('data', 'dokter', 'kamar', 'diagnosa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\RawatInap  $rawatInap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $no_rm)
    {
        $validate = $request->validate([
            'nama_pasien'           => "required|max:50",
            'dokter_id'             => "required",
            'kamar_id'              => "required",
            'usia'                  => "required|max:3",
            'jenis_kelamin'         => "required",
            'tanggal_masuk'         => "required",
            'tanggal_keluar'        => "sometimes|date",
            'diagnosa_utama'        => "required|max:50",
            'diagnosa_kedua'        => "max:50",
            'nama_operasi_1'        => "max:50",
            'nama_operasi_2'        => "max:50",
            'status_keadaan_keluar' => "required"
        ]);
        $data = RawatInap::findOrFail($no_rm)->first();
        $tanggal['tanggal_masuk'] = Carbon::parse($request->all()['tanggal_masuk']);
        $tanggal['tanggal_keluar'] = Carbon::parse($request->all()['tanggal_keluar']);
        $tanggal['tanggal_operasi'] = Carbon::parse($request->all()['tanggal_operasi']);
        $request->merge($tanggal);
        $update = $data->update($request->except('_method', '_token'));
        if ($update) {
            return redirect()->route('dashboard.rawatinap.index')->with('success', 'Your request succesfully executed.');
        }
    }

    public function selesai($no_rm)
    {
        $data = RawatInap::findOrFail($no_rm);
        $data->selesai = 1;
        if ($data->save()) {
            return redirect()->route('dashboard.rawatinap.index')->with('info', 'Rawat Inap sudah selesai, jangan lupa ucapkan terima kasih!');
        }
    }

    public function charts()
    {
        $grouping = RawatInap::all()->groupBy('diagnosa_utama');
        $labels = [];
        foreach ($grouping as $k => $v) {
            $labels[] = $k;
        }
        $jumlah = RawatInap::selectRaw('count(*) as jumlah')->groupBy('diagnosa_utama')->get();
        $counts = [];
        foreach ($jumlah as $key => $value) {
            $counts = $value->jumlah;
        }

        $datasets[] = [
            "label" => $labels,
            'backgroundColor' => ['rgba(54, 162, 235)', 'rgba(200, 162, 235)', 'rgba(200, 162, 235)'],
            'data' => $counts
        ];
        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets($datasets)
            ->optionsRaw("{
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }");
        return view('index', compact('chartjs'));
    }
}

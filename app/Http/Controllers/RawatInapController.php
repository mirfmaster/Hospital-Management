<?php

namespace App\Http\Controllers;

use App\Model\RawatInap;
use Illuminate\Http\Request;
use App\Model\Kamar;
use App\Model\Dokter;
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
        $data=RawatInap::with('dokter')->with('kamar')->get();
        // dd($data);
        return view('dashboard.rawatinap.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kamar=Kamar::all(['kamar_id','ruang_perawatan']);
        $dokter=Dokter::all(['dokter_id','nama_dokter']);
        // dd($kamar,$dokter);
        return view('dashboard.rawatinap.form',compact('kamar','dokter'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tanggal['tanggal_lahir']=Carbon::parse(strtotime($request->all()['tanggal_lahir']));
        $tanggal['tanggal_masuk']=Carbon::parse(strtotime($request->all()['tanggal_masuk']));
        $tanggal['tanggal_keluar']=Carbon::parse(strtotime($request->all()['tanggal_keluar']));
        $tanggal['tanggal_operasi']=Carbon::parse(strtotime($request->all()['tanggal_lahir']));
        $request->merge($tanggal);

        $request->validate([
            'nama_pasien'           => "required|max:50",
            'dokter_id'             => "required",
            'kamar_id'              => "required",
            'usia'                  => "required|max:3",
            'tanggal_lahir'         => "required|date",
            'jenis_kelamin'         => "required",
            'tanggal_masuk'         => "required",
            'tanggal_keluar'        => "sometimes|date",
            'lama_hari_rawat'       => "sometimes|max:3",
            'diagnosa_utama'        => "required|max:50",
            'diagnosa_kedua'        => "max:50",
            'nama_operasi_1'        => "required|max:25",
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
    public function show(RawatInap $rawatInap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\RawatInap  $rawatInap
     * @return \Illuminate\Http\Response
     */
    public function edit($no_rm,RawatInap $rawatInap)
    {
        $kamar = Kamar::all(['kamar_id', 'ruang_perawatan']);
        $dokter = Dokter::all(['dokter_id','nama_dokter']);
        $data=$rawatInap->find($no_rm)->first();
        return view('dashboard.rawatinap.form',compact('data','dokter','kamar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\RawatInap  $rawatInap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$no_rm)
    {
        $validate=$request->validate([
            'nama_pasien'           => "required|max:50",
            'dokter_id'             => "required",
            'kamar_id'              => "required",
            'usia'                  => "required|max:3",
            'tanggal_lahir'         => "required|date",
            'jenis_kelamin'         => "required",
            'tanggal_masuk'         => "required",
            'tanggal_keluar'        => "sometimes|date",
            'lama_hari_rawat'       => "sometimes|max:3",
            'diagnosa_utama'        => "required|max:50",
            'diagnosa_kedua'        => "max:50",
            'nama_operasi_1'        => "required|max:25",
            'nama_operasi_2'        => "max:50",
            'status_keadaan_keluar' => "required"
        ]);
        $data=RawatInap::find($no_rm)->first();
        $tanggal['tanggal_lahir']=Carbon::parse($request->all()['tanggal_lahir']);
        $tanggal['tanggal_masuk']=Carbon::parse($request->all()['tanggal_masuk']);
        $tanggal['tanggal_keluar']=Carbon::parse($request->all()['tanggal_keluar']);
        $tanggal['tanggal_operasi']=Carbon::parse($request->all()['tanggal_lahir']);
        $request->merge($tanggal);
        $update=$data->update($request->except('_method','_token'));
        // dd($request->all(),$update);
        if($update){
            return redirect()->route('dashboard.rawatinap.index')->with('success', 'Your request succesfully executed.');
        }
    }

    public function selesai($no_rm)
    {
        $data=RawatInap::find($no_rm)->first();
        $data->status=1;
        if($data->save()){
            return redirect()->route('dashboard.rawatinap.index')->with('info', 'Rawat Inap sudah selesai, jangan lupa ucapkan terima kasih!');
        }
    }
}

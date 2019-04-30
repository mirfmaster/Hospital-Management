<?php

namespace App\Http\Controllers;

use App\Model\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Dokter::all();
        return view('dashboard.dokter.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.dokter.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nomortelepon['nomor_telepon']=str_replace(['(',')','-'],"",$request->nomor_telepon);
        $request->merge($nomortelepon);
        $request->validate([
            'nama_dokter' => "required|max:25",
            'alamat' => 'required|max:255',
            'nomor_telepon' => 'required|min:10',
            'spesialisasi' => 'required|max:25',
        ]);
        Dokter::create($request->all());
        return redirect()->route('dashboard.dokter.index')->with('success', 'Your request succesfully executed.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function show(Dokter $dokter)
    {
        $data=$dokter;
        return view('dashboard.dokter.form',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokter $dokter)
    {
        $data=$dokter;
        return view('dashboard.dokter.form',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'nama_dokter' => "required|max:25",
            'alamat' => 'required|max:255',
            'nomor_telepon' => 'required|min:10',
            'spesialisasi' => 'required|max:25',
        ]);
        $dokter->update($request->all());
        return redirect()->route('dashboard.dokter.index')->with('success', 'Your request succesfully executed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return redirect()->route('dashboard.dokter.index')->with('warning', 'Your request successfully executed');
    }
}

<?php

namespace App\Http\Controllers;

use App\Model\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Kamar::all();
        return view('dashboard.kamar.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.kamar.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ruang_perawatan' => "required|max:25",
            'kelas' => 'required|max:25',
            'nomor_kamar' => 'required|max:10',
        ]);
        Kamar::create($request->all());
        return redirect()->route('dashboard.kamar.index')->with('success', 'Your request succesfully executed.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function edit(Kamar $kamar)
    {
        $data=$kamar;
        return view('dashboard.kamar.form',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kamar $kamar)
    {
        $request->validate([
            'ruang_perawatan' => "required|max:25",
            'kelas' => 'required|max:25',
            'nomor_kamar' => 'required|max:10',
        ]);
        $kamar->update($request->all());
        return redirect()->route('dashboard.kamar.index')->with('success', 'Your request succesfully executed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kamar $kamar)
    {
        $kamar->delete();
        return redirect()->route('dashboard.kamar.index')->with('warning', 'Your request successfully executed');
    }
}

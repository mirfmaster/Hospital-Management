<?php

namespace App\Http\Controllers;

use App\Model\Diagnose;
use Illuminate\Http\Request;

class DiagnoseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Diagnose::all();
        return view('dashboard.diagnosa.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.diagnosa.form');
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
            'kode_diagnosa' => "required|max:15",
            'diagnosa' => 'required|max:50',
        ]);
        Diagnose::create($request->all());
        return redirect()->route('dashboard.diagnosa.index')->with('success', 'Your request succesfully executed.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function edit(Kamar $diagnose)
    {
        $data=$diagnose;
        return view('dashboard.diagnosa.form',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Kamar  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kamar $diagnose)
    {
        $request->validate([
            'kode_diagnosa' => "required|max:15",
            'diagnosa' => 'required|max:50',
        ]);
        $diagnose->update($request->all());
        return redirect()->route('dashboard.diagnosa.index')->with('success', 'Your request succesfully executed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Kamar  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kamar $diagnose)
    {
        $diagnose->delete();
        return redirect()->route('dashboard.diagnosa.index')->with('warning', 'Your request successfully executed');
    }
}

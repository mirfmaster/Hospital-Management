<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Kamar;
use App\Model\RawatInap;
use Illuminate\Support\Carbon;

use PDF;

class ReportController extends Controller
{
    public function index()
    {
        $kamar=Kamar::all();
        $data=RawatInap::with('dokter')->with('kamar')->orderBy('tanggal_masuk','desc')->get();
        session()->flash('dataReports', $data);
        // dd($data);
        return view('dashboard.reports.index',compact('kamar','data'));
    }

    public function filter(Request $request)
    {
        $kamar=Kamar::all();
        $tanggal['start']=Carbon::parse(strtotime($request->all()['start']));
        $tanggal['end']=Carbon::parse(strtotime($request->all()['end']));
        $request->merge($tanggal);
        $request->validate([
            'start' => 'required|date',
            'end' => 'required|date',
            'kamar_id' => 'required'
        ]);
        $start=$tanggal['start']->format('Y-m-d');
        $end=$tanggal['end']->format('Y-m-d');
        $data=RawatInap::with('dokter')->with('kamar')
        ->whereBetween('tanggal_masuk',[$start, $end])
        // ->where('tanggal_masuk','>=',$request->start)
        // ->where('tanggal_keluar','<=',$request->end)
        ->where('kamar_id',$request->kamar_id)
        ->orderBy('tanggal_masuk','desc')
        ->get();
        session()->flash('dataReports', $data);

        return view('dashboard.reports.index',compact('kamar','data'));
    }

    public function stream()
    {
        $dataReports=session()->get('dataReports');
        session()->reflash();
        // dd($dataReports);
        $pdf = PDF::loadView('dashboard.reports.pdf', compact('dataReports'));
        return $pdf->stream('TALENT Reports.pdf');
    }

    public function download()
    {
        $dataReports=session()->get('dataReports');
        session()->reflash();
        // dd($dataReports);
        $pdf = PDF::loadView('dashboard.reports.pdf', compact('dataReports'));
        return $pdf->download('TALENT Reports.pdf');
    }
}

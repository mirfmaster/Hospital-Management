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
        $kamar = Kamar::all();
        $data = RawatInap::with('dokter')->with('kamar')->with('diagnosa')
            ->where('selesai', 1)
            ->orderBy('tanggal_masuk', 'desc')->get();
        session()->flash('dataReports', $data);
        // dd($data);
        foreach ($data as $rm) {
            $rm->lama_hari_rawat = Carbon::parse($rm->tanggal_keluar)->diffInDays($rm->tanggal_masuk) + 1 . ' Hari';
        }

        return view('dashboard.reports.index', compact('kamar', 'data'));
    }

    public function filter(Request $request)
    {
        $kamar = Kamar::all();
        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));
        $data = RawatInap::with('dokter')->with('kamar')->with('diagnosa')
            ->where('selesai', 1)
            ->whereBetween('tanggal_masuk', [$start, $end])
            // ->where('tanggal_masuk','>=',$request->start)
            // ->where('tanggal_keluar','<=',$request->end)
            ->where('kamar_id', $request->kamar_id)
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        foreach ($data as $rm) {
            $rm->lama_hari_rawat = Carbon::parse($rm->tanggal_keluar)->diffInDays($rm->tanggal_masuk) + 1 . ' Hari';
        }
        session()->flash('dataReports', $data);

        return view('dashboard.reports.index', compact('kamar', 'data'));
    }

    public function stream()
    {
        $dataReports = session()->get('dataReports');
        session()->reflash();
        $pdf = PDF::loadView('dashboard.reports.pdf', compact('dataReports'));
        return $pdf->stream('TALENT Reports.pdf');
    }

    public function download()
    {
        $dataReports = session()->get('dataReports');
        session()->reflash();
        $pdf = PDF::loadView('dashboard.reports.pdf', compact('dataReports'));
        return $pdf->download('TALENT Reports.pdf');
    }
}

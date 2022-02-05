<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\model\obat;
use App\model\signa;
use App\model\transaksi;
use App\model\racikanObat;
use Auth;
use Redirect;
use PDF;

class ReportController extends Controller
{
     public function generatePDF($kode){
        $transaksi     = transaksi::where('kode_transaksi',$kode)->get();

    	$pdf = PDF::loadview('report',['kode'=>$kode,'transaksi' => $transaksi]);
        return $pdf->download('laporan-pdf.pdf');
    }

    public function report($kode){
        $tr     = transaksi::where('kode_transaksi',$kode)->get();
        $racik  = racikanObat::all();
        return view('CetakOrder')->with([
            'transaksi' => $tr,
            'kode'      => $kode,
            'racik1'    => $racik,
            'racik'     => $racik
        ]);
    }
}

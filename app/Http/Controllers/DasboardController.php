<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\transaksi;
use App\model\obat;

class DasboardController extends Controller
{
    public function dasboard(){
        $kode       = transaksi::max('kode_transaksi')+1;
        $jumlah     = transaksi::max('kode_transaksi');
        $jumlahObat = obat::count();
        $kosong     = obat::where('stok','0')->get();
        $obat       = obat::orderBy('jumlah_terjual','desc')->where('jumlah_terjual','!=','0')->LIMIT(6)->get();
        return view('dasboard')->with([
            'kode'       => $kode,
            'jumlahObat' => $jumlahObat,
            'kosong'     => $kosong,
            'jumlah'     => $jumlah,
            'obat'       => $obat
        ]);
    }
}

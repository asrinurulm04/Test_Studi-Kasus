<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\model\obat;
use App\model\signa;
use App\model\transaksi;
use App\model\racikanObat;
use Auth;
use Redirect;

class PesanController extends Controller
{
    public function index($kode){
        $obat       = obat::all();
        $obat1      = obat::where('stok','!=','0')->get();
        $signa      = signa::all();
        $transaksi  = transaksi::where('kode_transaksi',$kode)->where('status','draf')->get();
        $racik      = racikanObat::all();
        return view('pesan')->with([
            'obat'      => $obat,
            'obat1'     => $obat1,
            'transaksi' => $transaksi,
            'kode'      => $kode,
            'racik'     => $racik,
            'racik1'    => $racik,
            'racik2'    => $racik,
            'signa'     => $signa
        ]);
    }
    
    public function stok($id){ // mangambil data subbrand
        $stok = obat::where('obatalkes_id',$id)->pluck('stok','obatalkes_id');
        return json_encode($stok);
    }

    public function addObat(Request $request){
        if($request->type=='original'){
            $add = new transaksi;
            $add->id_obat        = $request->pilih_obat;
            $add->id_signa       = $request->signa;
            $add->id_user        = Auth::user()->id;
            $add->kode_transaksi = $request->kode;
            $add->type           = $request->type;
            $add->jumlah_order   = $request->jumlah_obat;
            $add->tgl_order      = $request->date;
            $add->save();
        }elseif($request->type=='racik'){
            $add = new transaksi;
            $add->id_signa       = $request->signa;
            $add->id_user        = Auth::user()->id;
            $add->kode_transaksi = $request->kode;
            $add->type           = $request->type;
            $add->tgl_order      = $request->date;
            $add->jumlah_order   = $request->jumlah_obat;
            $add->nama_racikan   = $request->nama;
            $add->save();

            $data      = array(); 
            $validator = Validator::make($request->all(), $data);  
            if ($validator->passes()) {
				$idz = implode(',', $request->input('pilih_obat'));
				$ids = explode(',', $idz);
				for ($i = 0; $i < count($ids); $i++){
					$racik = new racikanObat;
                    $racik->id_transaksi = $add->id_transaksi;
                    $racik->nama_racikan = $request->nama;
                    $racik->id_obat      = $ids[$i];
                    $racik->jumlah_order = $request->jumlah_obat;
					$racik->save();
					$i = $i++;
				}
			}
        }

        return redirect::back()->with('status', 'Obat berhasil Di tambahkan!');
    }

    public function destroy($id){
        $del   = transaksi::where('id_transaksi',$id)->delete();
        $racik = racikanObat::where('id_transaksi',$id)->count();
        if($racik!=0){
            $racik = racikanObat::where('id_transaksi',$id)->delete();
        }
        
        return redirect::back()->with('status', 'Obat berhasil Di hapus!');
    }

    public function batalkanOrder($kode){
        $del = transaksi::where('kode_transaksi',$kode)->where('status','!=','selesai')->delete();
        
        return redirect::route('dasboard')->with('status', 'Transaksi Dibatalkan!');
    }

    public function selesaikanOrder($kode){
        $transaksi = transaksi::where('kode_transaksi',$kode)->get();
        foreach($transaksi as $transaksi){
            $hitung = obat::where('obatalkes_id',$transaksi->id_obat)->first();
            $obat   = obat::where('obatalkes_id',$hitung['obatalkes_id'])->update([
                'stok'           => $hitung['stok'] - $transaksi->jumlah_order,
                'jumlah_terjual' => $hitung['jumlah_terjual'] + $transaksi->jumlah_order,
            ]);

            $racik = racikanObat::where('id_transaksi',$transaksi->id_transaksi)->get();
            foreach($racik as $racik){
                $hitung1 = obat::where('obatalkes_id',$racik->id_obat)->first();
                $obat1   = obat::where('obatalkes_id',$hitung1['obatalkes_id'])->update([
                    'stok'           => $hitung1['stok'] - $racik->jumlah_order,
                    'jumlah_terjual' => $hitung1['jumlah_terjual'] + $racik->jumlah_order,
                ]);
            }

            $tr     = transaksi::where('id_transaksi',$transaksi->id_transaksi)->update([
                'status' => 'selesai'
            ]);
        }

        return redirect::route('report',$kode)->with('status', 'Transaksi Telah Selesai!');
    }
}

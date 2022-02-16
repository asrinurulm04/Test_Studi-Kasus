<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\obat;
use Redirect;

class ObatController extends Controller
{
    public function index(){ 
        $obat = obat::all();
        return view('obat')->with([
            'obat' => $obat
        ]);
    }

    public function editStok(Request $request, $id){
        $obat = obat::where('obatalkes_id',$id)->update([
            'stok' => $request->stok
        ]);

        return redirect::back()->with('status', 'Stok Berhasil Diupdate!');
    }

    public function obatan(){
        $obat = obat::where('obatalkes_id','1')->get();
        echo $obat;
    }
}

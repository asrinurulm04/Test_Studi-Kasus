<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey ='id_transaksi';
    
    public function kodeObat()
    {
    	return $this->hasOne('App\model\obat','obatalkes_id','id_obat');
    }
    
    public function signa()
    {
    	return $this->hasOne('App\model\signa','signa_id','id_signa');
    }
}

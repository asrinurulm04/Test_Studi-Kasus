<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class racikanObat extends Model
{
    protected $table = 'racikan_obat';
    protected $primaryKey ='id_racikan ';
    
    public function kodeObat1()
    {
    	return $this->hasOne('App\model\obat','obatalkes_id','id_obat');
    }
}

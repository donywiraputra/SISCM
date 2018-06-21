<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksidagang extends Model
{
  protected $table = 'transaksidagang';

  protected $fillable = ['idbarang','jumlah','biaya', 'iduser', 'created_at', 'updated_at'];

  public function transaksiDagang()
  {
    return $this->belongsTo('App\Models\Datajenisbarang', 'id');
  }
}

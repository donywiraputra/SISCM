<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksidagang extends Model
{
  protected $table = 'transaksidagang';

  public function transaksiDagang()
  {
    return $this->belongsTo('App\Models\Datajenisbarang', 'id');
  }
}

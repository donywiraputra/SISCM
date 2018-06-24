<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaksidagang extends Model
{
  protected $table = 'transaksidagang';

  protected $fillable = ['idbarang','jumlah','biaya', 'iduser', 'created_at', 'updated_at'];

  public function transaksiDagang()
  {
    return $this->belongsTo('App\Models\Datajenisbarang', 'id');
  }

  public function getCreatedAtAttribute($value)
  {
    return Carbon::parse($value)->addHour(8)->format('d M Y h:i a');
  }
}

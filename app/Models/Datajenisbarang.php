<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Datajenisbarang extends Model
{
  protected $table = 'jenisbarang';

  public function dataBarang()
  {
    return $this->hasMany('App\Models\Transaksidagang', 'idbarang');
  }

  public function getUpdatedAtAttribute($value)
  {
    return Carbon::parse($value)->addHour(8)->format('d M Y h:i a');
  }
}

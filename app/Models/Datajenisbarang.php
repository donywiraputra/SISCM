<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Datajenisbarang extends Model
{
  use SoftDeletes;
  protected $table = 'jenisbarang';
  protected $fillable = ['stok', 'updated_at'];

  public function dataBarang()
  {
    return $this->hasMany('App\Models\Transaksidagang', 'idbarang');
  }

  public function getUpdatedAtAttribute($value)
  {
    return Carbon::parse($value)->addHour(8)->format('d M Y h:i a');
  }

  // public function getHargaAttribute($value)
  // {
  //   return  number_format($value) ;
  // }
}

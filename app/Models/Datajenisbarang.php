<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datajenisbarang extends Model
{
  protected $table = 'jenisbarang';

  public function dataBarang()
  {
    return $this->hasMany('App\Models\Transaksidagang', 'idbarang');
  }
}

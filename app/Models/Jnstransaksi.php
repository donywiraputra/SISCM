<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jnstransaksi extends Model
{
    protected $primaryKey = 'idjnstransaksi';
    protected $table = 'jenistransaksi';
    public $timestamps = false;

    public function dataTransaksi()
    {
      return $this->hasMany('App\Models\Datatransaksi', 'idjnstransaksi');
    }
}

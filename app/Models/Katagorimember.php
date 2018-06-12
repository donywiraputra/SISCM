<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Katagorimember extends Model
{
    protected $primaryKey = 'idkatmember';
    protected $table = 'katagorimember';

    public function member()
    {
      return $this->hasMany('Member', 'id_katmember');
    }

  
}

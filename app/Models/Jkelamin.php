<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jkelamin extends Model
{
    protected $table = 'jeniskelamin';

    public function member()
    {
      return $this->hasMany('Member', 'jnskelamin');
    }
}

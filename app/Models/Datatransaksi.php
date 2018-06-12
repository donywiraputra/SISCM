<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Datatransaksi extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $primaryKey = 'idtransaksi';
    protected $table = 'datatransaksi';

    public function jnstrans()
    {
      return $this->belongsTo('App\Models\Jnstransaksi','idjenistransaksi');
    }

    public function memberid()
    {
      return $this->belongsTo('App\Models\Member','id_member');
    }

    public function user()
    {
      return $this->belongsTo('App\User','iduser');
    }

    public function getCreatedAtAttribute($value)
    {
      return Carbon::parse($value)->addHour(8)->format('d M Y h:i a');
    }
}

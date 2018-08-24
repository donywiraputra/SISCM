<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Member extends Model
{

    protected $dates = ['deleted_at'];
    protected $primaryKey = 'idmember';
    protected $table = 'member';

    public function katagoriMember()
    {
      return $this->belongsTo('Katagorimember', 'id_katmember');
    }

    public function jenisKelamin()
    {
      return $this->belongsTo('Jkelamin', 'jnskelamin');
    }

    public function transaksi()
    {
      return $this->hasMany('Datatransaksi', 'id_member');
    }

    public function getExpiredDateAttribute($value)
    {
      if(empty($value)){
        return null;
      }else{
        return Carbon::parse($value)
       ->format('d M Y');
      }
    }

    public function getCreatedAtAttribute($value)
    {
      return Carbon::parse($value)->addHour(8)->format('d M Y h:i a');
    }
}

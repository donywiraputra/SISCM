<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';

    public function getCreatedAtAttribute($value)
    {
      return Carbon::parse($value)->addHour(8)->format('d M Y h:i a');
    }
}

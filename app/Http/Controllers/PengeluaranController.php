<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function getPengeluaran()
    {
      return view('web.datapengeluaran');
    }
}

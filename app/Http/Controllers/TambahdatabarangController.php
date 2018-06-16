<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TambahdatabarangController extends Controller
{
    public function getTambahDataBarang()
    {
      return view('web.tambahdatabarang');
    }
}

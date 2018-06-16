<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksidagangController extends Controller
{
    public function getTransaksiDagang()
    {
      return view('web.transaksidagang');
    }
}

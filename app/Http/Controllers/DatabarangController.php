<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatabarangController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function getDataBarang()
    {
    return view('web.databarang');
    }


}

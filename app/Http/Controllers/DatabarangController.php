<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatabarangController extends Controller
{
    public function getDataBarang()
    {
    return view('web.databarang');
    }
}

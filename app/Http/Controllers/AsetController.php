<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function index(){
        return \view('aset.index');
    }
}

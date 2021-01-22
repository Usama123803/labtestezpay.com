<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DymoprinterController extends Controller
{
    public function index()
    {
        return view('pages.dymo-printer');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OpdController extends Controller
{
    public function create()
    {
        return view('content.opd.create');
    }
}

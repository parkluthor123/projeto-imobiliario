<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComprarController extends Controller
{
    public function index()
    {
        return view('pages.comprar');
    }
}

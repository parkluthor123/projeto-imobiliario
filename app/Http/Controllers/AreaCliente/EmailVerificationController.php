<?php

namespace App\Http\Controllers\AreaCliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{

    public function show()
    {
        return view('pages.area-restrita.confirmar-email');
    }
}

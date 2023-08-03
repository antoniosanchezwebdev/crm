<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FabricantesController extends Controller
{
    public function index(Request $request)
    {
        //
        $alertas = [];
        $tab = $request->query('tab');      // $user = Auth::user();

        return view('fabricantes.index', compact('alertas', 'tab'));

    }
}

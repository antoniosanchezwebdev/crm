<?php

namespace App\Http\Controllers;

use App\Models\CobroCaja;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $alertas = [];
        $tab = $request->query('tab');      // $user = Auth::user();

        return view('caja.index', compact('alertas', 'tab'));
    }
}

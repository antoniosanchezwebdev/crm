<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use App\Http\Requests\StoreTrabajadorRequest;
use App\Http\Requests\UpdateTrabajadorRequest;
use Illuminate\Http\Request;

class RendimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $alertas = [];
        $tab = $request->query('tab');
        return view('rendimiento.index', compact('alertas', 'tab'));
    }

}

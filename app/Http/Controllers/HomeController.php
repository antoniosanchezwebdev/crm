<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RevisionReminder;
use Carbon\Carbon;
use App\Models\Clients;
use App\Models\Presupuesto;
use App\Models\Facturas;
use App\Models\Vehiculo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $alertas = [];

        return view('home', compact('user', 'alertas'));
    }
    public function test(){
        $hoy = Carbon::now()->startOfDay();
        $FacturasVencimiento = Facturas::whereDate('fecha_vencimiento', '=', $hoy->toDateString())->get();
            return $FacturasVencimiento;

    }
}

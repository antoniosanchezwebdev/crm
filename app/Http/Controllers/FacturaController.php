<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Presupuesto;
use App\Models\Clients;
use App\Models\Facturas;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Mail\FacturaMail;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Carbon\Carbon;
use DateTime;

class FacturaController extends Controller
{
    use LivewireAlert;

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

        return view('factura.index', compact('alertas', 'tab'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('factura.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('factura.edit', compact('id'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function pdf($id)
    {
        $factura = Facturas::findOrFail($id);
        $tipoDocumento = $factura->tipo_documento;
        $productos = Productos::all();
        $lista = [];

        if ($tipoDocumento == 'albaran_credito') {
            $idsPresupuesto = json_decode($factura->id_presupuesto);
            $presupuestos = Presupuesto::whereIn('id', $idsPresupuesto)->get();
            foreach ($presupuestos as $presupuesto) {
                $listaArticulos = (array) json_decode($presupuesto->listaArticulos, true);
                foreach ($listaArticulos as $productoID => $pCantidad) {
                    if (!array_key_exists($productoID, $lista)) {
                        $lista[$productoID] = 0;
                    }
                    $lista[$productoID] += $pCantidad;
                }
            }
        } else {
            $presupuesto = Presupuesto::findOrFail($factura->id_presupuesto);
            $lista = (array) json_decode($presupuesto->listaArticulos, true);
        }

        $cliente = Clients::findOrFail($presupuesto->cliente_id); // Asumiendo que cliente_id es uniforme en todos los presupuestos

        // Cargar la vista adecuada y pasar los datos necesarios
        $pdf = PDF::loadView('livewire.facturas.pdf-component', compact('factura', 'presupuestos', 'cliente', 'lista', 'productos', 'tipoDocumento'));

        // Devolver el PDF para descargar con un nombre de archivo personalizado
        $nombreArchivo = $tipoDocumento == 'albaran_credito' ? 'albaran' : 'factura';
        return $pdf->download($nombreArchivo . '-' . $factura->numero_factura . '.pdf');
    }


}

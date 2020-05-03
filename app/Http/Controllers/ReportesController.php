<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facturas;
use App\Viajes;
use App\Camiones;
use App\Gastos_conceptos;
use App\Gastos;
use Illuminate\Support\Facades\Auth;

class ReportesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');

    }

    //reporte de facturacion

    public function rep_facturacion_view()
    {
        return view('reportes.facturacion');
    }

    public function get_facturacion_rep(Request $request)
    {
        // var_dump(Auth::user()->rol_id);exit();
        $from = $request->date_from;
        $to = $request->date_to;
        $data = Facturas::join('users','users.id','=','facturas.user_id')->join('clientes','clientes.id','=','facturas.cliente_id')->select('facturas.id','clientes.nombre as cliente','facturas.NCF','facturas.no_factura','facturas.monto','facturas.created_at')->whereRaw('date(pipi_facturas.created_at) between ? and ?',[$from,$to])->orderBy('facturas.NCF','desc')->get();
        $btn = "";
        foreach ($data as $d) {
            $btn = '<a class="btn btn-success btn-xs edit_concepto" href ="'.route('facturas.show',$d->id).'" target="_blank"><span class="btn-label"><i class="fa fa-eye"></i></span>Ver</a>';

            if (Auth::user()->rol_id != 4) {
                

                $btn .= '<a class="btn btn-danger btn-xs delete_concepto" href = "'.route('facturas.edit',$d->id).'"><span class="btn-label"><i class="fa fa-pencil"></i></span>Editar</a>';

                // var_dump($btn);exit();
                $d->accion = $btn;
            }else{

            }
            // var_dump($d->accion);exit;
            unset($d->id,$d);
        }
        echo json_encode(array('status' => 'success','msg' => 'reporte generado exitosamente','aaData'=> $data));

    }

    // reporte de viajes por camion
    public function rep_viajes_view()
    {
        $camiones = Camiones::all();
        return view('reportes.viajes')->with('camiones',$camiones);
    }

    public function get_viajes_rep(Request $request)
    {
        $from = $request->date_from;
        $to = $request->date_to;
        $camion_id = $request->camion_id;
        $data = '';
        if ($camion_id == 'all') {
            // $data = Viajes::join('users','users.id','=','viajes.user_id')->join('clientes','clientes.id','=','viajes.cliente_id')->join('camiones','camiones.id','=','viajes.camion_id')->select('viajes.concepto','camiones.matricula','clientes.nombre as cliente','users.name as asignado por','viajes.created_at','viajes.monto')->whereRaw('date(pipi_viajes.created_at) between ? and ?',[$from,$to])->get(); 

            $data = Viajes::join('users','users.id','=','viajes.user_id')->join('clientes','clientes.id','=','viajes.cliente_id')->select('viajes.concepto','clientes.nombre as cliente','users.name as creado por','viajes.created_at','viajes.monto')->whereRaw('date(pipi_viajes.created_at) between ? and ?',[$from,$to])->get();            
        } else {
            $data = Viajes::join('users','users.id','=','viajes.user_id')->join('clientes','clientes.id','=','viajes.cliente_id')->select('viajes.concepto','clientes.nombre as cliente','users.name as creado por','viajes.created_at','viajes.monto')->whereRaw('date(pipi_viajes.created_at) between ? and ? and pipi_viajes.camion_id = ?',[$from,$to,$camion_id])->get();
        }
        // var_dump($data);
        echo json_encode(array('status' => 'success','msg' => 'reporte generado exitosamente','aaData'=> $data));

    }

    //reporte de gastos

    public function rep_gastos_view()
    {
        $camiones = Camiones::all();
        $conceptos_gastos = Gastos_conceptos::all();
        return view('reportes.gastos')->with('camiones',$camiones)->with('conceptos_gastos',$conceptos_gastos);
    }

    public function get_gastos_rep(Request $request)
    {
        $from = $request->date_from;
        $to = $request->date_to;
        $camion_id = $request->camion_id;
        $concepto_id = $request->concepto_id;
        $data = '';
        if ($camion_id == 'all' && $concepto_id == 'all') {
            $data = Gastos::join('gastos_conceptos','gastos.concepto_id','=','gastos_conceptos.id')->join('camiones','camiones.id','=','gastos.camion_id')->select('gastos.descripcion','camiones.matricula','gastos_conceptos.descripcion as concepto','gastos.date','gastos.monto')->whereRaw('pipi_gastos.date between ? and ?',[$from,$to])->get();
        } elseif ($camion_id !== 'all' && $concepto_id == 'all') {
            $data = Gastos::join('gastos_conceptos','gastos.concepto_id','=','gastos_conceptos.id')->join('camiones','camiones.id','=','gastos.camion_id')->select('gastos.descripcion','camiones.matricula','gastos_conceptos.descripcion as concepto','gastos.date','gastos.monto')->whereRaw('pipi_gastos.date between ? and ? and pipi_gastos.camion_id = ?',[$from,$to,$camion_id])->get();
            
        }elseif ($camion_id == 'all' && $concepto_id !== 'all') {
            $data = Gastos::join('gastos_conceptos','gastos.concepto_id','=','gastos_conceptos.id')->join('camiones','camiones.id','=','gastos.camion_id')->select('gastos.descripcion','camiones.matricula','gastos_conceptos.descripcion as concepto','gastos.date','gastos.monto')->whereRaw('pipi_gastos.date between ? and ? and pipi_gastos.concepto_id = ?',[$from,$to,$concepto_id])->get();
            # code...
        }else {
            $data = Gastos::join('gastos_conceptos','gastos.concepto_id','=','gastos_conceptos.id')->join('camiones','camiones.id','=','gastos.camion_id')->select('gastos.descripcion','camiones.matricula','gastos_conceptos.descripcion as concepto','gastos.date','gastos.monto')->whereRaw('pipi_gastos.date between ? and ? and pipi_gastos.camion_id = ? and pipi_gastos.concepto_id = ?',[$from,$to,$camion_id,$concepto_id])->get();
            
        }
        echo json_encode(array('status' => 'success','msg' => 'reporte generado exitosamente','aaData'=> $data));

    }
}

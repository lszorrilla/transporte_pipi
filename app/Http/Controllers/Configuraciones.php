<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gastos_conceptos;
use App\Tipo_Camiones;
use App\Viajes;
use App\Camiones;
use App\Productos_facturacion;
use App\Posiciones;
use Illuminate\Support\Facades\Auth;

class Configuraciones extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function conceptos_gastos_view()
    {
        $conceptos = Gastos_conceptos::all();
        return view('configuracion/conceptos_gastos')->with('conceptos',$conceptos);
    }

    public function crear_conceptos_gastos_view()
    {
        // $conceptos = Gastos_conceptos::all();
        return view('configuracion/create_conceptos_gastos');
    }

    public function set_conceptos_gastos(Request $request)
    {
        # code...
        $concepto = new Gastos_conceptos();
        $concepto->descripcion = $request->descripcion;
        $concepto->save();

        return redirect()->route('configuraciones.conceptos');
    }

     public function edit_conceptos_gastos($id)
    {
        $conceptos = Gastos_conceptos::find($id);
        return view('configuracion/edit_conceptos')->with('concepto',$conceptos);
    }

    public function update_conceptos_gastos(Request $request,$id)
    {
        $concepto = Gastos_conceptos::find($id);
        $concepto->descripcion = $request->descripcion;
        $concepto->save();

        return redirect()->route('configuraciones.conceptos');
    }

    public function destroy_conceptos_gastos($id)
    {
        $concepto = Gastos_conceptos::find($id);
        $concepto->delete();

        return json_encode(array("status"=>"ok"));
    }


    /* tipos de camiones*/
    public function tipo_camiones_view()
    {
        $tipo = Tipo_Camiones::all();
        return view('configuracion/tipo_camiones')->with('tipo_cmc',$tipo);
    }

    public function crear_tipo_camiones_view()
    {
        // $conceptos = Tipo_Camiones::all();
        return view('configuracion/create_tipo_cmc');
    }

    public function set_tipo_camiones(Request $request)
    {
        # code...
        $tipo = new Tipo_Camiones();
        $tipo->descripcion = $request->descripcion;
        $tipo->save();

        return redirect()->route('configuraciones.tipos_cmc');
    }

     public function edit_tipo_camiones($id)
    {
        $tipo = Tipo_Camiones::find($id);
        return view('configuracion/edit_tipo_cmc')->with('tipo_cmc',$tipo);
    }

    public function update_tipo_camiones(Request $request,$id)
    {
        $tipo = Tipo_Camiones::find($id);
        $tipo->descripcion = $request->descripcion;
        $tipo->save();

        return redirect()->route('configuraciones.tipos_cmc');
    }

    public function destroy_tipo_camiones($id)
    {
        $tipo = Tipo_Camiones::find($id);
        $tipo->delete();

        return json_encode(array("status"=>"ok"));
    }


    // asignar viajes a camiones
    public function asignar_viajes_view()
    {
        
        return view('configuracion/asignar_viaje_view');  
    }

    public function get_viajes()
    {
        $viajes = Viajes::join('clientes','clientes.id','=','viajes.cliente_id')->join('productos_facturacion','productos_facturacion.id','=','viajes.id_producto_facturacion')->leftJoin('camiones','camiones.id','=','viajes.camion_id')->select('viajes.id','productos_facturacion.descripcion as concepto','clientes.nombre','camiones.matricula','viajes.created_at')->get();
        foreach ($viajes as $d) {
            $d->accion = '<button class="btn btn-success btn-xs asignar_viaje_btn" data-url ="'.route('configuraciones.get_asignar_modal',$d->id).'" onclick="open_asignar_modal(this)">Asignar</button>';
            // var_dump($d->accion);exit;
            unset($d->id,$d);
        }
        echo json_encode(array('status' => 'success','msg' => 'reporte generado exitosamente','aaData'=> $viajes));
    }

    public function get_asignar_modal($id)
    {
        $camiones= Camiones::all();
        return view('configuracion/asignar_viaje_modal')->with('camiones',$camiones)->with('viaje_id',$id);  
    }

    public function asignar_viajes(Request $request,$id)
    {
        $viaje = Viajes::find($id);
        $viaje->camion_id = $request->camion_id;
        $viaje->user_id = Auth::id();
        $viaje->save();

        return redirect()->route('configuraciones.asignar_viajes');

    }

    // items facturacion
    public function item_ft_view()
    {
        $items = Productos_facturacion::all();
        return view('configuracion/item_ft')->with('item',$items);
    }

    public function create_item_ft_view()
    {
        // $conceptos = Tipo_Camiones::all();
        return view('configuracion/create_item_ft');
    }

    public function create_item_ft(Request $request)
    {
        # code...
        $item = new Productos_facturacion();
        $item->descripcion = $request->descripcion;
        $item->save();

        return redirect()->route('configuraciones.item_ft_view');
    }

     public function edit_item_ft($id)
    {
        $item = Productos_facturacion::find($id);
        return view('configuracion/edit_item_ft')->with('item',$item);
    }

    public function update_item_ft(Request $request,$id)
    {
        $item = Productos_facturacion::find($id);
        $item->descripcion = $request->descripcion;
        $item->save();

        return redirect()->route('configuraciones.item_ft_view');
    }

    public function destroy_item_ft($id)
    {
        $item = Productos_facturacion::find($id);
        $item->delete();

        return json_encode(array("status"=>"ok"));
    }

    // posiciones
    public function posiciones_view()
    {
        $posiciones = Posiciones::all();
        return view('configuracion/posiciones')->with('posiciones',$posiciones);
    }

    public function create_posiciones_view()
    {
        // $conceptos = Tipo_Camiones::all();
        return view('configuracion/create_posiciones');
    }

    public function create_posiciones(Request $request)
    {
        # code...
        $posicion = new Posiciones();
        $posicion->descripcion = $request->descripcion;
        $posicion->save();

        return redirect()->route('configuraciones.posiciones_view');
    }

     public function edit_posiciones($id)
    {
        $posicion = Posiciones::find($id);
        return view('configuracion/edit_posiciones')->with('posicion',$posicion);
    }

    public function update_posiciones(Request $request,$id)
    {
        $posicion = Posiciones::find($id);
        $posicion->descripcion = $request->descripcion;
        $posicion->save();

        return redirect()->route('configuraciones.posiciones_view');
    }

    public function destroy_posiciones($id)
    {
        $posicion = Posiciones::find($id);
        $posicion->delete();

        return json_encode(array("status"=>"ok"));
    }
}

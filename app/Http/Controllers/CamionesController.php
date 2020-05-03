<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Camiones;
use App\Empleados;
use App\Gastos;
use App\Viajes;
use App\Tipo_Camiones;
use Illuminate\Support\Facades\Auth;

class CamionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:1,2,6,4,5');
    }
    
    public function index()
    {
        
        // $camiones = Camiones::all();

        $camiones = Camiones::Join('empleados', 'empleados.id', '=', 'camiones.chofer_id')
            ->join('tipo_camiones','tipo_camiones.id','=','camiones.tipo_id')
            ->select('camiones.*', 'empleados.nombre', 'empleados.apellido','tipo_camiones.descripcion as tipo')
            ->get();
        $counter = Camiones::count();
        // var_dump($counter);exit;

        return view('camiones.index')->with('camiones',$camiones)->with('counter',$counter);
    }

   
    public function create()
    {
        //
        $choferes = Empleados::where('posicion_id',1)
            ->get();

        $tipos = Tipo_Camiones::all();

        return view('camiones.create')->with('choferes',$choferes)->with('tipo_camiones',$tipos);

    }

   
    public function store(Request $request)
    {
        //
        // $file = $request->file('image')->store('avatars/camiones');

        $cmc = new Camiones;
        $cmc->marca = $request->marca;
        $cmc->chofer_id = $request->chofer;
        $cmc->chasis = $request->chasis;
        $cmc->matricula = $request->placa;
        $cmc->modelo = $request->modelo;
        $cmc->capacidad = $request->capacidad;
        $cmc->tipo_id = $request->tipo;
        // $cmc->image_url = $file;
        $cmc->user_id = Auth::id();

        // var_dump($file);
        $cmc->save();

        return redirect()->route('camiones.show',$cmc->id);

    }


    public function show($id)
    {
        
        $camion = Camiones::Join('empleados', 'empleados.id', '=', 'camiones.chofer_id')
            ->join('tipo_camiones','tipo_camiones.id','=','camiones.tipo_id')
            ->select('camiones.*', 'empleados.nombre','empleados.apellido','empleados.id as chofer_id','tipo_camiones.descripcion as tipo')
            ->where('camiones.id',$id)
            ->get();
            // var_dump($camion);exit();
        $viajes = Viajes::Join('clientes', 'clientes.id', '=', 'viajes.cliente_id')
            ->select('viajes.*','clientes.nombre')
            ->where('viajes.camion_id',$id)->get();

        $gastos = Gastos::Join('gastos_conceptos', 'gastos_conceptos.id', '=', 'gastos.concepto_id')
            ->select('gastos.*','gastos_conceptos.descripcion')
            ->where('gastos.camion_id',$id)->get();

        return view('camiones.show')->with('camion',$camion[0])->with('viajes',$viajes)->with('gastos',$gastos);
    }

   
    public function edit($id)
    {
        // var_dump($id);
        $camion = Camiones::Join('empleados', 'empleados.id', '=', 'camiones.chofer_id')
            ->select('camiones.*', 'empleados.nombre','empleados.id as chofer_id')
            ->where('camiones.id',$id)
            ->get();
        $tipos = Tipo_Camiones::all();
        $empleados = Empleados::where('posicion_id',1)->get(); 
        $ayudantes = Empleados::where('posicion_id',3)->get(); 
        return view('camiones.edit')->with('camion',$camion)->with('choferes',$empleados)->with('ayudante_chofer',$ayudantes)->with('tipo_camiones',$tipos);
    }

    
    public function update(Request $request, $id)
    {
        //
        $cmc = Camiones::find($id);
        $cmc->marca = $request->marca;
        $cmc->chofer_id = $request->chofer;
        $cmc->ayudante_id = $request->ayudante;
        $cmc->matricula = $request->placa;
        $cmc->chasis = $request->chasis;
        $cmc->modelo = $request->modelo;
        $cmc->capacidad = $request->capacidad;
        $cmc->active = $request->active;
        $cmc->tipo_id = $request->tipo;

        $cmc->user_id = Auth::id();
        // $file = $request->file('image')->store('avatars/camiones');
        // $cmc->image_url = $file;

        if ($request->active == 1) {
            $cmc->save();
            return redirect()->route('camiones.show',$cmc->id);
        } else {
            $cmc->delete();
            return redirect()->route('camiones.index');
        }
        
        
        // return redirect()->route('camiones.show',$cmc->id);
        // return redirect()->route('camiones.show');

    }

   
    public function destroy($id)
    {
        //
        
    }
}

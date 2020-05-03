<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Gastos;
use App\Gastos_conceptos;
use App\Gastos_tipos;
use App\Camiones;

class GastosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:1,2,3,6,4,5');
        
    }

    public function index()
    {
        // $tipo_gastos = Gastos_tipos::all();
        // $latest_gastos = Gastos::whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())')->get();

        $gastos = Gastos::Join('camiones', 'gastos.camion_id', '=', 'camiones.id')
            ->join('gastos_conceptos','gastos_conceptos.id','=','gastos.concepto_id')
            ->select('camiones.matricula', 'gastos_conceptos.descripcion as concepto', 'gastos.*')
            ->get();
        return view('gastos.index')->with('gastos',$gastos);
    }


    public function create()
    {
        $concepto_gastos = Gastos_conceptos::all();        
        $camiones = Camiones::all();        
        return view('gastos.create')->with('concepto_gastos',$concepto_gastos)->with('camiones',$camiones);
    }


    public function store(Request $request)
    {
        $gasto = new Gastos();
         $gasto->date = $request->date;
         $gasto->descripcion = '';
         $gasto->monto = $request->monto;
         $gasto->concepto_id = $request->concepto;
         $gasto->camion_id = $request->camion;
         $gasto->user_id = Auth::id();
            $gasto->cant_galones = $request->galones;
         $gasto->save();

        return redirect()->route('gastos.index');

    }


    public function show($id)
    {
        //
        $gasto = Gastos::Join('camiones', 'gastos.camion_id', '=', 'camiones.id')
            ->join('gastos_conceptos','gastos_conceptos.id','=','gastos.concepto_id')
            ->join('users','users.id','=','gastos.user_id')
            ->select('camiones.matricula', 'gastos_conceptos.descripcion as concepto', 'gastos.*','users.name')
            ->where('gastos.id',$id)
            ->get();

            return view('gastos.show')->with('gasto',$gasto[0]);
            
    }


    public function edit($id)
    {
        $gasto = Gastos::Join('camiones', 'gastos.camion_id', '=', 'camiones.id')
            ->join('gastos_conceptos','gastos_conceptos.id','=','gastos.concepto_id')
            ->join('users','users.id','=','gastos.user_id')
            ->select('camiones.matricula', 'gastos_conceptos.descripcion as concepto', 'gastos.*','users.name')
            ->where('gastos.id',$id)
            ->get();

        $concepto_gastos = Gastos_conceptos::all();        
        $camiones = Camiones::all();
        
        return view('gastos.edit')->with('gasto',$gasto[0])->with('camiones',$camiones)->with('concepto_gastos',$concepto_gastos);
    }


    public function update(Request $request, $id)
    {
        $gasto = Gastos::find($id);
        $gasto->date = $request->date;
        $gasto->descripcion = '';
        $gasto->monto = $request->monto;
        $gasto->concepto_id = $request->concepto;
        $gasto->camion_id = $request->camion;
        $gasto->user_id = Auth::id();
        $gasto->cant_galones = $request->galones;

        $gasto->save();

        return redirect()->route('gastos.index');
    }

    public function destroy($id)
    {
        $gasto = Gastos::find($id);
        $gasto->delete();
         
    }
}

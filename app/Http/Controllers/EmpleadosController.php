<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Camiones;
use App\Posiciones;
use App\Empleados;
use App\Referencia_laboral;
use Illuminate\Support\Facades\Auth;

class EmpleadosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:1,2,6,4,5');
        
    }

    public function index()
    {
        //
        $posiciones = Posiciones::all();
        $empleados = Empleados::join('posiciones', 'posiciones.id', '=', 'empleados.posicion_id')
            ->select('empleados.*', 'posiciones.descripcion as posicion')
            ->get();

        return view('empleados.index')->with('posiciones',$posiciones)->with('empleados',$empleados);
    }

    public function create()
    {
        //open modal
        $posiciones = Posiciones::all();
        return view('empleados.create')->with('posiciones',$posiciones);
    }

  
    public function store(Request $request)
    {
        $empleado =  new Empleados;
        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->cedula = $request->cedula;
        $empleado->posicion_id = $request->posicion;
        $empleado->email = $request->correo;
        $empleado->direccion = $request->direccion;
        $empleado->fecha_nacimiento = $request->fecha_nacimiento;
        $empleado->telefono = $request->telefono;
        $empleado->created_by = Auth::id();
        $empleado->save() ; 

        $referencia = new Referencia_laboral;
        $referencia->descripcion = $request->trabajo_anterior;
        $referencia->telefono = $request->trabajo_anterior_telefono;
        $referencia->empleado_id = $empleado->id;
        $referencia->save();
        
        return redirect()->route('empleados.show',$empleado->id);

    }

    public function show($id)
    {
        $empleado = Empleados::join('posiciones','posiciones.id','=','empleados.posicion_id')->select('empleados.*','posiciones.descripcion as posicion')->where('empleados.id',$id)->get();
        return view('empleados.show')->with('empleado',$empleado[0]);
    }

    public function edit($id)
    {
        // var_dump($id);exit;
        $posiciones = Posiciones::all();
        $empleados = Empleados::join('posiciones', 'posiciones.id', '=', 'empleados.posicion_id')
            ->select('empleados.*', 'posiciones.descripcion as posicion')
            ->where('empleados.id',$id)
            ->get();
        // $empleados = Empleados::find($id);
        $referencia = Referencia_laboral::where('empleado_id',$empleados[0]->id)->get();
        // var_dump($empleados,$posiciones,$referencia);exit();
        return view('empleados.edit')->with('posiciones',$posiciones)->with('empleado',$empleados)->with('referencia',$referencia);
    }


    public function update(Request $request, $id)
    {
        //
        
        $empleado = Empleados::find($id);
        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->active = $request->active;
        $empleado->cedula = $request->cedula;
        $empleado->posicion_id = $request->posicion;
        $empleado->email = $request->correo;
        $empleado->direccion = $request->direccion;
        $empleado->fecha_nacimiento = $request->fecha_nacimiento;
        $empleado->telefono = $request->telefono;
        $empleado->created_by = Auth::id();

        if ($request->active == 1) {
            $empleado->save();

            $referencia = Referencia_laboral::where('empleado_id',$empleado->id)->first();
            $referencia->descripcion = $request->trabajo_anterior;
            $referencia->telefono = $request->trabajo_anterior_telefono;
            $referencia->empleado_id = $empleado->id;
            $referencia->save();

            return redirect()->route('empleados.show',$empleado->id);
        } else {
            $empleado->delete();
            return redirect()->route('empleados.index');
        }
        // $empleado->save() ; 

        

        // return redirect()->route('empleados.index');
    }


    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientes;
use App\Facturas;
use Illuminate\Support\Facades\Auth;

class ClientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:1,2,6,4,5');
        
    }

    public function index()
    {
        $clientes = Clientes::all();
        $counter = Clientes::count();
        return view('clientes.index')->with('clientes',$clientes)->with('counter',$counter);
    }


    public function create()
    {
        //
        return view('clientes.create');
    }


    public function store(Request $request)
    {

        $cliente =  new Clientes;
        $cliente->user_id = Auth::id();
        $cliente->nombre =  $request->nombre;
        $cliente->direccion = $request->direccion;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->RNC = $request->rnc;
       
        $cliente->save();
        
        
        return redirect()->route('clientes.show',$cliente->id);

    }


    public function show($id)
    {
        $cliente = Clientes::find($id);
        $facturas = Facturas::where('cliente_id',$id)->get();
        return view('clientes.show')->with('cliente',$cliente)->with('facturas',$facturas);
    }

    public function edit($id)
    {
        $cliente = Clientes::find($id);

        return view('clientes.edit')->with('cliente',$cliente);
    }


    public function update(Request $request, $id)
    {
        $cliente = Clientes::find($id);
        $cliente->user_id = Auth::id();
        $cliente->nombre =  $request->nombre;
        $cliente->direccion = $request->direccion;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->RNC = $request->rnc;
       
        $cliente->save();
        
        
        return redirect()->route('clientes.show',$cliente->id);
    }

    public function find_cliente(Request $request)
    {
        $client_id = $request->cliente_id;
        $client = Clientes::find($client_id);
        
        return json_encode(array('cliente' => $client));
    }

    public function destroy($id)
    {
        //
    }
}

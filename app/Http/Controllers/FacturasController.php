<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientes;
use App\Cajas;
use App\Facturas;
use App\Viajes;
use App\Factura_detalles;
use App\Productos_facturacion;
use App;
use Illuminate\Support\Facades\Auth;

class FacturasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:1,2,6,4,5');
        
    }
    

    public function index()
    {
        $clientes = Clientes::all();
        $tipos_ft = Cajas::where('active',1)->get();
        $items = Productos_facturacion::all();
        return view('facturas.index')->with('clientes',$clientes)->with('tipos_ft',$tipos_ft)->with('items',$items);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        
        
        //get the next no_factura
        $tipo_comprobante = $request->tipo_ft;
        $ncf = $this->generate_ncf($tipo_comprobante);
        $no_factura = $this->generate_no_ft();
        $caja =  Cajas::find($tipo_comprobante);
        //save factura {no_factura,monto_total,comentario}
        $factura = new Facturas();
        $factura->no_factura = $no_factura;
        $factura->monto = $request->grand_total;
        $factura->NCF = $ncf;
        $factura->comentario = $request->comment;
        $factura->cliente_id = $request->cliente;
        $factura->user_id = Auth::id();
        $factura->valida_hasta = $caja->vencimiento;
        $factura->title = $caja->title;

        if ($factura->save()) {
            
            $caja->seq_num += 1; 
            $caja->save();

            foreach ($request->item as $key => $value) {
                for($i = 0;$i < $request->cant[$key];$i++) {
                    $viaje = new Viajes();
                
                    $viaje->id_producto_facturacion = $value;
                    $viaje->concepto = $request->desc[$key];
                    $viaje->monto = $request->monto[$key];
                    $viaje->cliente_id = $request->cliente;
                    $viaje->status = 'FACTURADO';
                    $viaje->user_id = Auth::id();
                    $viaje->save();
                
                    // insert into factura_detaill {viaje_id,factura_id} 
                    $factura_detalle = new Factura_detalles();
                    $factura_detalle->viaje_id = $viaje->id;
                    $factura_detalle->factura_id = $factura->id;
                    $factura_detalle->save(); 
                }
            }
        } else {
            # code...
        }  

        echo json_encode(array('status' => 'success','msg' => 'factura generada exitosamente','url'=> route('facturas.show',$factura->id)));
        // return redirect()->route('factura.pdf');

    }


    public function show($id)
    {
        // $data = $this->getData();
        $data  = array();
        $data['factura'] = Facturas::join('users','users.id','=','facturas.user_id')->select('users.name','facturas.*')->where('facturas.id',$id)->get();
        $data['factura_detaill'] = Factura_detalles::join('viajes','viajes.id','=','factura_detalles.viaje_id')
            ->join('productos_facturacion','viajes.id_producto_facturacion','=','productos_facturacion.id')
            ->selectRaw('pipi_viajes.*,pipi_productos_facturacion.descripcion as item, count(pipi_viajes.id_producto_facturacion) as cant, SUM(pipi_viajes.monto) as subtotal')
            ->where('factura_detalles.factura_id',$id)
            ->groupBy('id_producto_facturacion')
            ->groupBy('monto')
            ->groupBy('concepto')
            ->orderBy('viajes.created_at')
            ->get();
        $data['cliente'] = Clientes::find($data['factura'][0]->cliente_id);

        // var_dump($data);exit();

        $pdf = \App::make('dompdf.wrapper');
        $pdf = \PDF::loadView('pdf.invoice', $data);
        $ft = Facturas::find($id);
        $ft->original = 0;
        $ft->save();
        return $pdf->stream('invoice',array('Attachment'=>0));
    }


    public function edit($id)
    {
        $factura = Facturas::join('users','users.id','=','facturas.user_id')->select('users.name','facturas.*')->where('facturas.id',$id)->get();
        $factura_detaill = Factura_detalles::join('viajes','viajes.id','=','factura_detalles.viaje_id')
            ->select('viajes.*')
            ->where('factura_detalles.factura_id',$id)
            ->get();
        $cliente = Clientes::find($factura[0]->cliente_id);
        // var_dump($factura_detaill);exit;
        $items = Productos_facturacion::all();

        return view('facturas.edit')->with('factura_detaill',$factura_detaill)->with('factura',$factura[0])->with('cliente',$cliente)->with('items',$items);
    }


    public function update(Request $request, $id)
    {
         
        if($request->anular =="1"){
            return $this->destroy($id);
        }

        //update factura {no_factura,monto_total,comentario}
        $factura = Facturas::find($id);
        // $factura->no_factura = $no_factura;
        $factura->monto = $request->grand_total;
        $factura->cliente_id = $request->cliente;
        // $factura->updated_at = 'CURRENT_TIMESTAMP';
        $factura->updated_by = Auth::id();
        $factura->original = 1;

        if ($factura->save()) {
            foreach ($request->monto as $key => $value) {
                // save viaje{desc,mercancia,monto}
                $viaje = Viajes::find($key);

                $viaje->id_producto_facturacion = $request->item[$key];
                $viaje->concepto = $request->desc[$key];
                $viaje->monto = $value;
                $viaje->cliente_id = $request->cliente;
                $viaje->status = 'FACTURADO';
                $viaje->updated_by = Auth::id();
                if ($value != 0) { 
                    $viaje->save();
                }
            }
        } else {
            # code...
        }  

        echo json_encode(array('status' => 'success','msg' => 'factura generada exitosamente','url'=> route('facturas.show',$factura->id)));
    }


    public function destroy($id)
    {
        $factura_detaill = Factura_detalles::find($id);
        $factura_detaill->delete();
        
        $viaje = Viajes::find($factura_detaill->viaje_id);
        $viaje->delete();

        // update amount ft
        $factura = Facturas::find($factura_detaill->factura_id);
        $factura->monto -= $viaje->monto;
        $factura->save();

        echo json_encode(array('status'=>'success','msg'=>'borrado'));
    }

    private function generate_no_ft()
    {
        $last_no_factura =  Facturas::all()->last();
        // var_dump($last_no_factura);exit();
        $no_factura = is_null($last_no_factura) ? 2356 : intval($last_no_factura->no_factura) + 1;
        $n_ft = str_pad($no_factura, 8, "0", STR_PAD_LEFT );
        // ->orderBy('id', 'desc')->first();
        return $n_ft;
    }

    private function generate_ncf($tipo_ncf)
    {
        $ncf =  Cajas::find($tipo_ncf);
        $no_factura = is_null($ncf->seq_num) ? 1 : $ncf->seq_num + 1;
        $n_ft = str_pad($no_factura, 8, "0", STR_PAD_LEFT );
        
        return $ncf->prefix.$n_ft;
    }

}

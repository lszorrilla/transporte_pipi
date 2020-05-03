<style type="text/css">
  *{
    font-size: 0.95em;
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  }
  img {
      width: 320px;
  }
  .sub_titulo{
    /*text-align: center;*/
    border-bottom: solid black;
  }

   .detalles_cliente{
    margin: 15px 0px 0px 0px;
    width: 100%;
   }
    
   .table tr td{
    text-align: center;
   }

  .table_detalle_cliente{
    width: 100%;
  }
   .table_ft_detail th, .table_ft_detail td {
      border-bottom: 1px solid black;
  }
  
  p{
    border-bottom: solid gray 1px;
  }

  table#customers {
      border-collapse: collapse;
      width: 100%;
  }

  table#customers th, table#customers td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
  }
</style>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>TRANSPORTE Y SERVICIOS PIPI</title>
    
  </head>
  <body>
    <div class="header">
 
      <?php $image_path = '/images/logogray.png'; ?>
      <div style="display: inline-block;">
        <table class="table_detalle_cliente">
         <tbody>
          <tr>
            <td>
              <img src="{{ public_path() . $image_path }}">
            </td>
            <td></td>

          </tr>
          <tr>
            <td>Calle Real de Figuera No. 8A, Barrio Puerto Rico, Los Alcarrizos</td>
            <td> <b>{{$factura[0]->title}}</b></td>

          </tr>
          <tr>
            <td>Telefono:(809)-372-4257</td>
            <td>NCF: {{$factura[0]->NCF}}</td>
          </tr>
          <tr>
            <td>Correo: servicios@transportepipi.com</td>
            <td>Vålida hasta:  {{$factura[0]->valida_hasta}}</td>
          </tr>
          <tr>
             <td>RNC: 1-30-77421-8</td>
          </tr>
         </tbody>
       </table> 

      </div>       
   
    </div>
    <div style="margin-bottom: 15px;">
      <p>Factura No. {{str_pad($factura[0]->no_factura, 8, "0", STR_PAD_LEFT )}}</p>
    </div>            
    <div class="detalles_cliente" style="display:inline-block">
      <table class="table_detalle_cliente">
        <tbody>
          <tr>
            <td><b>RNC:</b> {{$cliente->RNC}}</td>        
            <td> </td>
            <td><b>FECHA: </b>{{explode(" ",$factura[0]->created_at)[0]}}</td>      
          </tr> 
          <tr>
            <td><b>CLIENTE:</b> {{$cliente->nombre}}</td>
            <td> </td>
            <td><b>HORA: </b>{{explode(" ",$factura[0]->created_at)[1]}}</td>      

          </tr>
          <tr>
            <td><b>DIRECION:</b> {{$cliente->direccion}}</td>
            <td> </td>
            
            <td><b>FACTURADO POR: </b>{{$factura[0]->name}}</td>

          </tr>
          <tr>
            <td><b>TELEFONO:</b> {{$cliente->telefono}}</td>
            
          </tr>
        </tbody>
      </table>

      
    </div> 
    <div class="ft_detalle">
      <table class="" id="customers">
        <thead>
          <tr>
            
            <th class="desc">Concepto</th>
            <th class="desc">Descripcion</th>
            <th class="desc">Cantidad</th>
            <th class="desc">Precio</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($factura_detaill as $element)
             <tr>
              <td class="no">{{$element->item}}</td>
              <td class="no">{{($element->concepto != "")? $element->concepto :" - "}}</td>
              <td class="no">{{$element->cant}}</td>
              <td class="no">{{number_format($element->monto,2)}}</td>
              <td class="total">{{number_format($element->subtotal,2)}}</td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td><b>-</b></td>
            <td><b>-</b></td>
            <td><b>-</b></td>
            <td><b>-</b></td>
            <td><b>{{number_format($factura[0]->monto,2)}}</b></td>
          </tr>
        </tfoot>
      </table>
      @if ($factura[0]->comentario != "")
        <div>
          <h4>Observaciones:</h4>
          <span>{{$factura[0]->comentario}}</span>
        </div>
      @endif
    </div>        
          <div style="display: inline-block; text-align: right; width: 100%;margin-top:10px;" >
            <span>original: Cliente</span>
            <br>
            <span>copia: Comercio</span>
          </div>
    <footer>
          <div style="display: inline-block; text-align: right; width: 50%;margin-top:10px;" >
            <div style="border-top: 1px solid black; display: inline-block; text-align: right; width: 220px;">
                    <h4 style="text-align: center;vertical-align: left;">Firma</h4>
            </div>
          
        
          </div>
    </footer>  

  </body>
  <script type="text/php">
    if ( isset($pdf) ) {
        {{-- echo $pdf->get_height(); --}}
        $font = $fontMetrics->get_font("helvetica", "bold");
        $pdf->page_text(390, 780, "Transporte y Servicios PIPI, SRL - Página: {PAGE_NUM} de {PAGE_COUNT} (Fac: {{str_pad($factura[0]->no_factura, 8, "0", STR_PAD_LEFT )}}) ", $font, 6, array(0,0,0));
    }
</script>
</html>
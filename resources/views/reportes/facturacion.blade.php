@extends('layouts.app')
@section('content')
  <div class="content-heading">
    <!-- START Language list-->

    <!-- END Language list-->
    Reporte de facturacion
    <small data-localize="">Reportes</small>
  </div>
  <div class="col-md-12">
    <!-- START panel-->
    <div class="panel  ">
      <div class="panel-body">
        
        <form action="#"  id="rep_ft_form" data-parsley-validate="" novalidate="">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group col-md-2">
                <label for="input-date_from" class="">Desde</label>
                <input id="input-date_from" autocomplete="off" type="text" placeholder="" class="form-control input-sm datepicker" name="date_from">
            </div>

            <div class="form-group col-md-2">
                <label for="input-date_to" class="">Hasta</label>
                <input id="input-date_to" autocomplete="off" type="text" placeholder="" class="form-control input-sm datepicker" name="date_to">
            </div>
        </form>
        
        <div class="form-group col-md-2">
            <label for="input-date_to" class=""></label>
            <button id="search"  class="btn-primary form-control">Buscar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
  <!-- START DATATABLE 3-->
  <div class="">
    <div class="panel panel-default">
      <div class="panel-heading">
        <small></small>
      </div>
      <div class="panel-body">
        <div id="" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
          <div class="table-responsive">
            <table id="rep_ft_table" class="datatable table  table-hover">
              <thead>
                <tr>
                  <th>cliente</th>
                  <th>NCF</th>
                  <th>No, Factura</th>
                  <th>Monto</th>
                  <th>Fecha</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="rep_ft_tbody">

              </tbody>
              <tfoot>
                <tr>
                    <th style="text-align:right">Total:</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- END panel-->
  <script type="text/javascript">
	$(document).ready(function() {
	    $("#search").on('click',function(element) {
	    	// element.preventDefault();

	    	form = $('#rep_ft_form').serialize();
	    	form_valid = $('#rep_ft_form').parsley();
	    	if (form_valid.isValid()) {
	    		element.preventDefault();
	    		$.ajax({
	                data: form,
	                url:  '{{route('reportes.getfacturacion')}}',
	                method:  'POST',
	                beforeSend: function () {
	                    // $("#resultado").html("Buscando, espere por favor...");
	                },
	                success:  function (response) {
	                    result = JSON.parse(response);
	                    if(result.status == "success"){						
                              
                         $('#rep_ft_table').dataTable({
                            'paging':   true,  // Table pagination
                            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
                            'ordering': false,  // Column ordering
                            "order": [ 2, 'desc' ],
                            'info':     true,  // Bottom left status text
                            'responsive': true, // https://datatables.net/extensions/responsive/examples/
                            'footerCallback': function ( row, data, start, end, display ) {
                                var api = this.api(), data;
                     
                                // Remove the formatting to get integer data for summation
                                var intVal = function ( i ) {
                                    return typeof i === 'string' ?
                                        i.replace(/[\$,]/g, '')*1 :
                                        typeof i === 'number' ?
                                            i : 0;
                                };
                     
                                // Total over all pages
                                total = api
                                    .column( 3 )
                                    .data()
                                    .reduce( function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0 );
                     
                                // Total over this page
                                pageTotal = api
                                    .column( 3, { page: 'current'} )
                                    .data()
                                    .reduce( function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0 );
                     
                                // Update footer
                                $( api.column( 3 ).footer() ).html(
                                    '$'+ new Intl.NumberFormat().format(pageTotal) 
                                    +' de ( $'+ new Intl.NumberFormat().format(total) +')'
                                );
                            },
                            destroy:true,
                            aaData: result.aaData,
                            aoColumns: [
                            { mData: 'cliente' },
                            { mData: 'NCF' },
                            { mData: 'no_factura' },
                            { mData: 'monto' },
                            { mData: 'created_at' },
                            { mData: 'accion' }
                            ],
                            dom: '<"html5buttons"B>lTfgitp',
                            buttons: [
                              {extend: 'copy',  className: 'btn-sm' },
                              {extend: 'csv',   className: 'btn-sm' },
                              {extend: 'excel', className: 'btn-sm', title: 'XLS-File'},
                              {extend: 'pdf',   className: 'btn-sm', title: $('title').text() },
                              {extend: 'print', className: 'btn-sm' }
                            ]
                        });
                             /*var tr = "";
                             for(var i in result.data){
                                tr += "<tr>"+
                                    "<td>"+result.data[i].cliente+"</td>"+
                                    "<td>"+result.data[i].NCF+"</td>"+
                                    "<td>"+result.data[i].no_factura+"</td>"+
                                    "<td>"+result.data[i].monto+"</td>"+
                                    "<td>"+result.data[i].created_at+"</td>"+
                                    "</tr>";
                             }
                             $("#rep_ft_tbody").html(tr);*/
	                    }else{

	                    }
	                    
	                }
	            });
	    	}
	    	
	    });
        
    });


</script>
@endsection
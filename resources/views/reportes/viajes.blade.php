@extends('layouts.app')
@section('content')
  <div class="content-heading">
    <!-- START Language list-->

    <!-- END Language list-->
    Reportes
    <small data-localize="">reporte de Viajes</small>
  </div>
  <div class="col-md-12">
    <!-- START panel-->
    <div class="panel  ">
      <div class="panel-body">
        
        <form action="#"  id="rep_viajes_form" data-parsley-validate="" novalidate="">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group col-md-2">
                <label for="input-date_from" class="">Desde</label>
                <input id="input-date_from" autocomplete="off" type="text" placeholder="" class="form-control input-sm datepicker" name="date_from">
            </div>

            <div class="form-group col-md-2">
                <label for="input-date_to" class="">Hasta</label>
                <input id="input-date_to" autocomplete="off" type="text" placeholder="" class="form-control input-sm datepicker" name="date_to">
            </div>
            <div class="form-group col-md-2">
                <label for="input-date_to" class="">Camion</label>
                <select class="form-control select2 input-sm" name="camion_id" id="" required>
                <option selected="" value="all">Todos</option>
                    @foreach ($camiones as $camion)
                        <option value="{{$camion->id}}">{{$camion->matricula}}</option>
                    @endforeach
                </select>
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
            <table id="rep_viajes_table" class="datatable table  table-hover">
              <thead>
                <tr>
                  <th>Concepto</th>                 
                  <th>Cliente</th>
                  <th>Creado por</th>
                  <th>Creado</th>
                  <th>Monto</th>
                </tr>
              </thead>
              <tbody id="rep_viajes_tbody">

              </tbody>
              <tfoot>
                <tr>
                    <th>Total:</th>
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

	    	form = $('#rep_viajes_form').serialize();
	    	form_valid = $('#rep_viajes_form').parsley();
	    	if (form_valid.isValid()) {
	    		element.preventDefault();
	    		$.ajax({
	                data: form,
	                url:  '{{route('reportes.getviajes')}}',
	                method:  'POST',
	                beforeSend: function () {
	                    // $("#resultado").html("Buscando, espere por favor...");
	                },
	                success:  function (response) {
	                    result = JSON.parse(response);
	                    if(result.status == "success"){	 					
                            
                            
                                 $('#rep_viajes_table').dataTable({
                                    'paging':   true,  // Table pagination
                                    'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
                                    'ordering': true,  // Column ordering
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
                                            .column( 4  )
                                            .data()
                                            .reduce( function (a, b) {
                                                return intVal(a) + intVal(b);
                                            }, 0 );
                             
                                        // Total over this page
                                        pageTotal = api
                                            .column( 4, { page: 'current'} )
                                            .data()
                                            .reduce( function (a, b) {
                                                return intVal(a) + intVal(b);
                                            }, 0 );
                             
                                        // Update footer
                                        $( api.column( 4 ).footer() ).html(
                                            '$'+ new Intl.NumberFormat().format(pageTotal) 
                                            +' de ( $'+ new Intl.NumberFormat().format(total) +')'
                                        );
                                    },
                                    destroy:true,
                                    aaData: result.aaData,
                                    aoColumns: [
                                    { mData: 'concepto' },
                                    { mData: 'cliente' },
                                    { mData: 'creado por' },
                                    { mData: 'created_at' },
                                    { mData: 'monto' }
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
	                    }else{

	                    }
	                    
	                }
	            });
	    	}
	    	
	    });
        
    });


</script>
@endsection
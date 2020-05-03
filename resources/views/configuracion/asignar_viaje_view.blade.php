@extends('layouts.app')
@section('content')
  <div class="content-heading">
    <!-- START Language list-->

    <!-- END Language list-->
    Asignar viaje
    <small data-localize="">Configuracion</small>
  </div>
  <div class="col-md-12">
    <!-- START panel-->
    <div class="panel  ">
      <div class="panel-body">
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
                  <th>Matricula camion</th>
                  <th>Fecha</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="rep_viajes_tbody">

              </tbody>
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
        $.ajax({
            data: {date:'s',_token:'{{csrf_token()}}'},
            url:  '{{route('configuraciones.get_viajes')}}',
            method:  'POST',
            beforeSend: function () {
                // $("#resultado").html("Buscando, espere por favor...");
            },
            success:  function (response) {
                result = JSON.parse(response);
                if(result.status == "success"){	 					
                    
                    
                            $('#rep_viajes_table').dataTable({
                            'paging':   true,  // Table pagination
                            'ordering': true,  // Column ordering
                            'info':     true,  // Bottom left status text
                            'responsive': true, // https://datatables.net/extensions/responsive/examples/
                            destroy:true,
                            aaData: result.aaData,
                            aoColumns: [
                            { mData: 'concepto' },
                            { mData: 'nombre' },
                            { mData: 'matricula' },
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
        
        $('.asignar_viaje_btn').click(function(e) {alert()
            // $('#myModal').modal('show');
            
        });

        
    });

    function open_asignar_modal(s){
            var url = $(s).attr('data-url');
            BootstrapDialog.show({
                title:"Asignar viaje",
                message: function(dialog) {
                    var $message = $('<div></div>');
                    var pageToLoad = dialog.getData('pageToLoad');
                    $message.load(pageToLoad);
            
                    return $message;
                },
                data: {
                    'pageToLoad': url
                }
            });
        }
</script>
@endsection
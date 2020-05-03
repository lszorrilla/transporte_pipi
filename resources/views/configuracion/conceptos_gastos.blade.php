@extends('layouts.app')

@section('content')
<div class="content-heading">
  <!-- START Language list-->
  <div class="pull-right">
    <div class="btn-group">
    </div>
  </div>
  <!-- END Language list-->
  Conceptos Gastos
  <small data-localize=""></small>
</div>
 <div class="col-md-12">
  <div class="col-md-4">
    <button type="button" id="crear_concepto" class="mb-sm btn btn-labeled btn-primary text-white" data-url = "{{route('configuraciones.crear_conceptos')}}">
    <span class="btn-label">
      <i class="fa fa-plus fa-inverse text-white"></i>
    </span>
    Nuevo 
    </button>
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
        <div id="datatable1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
          <div class="table-responsive">
            <table id="" class="datatable table  table-hover">
              <thead>
                <tr>
                  <th>Descripcion</th>
                  <th>acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($conceptos as $concepto)
                <!--  -->
                <tr>
                    <td>{{$concepto->descripcion}}</td>
                    <td>
                        <button type="button" class="btn btn-success btn-xs edit_concepto" data-url = "{{route('conceptos.edit',$concepto->id)}}"><span class="btn-label"><i class="fa fa-pencil"></i></span>Editar</button>
                        <button type="button" class="btn btn-danger btn-xs delete_concepto" data-url = "{{route('conceptos.destroy',$concepto->id)}}"><span class="btn-label"><i class="fa fa-times"></i></span>Eliminar</button>
                    </td>
                    
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 <script>
   $(document).ready(function() {

        $('#crear_concepto').click(function(e) {
            // $('#myModal').modal('show');
            var url = $(this).attr('data-url');
            BootstrapDialog.show({
                title:"Ingresar Gasto",
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
        });

        $('.asignar_viaje_btn').click(function(e) {
            // $('#myModal').modal('show');
            var url = $(this).attr('data-url');
            BootstrapDialog.show({
                title:"Ingresar Gasto",
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
        });

        $('.delete_concepto').on('click',function (element) {
            swal("Esta seguro que desea eleminiarlo?", {
            buttons: ["Cancel!", true],
            icon: "warning"
            }).then((value) => {
            // window.open(result.url, '_blank');
            if (value == 1) {
                var parent = $( this ).parent();
                var url = $(this).attr('data-url');
                
                $.ajax({
                    data:  {_token:'{{csrf_token()}}'},
                    url:  url,
                    method:  'DELETE',
                    beforeSend: function () {
                        // $("#resultado").html("Buscando, espere por favor...");
                    },
                    success:  function (response) {
                        location.reload();
                    }
                });
            } else {
                console.log("canceled")
            }
            });
        });
    });
 </script>
@endsection

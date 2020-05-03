@extends('layouts.app')

@section('content')
<div class="content-heading">
  <!-- START Language list-->
  <div class="pull-right">
    <div class="btn-group">
    </div>
  </div>
  <!-- END Language list-->
  Gastos
  <small data-localize=""></small>
</div>
 <div class="col-md-12">
  <div class="col-md-4">
    <button type="button" id="crear_gasto_btn" class="mb-sm btn btn-labeled btn-primary text-white" data-url = "{{route('gastos.create')}}">
    <span class="btn-label">
      <i class="fa fa-plus fa-inverse text-white"></i>
    </span>
    Nuevo Gasto
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
                  <th>Fecha</th>
                  <th># Chasis Camion </th>
                  <th>Concepto</th>
                  <th>Galones</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($gastos as $gasto)
                <!--  -->
                <tr>
                  <td>{{$gasto->date}}</td>
                  <td>{{$gasto->chasis}}</td>
                  <td>{{$gasto->concepto}}</td>
                  <td>{{is_null($gasto->cant_galones)? "NA" : $gasto->cant_galones}}</td>
                  <td><a href="{{route('gastos.show',$gasto->id)}}" class="link"><em class="fa fa-eye"></em></a></td>
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

    $('#crear_gasto_btn').click(function(e) {
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
});
 </script>
@endsection

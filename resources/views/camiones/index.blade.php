@extends('layouts.app')
@section('content')
<div class="content-heading">
  <!-- START Language list-->
  <div class="pull-right">
    <div class="btn-group">
    </div>
  </div>
  <!-- END Language list-->
  Camiones
  <small data-localize="">Listado de Camiones</small>
</div>
<div class="col-md-12">
  <div class="col-md-4">
    <button type="button" id="crear_camion_btn" class="mb-sm btn btn-labeled btn-primary text-white" data-url = "{{route('camiones.create')}}">
    <span class="btn-label">
      <i class="fa fa-plus fa-inverse text-white"></i>
    </span>
    Crear Camion
    </button>
  </div>
  <div class="col-md-4 pull-right">
    <div class="panel widget ">
      <div class="row row-table row-flush">
        <div class="col-xs-4 bg-danger  text-center">
          <em class="fa fa-truck fa-2x"></em>
        </div>
        <div class="col-xs-8 ">
          <div class="text-center">
            <h4 style="margin: 8px 0;" class="count">{{$counter}}</h4>
          </div>
        </div>
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
        <div id="datatable1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
          <div class="table-responsive">
            <table id="" class="datatable table table-hover">
              <thead>
                <tr>
                  <th></th>
                  <th>Placa</th>
                  <th>Marca</th>
                  <th>Chofer</th>
                  <th>Tipo</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($camiones as $camion)
                <!--  -->
                <tr>
                  <td>
                    <div class="media">
                      <em class="fa fa-truck " style="margin-top: 0;"></em>

                    </div>
                  </td>
                  <td>{{$camion->matricula}}</td>
                  <td>{{$camion->marca}}</td>
                  <td>{{$camion->nombre}}</td>
                  <td>{{$camion->tipo}}</td>
                  <td><a href="{{route('camiones.show',$camion->id)}}" class="link"><em class="fa fa-eye"></em></a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- end data table --}}
</div>
@endsection
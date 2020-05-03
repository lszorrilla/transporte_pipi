@extends('layouts.app')
{{-- @include('empleados.create') --}}
@section('content')
<div class="content-heading">
  <!-- START Language list-->
  <div class="pull-right">
    <div class="btn-group">
    </div>
  </div>
  <!-- END Language list-->
  Empleados
  <small data-localize="">Listado de empleados</small>
</div>
<div class="col-md-12">
  <div class="col-md-4">
      <button class="mb-sm btn btn-labeled btn-primary text-white" id="crear_empleado_btn" data-url="{{route('empleados.create')}}" >
    <span class="btn-label">
      <i class="icon-user-follow fa-inverse text-white"></i>
    </span>
    Crear Empleado
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
            <table id="" class="datatable table table-hover">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Posicion</th>
                    <th>Cedula</th>
                    <th>Ver</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($empleados as $empleado)
                    <tr>
                    <td>{{$empleado->nombre}}</td>
                    <td>{{$empleado->apellido}}</td>
                    <td>{{($empleado->posicion)}}</td>
                    <td>{{$empleado->cedula}}</td>
                    <td><a href="{{route('empleados.show',$empleado->id)}}" class="link see_employee_link"><em class="fa fa-eye"></em></a></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Posicion</th>
                    <th>Cedula</th>
                    <th></th>
                </tr>
                </tfoot>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- end data table --}}
</div>


@endsection

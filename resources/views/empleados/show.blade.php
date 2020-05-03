@extends('layouts.app')
@section('content')
  <div class="content-heading">
    <!-- START Language list-->
    <div class="pull-right">
      <div class="btn-group">
        <a href="{{route('empleados.index')}}" class="mb-sm btn btn-default btn-labeled">
          <span class="btn-label">
            <i class="fa fa-arrow-left"></i>
          </span>
          Ir Atras
        </a>
      </div>
    </div>
    <!-- END Language list-->
    Empleados
    <small data-localize="">Detalle de empleado</small>
  </div>
  <div class="col-md-12">
    <!-- START panel-->
    <div class="panel panel-default">
      <div class="panel-body">
        
        <div class=" col-md-10">
          <div class="col-md-4">
            {{--  <img style="margin-top: 25px;width: 250px;height: 250px;" src="{{asset('storage/'.$camion->image_url)}}" alt="Image" class="img-thumbnail thumb256 img-responsive img-circle">  --}}
          </div>
          <div class="col-md-4">
            <h4>Nombre</h4>
            <blockquote>
              <p>{{$empleado->nombre}} {{$empleado->apellido}}</p>
            </blockquote>
            
            <h4>Cedula</h4>
            <blockquote>
              <p>{{$empleado->cedula}}</p>
            </blockquote>
            <h4>Telefono</h4>
            <blockquote>
              <p>{{$empleado->telefono}}</p>
            </blockquote>

          </div>
          <div class="col-md-4">
            <h4>Direccion</h4>
            <blockquote>
              <p>{{$empleado->direccion}}</p>
            </blockquote>
            <h4>Posicion</h4>
            <blockquote>
              <p>{{$empleado->posicion}}</p>
            </blockquote>
          </div>
        </div>
        <div class=" col-md-2">
          <!-- edit -->
          <button type="button" class="pull-right btn btn-labeled  btn-primary edit-btn text-white" data-url = "{{route('empleados.edit',$empleado->id)}}">
          <span class="btn-label">
            <i class="fa fa-pencil fa-inverse text-white"></i>
          </span>
          Editar
          </button>
        </div>
      </div>
      <div class="panel-footer bg-gray-dark">
        <div class="row row-table text-center">

        </div>
      </div>
    </div>
  </div>
  <!-- END panel-->
@endsection
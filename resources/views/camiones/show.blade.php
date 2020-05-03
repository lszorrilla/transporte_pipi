@extends('layouts.app')
@section('content')
  <div class="content-heading">
    <!-- START Language list-->
    <div class="pull-right">
      <div class="btn-group">
        <a href="{{route('camiones.index')}}" class="mb-sm btn btn-default btn-labeled">
          <span class="btn-label">
            <i class="fa fa-arrow-left"></i>
          </span>
          Ir Atras
        </a>
      </div>
    </div>
    <!-- END Language list-->
    Camiones
    <small>Detalle de camion</small>
  </div>
  <div class="col-md-12">
    <!-- START panel-->
    <div class="panel panel-default">
      <div class="panel-body">
        
        <div class=" col-md-10">
          <div class="col-md-4">
            <em class="fa fa-truck fa-5x " style="margin-top: 0;"></em>
            {{--  <img style="margin-top: 25px;width: 250px;height: 250px;" src="{{asset('storage/'.$camion->image_url)}}" alt="Image" class="img-thumbnail thumb256 img-responsive img-circle">  --}}
          </div>
          <div class="col-md-4">
            <h4>No. Chasis</h4>
            <blockquote>
              <p>{{$camion->chasis}}</p>
            </blockquote>
            <h4>Placa</h4>
            <blockquote>
              <p>{{$camion->matricula}}</p>
            </blockquote>
            <h4>Capacidad</h4>
            <blockquote>
              <p>{{$camion->capacidad}}</p>
            </blockquote>
            <h4>Tipo</h4>
            <blockquote>
              <p>{{$camion->tipo}}</p>
            </blockquote>
          </div>
          <div class="col-md-4">
            <h4>Marca</h4>
            <blockquote>
              <p>{{$camion->marca}}</p>
            </blockquote>
            <h4>Modelo</h4>
            <blockquote>
              <p>{{$camion->modelo}}</p>
            </blockquote>
            <h4>Chofer</h4>
            <blockquote>
              <p>{{$camion->nombre}} {{$camion->apellido}}</p>
            </blockquote>
          </div>
                 </div>
        <div class=" col-md-2">
          <!-- edit -->
          <button type="button" class="pull-right btn btn-labeled  btn-primary edit-btn text-white" data-url = "{{route('camiones.edit',$camion->id)}}">
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
  <div class="col-md-5">
    <div class="panel panel-default m0">
      <div class="panel-heading">
        <div class="panel-title">Viajes recientes</div>
      </div>
      <!-- START viajes list group-->
      <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 180px;">
        <div data-height="180" data-scrollable="" class="list-group" style="overflow: hidden; width: auto; height: 180px;">
        <!-- START viajes list group item-->
        @foreach ($viajes as $viaje)
          <a href="#" class="list-group-item">
            <div class="media-box">
              <div class="media-box-body clearfix">
                <small class="pull-right">{{$viaje->created_at}}</small>
                <strong class="media-box-heading text-primary">No. {{$viaje->id}}</strong>
                <p class="mb-sm">
                  <small>{{$viaje->nombre}}</small>
                  <small>-</small>
                  <small>{{$viaje->concepto}}</small>
                  <small>-</small>
                  <small>{{$viaje->monto}}</small>
                </p>
              </div>
            </div>
          </a>
        @endforeach
          <!-- END viajes list group item-->
        </div>
        <div class="slimScrollBar" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 21px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 103.514px;">
        </div>
        <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;">   
        </div>
      </div>
      <!-- END viaje list group-->
      <!-- START panel footer-->
      <div class="panel-footer clearfix">
        {{--  <div class="">
          <button type="button" class="mb-sm btn bg-warning-dark btn-labeled btn-green  text-white" data-url = "">
          <span class="btn-label">
            <i class="fa fa-plus fa-inverse text-white"></i>
          </span>
          Asignar Viaje
          </button>
        </div>  --}}
      </div>
      <!-- END panel-footer-->
    </div>
  </div>
  <div class="col-md-5">
    <div class="panel panel-default m0">
      <div class="panel-heading">
        <div class="panel-title">Gastos recientes</div>
      </div>
      <!-- START list group-->
      <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 180px;">
        <div data-height="180" data-scrollable="" class="list-group" style="overflow: hidden; width: auto; height: 180px;">
          <!-- START list group item-->
        @foreach ($gastos as $gasto)

          <a href="="{{route('gastos.show',$gasto->id)}}" class="list-group-item">
            <div class="media-box">
              <div class="media-box-body clearfix">
                <small class="pull-right">{{$gasto->created_at}}</small>
                <strong class="media-box-heading text-primary">No.{{$gasto->id}}</strong>
                <p class="mb-sm">
                  <small>{{$gasto->descripcion}}</small>
                  <small>-</small>
                  <small>{{$gasto->monto}}</small>
                </p>
              </div>
            </div>
          </a>
       @endforeach
        <!-- END list group item-->
        </div>
        <div class="slimScrollBar" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 21px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 103.514px;"></div>
        <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div>
      </div>
      <!-- END list group-->
      <!-- START panel footer-->
      <div class="panel-footer clearfix">
        {{--  <div class="">
          <button type="button" class="mb-sm btn bg-warning-dark btn-labeled btn-green  text-white" data-url = "">
            <span class="btn-label">
              <i class="fa fa-plus fa-inverse text-white"></i>
            </span>
            Registrar Gasto
          </button>
        </div>  --}}
      </div>
      <!-- END panel-footer-->
    </div>
  </div>
  <div class="col-md-2">
    <div class="panel panel-default m0">
      <div class="panel-heading">
        <div class="panel-title">Estadisticas</div>
      </div>
      <!-- START list group-->
      <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 180px;">
        <div data-height="180" data-scrollable="" class="list-group" style="overflow: hidden; width: auto; height: 180px;">
          <a href="#" class="list-group-item">
            <div class="media-box">
              <div class="media-box-body clearfix">
                <small class="pull-right"></small>
                <strong class="media-box-heading text-primary">Productividad</strong>
                <p class="mb-sm">
                  <small>85%</small>
                </p>
              </div>
            </div>
          </a>
          <a href="#" class="list-group-item">
            <div class="media-box">
              <div class="media-box-body clearfix">
                <small class="pull-right"></small>
                <strong class="media-box-heading text-primary">Depreciacion</strong>
                <p class="mb-sm">
                  <small>Cliente</small>
                </p>
              </div>
            </div>
          </a>
        </div>
        <div class="slimScrollBar" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 21px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 103.514px;">
        </div>
        <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;">
        </div>
      </div>
      <!-- END list group-->
      <!-- START panel footer-->
      <div class="panel-footer clearfix">
        <div class="">
        </div>
      </div>
      <!-- END panel-footer-->
    </div>
  </div>
  <!-- END panel-->
@endsection
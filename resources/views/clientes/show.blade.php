@extends('layouts.app')
@section('content')
<div class="content-heading">
  <!-- START Language list-->
  <div class="pull-right">
    <div class="btn-group">
      <a href="{{route('clientes.index')}}" class="mb-sm btn btn-default btn-labeled">
        <span class="btn-label">
          <i class="fa fa-arrow-left"></i>
        </span>
        Ir Atras
      </a>
    </div>
  </div>
  <!-- END Language list-->
  Clientes
  <small data-localize="">Detalle de Cliente</small>
</div>
<div class="col-md-12">
  <!-- START panel-->
  <div class="panel panel-default">
    <div class="panel-body">
      
      <div class=" col-md-10">
        <div class="col-md-3">
          {{--  <img style="margin-top: 25px;width: 250px;height: 250px;" src="{{asset('images/clientes/cliente.jpg')}}" alt="Image" class="img-thumbnail thumb256 img-responsive img-circle">  --}}
          <em class="fa fa-users fa-5x " style="margin-top: 0;"></em>

        </div>
        <div class="col-md-3">
          <h4>Nombre</h4>
          <blockquote>
            <p>{{$cliente->nombre}}</p>
          </blockquote>
          <h4>Direccion</h4>
          <blockquote>
            <p>{{$cliente->direccion}}</p>
          </blockquote>
          <h4>Telefono</h4>
          <blockquote>
            <p>{{$cliente->telefono}}</p>
          </blockquote>
        </div>
        <div class="col-md-3">
          <h4>RNC</h4>
          <blockquote>
            <p>{{$cliente->RNC}}</p>
          </blockquote>
          <h4>Email</h4>
          <blockquote>
            <p>{{is_null($cliente->email) ? "-" : $cliente->email}}</p>
          </blockquote>
          <h4>Estado</h4>
          <blockquote>
            <p>
              @if ($cliente->active)
              {{"Activo"}}
              @else
              {{"Inactivo"}}
              @endif
            </p>
          </blockquote>
        </div>
        <div class="col-md-3">
          <h4>Fecha</h4>
          <blockquote>
            <p>2017/08/08</p>
          </blockquote>
          
        </div>
      </div>
      <div class="col-md-2">
        <button type="button" class="pull-right btn btn-labeled btn-primary edit-btn text-white" data-url = "{{route('clientes.edit',$cliente->id)}}">
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
<div class="col-md-8">
  <div class="panel panel-default m0">
    <div class="panel-heading">
      <div class="panel-title">Facturas recientes</div>
    </div>
    <!-- START list group-->
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 180px;"><div data-height="180" data-scrollable="" class="list-group" style="overflow: hidden; width: auto; height: 180px;">
      <!-- START list group item-->
      @foreach ($facturas as $ft)
      
        <a href="{{route('facturas.show',$ft->id)}}" class="list-group-item" target="_blank">
          <div class="media-box">
            <div class="media-box-body clearfix">
              <small class="pull-right">{{$ft->created_at}}</small>
              <strong class="media-box-heading text-primary">No. {{$ft->no_factura}}</strong>
              <p class="mb-sm">
                <small>{{$ft->comentario}}</small>
                <small>-</small>
                <small>{{number_format($ft->monto,2)}}</small>
              </p>
            </div>
          </div>
        </a>
      @endforeach
      
      <!-- END list group item-->
      </div><div class="slimScrollBar" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 21px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 103.514px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
      <!-- END list group-->
      <!-- START panel footer-->
      {{--  <div class="panel-footer clearfix">
        <div class="">
          <button type="button" class="mb-sm btn btn-success btn-labeled btn-green  text-white" data-url = "">
          <span class="btn-label">
            <i class="fa fa-plus fa-inverse text-white"></i>
          </span>
          Crear Factura
          </button>
        </div>
      </div>  --}}
      <!-- END panel-footer-->
    </div>
  </div>
  <div class="col-md-4">
    {{--  <div class="panel panel-default m0">
      <div class="panel-heading">
        <div class="panel-title">Camiones asignados</div>
      </div>
      <!-- START list group-->
      <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 180px;"><div data-height="180" data-scrollable="" class="list-group" style="overflow: hidden; width: auto; height: 180px;">
        <!-- START list group item-->
        <a href="#" class="list-group-item">
          <div class="media-box">
            <div class="media-box-body clearfix">
              <small class="pull-right">timestamp</small>
              <strong class="media-box-heading text-primary">No. Chasis</strong>
              <p class="mb-sm">
                <small>Chofer</small>
                <small>-</small>
                <small>Aydante</small>
              </p>
            </div>
          </div>
        </a>
        <a href="#" class="list-group-item">
          <div class="media-box">
            <div class="media-box-body clearfix">
              <small class="pull-right">timestamp</small>
              <strong class="media-box-heading text-primary">No. Chasis</strong>
              <p class="mb-sm">
                <small>Chofer</small>
                <small>-</small>
                <small>Aydante</small>
              </p>
            </div>
          </div>
        </a>
        <a href="#" class="list-group-item">
          <div class="media-box">
            <div class="media-box-body clearfix">
              <small class="pull-right">timestamp</small>
              <strong class="media-box-heading text-primary">No. Chasis</strong>
              <p class="mb-sm">
                <small>Chofer</small>
                <small>-</small>
                <small>Aydante</small>
              </p>
            </div>
          </div>
        </a>
        <a href="#" class="list-group-item">
          <div class="media-box">
            <div class="media-box-body clearfix">
              <small class="pull-right">timestamp</small>
              <strong class="media-box-heading text-primary">No. Chasis</strong>
              <p class="mb-sm">
                <small>Chofer</small>
                <small>-</small>
                <small>Aydante</small>
              </p>
            </div>
          </div>
        </a>
        <a href="#" class="list-group-item">
          <div class="media-box">
            <div class="media-box-body clearfix">
              <small class="pull-right">timestamp</small>
              <strong class="media-box-heading text-primary">No. Chasis</strong>
              <p class="mb-sm">
                <small>Chofer</small>
                <small>-</small>
                <small>Aydante</small>
              </p>
            </div>
          </div>
        </a>
        
        <!-- END list group item-->
        </div><div class="slimScrollBar" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 21px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 103.514px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
        <!-- END list group-->
        <!-- START panel footer-->
        <div class="panel-footer clearfix">
          <div class="">
            <button type="button" class="mb-sm btn bg-warning-dark  btn-warning btn-labeled text-white" data-url = "">
            <span class="btn-label">
              <i class="fa fa-plus fa-inverse text-white"></i>
            </span>
            Asignar Camion
            </button>
          </div>
        </div>
        <!-- END panel-footer-->
      </div>  --}}
    </div>
    <!-- END panel-->
    @endsection
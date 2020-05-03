@extends('layouts.app')
@section('content')
  <div class="content-heading">
    <!-- START Language list-->
    <div class="pull-right">
      <div class="btn-group">
        <a href="{{route('gastos.index')}}" class="mb-sm btn btn-default btn-labeled">
          <span class="btn-label">
            <i class="fa fa-arrow-left"></i>
          </span>
          Ir Atras
        </a>
      </div>
    </div>
    <!-- END Language list-->
    Gastos
    <small data-localize="">Detalle de Gastos</small>
  </div>
  <div class="col-md-12">
    <!-- START panel-->
    <div class="panel">
      <div class="panel-body">
        
        <div class=" col-md-10">
          <div class="col-md-4">
            <h4>No. Placa</h4>
            <blockquote>
              <p>{{$gasto->matricula}}</p>
            </blockquote>
            <h4>Concepto</h4>
            <blockquote>
              <p>{{$gasto->concepto}}</p>
            </blockquote>
          </div>
          <div class="col-md-4">
            <h4>Monto</h4>
            <blockquote>
              <p>{{number_format($gasto->monto,2)}}</p>
            </blockquote>
            <h4>Fecha</h4>
            <blockquote>
              <p>{{$gasto->date}}</p>
            </blockquote>
          </div>
          <div class="col-md-4">
            <h4>Galones</h4>
            <blockquote>
              <p>{{is_null($gasto->cant_galones)? "NA" : $gasto->cant_galones}}</p>
            </blockquote>
            <h4>Creado Por</h4>
            <blockquote>
              <p>{{$gasto->name}}</p>
            </blockquote>
          </div>
        </div>
        <div class=" col-md-2">
          <!-- edit -->
          <button type="button" class="pull-right btn btn-labeled  btn-primary edit-btn text-white" data-url = "{{route('gastos.edit',$gasto->id)}}">
          <span class="btn-label">
            <i class="fa fa-pencil fa-inverse text-white"></i>
          </span>
          Editar
          </button>
        </div>
      </div>
      <div class="panel-footer bg-gray-dark">
        
      </div>
    </div>
  </div>
  <!-- END panel-->
@endsection
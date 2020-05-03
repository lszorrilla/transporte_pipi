@extends('layouts.app')

@section('content')
<div class="content-heading">
  <!-- START Language list-->
  <div class="pull-right">
    <div class="btn-group">
    </div>
  </div>
  <!-- END Language list-->
  Clientes
  <small data-localize="">Listado de Clientes</small>
</div>
<div class="col-md-12">
  <div class="col-md-4">
    <button type="button" id="crear_cliente_btn" class="mb-sm btn btn-labeled btn-primary text-white" data-url = "{{route('clientes.create')}}">
    <span class="btn-label">
      <i class="fa fa-plus fa-inverse text-white"></i>
    </span>
    Crear Cliente
    </button>
  </div>
  <div class="col-md-4 pull-right">
    <div class="panel widget ">
      <div class="row row-table row-flush">
        <div class="col-xs-4 bg-danger  text-center">
          <em class="fa fa-users fa-2x"></em>
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
                  <th>Nombre</th>
                  <th>RNC</th>
                  <th>Telefono</th>
                  <th>Correo</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($clientes as $cliente)
                <!--  -->
                <tr>
                  <td>
                    <div class="media">
                      {{--  <img src="{{asset('images/clientes/cliente.jpg')}}" alt="Image" class="media-box-object img-circle thumb32">  --}}
                      <em class="fa fa-users " style="margin-top: 0;"></em>

                    </div>
                  </td>
                  <td>{{$cliente->nombre}}</td>
                  <td>{{$cliente->RNC}}</td>
                  <td>{{$cliente->telefono}}</td>
                  <td>{{is_null($cliente->email) ? "-" : $cliente->email}}</td>
                  <td><a href="{{route('clientes.show',$cliente->id)}}" class="link"><em class="fa fa-eye"></em></a></td>
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
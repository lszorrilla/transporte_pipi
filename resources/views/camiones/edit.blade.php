{!!  Form::open( ['route' => ['camiones.update', $camion[0]->id], 'method' => 'PUT','files'=>true]) !!}
{{ csrf_field() }}
<fieldset>
  <div class="form-group col-md-6">
    <div class="checkbox c-checkbox">
      <label>
        <input name="active" value="1" checked="" type="checkbox">
        <span class="fa fa-check"></span>Activo</label>
    </div>
    </div>
    <div class="form-group col-md-6">
      <label for="input-chasis" class="">Chasis</label>
      <input id="input-chasis" type="text" placeholder="Escriba el chasis" class="form-control input-sm" name="chasis" value="{{ $camion[0]->chasis }}">
    </div>

    <div class="form-group col-md-6">
      <label for="input-placa" class="">Placa</label>
      <input id="input-placa" type="text" placeholder="Escriba la placa" class="form-control input-sm" name="placa" value="{{ $camion[0]->matricula }}">
    </div>

    <div class="form-group col-md-6">
      <label for="input-marca" class="">Modelo</label>
      <input id="input-marca" type="text" placeholder="Escriba el modelo" class="form-control input-sm" name="modelo" value="{{ $camion[0]->modelo }}" >
    </div>
    <div class="form-group col-md-6">
      <label for="input-marca" class="">Marca</label>
      <input id="input-marca" type="text" placeholder="Escriba la marca" class="form-control input-sm marca" name="marca" value="{{ $camion[0]->marca }}">
    </div>
    <div class="form-group col-md-6">
      <label for="input-capacidad" class="">Capacidad</label>
      <input id="input-capacidad" type="text" placeholder="Escriba la correo" class="form-control input-sm" name="capacidad" value="{{ $camion[0]->capacidad }}">
    </div>
    <div class="form-group col-md-6">
      <label class="control-label">Tipo de Camion</label>
      <select class="form-control select2 input-sm" name="tipo">
        @foreach ($tipo_camiones as $tipo)
        <option value="{{$tipo->id}}">{{$tipo->descripcion}}</option>
        @endforeach
      </select>
    </div>
  </fieldset>
  <fieldset>
    <div class="form-group col-md-6">
      <label class="control-label">Chofer</label>
      <select class="form-control select2 input-sm" name="chofer" id="">
        @foreach ($choferes as $chofer)
        <option value="{{$chofer->id}}"<?php if ($chofer->id == $camion[0]->chofer_id): ?>
          selected
        <?php endif ?>>{{$chofer->id}}|{{$chofer->nombre." ".$chofer->apellido}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-6">
      <label class="control-label">Ayudante a chofer</label>
      <select class="form-control select2 input-sm" name="ayudante" id="">
        <option value="">seleccione un ayudante</option>
        @foreach ($ayudante_chofer as $ayudante)
        <option value="{{$ayudante->id}}" <?php if ($ayudante->id == $camion[0]->id_ayudante): ?>
          selected
        <?php endif ?>>{{$ayudante->id}}|{{$ayudante->nombre." ".$ayudante->apellido}}</option>
        @endforeach
      </select>
    </div>
    {{--  <div class="form-group col-md-6">
      <label class="control-label"></label>
      <input class="input-sm " placeholder="" type="file" name="image"> 
    </div>  --}}
  </fieldset>
  <div class="form-group col-md-">
    <br>
    <input id="save" type="submit"  class="btn-primary form-control" name="submit" value="Actualizar">
  </div>
  {!! Form::close() !!}
  <script type="text/javascript">
    (function(window, document, $, undefined){

      $(function(){

        if ( !$.fn.select2 ) return;

        // Select 2

        $('.select2').select2({
            theme: 'bootstrap'
        });
        

      });

    })(window, document, window.jQuery);
  </script>
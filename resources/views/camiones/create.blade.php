{!!  Form::open( ['route' => ['camiones.store'], 'method' => 'POST','files'=>true]) !!}
{{ csrf_field() }}
<fieldset>
  
    <div class="form-group col-md-4">
      <label for="input-chasis" class="">Chasis</label>
      <input id="input-chasis" type="text" placeholder="Escriba el chasis" class="form-control input-sm" name="chasis">
    </div>
    <div class="form-group col-md-4">
      <label for="input-placa" class="">Placa</label>
      <input id="input-placa" type="text" placeholder="Escriba el numero de placa" class="form-control input-sm" name="placa">
    </div>
    <div class="form-group col-md-4">
      <label for="input-modelo" class="">Modelo</label>
      <input id="input-modelo" type="text" placeholder="Escriba el modelo" class="form-control input-sm" name="modelo" >
      
    </div>
    <div class="form-group col-md-4">
      <label for="input-marca" class="">Marca</label>
      <input id="input-marca" type="text" placeholder="Escriba la marca" class="form-control input-sm marca" name="marca" >
    </div>
    <div class="form-group col-md-4">
      <label for="input-capacidad" class="">Capacidad</label>
      <input id="input-capacidad" type="text" placeholder="Capacidad" class="form-control input-sm" name="capacidad" >
    </div>
    
    <div class="form-group col-md-4">
      <label class="control-label">Chofer</label>
      <select class="form-control select2 input-sm" name="chofer" id="">
        @foreach ($choferes as $chofer)
        <option value="{{$chofer->id}}">{{$chofer->id}}|{{$chofer->nombre." ".$chofer->apellido}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-6">
      <label class="control-label">Tipo de Camion</label>
      <select class="form-control select2 input-sm" name="tipo">
        @foreach ($tipo_camiones as $tipo)
        <option value="{{$tipo->id}}">{{$tipo->descripcion}}</option>
        @endforeach
      </select>
    </div>
    <!--<div class="form-group col-md-6">
      <label class="control-label"></label>
      <input class="input-sm " placeholder="" type="file" name="image"> 
       
      <div class="bootstrap-filestyle input-group">
        <input class="form-control " placeholder="" disabled="" type="file" name="image"> 
        <span tabindex="0" class="group-span-filestyle input-group-btn">
          <label for="filestyle-0" class="btn btn-default ">
            <span class="icon-span-filestyle glyphicon glyphicon-folder-open"></span> 
            <span class="buttonText">Buscar imagen</span>
          </label>
        </span>
      </div> -->
    </div>
  </fieldset>
  <div class="form-group col-md-">
    <br>
    <input id="save" type="submit"  class="btn-primary form-control" name="submit" value="Guardar">
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
{!!  Form::open( ['route' => ['gastos.update',$gasto->id], 'method' => 'PUT','files'=>true]) !!}

{{ csrf_field() }}
<fieldset>
  <div class="col-md-12">
    <div class="form-group col-md-4">
      <label class="control-label">Concepto</label>
      <select class="form-control select2 input-sm" name="concepto" id="" required="">
        @foreach ($concepto_gastos as $concepto)
            <option value="{{$concepto->id}}" @if ($concepto->id == $gasto->concepto_id)
              selected 
            @endif>{{$concepto->descripcion}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-4">
      <label class="control-label">Camion</label>
      <select class="form-control select2 input-sm" name="camion" id="" required="">
        @foreach ($camiones as $camion)
            <option value="{{$camion->id}}" @if ($camion->id == $gasto->camion_id)
              selected 
            @endif>{{$camion->matricula}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group col-md-4">
      <label for="input-date" class="">Fecha</label>
      <input id="input-date" type="text" placeholder="" class="form-control input-sm datepicker" name="date" value="{{$gasto->date}}" required="">
    </div> 
    <div class="form-group col-md-4">
      <label for="input-monto" class="">Monto</label>
      <input id="input-monto" type="number" placeholder="monto" class="form-control input-sm" name="monto" value="{{$gasto->monto}}" required="">
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group col-md-4">
      <label for="input-date" class="">Galones</label>
      <input id="" type="text" placeholder="" class="form-control input-sm" name="galones" value="{{$gasto->cant_galones}}">
    </div>
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
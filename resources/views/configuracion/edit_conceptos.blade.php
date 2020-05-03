{!!  Form::open( ['route' => ['conceptos.update',$concepto->id], 'method' => 'PUT']) !!}

{{ csrf_field() }}
<fieldset>
    <div class="form-group col-md-4">
      <label for="input" class="">Descripcion</label>
      <input id="input" type="text" placeholder="" class="form-control input-sm " name="descripcion" value="{{$concepto->descripcion}}">
    </div>
  </fieldset>
  <div class="form-group col-md-">
    <br>
    <input id="save" type="submit"  class="btn-primary form-control" name="submit" value="Guardar">
  </div>
{!! Form::close() !!}
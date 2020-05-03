{!!  Form::open( ['route' => ['clientes.store'], 'method' => 'POST']) !!}
{{ csrf_field() }}
<fieldset>
  <div class="form-group col-md-12">
    <div class="checkbox c-checkbox">
      <label>
        <input checked="" type="checkbox" name="activo">
        <span class="fa fa-check"></span>Activo</label>
      </div>
    </div>
    <div class="form-group col-md-4">
      <label for="input-nombre" class="">Compania</label>
      <input id="input-nombre" type="text" placeholder="Escriba el nombre" class="form-control input-sm" name="nombre" required>
    </div>
    
    <div class="form-group col-md-4">
      <label for="input-direccion" class="">direccion</label>
      <input id="input-direccion" type="text" placeholder="Escriba el direccion" class="form-control input-sm" name="direccion" required>
      
    </div>
    <div class="form-group col-md-4">
      <label for="input-rnc" class="">RNC</label>
      <input id="input-rnc" type="text" placeholder="Escriba la rnc" class="form-control input-sm rnc" name="rnc" required>
    </div>
    <div class="form-group col-md-4">
      <label for="input-telefono" class="">telefono</label>
      <input id="input-telefono" type="text" placeholder="telefono" class="form-control input-sm phone" name="telefono" required>
    </div>
    
    <div class="form-group col-md-4">
      <label for="input-email" class="">email</label>
      <input id="input-email" type="email" placeholder="email" class="form-control input-sm" name="email">
    </div>
    
    {{--  <div class="form-group col-md-6">
      <label class="control-label"></label>
      <input class="form-control " placeholder="" type="file" name="image">
    </div>  --}}
  </fieldset>
  <div class="form-group col-md-">
    <br>
    <input id="save" type="submit"  class="btn-primary form-control" name="submit" value="Guardar">
  </div>
{{-- </form> --}}
{!! Form::close() !!}
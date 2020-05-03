    
<form class=" mb-lg form" role="form" method="post" action="{{route('empleados.store')}}">
    {{ csrf_field() }}    
    <fieldset>
      
      <div class="form-group col-md-6">
          <label for="input-nombre" class="">Nombre</label>
          <input id="input-nombre" type="text" placeholder="Escriba el nombre" class="form-control input-sm" name="nombre" require>
      </div>
        
        
      <div class="form-group col-md-6">
        <label for="input-apellido" class="">Apellido</label>
        <input id="input-apellido" type="text" placeholder="Escriba la apellido" class="form-control input-sm" name="apellido" require>
        
      </div>

      <div class="form-group col-md-6">
        <label for="input-cedula" class="">Cedula</label>
        <input id="input-cedula" type="text" placeholder="Escriba el cedula" class="form-control input-sm cedula" name="cedula" require>
      </div>

        <div class="form-group col-md-6">
            <label for="input-telefono" class="">Telefono</label>
             <input id="input-telefono" type="text" placeholder="Escriba la correo" class="form-control input-sm phone" name="telefono" require>
        </div>

        <div class="form-group col-md-6">
            <label for="input-direccion" class="">Direccion</label>
            <input id="input-direccion" type="text" placeholder="Escriba el año" class="form-control input-sm" name="direccion" require>
        </div>
        

        <div class="form-group col-md-6">
            <label for="input-fecha_nacimiento" class="">Fecha de nacimiento</label>
            <input id="input-fecha_nacimiento" type="text" placeholder="Escriba la fecha denacimiento" class="form-control input-sm datepicker" name="fecha_nacimiento" require>
        </div>
        <div class="form-group col-md-6">
            <label class="control-label">Posicion</label>
           <select class="form-control" name="posicion" id="" require>
               @foreach ($posiciones as $posicion)
                 <option value="{{$posicion->id}}">{{$posicion->descripcion}}</option>
               @endforeach
           </select>
        </div>
        
        <div class="form-group col-md-6">
            <label for="input-correo" class="">Correo</label>
            <input id="input-correo" type="text" placeholder="Escriba la correo" class="form-control input-sm" name="correo">
        </div>
     </fieldset>
      <fieldset>
        <div class="form-group col-md-4">
            <label for="input-trabajo_anterior" class="">Contacto de emergencia</label>
            <input id="input-trabajo_anterior" type="text" placeholder="Escriba el trabajo_anterior" class="form-control input-sm" name="trabajo_anterior" require >
        </div>

        <div class="form-group col-md-4">
            <label for="input-telefono" class="">Telefono</label>
             <input id="input-telefono" type="text" placeholder="Escriba el correo de referencia" class="form-control input-sm phone" name="trabajo_anterior_telefono" require >
        </div>

      </fieldset>

      <div class="form-group col-md-">
          <br>
          <input id="save" type="submit"  class="btn btn-primary form-control" name="submit" value="Guardar">
      </div>
     
</form>
   <script>
                 $('.datepicker').datepicker({
                    dateFormat: 'yy-mm-dd',
                    autoclose: true
                });
            </script>
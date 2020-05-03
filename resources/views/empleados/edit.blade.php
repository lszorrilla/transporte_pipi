@php
  // var_dump($referencia[0]);exit();
@endphp
         {!!  Form::open( ['route' => ['empleados.update', $empleado[0]->id], 'method' => 'PUT']) !!}

          {{ csrf_field() }}    
          <fieldset>
            <div class="form-group col-md-4">
              <label class=" checkbox c-checkbox c-checkbox-rounded">
               <input id="" name="active" value="1" type="checkbox" checked>
               <span class="fa fa-check"></span>Active</label>
            </div>
            <div class="form-group col-md-4">
                <label for="input-nombre" class="">Nombre</label>
                <input id="input-nombre" type="text" placeholder="Escriba el nombre" class="form-control input-sm" name="nombre" value="{{ $empleado[0]->nombre }}" require>
            </div>
            
            <div class="form-group col-md-4">
              <label for="input-apellido" class="">Apellido</label>
              <input id="input-apellido" type="text" placeholder="Escriba la apellido" class="form-control input-sm" name="apellido" value="{{ $empleado[0]->apellido }}" require>
              
            </div>

            <div class="form-group col-md-4">
              <label for="input-cedula" class="">Cedula</label>
              <input id="input-cedula" type="text" placeholder="Escriba el cedula" class="form-control input-sm cedula" name="cedula" value="{{ $empleado[0]->cedula }}" require>
            </div>

              <div class="form-group col-md-4">
                  <label for="input-telefono" class="">Telefono</label>
                   <input id="input-telefono" type="text" placeholder="Escriba la correo" class="form-control input-sm phone" name="telefono" value="{{ $empleado[0]->telefono }}" require>
              </div>

              <div class="form-group col-md-4">
                  <label for="input-direccion" class="">Direccion</label>
                  <input id="input-direccion" type="text" placeholder="Escriba el año" class="form-control input-sm" name="direccion" value="{{ $empleado[0]->direccion }}" require>
              </div>
              

              <div class="form-group col-md-4">
                  <label for="input-fecha_nacimiento" class="">Fecha de nacimiento</label>
                  <input id="input-fecha_nacimiento" type="text" placeholder="Escriba la fecha denacimiento" class="form-control input-sm datepicker" name="fecha_nacimiento" value="{{ $empleado[0]->fecha_nacimiento }}" require>
              </div>
              <div class="form-group col-md-4">
                  <label class="control-label">Posicion</label>
                 <select class="form-control" name="posicion" id="" require>
                     @foreach ($posiciones as $posicion)
                       <option value="{{$posicion->id}}" @if ($empleado[0]->posicion == $posicion->descripcion)
                        selected="true" 
                       @endif>{{$posicion->descripcion}}</option>
                     @endforeach
                 </select>
              </div>
              
              <div class="form-group col-md-4">
                  <label for="input-correo" class="">Correo</label>
                  <input id="input-correo" type="text" placeholder="Escriba la correo" class="form-control input-sm" name="correo" value="{{ $empleado[0]->email }}">
              </div>
           </fieldset>
           <fieldset>
              <div class="form-group col-md-4">
                  <label for="input-trabajo_anterior" class="">Contacto de emergencia</label>
                  <input id="input-trabajo_anterior" type="text" placeholder="Escriba el trabajo_anterior" class="form-control input-sm" name="trabajo_anterior" value="{{ $referencia[0]->descripcion }}" require>
              </div>

              <div class="form-group col-md-4">
                  <label for="input-telefono" class="">Telefono</label>
                   <input id="input-telefono" type="text" placeholder="Escriba el correo de referencia" class="form-control input-sm phone" name="trabajo_anterior_telefono" value="{{ $referencia[0]->telefono }}" require>
              </div>

            </fieldset>
            <div class="form-group col-md-">
                <br>
                <input id="save" type="submit"  class="btn-primary form-control" name="submit" value="Actualizar">
            </div>
        {{-- </form> --}}

        {!! Form::close() !!}
            <script>
                 $('.datepicker').datepicker({
                    dateFormat: 'yy-mm-dd',
                    autoclose: true
                });
            </script>
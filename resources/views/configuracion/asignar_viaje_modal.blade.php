{!!  Form::open( ['route' => ['configuraciones.setasignar_viajes',$viaje_id], 'method' => 'PUT']) !!}

{{ csrf_field() }}
    <div class="form-group col-md-6">
            <label for="input-date_to" class="">Camion</label>
            <select class="form-control select2 input-sm" name="camion_id" id="" required style="width:100% !important;">
            <option selected="" value="all">Todos</option>
                @foreach ($camiones as $camion)
                    <option value="{{$camion->id}}">{{$camion->matricula}}</option>
                @endforeach
            </select>

    </div>
  <div class="form-group">
    <br>
    <input id="save" type="submit"  class="btn-primary form-control" name="submit" value="Guardar">
  </div>
{!! Form::close() !!}

  <script type="text/javascript">
     $(document).ready(function() {

        // Select 2
        $('.select2').select2("");
        


        // $('.select2').select2({
        //     theme: 'bootstrap'
        // });
        

      });

    
  </script>
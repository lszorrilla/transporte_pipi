
<!-- Modal -->
<div id="CamionModal" class="modal " role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
            <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-collapsed">
                Nuevo Camion
            </div>
            <div class="panel-body">
               <form class=" mb-lg form" role="form" method="post" action="{{route('camiones.store')}}">
               {{ csrf_field() }}
                   <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-fabricante" class="">Marca</label>
                            <input id="input-fabricante" type="text" placeholder="Escriba el fabricante" class="form-control input-sm" name="marca">
                        </div>
                        <div class="form-group">
                            <label for="input-matricula" class="">Matricula</label>
                            <input id="input-matricula" type="text" placeholder="Escriba la matricula" class="form-control input-sm" name="matricula">
                        </div>
                        <div class="form-group">
                            <label for="input-color" class="">Color</label>
                            <input id="input-color" type="text" placeholder="Escriba el color" class="form-control input-sm" name="color">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Chofer</label>
                           <select class="form-control" name="chofer">
                              @foreach ($choferes as $chofer)
                                  <option value="{{$chofer->id}}">{{$chofer->id}}|{{$chofer->nombre." ".$chofer->apellido}}</option>
                              @endforeach
                           </select>
                        </div>
                   </div>
                   <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-modelo" class="">Modelo</label>
                            <input id="input-modelo" type="text" placeholder="Escriba el modelo" class="form-control input-sm" name="modelo">
                        </div>
                        <div class="form-group">
                            <label for="input-categoria" class="">Categoria</label>
                            <input id="input-categoria" type="text" placeholder="Escriba la categoria" class="form-control input-sm" name="tipo">
                        </div>
                        <div class="form-group">
                            <label for="input-ano" class="">Año</label>
                            <input id="input-ano" type="text" placeholder="Escriba el año" class="form-control input-sm" name="ano">
                        </div>

                        <div class="form-group">
                            <br>
                            <input id="save" type="submit"  class="btn btn-primary form-control" name="submit" value="Guardar">
                        </div>
                   </div>
               </form>
            </div>
        </div>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
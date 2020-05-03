@extends('layouts.app')

@section('content')
<div class="content-heading">
  <!-- START Language list-->
  <div class="pull-right">
    <div class="btn-group">
    </div>
  </div>
  <!-- END Language list-->
  Factura #<span>{{str_pad($factura->no_factura, 8, "0", STR_PAD_LEFT )}}</span> <span class="pull-right">NCF: {{$factura->NCF}}</span>
  <small style="color: red">(Edicion)</small>
  
</div>
<div class="col-md-12">
	
	<form action="{{route('facturas.update',$factura->id)}}"  id="f_form" data-parsley-validate="" novalidate="" onsubmit="event.preventDefault();return false;">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="panel panel-default">
			<div class="panel-heading">
				<small></small>
			</div>
			<div class="panel-body">			
				    <div class="row">
					<div class="form-group col-md-4 ">
				      <label class="control-label">Datos del Cliente</label>
				      <input type="hidden" name="cliente" value="{{$cliente->id}}">
				    </div>
				    </div>
				    <div class="col-md-3">
			          <h4>Nombre</h4>
			          
			            <span class="border-left" id="cliente_nombre">{{$cliente->nombre}}</span>
			          
			          <h4>Direccion</h4>
			          
			            <span class="border-left" id="cliente_direccion">{{$cliente->direccion}}</span>
			          
			          
			        </div>
			        <div class="col-md-3">
			          <h4>RNC</h4>
			          
			            <span class="border-left" id="cliente_RNC">{{$cliente->RNC}}</span>
			          
			          <h4>Email</h4>
			          
			            <span class="border-left" id="cliente_email">{{$cliente->email}}</span>
			          
			        </div>
			        <div class="col-md-3">
			        	<h4>Telefono</h4>
			          
			            <span class="border-left" id="cliente_telefono">{{$cliente->telefono}}</span>
			          
			        </div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="col-md-3">
				<h4>Anular Factura</h4>

				<select name"anular" class="form-control">
					<option value="1">Si</option>
					<option value="0" selected>No</option>
				</select>

			</div>
			<div class="panel-heading">
				<small>Factura detalle</small>

			</div>
			<div class="panel-body">
				<div class="well" id="ft_detail_container">
					@foreach ($factura_detaill as $element)
					<div class="row ft_detail">
						<div class="form-group col-md-4">
							<label class="control-label">Item</label>
							<select class="form-control select2 input-sm" name="item[{{$element->id}}]" id="" required>
								@foreach ($items as $item)
									<option value="{{$item->id}}" <?php if ($element->id_producto_facturacion == $item->id): ?>
										<?php echo "selected" ?>
									<?php endif ?>>{{$item->descripcion}}</option>
								@endforeach
							</select>
						</div>

						<div class="col-md-3">
							<label class="control-label">Descripcion</label>
							<input type="text" name="desc[{{$element->id}}]" class="form-control input-sm" placeholder="descripcion" value="{{$element->concepto}}" >
						</div>
						<div class="col-md-3">
							<label class="control-label">Precio</label>
							<input id="{{$element->id}}" type="number" name="monto[{{$element->id}}]" class="form-control input-sm amount" placeholder="monto" onkeyup="calcular_total()" value="{{$element->monto}}" required="" step="0.01">
						</div>
						
						<button type="button" id="{{$element->id}}" class="remove_ft_detail mb-sm btn btn-link btn-danger  " >
						    <span class="">
						      <i class="fa fa-trash-o "></i>
						    </span>
					    </button>
					    <hr class="col-md-8">
					</div>
					@endforeach
				</div>
				<div>
					<div class="col-md-4">
						<label class="control-label">Obervaciones</label>
						<textarea rows="10" class="form-control note-editor" name="comment">{{$factura->comentario}}</textarea>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="">
					<h3>Total:<span id="grand_total">{{number_format($factura->monto,2)}}</span></h3>
					<input type="hidden" name="grand_total" id="grand_total_input" value="{{$factura->monto}}">
				</div>
				<div class="">
					<button name="Guardar" class="btn mb-sm btn-labeled btn-primary" id="enviar_ft_btn">Guardar</button>
					{{-- <a href="#" id="">Enviar</a> --}}
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(window).keydown(function(event){
		    if(event.keyCode == 13) {
		      event.preventDefault();
		      return false;
		    }
		 });


	    $("#enviar_ft_btn").on('click',function(element) {
	    	element.preventDefault();

	    	form = $('#f_form').serialize();
	    	// console.log(form);
	    	form_valid = $('#f_form').parsley();
	    	if (form_valid.isValid()) {
	    		element.preventDefault();

	    		$.ajax({
	                data: form,
	                url:  $('#f_form').attr('action'),
	                method:  'PUT',
	                beforeSend: function () {
	                    // $("#resultado").html("Buscando, espere por favor...");
	                },
	                success:  function (response) {
	                    result = JSON.parse(response);
	                    if(result.status == "success"){
	                    		 					
		 					swal ( "Excelente" ,  "Factura guardada exitosamente!" ,  "success" ).then((value) => {
							  window.open(result.url, '_blank');
		 					 location.reload();

							});
	                    }else{

	                    }
	                    
	                }
	            });
	    	}
	    	
	    });

        $("#cliente_select").change(function (element) {
            if ($(this).val() != "") {
                $.ajax({
                    data:  {cliente_id:$(this).val(),_token:'{{csrf_token()}}'},
                    url:   '/clientes/find_cliente',
                    method:  'POST',
                    beforeSend: function () {
                        // $("#resultado").html("Buscando, espere por favor...");
                    },
                    success:  function (response) {
                        result = JSON.parse(response);
                        
                        $("#cliente_nombre").html(result.cliente.nombre);
                        $("#cliente_direccion").html(result.cliente.direccion);
                        $("#cliente_RNC").html(result.cliente.RNC);
                        $("#cliente_email").html(result.cliente.email);
                        $("#cliente_telefono").html(result.cliente.telefono);
                        // $("#resultado").html(response);
                    }
                });
            } else {
                $("#cliente_nombre").html("");
                $("#cliente_direccion").html("");
                $("#cliente_RNC").html("");
                $("#cliente_email").html("");
                $("#cliente_telefono").html("");
            }
            
        });

        $('#add_ft_detail').click(function (element) {
             var s = $( ".ft_detail:first" ).clone().find('.hidden_button').removeClass('hidden_button').end();
             $('#ft_detail_container').append(s);
             calcular_total()
        });

        $('#ft_detail_container').on('click','.remove_ft_detail',function (element) {
        	swal("Esta seguro que desea eleminiar este item?", {
			  buttons: ["Cancel!", true],
			  icon: "warning"
			}).then((value) => {
			  // window.open(result.url, '_blank');
			  if (value == 1) {
				  var parent = $( this ).parent();
				$.ajax({
					data:  {_token:'{{csrf_token()}}'},
					url:   $("#baseurl").val() + "/facturas/" + $(this).attr("id"),
					method:  'DELETE',
					beforeSend: function () {
						// $("#resultado").html("Buscando, espere por favor...");
					},
					success:  function (response) {
						result = JSON.parse(response);
						$( parent ).remove();
						calcular_total()
						// $("#resultado").html(response);
					}
	            });
			  } else {
			  	console.log("canceled")
			  }
			});
        });
    });

    function calcular_total() {
        var montos = $( ".amount" );
        // console.log(montos)
        var suma = 0;
        $( ".amount" ).each(function() {
        	val = $( this ).val();
        	if (val == "") {
        		val = 0;
        	}
          suma += parseFloat(val);
        });
        $('#grand_total').text(new Intl.NumberFormat('en-US',{minimumFractionDigits:2,maximumFractionDigits:2}).format(suma));
        $('#grand_total_input').val(suma.toFixed(2));
    }
</script>
@endsection

@extends('layouts.app')

@section('content')
<div class="content-heading">
  <!-- START Language list-->
  <div class="pull-right">
    <div class="btn-group">
    </div>
  </div>
  <!-- END Language list-->
  Facturacion
  <small data-localize="">Nueva Factura</small>
</div>
<div class="col-md-12">
	
	<form action="#"  id="f_form" data-parsley-validate="" novalidate="">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="panel panel-default">
			<div class="panel-heading">
				<small></small>
			</div>
			<div class="panel-body">
				<!-- {!!  Form::open( ['route' => ['facturas.store'], 'method' => 'POST']) !!} -->	
				<div class="row">
						<div class="form-group col-md-4 ">
							<label class="control-label">Tipo de factura</label>
							<select class="form-control select2 input-sm" name="tipo_ft" id="tipo_ft" required>
							<option selected="" value="">seleccione un tipo de factura</option>
							@foreach ($tipos_ft as $tp)
								<option value="{{$tp->id}}">{{$tp->name}}</option>
							@endforeach
							</select>
						</div>	
						</div>
				    <div class="row">
						
					<div class="form-group col-md-4 ">
				      <label class="control-label">Cliente</label>
				      <select class="form-control select2 input-sm" name="cliente" id="cliente_select" required>
				      	<option selected="" value="">seleccione un cliente</option>
				        @foreach ($clientes as $cliente)
				        	<option value="{{$cliente->id}}">{{$cliente->id}}|{{$cliente->nombre}}</option>
				        @endforeach
				      </select>
				    </div>
				    </div>
				    <div class="col-md-3">
			          <h4>Nombre</h4>
			          
			            <span class="border-left" id="cliente_nombre"></span>
			          
			          <h4>Direccion</h4>
			          
			            <span class="border-left" id="cliente_direccion"></span>
			          
			          
			        </div>
			        <div class="col-md-3">
			          <h4>RNC</h4>
			          
			            <span class="border-left" id="cliente_RNC"></span>
			          
			          <h4>Email</h4>
			          
			            <span class="border-left" id="cliente_email"></span>
			          
			        </div>
			        <div class="col-md-3">
			        	<h4>Telefono</h4>
			          
			            <span class="border-left" id="cliente_telefono"></span>
			          
			        </div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<small>Factura detalle</small>
				<button type="button" id="add_ft_detail" class="mb-sm btn btn-labeled btn-green text-white" >
				    <span class="">
				      <i class="fa fa-plus fa-inverse text-white"></i>
				    </span>
			    </button>
			</div>
			<div class="panel-body">
				<div class="well" id="ft_detail_container">
					<div class="row ft_detail">
						<div class="form-group col-md-3">
							<label class="control-label">Item</label>
							<select class="form-control select2 input-sm" name="item[]" id="" required>
								@foreach ($items as $item)
									<option value="{{$item->id}}">{{$item->descripcion}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-3">
							<label class="control-label">Descripcion</label>
							<input type="text" name="desc[]" class="form-control input-sm" placeholder="descripcion">
						</div>
						<!-- <div class="col-md-3">
							<input type="text" name="mercancia[]" class="form-control input-sm" placeholder="mercancia">
						</div> -->
						<div class="col-md-2">
							<label class="control-label">Precio</label>
							<input type="number" name="monto[]" min="1" class="form-control input-sm amount" placeholder="monto" required="" onkeyup="clear_cant(this)" onchange="clear_cant(this)" step="0.01">	
						</div>
						<div class="col-md-1">
							<label class="control-label">Cant</label>
							<input type="number" name="cant[]" class="form-control input-sm qty" placeholder="Qty" onkeyup="calcular_subtotal(this)" onchange="calcular_subtotal(this)" min="1"  required="">
						</div>	
						<div class="col-md-2">
							<label class="control-label">Monto</label>
							<input type="text"  class="form-control input-sm qty_price" placeholder="total" readonly>	
						</div>
							<label class="control-label"></label>
							<button type="button" id="" class="remove_ft_detail mb-sm btn btn-link btn-danger  hidden_button" >
						    
						      <i class="fa fa-trash-o"></i>

					    </button>
						
						
					    <hr class="col-md-10">
					</div>
				</div>
				<div>
					<div class="col-md-4">
						<label class="control-label">Obervaciones</label>
						<textarea rows="10" class="form-control note-editor" name="comment"></textarea>
					</div>
				</div>
				<div class="pull-right" style="margin-right: 100px;">
					<h3>Total:<span id="grand_total">00.00</span></h3>
					<input type="hidden" name="grand_total" id="grand_total_input">
				</div>
			</div>
			
			<div class="panel-footer">
				<div class="">
					<button class="btn btn-lg btn-labeled btn-primary text-white" id="enviar_ft_btn">Guardar</div>
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
	    	form_valid = $('#f_form').parsley();
	    	if (form_valid.isValid()) {
	    		element.preventDefault();

	    		$.ajax({
	                data: form,
	                url:  '{{route('facturas.store')}}',
	                method:  'POST',
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
			 $( ".ft_detail" ).children("div").children("select").select2("destroy");
			 // console.log($(".ft_detail").children("div").children("select"))
             var s = $( ".ft_detail:first" ).clone().find('.hidden_button').removeClass('hidden_button').end();
             //s.find('select').('option:selected',this).remove();
             $('#ft_detail_container').append(s);
             calcular_total();
			 // $( ".ft_detail" ).children("select").select2();
			 $( ".ft_detail" ).children("div").children("select").select2();

             

        });

        $('#ft_detail_container').on('click','.remove_ft_detail',function () {
        	swal("Esta seguro que desea eleminiar este item?", {
			  buttons: ["Cancel!", true],
			  icon: "warning"
			}).then((value) => {
            	$( this ).parent().remove();
            	calcular_total()
        	});
		});
		
		/*$('.qty').change(function(){
			var $this = $(this);
			var qty = $this.val();
			var precio = $this.parent().prev().children().val();
			var subtotal = parseInt(precio) * parseInt(qty);
			$this.parent().next().children().val(subtotal);
			calcular_total()
		});*/
        
    });

	function calcular_subtotal(elem){
		var qty = elem.value;
		var precio = elem.parentElement.previousElementSibling.children[1].value;
		if (precio != 0 || precio != "") {

			var subtotal = parseFloat(precio) * parseInt(qty);
			elem.parentElement.nextElementSibling.children[1].value = subtotal;
		} else {
			elem.parentElement.nextElementSibling.children[1].value = 0;
		}
		calcular_total();
		// console.log("subtotal:",subtotal)
	}
    function calcular_total() {
        var montos = $( ".qty_price" );

        var suma = 0;
        $( ".qty_price" ).each(function() {
        	val = $( this ).val();
        	if (val == "") {
        		val = 0;
        	}
          suma += parseFloat(val);
        });
        $('#grand_total').text(new Intl.NumberFormat('en-US',{minimumFractionDigits:2,maximumFractionDigits:2}).format(suma));
        $('#grand_total_input').val(suma.toFixed(2));
    }

    function clear_cant(elem) {
    	var precio = elem.value;
		var qty = elem.parentElement.nextElementSibling.children[1].value;
		if (qty != 0 || qty != "") {
			var subtotal = parseFloat(precio) * parseInt(qty);
			elem.parentElement.nextElementSibling.nextElementSibling.children[1].value = subtotal;
		} else {
			elem.parentElement.nextElementSibling.nextElementSibling.children[1].value = 0;

		}
		
		calcular_total();
    }
</script>
@endsection

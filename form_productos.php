<?php 
	$rev = exec('git rev-parse --short HEAD');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo "version 1.0.0.".$rev ?></title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<style>
		#div-productos {
			height: 200px;
			overflow: auto;
		}
	
		.producto-label {
			padding-left: 1em;
		}

		.contador-producto {
			float: right;
		}

		.contador-producto input {
			width: 35px;
			margin-left: 5px;
			margin-right: 5px;
			border: none;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h4>Productos Rev</h4>			
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input type="text" name="inputFrm_01" id="inputFrm_01" class="form-control" value="" required="required" pattern="" title="">					
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<input type="text" name="inputFrm_01" id="inputFrm_01" class="form-control" value="" required="required" pattern="" title="">					
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input type="text" name="inputFrm_01" id="inputFrm_01" class="form-control" value="" required="required" pattern="" title="">					
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<input type="text" name="inputFrm_01" id="inputFrm_01" class="form-control" value="" required="required" pattern="" title="">					
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input type="text" name="inputFrm_01" id="inputFrm_01" class="form-control" value="" required="required" pattern="" title="">					
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<button type="button" id="btn-productos" class="btn btn-large btn-block btn-default">Selecciona tus productos</button>					
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<textarea name="" id="input" class="form-control" rows="3" required="required"></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-md-offset-6">
					<div class="form-group">
						<button type="button" id="btn-encargar" class="btn btn-large btn-block btn-success">Encargar</button>					
					</div>
				</div>
			</div>			
		</div>
	</div>
	</div>
	<div class="modal fade" id="modal-id">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Productos</h4>
				</div>
				<div class="modal-body">
					<div id="div-productos">						
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary">Guardar</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var aProductos = [];
		var oProductos = {};

		var cargaProductos = function() {

			var ul = $('<ul></ul>');
			$(ul).addClass('list-group');

			for (i = 1; i <= 10; i++) {
				var li = $('<li></li>');
				$(li).attr({
					id: 'producto_' + i,
					class: 'list-group-item'
				});

				var chkProducto = $("<input type='checkbox'>");
				$(chkProducto).prop('id', 'chk_producto_' + i);
				$(chkProducto).prop('value', i);
				$(chkProducto).addClass('producto-chk');

				var chkLabel = $("<label> Producto " + i + "</label>");	
				$(chkLabel).addClass('producto-label');

				var lnkRestar = $("<a></a>");
				$(lnkRestar).data('id-producto', i);
				$(lnkRestar).addClass('restar-producto');
				var iconRestar = $("<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>");
				$(lnkRestar).append($(iconRestar));

				var lnkSumar = $("<a></a>");
				$(lnkSumar).data('id-producto', i);
				$(lnkSumar).addClass('sumar-producto');
				var iconSumar = $("<span class='glyphicon glyphicon-plus' aria-hidden='true'></span>");
				$(lnkSumar).append($(iconSumar));

				var inpContador = $("<input type='text'>");
				$(inpContador).prop('id', 'can_productos' + i);
				$(inpContador).addClass('text-center');
				$(inpContador).val(0);

				var divContador =  $("<div></div>");
				$(divContador).prop('id', 'div-contador-producto' + i);
				$(divContador).data('id-producto', i);
				$(divContador).addClass('contador-producto disabled');

				$(divContador).append($(lnkRestar));
				$(divContador).append($(inpContador));
				$(divContador).append($(lnkSumar));
				
				$(li).append($(chkProducto));
				$(li).append($(chkLabel));
				$(li).append($(divContador));

				$(chkProducto).click(function(event) {
					var idProducto = $(divContador).prop('id', 'div-contador-producto' + i);
					console.log($(this).data('id-producto'));
					if ($(divContador).hasClass('disabled')) {
						$(divContador).removeClass('disabled');
					} else {
						$(divContador).addClass('disabled');
					}
				});

				$('.restar-producto').click(function(event) {
					event.preventDefault();
					console.log($(this).parent());
					if ($(this).parent().hasClass('disabled')) {
						return false;
					}
					var idProducto = $(this).data('id-producto');
					var canProducto = $('#can_productos' + idProducto).val();
					$('#can_productos' + idProducto).val(restarProductos(canProducto));
					console.log(canProducto);
					return false;
				});

				$('.sumar-producto').click(function(event) {
					event.preventDefault();
					console.log($(this).parent());
					if ($(this).parent().hasClass('disabled')) {
						return false;
					}
					var idProducto = $(this).data('id-producto');
					var canProducto = $('#can_productos' + idProducto).val();
					$('#can_productos' + idProducto).val(sumarProductos(canProducto));
					console.log(canProducto);
					return false;
				});

				$(ul).append($(li));
			}

			$('#div-productos').append($(ul));
			
			$('#modal-id').modal('show');
		};

		var sumarProductos = function(cantidad) {
			var can = cantidad;
			can++;
			return can;
		};

		var restarProductos = function(cantidad) {
			var can = cantidad;
			can--;

			if (can < 0) {
				can = 0;
			}

			return can;			
		};

		var guardarProductos = function() {

		};

		$(document).ready(function() {
			$('#btn-productos').click(function(event) {
				cargaProductos();				
			});
		});
	</script>
</body>
</html>

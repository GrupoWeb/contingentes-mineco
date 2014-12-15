@extends('template/template')

@section('content')

	<script>
		$(document).ready(function() {
				$('.tablaCatalogo').dataTable( {
					"processing" : true,
					
				"bLengthChange": false,
				"sDom": '<"top"<"col-md-5 col-titulo"><"col-md-4"f>><"col-md-12"rt><"bottom"<"col-md-6"i><"col-md-6"p>><"clear">',
					"iDisplayLength": 20,

					"oLanguage": {
						"sLengthMenu": "Mostrar _MENU_ resultados por p&aacute;gina",
						"sZeroRecords": "No se encontraron registros",
						"sInfo": "Mostrando _START_ a _END_ de _TOTAL_ resultados",
						"sInfoEmpty": "Mostrando 0 a 0 de 0 resultados",
						"sInfoFiltered": "(filtrado de _MAX_ resultados totales)",
						"sSearch":"",
						"sProcessing":"Procesando",
						"oPaginate": {
							"sPrevious":"Anterior",
							"sNext":"Siguiente",
							"sFirst":"Primera",
							"sLast":"Ultima"
							}
					}
				});
				
      $('.tablaCatalogo').each(function(){
      	var txSearch = $(this).closest('.dataTables_wrapper').find('div[id$=_filter] input');

					txSearch.addClass('hidden');
			
				
				var txInfo = $(this).closest('.dataTables_wrapper').find('div[id$=_info]');
				txInfo.addClass('small text-muted');

				var divTitulo = $(this).closest('.dataTables_wrapper').find('.col-titulo');
				divTitulo.html('<h3 class="text-primary">Solicitudes pendientes - Inscripción</h3>');


				var divBoton = $(this).closest('.dataTables_wrapper').find('.col-boton-agregar');

					divBoton.html('<a></a>');

      });
		});
	</script>
	<style>
		.btn { margin-left: 2px; margin-right: 2px;}
		.top { margin-top: 10px;}
		.top h2 {margin-top:0; margin-bottom: 0;}
	</style>
	@if(Session::get('message'))
		<div class="alert alert-{{ Session::get('type') }} alert-dismissable .mrgn-top">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			{{ Session::get('message') }}
		</div>
	@endif
	
	<table class="table table-striped table-bordered table-condensed tablaCatalogo display">
		<thead>
      <tr>     	
        <th>Nombre</th>
        <th>Email</th>
        <th>Producto</th>
        <th>Fecha de solicitud</th>
        <th>Activo</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
		<tbody>
			@foreach($solicitudes as $solicitud)
			<tr>
				<td>{{$solicitud->nombre}}</td>
				<td>{{$solicitud->email}}</td>
				<td>{{$solicitud->producto}}</td>
				<td><?php
					$arrhf = explode(" ",$solicitud->created_at);
					$arrf = explode("-",$arrhf[0]);
					$hora = $arrhf[1];
				
				?>
					{{$arrf[2]."-".$arrf[1]."-".$arrf[0]." ".$hora}}
				</td>
				<td>
					@if($solicitud->activo>0)
						<span class="label label-success" style="display:block; width: 40px; margin:auto;">Si</span>
					@else
						<span class="label label-default" style="display:block; width: 40px; margin: auto;">No</span>
					@endif
				</td>
				<td><a class="btn btn-xs btn-primary" title="Editar" href="/solicitudespendientes/inscripcion/{{Crypt::encrypt($solicitud->usuarioid.'+'.$solicitud->contingenteid)}}/edit"><span class="glyphicon glyphicon-pencil"></span></a></td>
			</tr>
			@endforeach
		</tbody>
 
	</table>

@stop
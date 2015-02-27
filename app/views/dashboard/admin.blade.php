@extends('template/template')

@section('content')
	<div class="col-sm-12">
		<div class="pull-right">
			<?php $tratados = Session::get('tratados'); $selected = Session::get('tselected'); ?>
			<select class="selectpicker" id="cmbTratado">
				<option value="0" {{ (0 == $selected) ? 'selected' : '' }}>-- TODOS --</option>
				@foreach($tratados as $tratado)
					<?php $tid = $tratado->tratadoid; ?>
					<option value="{{ $tid }}" {{ ($tid == $selected) ? 'selected' : '' }}>{{ $tratado->nombrecorto }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="clearfix"></div>
	<br />
	@if(Session::has('message'))
		<div class="alert alert-{{ Session::get('type') }} alert-dismissable">
			{{ Session::get('message') }}
		</div>
	@endif
	
	<?php $tid = Session::get('tselected'); ?>
	@if($tid == 0)
		@foreach($datos as $tratadoid=>$tratado)
			<div class="col-sm-2">
				<button type="button" class="btn btn-{{ $tratado['saldo'] > 0 ? 'primary' : 'defaut' }} btn-lg btn-block tratadobtn" data-tratado="{{ $tratadoid }}">
					<i class="fa fa-file-text-o fa-2x"></i><br/>
					<h3>{{ number_format($tratado['saldo'], 2) }}</h3>
					{{ $tratado['nombrecorto'] }}
				</button><br />
			</div>
		@endforeach
	@else
		@foreach($datos as $tratadoid=>$tratado)
			@if($tratadoid == $tid)
				<div class="col-md-12">
					<div class="panel panel-primary">
					  <div class="panel-heading">
					    <h3 class="panel-title text-center">{{ $tratado['nombrecorto'] }} <small>{{$tratado['tipo']}}</small></h3>
					  </div>
					  <div class="panel-body">
					    <div class="col-md-4 text-center"><h4>{{ number_format($tratado['saldo'], 2) }}<br />Saldo</h4></div>
					    <div class="col-md-4 text-center"><a href="empresas"><h4>{{ $tratado['inscritos'] }}<br />Inscritos</h4></a></div>
					    <div class="col-md-4 text-center"><a href="tratados"><h4>{{ $tratado['contingentes'] }}<br />Contingentes</h4></a></div>
					    <div class="clearfix"></div>
					    
					    <table class="table table-condensed table-striped table-bordered">
					    	<thead>
					    		<tr>
					    			<th>Solicitud</th>
					    			<th class="text-center">Pendientes</th>
					    			<th class="text-center">Aprobadas</th>
					    			<th class="text-center">Rechazadas</th>
					    			<th class="text-center">Total</th>
					    		</tr>
					    	</thead>
					    	<tbody>
					    		@foreach($tratado['solicitudes'] as $nombre=>$datos)
					    			<?php
					    				switch ($nombre) {
					    					case 'inscripcion':
					    						$url = '/solicitudespendientes/inscripcion';
					    						break;

					    					case 'asignacion':
					    						$url = '/solicitudespendientes/asignacion';
					    						break;

					    					case 'emision':
					    						$url = '/solicitudespendientes/emision';
					    						break;
					    				}
					    			?>
					    			<?php $total = 0 ?>
					    			<tr>
					    				<td>{{ ucfirst($nombre) }}</td>
					    				@foreach($datos as $key=>$value)
					    					@if($key == 'Pendiente' && $value <> 0)
					    						<td class="text-center"><a href="{{ $url }}">{{ $value ? $value : 0 }}</a></td>
					    					@else
					    						<td class="text-center">{{ $value ? $value : 0 }}</td>
					    					@endif
												<?php $total += $value; ?>
					    				@endforeach
					    				<td class="text-center"><strong>{{ $total }}</strong></td>
					    			</tr>
					    		@endforeach
					    	</tbody>
					    </table>
					  </div>
					</div>
				</div>
			@endif
		@endforeach
	@endif	

	<script>
		$(document).ready(function(){
			$('.tratadobtn').click(function(){
				$.get('/changetratado/' + $(this).attr('data-tratado'), function(data){
					location.reload(true); 
				});
			});
		});
	</script>
@stop
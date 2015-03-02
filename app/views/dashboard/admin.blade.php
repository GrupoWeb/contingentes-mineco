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
				<button type="button" class="btn btn-default btn-lg btn-block tratadobtn" data-tratado="{{ $tratadoid }}">
					<i class="fa fa-file-text-o fa-2x"></i><br/>
					{{ $tratado['nombrecorto'] }}<br />
					<small>{{ $tratado['tipo'] }}</small>
				</button><br />
			</div>
		@endforeach
	@else
		@foreach($datos as $tratadoid=>$tratado)
			@if($tratadoid == $tid)
				<h1 class="titulo">{{ $tratado['nombrecorto'] }} <small>{{$tratado['tipo']}}</small></h1>
		    <div class="contenido contenido-full">
		      <div class="col-md-12">
		      	<h4 class="titulo">Solicitudes</h4>
		      	<table class="table table-condensed table-bordered table-white">
				    	<thead>
				    		<tr>
				    			<th>&nbsp;</th>
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
				    				<td><strong>{{ ucfirst($nombre) }}</strong></td>
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

		      	<h4 class="titulo">Contingentes</h4>
		      	<table class="table table-condensed table-bordered table-white">
				    	<thead>
				    		<tr>
				    			<th class="text-center">Contingente</th>
				    			<th class="text-center">Empresas inscritas</th>
				    			<th class="text-center">Saldo</th>
				    		</tr>
				    	</thead>
				    	<tbody>
				    		<?php $totalempresas = 0; ?>
				      	@foreach($tratado['contingentes'] as $contingente)
				      		<tr>
										<td>{{ $contingente['nombre'] }}</td>
										<td class="text-right">
											@if($contingente['inscritos'] <> 0)
												<a href="/empresas?contingente={{Crypt::encrypt($contingente['contingenteid']) }}">
													{{ number_format($contingente['inscritos']) }}
												</a>
												<?php $totalempresas += $contingente['inscritos']; ?>
											@else
												{{ '0' }}
											@endif
										</td>
										<td class="text-right">
											@if($contingente['saldo'] <> 0)
												<a href="/tratado/graficas/saldo/{{ Crypt::encrypt($contingente['contingenteid']) }}" target="_blank">
													{{ number_format($contingente['saldo'], 3) }}
												</a>
											@else
												{{ '0.000' }}
											@endif
										</td>
									</tr>
				      	@endforeach
				      	<tr>
				      		<td class="text-right"><strong>TOTAL</strong></td>
				      		<td class="text-right">
				      			<a href="/empresas">
				      				<strong>{{ number_format($totalempresas) }}</strong>
				      			</a>
				      		</td>
				      		<td>&nbsp;</td>
				      	</tr>
				      </tbody>
				    </table>
		      </div>
		      <div class="clearfix"></div>
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
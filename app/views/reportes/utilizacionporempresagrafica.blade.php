@extends('template/reporte')
@section('content')

	<table class="table table-striped table-bordered blue">
		<thead>
			<tr>
				<th rowspan="2" colspan="1" class="text-center bg-white">
					@if($formato <> 'excel') 
						{{ HTML::image('images/logo.jpg') }}
					@endif
					<br>DACE - MINECO
				</th>
				<th rowspan="1" colspan="3" class="text-center bg-white" id="titulo"><h4>{{$titulo}}</h4></th>				
			</tr>

			<tr>
				<th rowspan="1" colspan="1" class="text-center bg-white" id="tratado">{{ $tratado }}</th>
				<th rowspan="1" colspan="1" class="text-center bg-white" id="producto">{{ $producto }}</th>
				<th rowspan="1" colspan="1" class="text-center bg-white" id="date">Reporte generado {{ date('d/m/Y') }}</th>
			</tr>
		</thead>
	</table>
	<p id = "pie" hidden>{{$esAsignacion}}</p>
	<?php echo HTML::script('js/highcharts.js'); ?>
	<?php echo HTML::script('js/highcharts-exporting.js'); ?>
	@if(!empty($movimientos))
		<div id="container" style="height: 600px; margin: 0 auto"></div>
	@else
		<h1><font color="red">Noy se encotraron datos para este periodo.</font></h1>
	@endif

	@if($esAsignacion == 1)
		<script type="text/javascript">
			$(function () {
		    $('#container').highcharts({
		        chart: {
		            type: 'bar'
		        },
		        title: {
		            text: ''
		        },
		        xAxis: {
		            categories: [
		            	@foreach($movimientos as $movimiento)
		            		{{ '"'.$movimiento->razonsocial .'",' }}
		            	@endforeach
		            ]
		        },
		        credits: false,
		        yAxis: {
		            min: 0,
		            title: {
		                text: ''
		            }
		        },
		        legend: {
		            reversed: true
		        },
		        plotOptions: {
		            series: {
		                stacking: 'normal'
		            }
		        },
		        series: [{
		            name: 'Saldo',
		            data: [
		            	@foreach($movimientos as $movimiento)
		            		{{ $movimiento->asignado - $movimiento->consumo .',' }}
		            	@endforeach
		            ]
		        }, {
		            name: 'Consumido',
		            data: [
		            	@foreach($movimientos as $movimiento)
		            		{{ $movimiento->consumo .',' }}
		            	@endforeach
		            ]
		        }]
		    });
			});
		</script>
	@else
		<script type="text/javascript">
			$(function () {
				$('#container').highcharts({
	        chart: {
	            plotBackgroundColor: null,
	            plotBorderWidth: null,
	            plotShadow: false
	        },
					colors: 
						['#337ab7', '#5cb85c', '#f7a35c', '#8085e9', '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1'],
	        title: {
	            text: ''
	        },
	        credits : {
	        	enabled: false
	        },
	        exporting: {
	        	enabled: true
	        },
	        tooltip: {
	            pointFormat: '{series.name}: <b>{point.y:,.3f}</b>'
	        },
	        plotOptions: {
	            pie: {
	            		size: '80%',
	                allowPointSelect: true,
	                cursor: 'pointer',
	                dataLabels: {
	                    enabled: true,
	                    format: '<b>{point.name}</b>: {point.y:,.3f}',
	                    style: {
	                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
	                    }
	                }
	            }
	        },
	        series: [{
	            type: 'pie',
	            name: 'Monto',
	            data: [
	            	@foreach($movimientos as $movimiento)
	            		["{{ addslashes($movimiento->razonsocial) }}", {{ $movimiento->consumo}} ],
	            	@endforeach
	            ]
	        }]
	      });
			});
		</script>
	@endif
@stop
@extends('template/reporte')

@section('content')
	<?php echo HTML::script('js/highcharts-exporting.js'); ?>
	<?php echo HTML::script('js/highcharts.js'); ?>

	<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
	@if($asignacion == 1)
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
		            	@foreach($movimientos as $empresa=>$valores)
		            		{{ '"'.$empresa.'",' }}
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
		            name: 'Asignado',
		            data: [
		            	@foreach($movimientos as $empresa=>$valores)
		            		{{ $valores['asignado'].',' }}
		            	@endforeach
		            ]
		        }, {
		            name: 'Emitido',
		            data: [
		            	@foreach($movimientos as $empresa=>$valores)
		            		{{ $valores['emitido'].',' }}
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
	            plotShadow: false,
	            type: 'pie'
	        },
	        credits: false,
	        title: {
	            text: ''
	        },
	        tooltip: {
	            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	        },
	        plotOptions: {
	            pie: {
	                allowPointSelect: true,
	                cursor: 'pointer',
	                dataLabels: {
	                    enabled: false
	                },
	                showInLegend: true
	            }
	        },
	        series: [{
	            name: "Brands",
	            colorByPoint: true,
	            data: [
	            	@foreach($movimientos as $empresa=>$monto)
	            		{ name: "{{ $empresa }}", y: {{ $monto }}},
	            	@endforeach
	            ]
	        }]
	      });
			});
		</script>
	@endif
@stop
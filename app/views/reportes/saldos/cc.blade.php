@extends('template/reporte')

@section('content')
	{{ HTML::script('js/highcharts.js') }}
	{{ HTML::script('js/highcharts-exporting.js') }}

	<div id="container"></div>

	<script>
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
	            	@foreach($empresas as $empresa)
	            		'{{ $empresa["nombre"] }}', 
	            	@endforeach
	            ]
	        },
	        yAxis: {
	            min: 0,
	            title: {
	                text: ''
	            }
	        },
	        legend: {
	            reversed: true
	        },
	        credits : {
	        	enabled: false
	        },
	        exporting: {
	        	enabled: true
	        },
	        plotOptions: {
	            series: {
	                stacking: 'normal'
	            }
	        },
	        series: [{
	            name: 'Asignado',
	            data: [
	            	@foreach($empresas as $empresa)
	            		{{ $empresa['asignado']. ',' }}
	            	@endforeach
	            ]
	        }, {
	            name: 'Consumido',
	            data: [
	            	@foreach($empresas as $empresa)
	            		{{ $empresa['consumido'] . ',' }}
	            	@endforeach
	            ]
	        }]
	    });
		});
	</script>
@stop
@extends('template/reporte')

@section('content')
	{{ HTML::script('js/highcharts.js') }}
	{{ HTML::script('js/highcharts-exporting.js') }}

	<div id="graficacc"></div>

	<script>
		$(function () {
	    $('#graficacc').highcharts({
	        chart: {
	        	height: 800,
	          type: 'bar'
	        },
	        colors: 
						['#337ab7', '#5cb85c', '#f7a35c', '#8085e9', '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1'],
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
            name: 'Saldo',
            data: [
            	@foreach($empresas as $empresa)
            		{{ $empresa['saldo'] . ',' }}
            	@endforeach
            ]
	        },
	        {
            name: 'Consumido',
            data: [
            	@foreach($empresas as $empresa)
            		{{ $empresa['consumido']. ',' }}
            	@endforeach
            ]
	        }]
	    });
		});
	</script>
@stop
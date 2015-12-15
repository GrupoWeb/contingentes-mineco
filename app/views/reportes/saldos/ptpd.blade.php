@extends('template/reporte')

@section('content')
	{{ HTML::script('js/highcharts.js') }}
	{{ HTML::script('js/highcharts-exporting.js') }}
	<div id="container"></div>	
	<script>
		$(function () {
	    $('#container').highcharts({
	        chart: {
	        		height: 800,
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
	            pointFormat: '{series.name}: <b>{point.y:.3f}</b>'
	        },
	        plotOptions: {
	            pie: {
	                allowPointSelect: true,
	                cursor: 'pointer',
	                dataLabels: {
	                    enabled: true,
	                    format: '<b>{point.name}</b>: {point.y:.3f}',
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
	            		['Disponible', {{$saldo }}],
	            	@foreach($empresas as $empresa)
	            		['{{ $empresa["nombre"] }}', {{ $empresa['consumido'] }}],
	            	@endforeach
	            ]
	        }]
	    });
		});
	</script>
@stop
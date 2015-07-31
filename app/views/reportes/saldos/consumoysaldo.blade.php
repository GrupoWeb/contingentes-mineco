	<div id="container{{$contingente->contingenteid}}"></div>	
	<script>
		$(function () {
	    $('#container{{$contingente->contingenteid}}').highcharts({
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
	        	enabled: false
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
	            	@if($grafica[$contingente->contingenteid]['esasignacion'])
	            		['Disponible', {{ $grafica[$contingente->contingenteid]['saldo'] }}],
		            	['Utilizado', {{ $grafica[$contingente->contingenteid]['empresa'] }}],
	            	@else
		            	['Disponible', {{ $grafica[$contingente->contingenteid]['saldo'] }}],
		            	['Mi Empresa', {{ $grafica[$contingente->contingenteid]['empresa'] }}],
		            	['Otras empresas', {{ $grafica[$contingente->contingenteid]['otros'] }}],
	            	@endif
	            ]
	        }]
	    });
		});
	</script>
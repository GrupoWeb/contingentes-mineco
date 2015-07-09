<div id="container"></div>	
<script>
	$(function () {
    $('#container').highcharts({
      chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false
      },
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
        		['Disponible', {{ $saldo }}],
        	@foreach($empresas as $empresa)
        		['{{ $empresa["nombre"] }}', {{ $empresa['consumido'] }}],
        	@endforeach
        ]
      }]
    });
	});
</script>
@if($formato =='excel')
	<?php
	  header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="reporte' . date('YmdHi') . '.xls"');
	?>
	@yield('content')
@else
	<!DOCTYPE html>
	<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<title>DACE - MINECO</title>

		{{ HTML::style('packages/csgt/components/css/bootstrap.min.css'); }}
		{{ HTML::style('packages/csgt/components/css/bootstrap-theme.min.css'); }}
		{{ HTML::style('packages/csgt/components/css/core.css'); }}
		{{ HTML::style('css/reportes.css'); }}
		{{ HTML::script('packages/csgt/components/js/jquery.min.js'); }}
		{{ HTML::script('packages/csgt/components/js/bootstrap.min.js'); }}

		</head>
		<body>
			<div class="container header-fijo">
				<table class="table table-condensed table-bordered">
					<thead>
						<tr>
							<th rowspan="2" class="text-center bg-white" width="10%">
								@if($formato <> 'excel') 
									{{ HTML::image('images/logo.jpg') }}
								@endif
								<br>DACE - MINECO
							</th>
							<th colspan="3" class="text-center bg-white"><h4>{{$titulo}}</h4></th>
						</tr>
						<tr>
							<th width="30%" class="text-center bg-white">{{ $tratado }}</th>
							<th width="30%" class="text-center bg-white">{{ $producto }}</th>
							<th width="30%" class="text-center bg-white">Reporte generado {{ date('d/m/Y') }}</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="container">
				@yield('content')
			</div>
		</body>
	</html>
@endif
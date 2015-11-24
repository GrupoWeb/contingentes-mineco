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
		{{ HTML::style('css/table-scroll-reset.css'); }}
		{{ HTML::style('css/table-scroll-style.css'); }}

		{{ HTML::script('packages/csgt/components/js/jquery.min.js'); }}
		{{ HTML::script('packages/csgt/components/js/bootstrap.min.js'); }}
		{{ HTML::script('packages/csgt/components/js/table-scroll.js'); }}

		</head>
		<body>
			<div class="container-full">
					@yield('content')
			</div>
		</body>
	</html>
@endif
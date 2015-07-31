<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title>DACE - MINECO</title>

	{{ HTML::style('http://fonts.googleapis.com/css?family=Archivo+Narrow|Lato:400,700') }}

	{{ HTML::style('packages/csgt/components/css/bootstrap.min.css') }}
	{{ HTML::style('packages/csgt/components/css/bootstrap-theme.min.css') }}
	{{ HTML::style('packages/csgt/components/css/bootstrap-datetimepicker.min.css') }}
	{{ HTML::style('packages/csgt/components/css/bootstrap-select.min.css') }}
	{{ HTML::style('packages/csgt/components/css/dataTables.bootstrap.css') }}
	{{ HTML::style('packages/csgt/components/css/dataTables.tableTools.min.css') }}
	{{ HTML::style('packages/csgt/components/css/bootstrapValidator.min.css') }}
	{{ HTML::style('packages/csgt/components/css/font-awesome.min.css') }}
	{{ HTML::style('css/dace.css') }}

	{{ HTML::script('packages/csgt/components/js/jquery.min.js') }}
	{{ HTML::script('packages/csgt/components/js/moment-with-locales.min.js') }}
	{{ HTML::script('packages/csgt/components/js/bootstrap.min.js') }}
	{{ HTML::script('packages/csgt/components/js/bootstrap-datetimepicker.min.js') }}
	{{ HTML::script('packages/csgt/components/js/bootstrap-select.min.js') }}
	{{ HTML::script('packages/csgt/components/js/jquery.dataTables.min.js') }}
	{{ HTML::script('packages/csgt/components/js/dataTables.bootstrap.js') }}
	{{ HTML::script('packages/csgt/components/js/dataTables.tableTools.min.js') }}
	{{ HTML::script('packages/csgt/components/js/bootstrapValidator.min.js') }}
	{{ HTML::script('packages/csgt/components/js/bootstrapValidatorExtra.js') }}
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script>
		$(document).ready(function(){
			$(".alert").delay(5000).fadeOut('slow');
		});
	</script>
	</head>
	<body>
		<div class="header">
			<a href="/"><img src="images/logo.jpg" alt="Mineco - DACE"></a>
			<h1 class="blue-title">Contingentes Arancelarios</h1>
		</div>
		<h1 class="titulo">Solicitud de inscripción</h1>
		<div class="main">
			<div class="container">
				@yield('content')
			</div>
		</div>
	</body>
</html>
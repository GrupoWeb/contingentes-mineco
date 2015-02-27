<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="../../assets/ico/favicon.ico">
	
	<title>DACE - MINECO</title>

	{{ HTML::style('packages/csgt/components/css/bootstrap.min.css'); }}
	{{ HTML::style('packages/csgt/components/css/bootstrap-theme.min.css'); }}
	{{ HTML::style('packages/csgt/components/css/core.css'); }}
	{{ HTML::script('packages/csgt/components/js/jquery.min.js'); }}
	{{ HTML::script('packages/csgt/components/js/bootstrap.min.js'); }}

	</head>
	<body>
		<div class="container">
			@yield('content')
		</div>
	</body>
</html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Ingreso</title>

    {{ HTML::style('css/bootstrap.min.css'); }}
    {{ HTML::style('css/core.css'); }}
    {{ HTML::script('js/jquery.min.js'); }}
    {{ HTML::script('js/bootstrap.min.js'); }}
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
		<div class="container">
			<style>
        .panel-login{
          max-width: 500px;
          margin: auto;
          padding: 2.5% 1% 1% 1%;
        }
        
        .panel-login label {
          font-weight: normal;
        }
  
        .btn-login{
          width: 100%;
        }
  
        #lblNoCerrar {
          font-weight: normal;
        }
  
        .logo-panel{
          margin-top: 10px;
          margin-bottom: 10px;
        }
      </style>
      
      <div class="text-muted text-center logo-panel">
        {{ HTML::image('images/logo.png', $alt="Logo Main", $attributes = array('width'=>'100%')) }}
      </div>
  
      <div class="panel panel-default panel-login">
        @yield('content')
      </div>
		</div> <!-- /container -->
    <div class="footer">
      <p class="text-muted text-center">
        <a href="http://cs.com.gt">Compuservice Webdesigns </a> &copy; {{ date('Y') }}
      </p>
		</div>
	</body>
</html>

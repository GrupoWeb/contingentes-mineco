<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Compuservice, S.A.">

  <title>Ministerio de Economía - Contingentes Arancelarios</title>

  {{ HTML::style('http://fonts.googleapis.com/css?family=Archivo+Narrow|Raleway:400,700') }}
  {{ HTML::style('packages/csgt/components/css/bootstrap.min.css'); }}
  {{ HTML::style('css/home.css'); }}
  {{ HTML::style('css/dace.css') }}

  {{ HTML::script('packages/csgt/components/js/jquery.min.js'); }}
  {{ HTML::script('packages/csgt/components/js/bootstrap.min.js'); }}
  <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>
  <nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">
          <img src="/images/logo-menu.png" alt="Ministerio de economía - DACE">
        </a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li>
            <a href="/signup">Solicitud de inscripción</a>
          </li>
          <li>
            <a href="/acuerdoscomerciales">Acuerdos comerciales</a>
          </li>
          <li>
            <a href="/manuales">Manuales</a>
          </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li><a href="/login">Iniciar sesión &nbsp;<span class="glyphicon glyphicon-user"></span></a></li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
  </nav>

  <!-- Page Content -->
  <div class="container">
    @yield('content')
    <footer>
      <div class="row">
        <div class="col-lg-12">
          <p class="text-muted text-center">
            <a href="http://cs.com.gt" target="_blank">Compuservice Webdesigns </a> &copy; {{ date('Y') }}
          </p>
        </div>
      </div>
    </footer>
  </div>
</body>
</html>
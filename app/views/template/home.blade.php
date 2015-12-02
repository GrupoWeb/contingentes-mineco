<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Compuservice, S.A.">

  <title>Ministerio de Economía - Contingentes Arancelarios</title>

  {{ HTML::style('https://fonts.googleapis.com/css?family=Archivo+Narrow|Lato:400,700') }}
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
          <img src="/images/logo-menu.jpg" alt="Ministerio de economía - DACE">
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
  <div class="row fondo">
    <div class="container">
      @yield('content')
      <div class="footer">
      <div class="col-sm-6">
        <p class="text-muted">8a. Avenida 10-43 Zona 1. 01001 Guatemala, C.A. PBX  (502) 2412-0200</p>
        <p class="text-muted">Horarios de atención Lunes a Viernes 08:00 - 16:00Hrs</p>
      </div>
      <div class="col-sm-6 text-right">
        <p><a href="http://mineco.gob.gt/contactenos" target="_blank">Contáctenos</a></p>
        <p><a href="http://mineco.gob.gt/directorio-sedes-departamentales-y-municipales" target="_blank">Directorio de sedes departamentales, municipales</a></p>
        <p>Última Actualización 02/12/2015</p>
      </div>
      <div class="clearfix"></div>
      <hr>
      <p class="text-muted text-center">
        Todos los derechos reservados | <a href="https://contingentesarancelarios.mineco.gob.gt/">contingentesarancelarios.mineco.gob.gt</a> | {{ date('Y') }} | Powered by <a href="http://cs.com.gt" target="_blank">Compuservice Webdesigns</a>
      </p>
    </div>
    </div>
  </div>
</body>
</html>
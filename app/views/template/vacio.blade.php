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
          <img style="max-width:161px; margin-top: -7px;" src="/images/logo-menu.jpg" alt="Ministerio de economía - DACE">
        </a>
      </div>
    </div>
  </nav>
    <div class="row">
        <div class="container">
            @yield('content')
        </div>
    </div>
</body>
</html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Login Auth">
    <meta name="author" content="Compuservice">
    <title>Registro de Usuarios</title>
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap-select.min.css'); }}
    {{ HTML::script('js/jquery.min.js'); }}
    {{ HTML::script('js/bootstrap.min.js'); }}
    {{ HTML::script('js/bootstrap-select.min.js'); }}
    {{ HTML::script('js/bootstrapValidator.min.js') }}
    <style>
      body { margin: 5px; }
      .form-signin { max-width: 850px;margin: 0 auto;display: block;margin-top: 30px; }
      .form-control-feedback{ z-index: 2000; }
    </style>
    <script>
      $(document).ready(function(){
        $(".alert").delay(5000).fadeOut('slow');
      });
    </script>
  </head>
  <body>
    <?php
      $params = array('id'=>'frmLogin','class'=>'form-horizontal');
      if ($route) $params['route'] = $route;
    ?>
    {{Form::open($params) }}
      <div class="panel panel-default form-signin">
        <div class="panel-body">
          <div class="text-center">
            {{HTML::image(Config::get('login::logo.path'),Config::get('login::logo.alt'))}}
          </div>
          <h5>Datos Generales</h5>
          <hr>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="txNombre" class="col-sm-4 control-label">Nombre</label>
                <div class="col-sm-8">
                  {{ Form::text('txNombre', '', array('class'=>'form-control')) }}
                </div>
              </div>
              <div class="form-group">
                <label for="txPassword" class="col-sm-4 control-label">Password</label>
                <div class="col-sm-8">
                  {{ Form::password('txPassword', array('class'=>'form-control')) }}
                </div>
              </div>
              <div class="form-group">
                <label for="cmbProductos" class="col-sm-4 control-label">Producto</label>
                <div class="col-sm-8">
                  <?php 
                    $prods = array();
                    foreach($productos as $producto)
                      $prods[Crypt::encrypt($producto->productoid)] = $producto->nombre;
                  ?>
                  {{ Form::select('cmbProductos', $prods, null, array('class'=>'selectpicker form-control','id'=>'cmbProductos')) }}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="txNombre" class="col-sm-4 control-label">Email</label>
                <div class="col-sm-8">
                  {{ Form::text('txNombre', '', array('class'=>'form-control')) }}
                </div>
              </div>
              <div class="form-group">
                <label for="txPasswordrepeat" class="col-sm-4 control-label">Repetir Password</label>
                <div class="col-sm-8">
                  {{ Form::password('txPasswordrepeat', array('class'=>'form-control')) }}
                </div>
              </div>
            </div>
          </div>
          <h5>Datos Específicos</h5>
          <hr>
          <div id="especificos"></div>
          @if(Session::get('flashMessage')) 
            <div class="alert alert-{{ Session::get('flashType')?Session::get('flashType'):'danger' }} alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{Session::get('flashMessage')}}
            </div>
          @endif
        </div>
        <div class="panel-footer">
          <div class="row">
            <div class="col-xs-4 pull-right">
              <button type="submit" class="btn btn-large btn-success pull-right">{{Config::get('login::botonsignup')}}</button>
            </div>
          </div>
        </div>
    </div>
    {{Form::close()}}
    <script>
      $(document).ready(function(){

        $("#cmbProductos").change(function() {
          $.get('/signup/requisitos/' + $(this).val(), function(data){
            $('#especificos').html(data);
          });
        });

        $('#frmLogin').bootstrapValidator({
          feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
          }
        });

        $('.selectpicker').selectpicker();

        $("#cmbProductos").change();

        //$('.documento').on("change", function(){ alert('menene') });
      });
    </script>
  </body>
</html>
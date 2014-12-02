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
      .form-horizontal .has-feedback .div-contingente .form-control-feedback {
        right: -15px;
      }
    </style>
    <script>
      $(document).ready(function(){
        $(".alert").delay(5000).fadeOut('slow');
      });
    </script>
  </head>
  <body>
    <?php
      $params = array('id'=>'frmRegistro','class'=>'form-horizontal', 'files'=>true);
      if ($route) $params['route'] = $route;
    ?>
    {{Form::open($params) }}
      <div class="panel panel-default form-signin">
        <div class="panel-body">
          <div class="text-center">
            {{HTML::image(Config::get('login::logo.path'),Config::get('login::logo.alt'))}}
          </div>
          <h3 class="text-primary">Solicitud de inscripci&oacute;n</h3>
          <h4 class="text-warning">Datos Generales</h4>
          <hr>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="txNombre" class="col-sm-4 control-label">Nombre</label>
                <div class="col-sm-8">
                  {{ Form::text('txNombre', '', array('class'=>'form-control', 
                    'data-bv-notEmpty'         =>'true',
                    'data-bv-notEmpty-message' => 'El nombre es requerido',
                    'autocomplete'             => 'off'
                    )) }}
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-4 control-label">Email</label>
                <div class="col-sm-8">
                  {{ Form::text('email', '', array(
                    'class'                        =>'form-control',
                    'data-bv-notEmpty'             => 'true',
                    'data-bv-notEmpty-message'     => 'El email es requerido',
                    'data-bv-emailaddress'         => 'true',
                    'data-bv-emailaddress-message' => 'Email con formato incorrecto',
                    'data-bv-remote'               => 'true',
                    'data-bv-remote-url'           => '/signup/checkEmail',
                    'data-bv-remote-message'       => 'Email ya existe en la base de datos',
                    'data-bv-remote-type'          => 'POST'
                  )) }}
                </div>
              </div>
              <div class="form-group">
                <label for="contingentes" class="col-sm-4 control-label">Contingente(s)</label>
                <div class="col-sm-8 div-contingente">
                  <?php $grupoActual = 'primero'; ?>
                  <select name="contingentes[]" class="selectpicker form-control" id="contingentes" multiple="true" title="Seleccione uno o varios">
                    @foreach($contingentes as $contingente)
                      @if($contingente->tratado <> $grupoActual)
                        @if($grupoActual <> 'primero')
                          </optgroup>
                        @endif
                        <optgroup label="{{ $contingente->tratado }}">
                        <?php $grupoActual = $contingente->tratado; ?>  
                      @endif
                      <option value="{{ $contingente->contingenteid }}">{{ $contingente->producto }}</option>
                    @endforeach
                    </optgroup>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="txPassword" class="col-sm-4 control-label">Contrase&ntilde;a</label>
                <div class="col-sm-8">
                  {{ Form::password('txPassword', array(
                    'class'                        =>'form-control', 
                    'placeholder'                  => 'M&iacute;nimo 6 caracteres',
                    'data-bv-notempty'             => 'true',
                    'data-bv-notempty-message'     => 'Contrase&ntilde;a es requerida',
                    'data-bv-stringlength'         => 'true',
                    'data-bv-stringlength-min'     => '6',
                    'data-bv-stringlength-message' => 'La contrase&ntilde;a debe tener al menos 6 caracteres.',
                    'data-bv-identical'            => 'true',
                    'data-bv-identical-field'      => 'txPasswordrepeat',
                    'data-bv-identical-message'    => 'Las contrase&ntilde;as no concuerdan'
                  )) }}
                </div>
              </div>
              <div class="form-group">
                <label for="txPasswordrepeat" class="col-sm-4 control-label">&nbsp;</label>
                <div class="col-sm-8">
                  {{ Form::password('txPasswordrepeat', array(
                    'class'                     => 'form-control', 
                    'placeholder'               => 'Repetir contrase&ntilde;a',
                    'data-bv-notempty'          => 'true', 
                    'data-bv-notempty-message'  => 'Contrase&ntilde;a es requerida',
                    'data-bv-identical'         => 'true',
                    'data-bv-identical-field'   => 'txPassword',
                    'data-bv-identical-message' => 'Las contrase&ntilde;as no concuerdan'
                  )) }}
                </div>
              </div>
            </div>
          </div>
          <h4 class="text-warning">Requerimientos</h4>
          <hr>
          <div class="requerimientos">
            
          </div>
        </div>
        <div class="panel-footer">
          <div class="row">
            <div class="col-xs-4 pull-left">
              <div id="mensajes"></div>
            </div>
            <div class="col-xs-4 pull-right">
              <input type="submit" class="btn btn-large btn-success pull-right" value="{{Config::get('login::botonsignup')}}">
            </div>
          </div>
        </div>
    </div>

    {{Form::close()}}
    <script>
      $(document).ready(function(){
        $("#contingentes").change(function() {
          $('.nuevos').remove();
          $('#frmRegistro').bootstrapValidator('revalidateField', 'contingentes');
          $.get('/requerimientos/productos/' + $(this).val() + '/inscripcion', function(data){
              $.each(data, function(key, datos){
                $.get('/requerimientos/productos/vacio?nombre=' + datos.nombre + '&id=' + datos.requerimientoid, function(template){
                  $('.requerimientos').append(template);
                  $('#frmRegistro').bootstrapValidator('addField', 'file' + datos.requerimientoid);
                });     
              });       
          });
        });
    
        $('#contingentes').selectpicker();
        $('#frmRegistro')
          .bootstrapValidator({
            excluded: ':disabled',
            feedbackIcons: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
              contingentes: {
                validators: {
                  callback: {
                    message: 'Porfavor seleccione al menos un contingente',
                    callback: function(value, validator, $field) {
                      var options = validator.getFieldElements('contingentes').val();
                      return (options !=null && options.length >=1);
                    }
                  }
                }
              }
            },
        })
        .on('error.field.bv', function(e, data) {
          data.bv.disableSubmitButtons(false);
        })
        .on('success.field.bv', function(e, data) {
          data.bv.disableSubmitButtons(false);
        });

      $('#contingentes').change();
      });
    </script>
  </body>
</html>
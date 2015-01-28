@extends('template/template')
@section('content')
    <script>
      $(document).ready(function(){
        $(".alert").delay(5000).fadeOut('slow');
      });
    </script>
 
  <body>
    <?php
      $params = array('id'=>'frmRegistro','class'=>'form-horizontal', 'files'=>true,'method'=>'POST');
      if ($route) $params['route'] = "solicitud.inscripcion.update";
    ?>
    {{Form::open($params) }}
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
      <div class="panel panel-default form-signin">
        <div class="panel-body">
          <div class="text-center">
            {{HTML::image(Config::get('login::logo.path'),Config::get('login::logo.alt'))}}
          </div>
          <h3 class="text-primary">Solicitud de inscripci&oacute;n</h3>
       
              <div class="col-md-12">
                <div class="form-group">
                  <label for="contingentes" class="col-sm-2 control-label">Contingente(s)</label>
                  <div class="col-sm-10 div-contingente">
                    <?php $grupoActual = 'primero'; ?>
                    <select name="contingentes[]" class="selectpicker form-control" id="contingentes" multiple="true" title="Seleccione uno o varios">
                      @foreach($contingentes as $contingente)
                        @if($contingente->tratado <> $grupoActual)
                          @if($grupoActual <> 'primero')
                            </optgroup>
                          @endif
                          <optgroup label="{{ $contingente->tipo}} | {{$contingente->tratado}}">
                          <?php $grupoActual = $contingente->tratado; ?>  
                        @endif
                        <option value="{{ Crypt::encrypt($contingente->contingenteid) }}">{{ $contingente->producto }}</option>
                      @endforeach
                      </optgroup>
                    </select>
                  </div>
                </div>
              </div>
          <div class="clearfix"></div>
          <h4 class="text-warning">Requerimientos</h4>
          A continuación se enumeran los requerimientos para todos los contingentes seleccionados.
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
          $.get('/requerimientos/contingentes/' + $(this).val() + '/inscripcion', function(data){
              $.each(data, function(key, datos){
                $.get('/requerimientos/contingentes/vacio?nombre=' + datos.nombre + '&id=' + datos.requerimientoid, function(template){
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
@stop
@extends('template/template')

@section('content')
  {{ HTML::style('packages/csgt/components/css/bootstrap-fileinput.min.css') }}
  {{ HTML::script('packages/csgt/components/js/bootstrap-fileinput.min.js') }}
  
  {{Form::open(array('class'=>'form-horizontal','role'=>'form','files'=>true, 'id'=>'frmSolicitud')) }}
    <h1 class="titulo">Solicitud de emisi&oacute;n</h1>
    <div class="contenido contenido-full">
      <div class="col-md-12">
        <div class="form-group">
          <label for="cmbContingente" class="col-sm-2 control-label">Contingente</label>
          <div class="col-sm-6 div-contingente">
            <?php $grupoActual = 'primero'; ?>
            <select name="cmbContingentes" class="selectpicker form-control" id="cmbContingentes" title="Seleccione uno">
              @foreach($contingentes as $contingente)
                @if($contingente->tratado <> $grupoActual)
                  @if($grupoActual <> 'primero')
                    </optgroup>
                  @endif
                  <optgroup label="{{ $contingente->tratado }}">
                  <?php $grupoActual = $contingente->tratado; ?>  
                @endif
                <option value="{{ Crypt::encrypt($contingente->contingenteid) }}" data-tratado="{{Crypt::encrypt($contingente->tratadoid) }}">{{ $contingente->producto }}</option>
              @endforeach
              </optgroup>
            </select>
          </div>
        </div> <!-- contingente -->
        <div class="form-group">
          <label for="cmbPartida" class="col-sm-2 control-label">Partida arancelaria</label>
          <div class="col-sm-6 div-contingente" id="divPartidas"></div>
        </div> <!-- partida arancelaria -->
        <div class="form-group">
          <label for="txCantidad" class="col-sm-2 control-label">Cantidad</label>
          <div class="col-sm-6 div-contingente">
            {{ Form::text('cantidad', '', array('class'=>'form-control',
              'data-bv-notEmpty'              => 'true',
              'data-bv-notEmpty-message'      => 'La cantidad es incorrecta',
              'data-bv-greaterthan'           => 'true',
              'data-bv-greaterthan-value'     => 0,
              'data-bv-greaterthan-inclusive' => 'false',
              'data-bv-greaterthan-message'   => 'El valor debe ser mayor que cero.',
              'data-bv-numeric'               => 'true',
              'data-bv-numeric-message'       => 'Solo se aceptan dígitos',
              'autocomplete'                  => 'off'
            )) }}
            
            {{ Form::hidden('disponible', '') }}
          </div>
        </div> <!-- cantidad -->
        <div class="form-group">
          <label for="disponible" class="col-sm-2 control-label"><span id="disponible">Máximo Disponible</span></label>
          <div class="col-sm-6 div-contingente">
            <p class="help-block disponible-block"></p>
          </div>
        </div> <!-- disponible -->
        <div class="form-group">
          <label for="pais" class="col-sm-2 control-label">País procedencia</label>
          <div class="col-sm-6 div-contingente">
            <div id="pais"></div>
          </div>
        </div> <!-- pais -->
        <h4 class="titulo">Requerimientos</h4>
        A continuación se enumeran los requerimientos para todos los contingentes seleccionados.
        <hr>
        <div class="requerimientos"></div>
        <div class="row">
          <div class="col-xs-4 pull-left">
            <div id="mensajes"></div>
          </div>
          <div class="col-md-12 text-center">
            <input type="submit" class="btn btn-large btn-primary" value="Enviar solicitud de emisi&oacute;n">
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  {{Form::close()}}
  <script>
    $(document).ready(function(){
      $('.selectpicker').selectpicker();

      $("#cmbContingentes").change(function() {
          $('#divPartidas').html('<p class="form-control-static"><i class="fa fa-lg fa-spinner fa-pulse"></i></p>');
          $('.disponible-block').html($('#divPartidas').html());
          $('#pais').html($('#divPartidas').html());
          $('.requerimientos').html($('#divPartidas').html());
          $('.nuevos').remove();
          $.get('/requerimientos/contingentes/' + $(this).val() + '/emision', function(data){
            $('.requerimientos').html('');
            $.each(data, function(key, datos){
              $.get('/requerimientos/contingentes/vacio?nombre=' + datos.nombre + '&id=' + datos.requerimientoid, function(template){
                $('.requerimientos').append(template);
                $('#frmSolicitud').bootstrapValidator('addField', 'file' + datos.requerimientoid);
                $(".file").fileinput({
                  browseLabel: "Buscar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
                  browseClass: "btn btn-default",
                  showPreview: false,
                  showRemove:  false,
                  showUpload:  false,
                  allowedFileExtensions: ['jpg', 'png', 'pdf'],
                  msgInvalidFileExtension: 'Solo se permiten archivos jpg, png o pdf',
                  msgValidationError : 'Solo se permiten archivos jpg, png o pdf',
                });
              });     
            });       
          });

          $.get('/contingente/partidas/' + $(this).val(), function(data){
            $('#divPartidas').html(data);
            $('.cmb-partida').selectpicker({'showSubtext': true});
            $('#frmSolicitud').bootstrapValidator('addField', 'partidas[]');
          });

          $.get('/contingente/saldo/' + $(this).val() + '?tratado=' + $("#cmbContingentes option:selected").attr('data-tratado'), function(data){
            $('[name="disponible"]').val(data.disponible);
            $('.disponible-block').text(data.disponible);
            $('#disponible').text('Máximo Disponible (' + data.unidad + ')');
          }).fail(function(xhr, textStatus, errorThrown)  {
            alert( "Error: Imposible calcular el disponible para este contingente.");
            window.location = '/';
          });

          $.get('/contingente/paises/' + $(this).val(), function(data){
            $('#pais').html(data);
          });
      });

      $("#cmbContingentes").change();

      $('#frmSolicitud').bootstrapValidator({
        'live': 'submitted',
        fields: {
          cantidad: {
            validators: {
              lessThan: {
                  value: 'disponible',
                  message: 'La cantidad no puede sobrepasar el monto disponible'
              }
            }
          }
        }
      });
    });
  </script>
@stop
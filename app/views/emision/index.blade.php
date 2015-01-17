@extends('template/template')

@section('content')
  {{Form::open(array('class'=>'form-horizontal','role'=>'form','files'=>true, 'id'=>'frmSolicitud')) }}
    <h3 class="text-primary">Solicitud de emisi&oacute;n</h3>
    <h4 class="text-warning">Contingente y Cantidades</h4>
    <hr>
    <div class="form-group col-sm-6">
      <label for="cmbProductos" class="col-sm-4 control-label">Contingente</label>
      <div class="col-sm-8">
        <?php $grupoActual = 'primero'; ?>
        <select name="contingentes" class="selectpicker form-control" id="cmbContingentes" title="Seleccione uno">
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
    <div class="clearfix"></div>
    <div class="form-group col-sm-6">
      <label for="cmbPartida" class="col-sm-4 control-label">Partida arancelaria</label>
      <div class="col-sm-8" id="divPartidas">
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-group col-sm-6">
      <label for="cantidad" class="col-sm-4 control-label">Cantidad</label>
      <div class="col-sm-8">
        {{ Form::text('cantidad', '', array('class'=>'form-control',
          'data-bv-notEmpty'           => 'true',
          'data-bv-notEmpty-message'   => 'La cantidad es incorrecta',
          'data-bv-numeric'            => 'true',
          'data-bv-numeric-message'    => 'Solo se aceptan dígitos',
          'autocomplete'               => 'off'
          )) }}
          
          {{ Form::hidden('disponible', '') }}
      </div>
      <div class="col-sm-4"></div>
      <span id="helpBlock" class="help-block">&nbsp;&nbsp;&nbsp;&nbsp;Máximo disponible: <span name="disponible-span"></span><span id="unidades"></span></span>
    </div>
    <div class="clearfix"></div>
    <h4 class="text-warning">Requisitos Adicionales</h4>
    <hr>
    <div class="form-group hide" id="fileSeed">
      <label class="col-sm-7 control-label"></label>
      <div class="col-sm-5">{{ Form::file('txArchivo[]', array('data-bv-notempty'=>'true')) }}</div>
    </div>

    <div class="col-sm-12 pull-right">
      <input type="submit" class="btn btn-large btn-success pull-right" value="Enviar">
    </div>
  {{Form::close()}}
  <script>
    $(document).ready(function(){
      $('#frmSolicitud').bootstrapValidator({
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


      $("#cmbContingentes").change(function() {
        $('.nuevos').remove();
        $.get('/requerimientos/contingentes/' + $(this).val() + '/emision', function(data){
          $.each(data, function(key, datos){
            var $template = $('#fileSeed');
            $('#fileSeed .control-label').html(datos.nombre);
            var $clone    = $template.clone().removeClass('hide').removeAttr('id').addClass('nuevos').insertAfter($template);
            var $option   = $clone.find('[name="txArchivo[]"]');
            $option.attr('name', 'file'+datos.requerimientoid);
            $('#frmSolicitud').bootstrapValidator('addField', $option);
          });
        });

        $.get('/contingente/partidas/' + $(this).val(), function(data){
          $('#divPartidas').html(data);
          $('.cmb-partida').selectpicker({'showSubtext': true});
          $('#frmSolicitud').bootstrapValidator('addField', 'partidas[]');
        });

        $.get('/contingente/saldo/' + $(this).val(), function(data){
          $('[name="disponible"]').val(data.disponible);
          $('[name="disponible-span"]').text(data.disponible);
          $('#unidades').text(data.unidad);

          $('#frmSolicitud').bootstrapValidator('revalidateField', 'cantidad');
        });
      });

      $('.selectpicker').selectpicker();

      $("#cmbContingentes").change();

      $('[name="cantidad"]').change(function(){
        $('#frmSolicitud').bootstrapValidator('revalidateField', 'cantidad');
      });

    });
  </script>
@stop
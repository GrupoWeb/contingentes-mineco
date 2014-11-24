@extends('template/template')

@section('content')
  {{Form::open(array('class'=>'form-horizontal','role'=>'form','files'=>true, 'id'=>'frmSolicitud')) }}
    <h3 class="text-primary">Solicitud de emisi&oacute;n</h3>
    <h4 class="text-warning">Contingente y Cantidades</h4>
    <hr>
    <div class="form-group col-sm-6">
      <label for="cmbProductos" class="col-sm-4 control-label">Contingente</label>
      <div class="col-sm-8">
        <?php 
          $prods = array();
          foreach($productos as $producto)
            $prods[Crypt::encrypt($producto->productoid)] = $producto->nombre;
        ?>
        {{ Form::select('cmbProductos', $prods, null, array('class'=>'selectpicker form-control','id'=>'cmbProductos')) }}
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
          'data-bv-notEmpty'         =>'true',
          'data-bv-notEmpty-message' => 'La cantidad es incorrecta',
          'data-bv-numeric'          => 'true',
          'data-bv-numeric-message'  => 'Solo se aceptan dígitos',
          'autocomplete'             => 'off'
          )) }}
      </div>
      <div class="col-sm-4"></div>
      <span id="helpBlock" class="help-block">&nbsp;&nbsp;&nbsp;&nbsp;Máximo disponible: 1,200TM</span>
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
      $("#cmbProductos").change(function() {
        $('.nuevos').remove();
        $.get('/requerimientos/' + $(this).val() + '/emision', function(data){
          $.each(data, function(key, datos){
            var $template = $('#fileSeed');
            $('#fileSeed .control-label').html(datos.nombre);
            var $clone    = $template.clone().removeClass('hide').removeAttr('id').addClass('nuevos').insertAfter($template);
            var $option   = $clone.find('[name="txArchivo[]"]');
            $option.attr('name', 'file'+datos.priid);
            $('#frmSolicitud').bootstrapValidator('addField', $option);
          });
        });

        $.get('/contingente/partidas/' + $(this).val(), function(data){
          $('#divPartidas').html(data);
          $('.cmb-partida').selectpicker({'showSubtext': true});
          $('#frmSolicitud').bootstrapValidator('addField', 'partidas[]');
        });
      });

      $('#frmSolicitud').bootstrapValidator({
        feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
        }
      });
      $('.selectpicker').selectpicker();
      $("#cmbProductos").change();
    });
  </script>
@stop
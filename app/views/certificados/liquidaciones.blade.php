@extends('template/template')

@section('content')
  {{ HTML::style('packages/csgt/components/css/bootstrap-fileinput.min.css') }}
  {{ HTML::script('packages/csgt/components/js/bootstrap-fileinput.min.js') }}
  
  @if(Session::has('message'))
    <div class="alert alert-{{ Session::get('type') }} alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      {{ Session::get('message') }}
    </div>
  @endif

  <h1 class="titulo">Liquidación de certificados</h1>
    <div class="contenido contenido-full">
      <div class="col-md-12"><br />
        @if(count($certificados) <= 0)
        <p class="text-center"><strong>No tiene certificados pendientes de liquidación</strong></p><br />
        @else
          {{Form::open(['url'=>'solicitudliquidacion', 'class'=>'form-horizontal', 'id'=>'frmLiquidacion','files'=>true]) }}
            <div class="form-group">
              <label for="cmbCertificado" class="col-sm-2 control-label">Certificado</label>
              <div class="col-sm-6 div-contingente">
                <select name="cmbCertificados" class="form-control selectpicker" id="cmbCertificados">
                  @foreach($certificados as $certificado)
                    <option value="{{ Crypt::encrypt($certificado->certificadoid) }}">{{ $certificado->numerocertificado }}</option>
                  @endforeach
                </select>
              </div>
            </div> <!-- certificados -->
            <div class="form-group">
              <div id="infocertificado" class="col-sm-6 div-contingente col-sm-offset-2"></div>
            </div> <!-- certificados -->
            <div class="form-group">
              <label for="txDua" class="col-sm-2 control-label">DUA</label>
              <div class="col-sm-6 div-contingente">
                {{ Form::text('txDua', '', array('class'=>'form-control', 
                  'data-bv-notEmpty'         => 'true',
                  'data-bv-notEmpty-message' => 'La DUA es requerida',
                  'autocomplete'             => 'off'
                )) }}
              </div>
            </div> <!-- dua -->
            <div class="form-group">
              <label for="txCantidad" class="col-sm-2 control-label">Cantidad real</label>
              <div class="col-sm-6 div-contingente">
                {{ Form::text('txCantidad', '', array('class'=>'form-control', 
                  'data-bv-notEmpty'              => 'true',
                  'data-bv-notEmpty-message'      => 'La cantida es requerida',
                  'data-bv-numeric'               => 'true',
                  'data-bv-numeric-message'       => 'La cantidad debe ser numerica',
                  'autocomplete'                  => 'off',
                  'data-bv-greaterthan'           => 'true',
                  'data-bv-greaterthan-inclusive' => 'false',
                  'data-bv-greaterthan-message'   => 'El valor debe ser un número positivo',
                  'data-bv-greaterthan-value'     => '0',
                )) }}
              </div>
            </div> <!-- cantidad real -->
            <div class="form-group">
              <label for="txCIF" class="col-sm-2 control-label">Valor CIF</label>
              <div class="col-sm-6 div-contingente">
                {{ Form::text('txCIF', '', array('class'=>'form-control', 
                  'data-bv-notEmpty'              => 'true',
                  'data-bv-notEmpty-message'      => 'El valor CIF es requerido',
                  'data-bv-numeric'               => 'true',
                  'data-bv-numeric-message'       => 'La cantidad debe ser numerica',
                  'autocomplete'                  => 'off',
                  'data-bv-greaterthan'           => 'true',
                  'data-bv-greaterthan-inclusive' => 'false',
                  'data-bv-greaterthan-message'   => 'El valor debe ser un número positivo',
                  'data-bv-greaterthan-value'     => '0',
                )) }}
              </div>
            </div> <!-- valor CIF -->
            <div class="form-group">
              <label for="txDocumento" class="col-sm-2 control-label">Documento Adunto (DUA)</label>
              <div class="col-sm-6 div-contingente">
                {{ Form::file('txDocumento', array(
                  'data-bv-notEmpty'         => 'true',
                  'data-bv-notEmpty-message' => 'El archivo es requerido',
                  'class'                    => 'archivo',
                )) }}
              </div>
            </div> <!-- documento adjunto -->
            <div class="form-group">
              <label for="txFecha" class="col-sm-2 control-label">Fecha de liquidación:</label>
              <div class="col-sm-6">
                <div class="input-group date catalogoFechaHora">
                  {{ Form::text('txFecha', '', [
                      'class'            => 'form-control',
                      'id'               => 'txFecha',
                      'data-date-format' => 'DD/MM/YYYY HH:mm',
                  ]) }}
                  <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                </div>    
              </div>
            </div> <!-- fecha liquidacion -->
            <hr>
            <div class="row">
              <div class="col-xs-4 pull-left">
                <div id="mensajes"></div>
              </div>
              <div class="col-md-12 text-center">
                <input type="submit" class="btn btn-large btn-primary" value="Liquidar certificado">
              </div>
            </div>
          {{Form::close()}}
        @endif
      </div>
      <div class="clearfix"></div>
    </div>

  <script>
  	$(document).ready(function(){
	  	$('#frmLiquidacion')
	      .bootstrapValidator({
	        excluded: ':disabled',
	        feedbackIcons: {
	          valid: 'glyphicon glyphicon-ok',
	          invalid: 'glyphicon glyphicon-remove',
	          validating: 'glyphicon glyphicon-refresh'
	      	},
          live: 'disabled'
	    	});

      $('.catalogoFechaHora').datetimepicker({
        locale: 'es',
        useCurrent: true,
      });

      $('#cmbCertificados').change(function() {
        var id = $(this).val();

        $.get('solicitudliquidacion/'+id, function(data) {
          $('#infocertificado').html(data);
        });
      });

      $('#cmbCertificados').change();

      $(".archivo").fileinput({
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
  </script>
@stop
@extends('template/template')
@section('content')
  {{ HTML::style('packages/csgt/components/css/bootstrap-fileinput.min.css') }}
  {{ HTML::style('packages/csgt/components/css/bootstrapValidator.min.css') }}
  {{ HTML::style('packages/csgt/components/css/bootstrap-select.min.css') }}

  {{ HTML::script('packages/csgt/components/js/bootstrap-select.min.js') }}
  {{ HTML::script('packages/csgt/components/js/bootstrap-fileinput.min.js') }}
  {{ HTML::script('packages/csgt/components/js/bootstrapValidator.min.js') }}
  {{ HTML::script('packages/csgt/components/js/bootstrapValidatorExtra.js') }}
  <?php
    $params = array('id'=>'frmRegistro','class'=>'form-horizontal', 'files'=>true, 'url'=>'editardatosempresa');
  ?>
  {{Form::open($params) }}
  <input type="hidden" name='empresa' value="{{Crypt::encrypt($data->empresaid)}}">
  <input type="hidden" name='txNIT' value="{{$data->nit}}">
  <input type="hidden" name='txRazonSocial' value="{{$data->razonsocial}}">

  <div class="contenido">
      <h4 class="titulo">Editar Datos de la empresa</h4>
    <!-- representante legal  -->
    <div class="col-md-12">
      <div class="form-group">
        <label for="txNombre" class="col-sm-2 control-label">Representante Legal</label>
        <div class="col-sm-10">
          {{ Form::text('txPropietario', $data->razonsocial, array('class'=>'form-control', 
            'data-bv-notEmpty'         =>'true',
            'data-bv-notEmpty-message' => 'El representante legal es requerido',
            'autocomplete'             => 'off',
            'placeholder'              => 'Nombre del propietario o representante legal'
            )) }}
        </div>
      </div>
    </div>
    <!-- telefono -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txTelefono" class="col-sm-4 control-label">Teléfono</label>
        <div class="col-sm-8">
          {{ Form::text('txTelefono', $data->telefono, array('class'=>'form-control', 
            'data-bv-notEmpty'         => 'true',
            'data-bv-notEmpty-message' => 'El teléfono es requerido',
            'data-bv-integer'          => 'true',
            'data-bv-integer-message'  => 'Debe ser un número',
            'autocomplete'             => 'off'
            )) }}
        </div>
      </div>
    </div>   
    <!-- fax -->    
    <div class="col-md-6">
      <div class="form-group">
        <label for="txFax" class="col-sm-4 control-label">FAX</label>
        <div class="col-sm-8">
          {{ Form::text('txFax', $data->fax, array('class'=>'form-control', 
            'data-bv-integer' => 'true',
            'data-bv-integer-message' => 'Debe ser un número',
            'autocomplete'             => 'off'
            )) }}
        </div>
      </div>
    </div>    
    <!--password --> 
   
    <!--domicilio fiscal -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txNombre" class="col-sm-4 control-label">Domicilio Fiscal</label>
        <div class="col-sm-8">
          {{ Form::textarea('txDomicilioFiscal', $data->domiciliofiscal, array('class'=>'form-control', 
            'data-bv-notEmpty'         =>'true',
            'data-bv-notEmpty-message' => 'El domicilio fiscal es requerido',
            'autocomplete'             => 'off',
            'rows'                     => 3,
            )) }}
        </div>
      </div>
    </div>
    <!--domicilio comercial -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txNombre" class="col-sm-4 control-label">Domicilio Comercial</label>
        <div class="col-sm-8">
          {{ Form::textarea('txDomicilioComercial', $data->domiciliocomercial, array('class'=>'form-control', 
            'data-bv-notEmpty'         =>'true',
            'data-bv-notEmpty-message' => 'El domicilio comercial es requerido',
            'autocomplete'             => 'off',
            'rows'                     => 3,
            )) }}
        </div>
      </div>
    </div>
    <!-- lugar -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txDireccionNotificaciones" class="col-sm-4 control-label">Lugar para recibir notificaciones</label>
        <div class="col-sm-8">
          {{ Form::textarea('txDireccionNotificaciones', $data->direccionnotificaciones, array('class'=>'form-control', 
            'data-bv-notEmpty'         =>'true',
            'data-bv-notEmpty-message' => 'El lugar para recibir notificaciones es requerido',
            'autocomplete'             => 'off',
            'rows'                     => '3',
            )) }}
        </div>
      </div>
    </div>
    <!--encargado -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txNombre" class="col-sm-4 control-label">Propietario</label>
        <div class="col-sm-8">
          {{ Form::text('txEncargadoImportaciones', $data->propietario, array('class'=>'form-control', 
            'data-bv-notEmpty'         =>'true',
            'data-bv-notEmpty-message' => 'El nombre del contacto es requerido',
            'autocomplete'             => 'off',
            'placeholder'              => 'Importacion/exportacion'
            )) }}
        </div>
      </div>
    </div> 
    <!-- codigo VUPE -->
    <div class="clearfix"></div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="txVUPE" class="col-sm-2 control-label">Código VUPE</label>
        <div class="col-sm-10">
          {{ Form::text('txVUPE', $data->codigovupe, array('class'=>'form-control', 
            'autocomplete' => 'off',
            'placeholder'  => 'Unicamente requerido para exportación de desperdicios y desechos de metales'
            )) }}
        </div>
      </div>
    </div>  

    <div class="clearfix"></div>
      <h4 class="titulo">Documentos</h4> <span class="agregar pull-right btn btn-primary">Agregar Archivo</span>
      <br />
      <hr>
     <div class="form-group hide" id="optionTemplate">
        <div class="col-sm-6 col-sm-offset-4">
          <input  type="file" class="form-control" name="file[]" >
        </div>
      </div>

  </div>
    <div class="clearfix"></div>
    <div class="col-md-12 text-center">
      <input type="submit" class="btn btn-large btn-primary" value="Enviar solicitud de inscripci&oacute;n">
    </div>
    <div class="clearfix"></div>
  </div>
  {{Form::close()}}
  <script>
      $(document).ready(function(){
        $( ".agregar" ).click(function() {
          var $template = $('#optionTemplate'),
              $clone    = $template
                              .clone()
                              .removeClass('hide')
                              .removeAttr('id')
                              .insertBefore($template);

                              $option   = $clone.find('[name="file[]"]');

          $('#frmRegistro').bootstrapValidator('addField', $option);
          $clone.fileinput({
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

        $('#frmRegistro')
          .bootstrapValidator({
            excluded: ':disabled',
            feedbackIcons: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
            },
        });
      });
    </script>
@stop
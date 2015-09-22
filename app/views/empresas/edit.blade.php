@extends('template.template')

@section('content')
  {{ HTML::style('packages/csgt/components/css/bootstrap-fileinput.min.css') }}
  {{ HTML::script('packages/csgt/components/js/bootstrap-fileinput.min.js') }}

  {{Form::open(array('id'=>'frmRegistro', 'class'=>'form-horizontal', 'files'=>true, 'url'=>'solicitud/actualizacion')) }}

  <div class="contenido">
      <h1 class="titulo">Actualizar datos</h1>
      <div class="col-md-12">
        <h4 class="titulo">Datos Generales</h4>
      </div>
      <!-- representante legal  -->
      <div class="col-md-12">
        <div class="form-group">
          <label for="txNombre" class="col-sm-2 control-label">Representante Legal</label>
          <div class="col-sm-10">
            {{ Form::text('txPropietario', ($data ? $data->propietario : ''), array('class'=>'form-control', 
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
          <label for="txNombre" class="col-sm-4 control-label">Encargado</label>
          <div class="col-sm-8">
            {{ Form::text('txEncargadoImportaciones', $data->encargadoimportaciones, array('class'=>'form-control', 
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

      <div class="col-md-12">
        <h4 class="titulo">Adjuntar documentos</h4>
      </div>
      <div class="col-md-12">
        <p>*NOTA: Para poder realizar los cambios requeridos es necesario adjuntar los documentos que respandan el cambio.</p>
      </div>
      <div class="col-md-12">
        <a href="javascript:void(0);" class="btn btn-primary agregar pull-right">Agregar</a>
      </div>
      <div class="clearfix"></div>
      <br />
      <div class="col-md-12 hide" id="fileinput">
        <div class="form-group">
          <div class="col-sm-12">
            <input type="file" class="form-control" name="adjuntos[]" />
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-4 col-md-offset-4">
        {{ Form::submit('Actualizar', array('class'=>'btn btn-primary btn-block', 'autocomplete'=>'off')) }}
      </div>
      <div class="clearfix"></div>
    </div>
  {{Form::close()}}
  <script>
    $(document).ready(function(){
      $('#frmRegistro').bootstrapValidator({
        excluded: ':disabled',
        feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
        }
      });

      $( ".agregar" ).click(function() {
        var $template = $('#fileinput'),
            $clone    = $template
                          .clone()
                          .removeClass('hide')
                          .removeAttr('id')
                          .insertBefore($template),

            $option   = $clone.find('[name="adjuntos[]"]');
            
        $option.fileinput({
            browseLabel: "Buscar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
            browseClass: "btn btn-default",
            showPreview: false,
            showRemove:  false,
            showUpload:  false,
            allowedFileExtensions: ['jpg', 'png', 'pdf'],
            msgInvalidFileExtension: 'Solo se permiten archivos jpg, png o pdf',
            msgValidationError : 'Solo se permiten archivos jpg, png o pdf',
        });

        $('#frmRegistro').bootstrapValidator('addField', $option);
      });
    });
  </script>
@stop
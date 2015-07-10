@extends('template/template')
@section('content')
  {{ HTML::style('packages/csgt/components/css/bootstrap-fileinput.min.css') }}
  {{ HTML::script('packages/csgt/components/js/bootstrap-fileinput.min.js') }}
  
  <script>
    $(document).ready(function(){
      $(".alert").delay(5000).fadeOut('slow');
    });
  </script>
 
  <?php
    $params = array('id'=>'frmRegistro','class'=>'form-horizontal', 'files'=>true,'method'=>'POST');
  ?>
  {{Form::open($params) }}
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="contenido contenido-full">
      <h1 class="titulo">Solicitud de inscripci&oacute;n</h1>
      <br>
      <div class="col-md-12">
        @if(Session::has('message'))
          <div class="alert alert-{{ Session::get('type') }} alert-dismissable">
            {{ Session::get('message') }}
          </div>
        @endif

        <div class="form-group">
          <label for="tratados" class="col-sm-2 control-label">Acuerdo Comercial</label>
          <div class="col-sm-10 div-tratados">
            <select name="tratados" class="selectpicker form-control" id="tratados">
              @foreach($tratados as $tratado)
                <option value="{{ Crypt::encrypt($tratado->tratadoid) }}">{{ $tratado->nombrecorto }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label for="contingentes" class="col-sm-2 control-label">Contingente</label>
          <div class="col-sm-10 div-contingente" id="div-contingente"></div>
        </div>
      </div>
      <div class="col-md-12">
        <h4 class="titulo">Requerimientos</h4>
         A continuación se enumeran los documentos que deben adjuntarse para aplicar a un contigente arancelario.
        <hr>
        <div class="requerimientos"></div>
        <div class="row">
          <div class="col-xs-4 pull-left">
            <div id="mensajes"></div>
          </div>
          <div class="col-md-12 text-center">
            <input type="submit" class="btn btn-large btn-primary" value="Enviar solicitud de inscripci&oacute;n">
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>    
  {{Form::close()}}

  <style>
    .file-preview-frame {
      display: none !important;
    }
  </style>

  <script>
    $(document).ready(function(){
      $('#tratados').change(function(){
        $.get('/contingentes/tratado/' + $(this).val(), function(data){
          $('#div-contingente').html(data);
          $('#cmbContingente').change();
        });
      });

      $('#tratados').change();

      $(document).on('change', '#cmbContingente', function(){
        $('.nuevos').each(function( index ) {
          $('#frmRegistro').bootstrapValidator('removeField', $(this).attr('id')); 
          console.log($(this).attr('id'));
        });

        $('.nuevos').remove();

        $.get('/requerimientos/contingentes/' + $(this).val() + '/inscripcion', function(data){
            $.each(data, function(key, datos){
              $.get('/requerimientos/contingentes/vacio?nombre=' + datos.nombre + '&id=' + datos.requerimientoid, function(template){
                $('.requerimientos').append(template);
                $('#frmRegistro').bootstrapValidator('addField', 'file' + datos.requerimientoid);
                $(".file").fileinput({
                  browseLabel: "Buscar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
                  browseClass: "btn btn-default",
                  allowedPreviewTypes: ["flash"],
                  maxFileSize: 8000,
                  allowedFileExtensions: ['jpg', 'png', 'pdf'],
                  msgSizeTooLarge: "El archivo {name} ({size} KB) excede el límite máximo de {maxSize} KB. Por favor pruebe con otro archivo",
                  msgInvalidFileExtension: 'Solo se permiten archivos jpg, png o pdf',
                  showPreview: true,
                  showRemove:  false,
                  showUpload:  false,
                  previewSettings: {
                  image: {width: "20px", height: "20px"},
                  other: {width: "20px", height: "20px"},
                  }
                });
              });     
            });       
        });
      });










    });
  </script>
@stop
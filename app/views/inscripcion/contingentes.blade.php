<select name="contingentes" class="selectpicker form-control" id="contingentes">
		@foreach($contingentes as $contingente)
			<option value="{{ Crypt::encrypt($contingente->contingenteid) }}">{{ $contingente->producto }}</option>
		@endforeach
</select>

<script>
  $(document).ready(function(){
  	$('#contingentes').selectpicker();

  	$("#contingentes").change(function() {
      $('.nuevos').remove();
      $('#frmRegistro').bootstrapValidator('revalidateField', 'contingentes');
      $.get('/requerimientos/contingentes/' + $(this).val() + '/inscripcion', function(data){
          $.each(data, function(key, datos){
            $.get('/requerimientos/contingentes/vacio?nombre=' + datos.nombre + '&id=' + datos.requerimientoid, function(template){
              $('.requerimientos').append(template);
              $('#frmRegistro').bootstrapValidator('addField', 'file' + datos.requerimientoid);
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
    });

		$('#contingentes').change();

  });
</script>
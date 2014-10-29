<ul class="list-group">
	@foreach($requisitos as $requisito)
		<li class="list-group-item" id="li{{$requisito->requerimientoid}}">
	    <span class="text-left">{{ $requisito->nombre }}</span><br />
	    {{ Form::file('file'.$requisito->requerimientoid, array(
					'class'                => 'documento',
					'id'                   => 'file'.$requisito->requerimientoid,
					// 'data-bv-notempty'     => 'true',
					// 'data-bv-notempty-message'=>'El archivo es requerido',
					// 'data-bv-file'         => 'true',
					// 'data-bv-file-extension'=>'pdf',
					// 'data-bv-file-message' => 'Tipo de archivo no soportado'
	    	)); }}
	  </li>
	  <script>
	  	files.push('{{$requisito->requerimientoid}}');
	  </script>
	@endforeach
</ul>
<script>
	var isEmpty  = true;
	$(document).ready(function(){
		//revisa();
		$('.documento').change(function(){
			var id = $(this).attr('name').substr(4);
			$('#mensajes').html('');
			$(this).parent('li').removeClass('list-group-item-danger').addClass('list-group-item-success');
			revisa();
		});

		// validar los files
		$('#submit2').on('click',function(event) 
    {	
			if(!isEmpty)
			{
				return;
			}else
			{
				console.log("es vacio");
				$('#mensajes').html(' <span class="label label-danger">Los requisitos son obligatorios</span>');
				$('#submit2').removeAttr('disabled');
				revisa();
			}
				event.preventDefault();
		});

		function revisa(){
			var verEmpty = false;
			files.forEach(function(item){
				if($('#file'+item).val()=='')
				{
					verEmpty = true;
					$('#li'+item).removeClass('list-group-item-success').addClass('list-group-item-danger');
				}
			});
			if(verEmpty)
			{
				isEmpty = true;
				$('#mensajes').html(' <span class="label label-danger">Los requisitos son obligatorios</span>');
			}else
			{
				isEmpty = false;
				$('#mensajes').html('');
			}
			console.log('isEmpty = ' + isEmpty);
		}
	});
</script>
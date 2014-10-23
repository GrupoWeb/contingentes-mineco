<ul class="list-group">
	@foreach($requisitos as $requisito)
		<li class="list-group-item" id="li{{$requisito->requerimientoid}}">
	    <span class="text-left">{{ $requisito->nombre }}</span><br />
	    {{ Form::file('file'.$requisito->requerimientoid, array(
					'class'                => 'documento',
					'id'                   => 'file'.$requisito->requerimientoid,
					'data-bv-notempty'     => 'true',
					'data-bv-file'         => 'true',
					'data-bv-file-message' => 'El archivo es requerido'
	    	)); }}
	  </li>
	  <script>
	  	files.push('{{$requisito->requerimientoid}}');
	  </script>
	@endforeach
</ul>
<script>
	$(document).ready(function(){
		$('.documento').change(function(){
			var id = $(this).attr('name').substr(4);
			$('#mensajes').html('');
			$(this).parent('li').removeClass('list-group-item-danger').addClass('list-group-item-success');
		});

		// validar los files
		$('#frmLogin').submit(function(event) 
    {	var isEmpty = false;
			files.forEach(function(item){
				if($('#file'+item).val()=='')
				{
					isEmpty = true;
					$('#li'+item).removeClass('list-group-item-success').addClass('list-group-item-danger');
				}
			});
			if(!isEmpty)
			{
				return;
			}else
			{
				console.log("es vacio");
				$('#mensajes').html(' <span class="label label-danger">Los requisitos son obligatorios</span>');
				$('#submit').removeAttr('disabled');
			}
			event.preventDefault();
		});
	});
</script>
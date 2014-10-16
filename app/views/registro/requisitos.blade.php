<ul class="list-group">
	@foreach($requisitos as $requisito)
		<li class="list-group-item">
	    <span class="text-left">{{ $requisito->nombre }}</span><br />
	    {{ Form::file('file'.$requisito->priid, array('class'=>'documento','id'=>'file'.$requisito->priid)); }}
	  </li>
	@endforeach
</ul>
<script>
	$(document).ready(function(){
		$('.documento').change(function(){
			var id = $(this).attr('name').substr(4);
			$(this).parent('li').addClass('list-group-item-success');
		});
	});
</script>
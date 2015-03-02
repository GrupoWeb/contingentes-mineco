<select name="contingentes" class="selectpicker form-control" id="contingentes">
		@foreach($contingentes as $contingente)
			<option value="{{ Crypt::encrypt($contingente->contingenteid) }}">{{ $contingente->producto }}</option>
		@endforeach
</select>

<script>
  $(document).ready(function(){
  	$('#contingentes').selectpicker();
  });
</script>
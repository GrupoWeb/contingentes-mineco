<select name="cmbContingente" class="selectpicker form-control" id="cmbContingente">
		@foreach($contingentes as $contingente)
			<option value="{{ Crypt::encrypt($contingente->contingenteid) }}">{{ $contingente->producto }}</option>
		@endforeach
</select>

<script>
  $(document).ready(function(){
  	$('#cmbContingente').selectpicker({'noneSelectedText':'No hay períodos abiertos para este tratado'});
  });
</script>
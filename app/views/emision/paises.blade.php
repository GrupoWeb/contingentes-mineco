@if($contingentepais->paisid)
	<p class="help-block">{{ $contingentepais->nombre }}</p>
	{{ Form::hidden('cmbPais', Crypt::encrypt($contingentepais->paisid)) }}
@else
	<select id="cmbPais" name="cmbPais" class="selectpicker">
		@foreach($paises as $pais)
			<option value="{{ Crypt::encrypt($pais->paisid) }}">{{ $pais->nombre }}</option>
		@endforeach
	</select>
	<script>
		$(document).ready(function(){
			$('.selectpicker').selectpicker();
		});
	</script>
@endif
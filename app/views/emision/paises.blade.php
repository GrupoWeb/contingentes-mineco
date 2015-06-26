<div class="form-group">
  <label for="pais" class="col-sm-2 control-label">País procedencia</label>
  <div class="col-sm-6 div-contingente">
		@if($contingentepais->paisid)
			<p class="help-block">{{ $contingentepais->nombre }}</p>
			{{ Form::hidden('cmbPais', Crypt::encrypt($contingentepais->paisid)) }}
		@else
			<select id="cmbPais" name="cmbPais" class="selectpicker">
				@foreach($paises as $pais)
					<option value="{{ Crypt::encrypt($pais->paisid) }}">{{ $pais->nombre }}</option>
				@endforeach
			</select>
		@endif
  </div>
</div> <!-- pais -->

@if(!$contingentepais->paisid)
	<script>
		$(document).ready(function(){
			$('.selectpicker').selectpicker();
		});
	</script>
@endif
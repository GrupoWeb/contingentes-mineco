<select name="cmbPeriodo" class="selectpicker">           
  @foreach ($periodos as $periodo)
    <option value="{{ Crypt::encrypt($periodo->periodoid) }}">{{ $periodo->nombre }}</option>
  @endforeach
</select>

<script type="text/javascript">
	$(function() {
    $('.selectpicker').selectpicker(); 
	});
</script>
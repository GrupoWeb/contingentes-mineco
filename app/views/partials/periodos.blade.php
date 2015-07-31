<select name="cmbPeriodo" class="selectpicker">   
  @if(Input::has('todos'))
    <option value="{{Crypt::encrypt('-1')}}">Todos</option>
  @endif        
  @foreach ($periodos as $periodo)
    <option value="{{ Crypt::encrypt($periodo->periodoid) }}">{{ $periodo->nombre }}</option>
  @endforeach
</select>

<script type="text/javascript">
	$(function() {
    $('.selectpicker').selectpicker(); 
	});
</script>
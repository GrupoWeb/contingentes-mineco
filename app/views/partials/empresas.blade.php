<select name="cmbEmpresa" class="selectpicker form-control"> 
	@if(Input::has('todos')) 
		<option value="{{ Crypt::encrypt(-1) }}">Todas</option>   
	@endif      
  @foreach ($empresas as $empresa)
    <option value="{{ Crypt::encrypt($empresa->empresaid) }}">{{ $empresa->nombre }}</option>
  @endforeach
</select>

<script type="text/javascript">
	$(function() {
    $('.selectpicker').selectpicker(); 
	});
</script>
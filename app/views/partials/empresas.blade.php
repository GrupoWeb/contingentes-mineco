<select name="cmbEmpresa" class="selectpicker form-control">  
	<option value="{{ Crypt::encrypt(0) }}">Todas</option>         
  @foreach ($empresas as $empresa)
    <option value="{{ Crypt::encrypt($empresa->empresaid) }}">{{ $empresa->nombre }}</option>
  @endforeach
</select>

<script type="text/javascript">
	$(function() {
    $('.selectpicker').selectpicker(); 
	});
</script>
<select name="cmbEmpresa" class="form-control" id="cmbEmpresa" data-bv-notEmpty="true" data-bv-notEmpty-message="Campo requerido"> 
	@if(Input::has('todos')) 
		<option value="{{ Crypt::encrypt(-1) }}">Todas</option>   
	@endif      
  @foreach ($empresas as $empresa)
    <option value="{{ Crypt::encrypt($empresa->empresaid) }}">{{ $empresa->nombre }}</option>
  @endforeach
</select>
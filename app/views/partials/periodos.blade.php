<select name="cmbPeriodo" class="form-control" id="cmbPeriodo" data-bv-notEmpty="true" data-bv-notEmpty-message="Campo requerido">   
  @if(Input::has('todos'))
    <option value="{{Crypt::encrypt('-1')}}">Todos</option>
  @endif        
  @foreach ($periodos as $periodo)
    <option value="{{ Crypt::encrypt($periodo->periodoid) }}">{{ $periodo->nombre }}</option>
  @endforeach
</select>
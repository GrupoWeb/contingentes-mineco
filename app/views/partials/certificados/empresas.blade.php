<select name="{{ $nombre }}" class="selectpicker form-control" id="{{ $id }}">
  @if(in_array(Auth::user()->rolid,Config::get('contingentes.roladmin')))
		<option value="{{Crypt::encrypt('-1')}}">Todos</option>
	@endif
  @foreach($empresas as $empresa)
    <option value="{{ Crypt::encrypt($empresa->empresaid) }}">{{ $empresa->nombre }}</option>
  @endforeach
</select>
<select name="{{ $nombre }}" class="selectpicker form-control" id="{{ $id }}">
  @if(in_array(Auth::user()->rolid,Config::get('contingentes.roladmin')))
		<option value="{{Crypt::encrypt('-1')}}">Todos</option>
	@endif
  @foreach($contingentes as $contingente)
    <option value="{{ Crypt::encrypt($contingente->contingenteid) }}">{{ $contingente->producto }}</option>
  @endforeach
</select>
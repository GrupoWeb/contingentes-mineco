<select name="{{ $nombre }}" class="selectpicker form-control" id="{{ $id }}">
  <option value="{{Crypt::encrypt('-1')}}">Todos</option>
  @foreach($contingentes as $contingente)
    <option value="{{ Crypt::encrypt($contingente->contingenteid) }}">{{ $contingente->producto }}</option>
  @endforeach
</select>
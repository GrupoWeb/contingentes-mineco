<select name="{{ $nombre }}" class="selectize form-control" id="{{ $id }}" data-bv-notEmpty="true" data-bv-notEmpty-message="Campo requerido">
  @if(Input::has('todos'))
    <option value="{{Crypt::encrypt('-1')}}">Todos</option>
  @endif
  @foreach($contingentes as $contingente)
    <option value="{{ Crypt::encrypt($contingente->contingenteid) }}">{{ $contingente->producto }}</option>
  @endforeach
</select>
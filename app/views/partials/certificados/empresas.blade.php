<select name="{{ $nombre }}" class="selectpicker form-control" id="{{ $id }}">
  <option value="{{Crypt::encrypt('-1')}}">Todos</option>
  @foreach($empresas as $empresa)
    <option value="{{ Crypt::encrypt($empresa->empresaid) }}">{{ $empresa->nombre }}</option>
  @endforeach
</select>
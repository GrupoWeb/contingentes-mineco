<select name="{{ $nombre }}" class="selectpicker form-control" id="{{ $id }}">
	@if(count($periodos) == 0)
  	<option value="{{Crypt::encrypt('-1')}}">Actual</option>
  @else
	  @foreach($periodos as $periodo)
	    <option value="{{ Crypt::encrypt($periodo->periodoid) }}">{{ $periodo->nombre }}</option>
	  @endforeach
	@endif
</select>
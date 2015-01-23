<?php $grupoActual = 'primero'; ?>
<select name="{{ $nombre }}" class="selectpicker form-control" id="{{ $id }}" title="Seleccione uno{{ $tipo == 'multi' ? ' o varios' : ''}}" {{ $tipo == 'multi' ? 'multiple="true"' : '' }}>
  @foreach($contingentes as $contingente)
    @if($contingente->tratado <> $grupoActual)
      @if($grupoActual <> 'primero')
        </optgroup>
      @endif
      <optgroup label="{{ $contingente->tipo}} | {{$contingente->tratado}}">
      <?php $grupoActual = $contingente->tratado; ?>  
    @endif
    <option value="{{ Crypt::encrypt($contingente->contingenteid) }}">{{ $contingente->producto }}</option>
  @endforeach
  </optgroup>
</select>


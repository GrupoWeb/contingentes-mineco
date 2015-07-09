<dl>
  <dt>Nombre:</dt>
  <dd>{{ $info->nombre }}</dd>
  <dt>Tipo:</dt>
  <dd>{{ $info->tipo }}</dd>
</dl>

<p>Contingentes en tratado:</p>
<ul class="list-group">
	@foreach($productos as $producto)
		<li class="list-group-item">
			{{ $producto->nombre }} <br />
			<span class="badge">{{ number_format($producto->activado, 3).' '.$producto->nombrecorto.' Activado' }}</span>
    	<a href="/normativos/{{ $producto->normativo }}" target="_blank">Normativo</a>
		</li>
	@endforeach
</ul>
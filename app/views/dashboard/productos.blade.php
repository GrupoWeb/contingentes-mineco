<dl>
  <dt>Nombre:</dt>
  <dd>{{ $info->nombre }}</dd>
  <dt>Tipo:</dt>
  <dd>{{ $info->tipo }}</dd>
</dl>

<p>Contingentes en tratado:</p>
<ul class="list-group">
	@foreach($productos as $producto)
		<li class="list-group-item">{{ $producto }}</li>
	@endforeach
</ul>
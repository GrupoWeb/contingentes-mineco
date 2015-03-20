@extends('template/template')

@section('content')
<h3 class="text-primary">Perfil de usuario</h3>
<div class="col-sm-12">
	<dl class="dl-horizontal">
      <dt>Nombre:</dt><dd>{{$usuario->nombre}}</dd>
      <dt>Email:</dt><dd>{{$usuario->email}}</dd>
      <dt>Rol:</dt><dd>{{$usuario->rol}}</dd>
      <dt>Fecha de ingreso:</dt><dd>{{$usuario->creado}}</dd>
	</dl>
</div>


<h4 class="text-success">Solicitudes</h4>
<ul id="solicitudes" class="nav nav-tabs">
  <li class="active"><a href="#inscripcion" data-toggle="tab">Inscripción</a></li>
  <li><a href="#asignacion" data-toggle="tab">Asignación</a></li>
  <li><a href="#emision" data-toggle="tab"  >Emisión</a></li>
</ul>
<div id="solicitudesContent" class="tab-content">
  <div role="tabpanel" id="inscripcion" class="tab-pane fade in active">
    <ul class="list-group">
      <h5 class="text-warning">Contingentes</h5>
         @foreach($contingentes as $contingente)
        <li class="list-group-item">
          <div >{{$contingente->tratado." - ".$contingente->producto}}</div> 
        </li>    
        @endforeach
    </ul>
  </div>  

  <div role="tabpanel" id="asignacion" class=" tab-pane fade">
   @if(count($asignaciones))
    
    <ul class="list-group">
      <h5 class="text-warning">Solicitudes</h5>
         @foreach($asignaciones as $asignacion)
        <li class="list-group-item">
          <dl class="dl-horizontal">
            <dt>Fecha solicitud:</dt><dd>{{$asignacion->fechasolicitud}}</dd>
            <dt>Contingente:</dt><dd>{{$asignacion->contingente}}</dd>
            <dt>Solicitado:</dt><dd>{{$asignacion->solicitado}}</dd>
            <dt>Estado:</dt>
              <dd>
                @if($asignacion->estado=="Aprobada")
                  <span class="label label-success" >Aprobada</span></dd>
                @elseif($asignacion->estado=="Rechazada")
                  <span class="label label-danger" >Rechazada</span></dd>
                  <dt>Observaciones:</dt><dd>{{$asignacion->observaciones}}</dd>
                @else
                  <span class="label label-default" >{{$asignacion->estado}}</span></dd>
                @endif

          </dl>
        </li>    
        @endforeach

    </ul>
  @endif
  </div>

   <div role="tabpanel" id="emision" class=" tab-pane fade">
    @if(count($emisiones)) 
    
    <ul class="list-group">
         @foreach($emisiones as $emision)
        <li class="list-group-item">
          <dl class="dl-horizontal">
            <dt>Fecha solicitud:</dt><dd>{{$emision->fechasolicitud}}</dd>
            <dt>Contingente:</dt><dd>{{$emision->contingente}}</dd>
            <dt>Solicitado:</dt><dd>{{$emision->solicitado}}</dd>
            <dt>Emitido:</dt><dd>{{$emision->emitido}}</dd>
            <dt>Estado:</dt>
              <dd>
                @if($emision->estado=="Aprobada")
                  <span class="label label-success" >Aprobada</span></dd>
                @elseif($emision->estado=="Rechazada")
                  <span class="label label-danger" >Rechazada</span></dd>
                   <dt>Observaciones:</dt><dd>{{$emision->observaciones}}</dd>
                @else
                  <span class="label label-default" >{{$emision->estado}}</span></dd>
                @endif
              </dd>
          </dl>
        </li>    
        @endforeach


    </ul>
  @endif
  </div> 
</div>

  <h4 class="text-success">Documentos</h4>
   @foreach($requerimientos as $requerimiento)
  <li class="list-group-item">
      <a class="btn btn-default btn-xs" target="_blank" href="/archivos/{{$usuario->usuarioid. '/'.$requerimiento->archivo }}">
      <span class="fa fa-cloud-download"></span>
      </a>&nbsp;{{$requerimiento->nombre}}
  </li>
  @endforeach
<script>
    $(document).ready(function(){
      $('#solicitudes a').click(function (e) {
        
        e.preventDefault()
        $(this).tab('show')
      })
    });
</script>



@stop
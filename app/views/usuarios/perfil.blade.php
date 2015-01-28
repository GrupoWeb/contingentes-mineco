@extends('template/template')
@section('content')

<h3 class="text-primary">Perfil de usuario</h3>
<div class="col-sm-12">
	<dl class="dl-horizontal">
      <dt>Nombre:</dt><dd>{{$usuario->nombre}}</dd>
      <dt>Email:</dt><dd>{{$usuario->email}}</dd>
      <dt>Rol:</dt><dd>{{$usuario->rol}}</dd>
      <dt>Fecha de ingreso:</dt><dd>{{$usuario->creado}}</dd>
      <dt>Activo:</dt>
        <dd>
          @if($usuario->activo)
            <span class="label label-success" >Si</span>
          @else
            <span class="label label-default" >No</span>
          
          @endif
        </dd>
	</dl>
</div>

<div class="col-md-12">
  <h4 class="text-success">Solicitudes de inscripción</h4>
  <ul class="list-group">
    <h5 class="text-warning">Contingentes</h5>
       @foreach($contingentes as $contingente)
      <li class="list-group-item">
        {{$contingente->tratado." - ".$contingente->producto}}
        @if($contingente->activo)
          <span class="label label-success" >Activo</span>
        @else
          <span class="label label-default" >Inactivo</span>
        @endif
      </li>    
      @endforeach

      <h5 class="text-warning">Documentos</h5>
       @foreach($requerimientos as $requerimiento)
      <li class="list-group-item">
          <a class="btn btn-default btn-xs" target="_blank" href="/archivos/{{$usuario->usuarioid. '/'.$requerimiento->archivo }}">
          <span class="fa fa-cloud-download"></span>
          </a>&nbsp;{{$requerimiento->nombre}}
      </li>
      @endforeach

  </ul>
</div>  
   
  @if(count($emisionRequerimientos)) 
 <div class="col-md-12">
  <h4 class="text-success">Solicitudes de emisión</h4>
  <ul class="list-group">

      <h5 class="text-warning">Documentos</h5>
       @foreach($emisionRequerimientos as $requerimiento)
      <li class="list-group-item">
          <a class="btn btn-default btn-xs" target="_blank" href="/archivos/{{$usuario->usuarioid. '/'.$requerimiento->archivo }}">
          <span class="fa fa-cloud-download"></span>
          </a>&nbsp;{{$requerimiento->nombre}}
      </li>
      @endforeach

  </ul>
</div> 
@endif
 
 @if(count($asignacionRequerimientos))
 <div class="col-md-12">
  <h4 class="text-success">Solicitudes de asignación</h4>
  <ul class="list-group">

      <h5 class="text-warning">Documentos</h5>
       @foreach($asignacionRequerimientos as $requerimiento)
      <li class="list-group-item">
          <a class="btn btn-default btn-xs" target="_blank" href="/archivos/{{$usuario->usuarioid. '/'.$requerimiento->archivo }}">
          <span class="fa fa-cloud-download"></span>
          </a>&nbsp;{{$requerimiento->nombre}}
      </li>
      @endforeach

  </ul>
</div>
@endif



@stop
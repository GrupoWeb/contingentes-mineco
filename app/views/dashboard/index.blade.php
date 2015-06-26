@extends('template/template')

@section('content')
	@if(Session::has('message'))
		<div class="alert alert-{{ Session::get('type') }} alert-dismissable">
			{{ Session::get('message') }}
		</div>
	@endif

	<!--<div class="row"> -->
		<div class="col-md-4 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-cart-plus fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge">{{ $contingentes }}</div>
              <div>Contingentes inscritos</div>
            </div>
          </div>
        </div>
        <a href="/solicitud/inscripcion">
          <div class="panel-footer">
            <span class="pull-left">Solicitar otro</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
	  </div>
	  <div class="col-md-4 col-xs-12">
      <div class="panel panel-green">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-file-text-o fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge">{{ $emisiones }}</div>
              <div>Emisiones Pendientes</div>
            </div>
          </div>
        </div>
        <a href="/historicosolicitudes/emision?estado=Pendiente">
          <div class="panel-footer">
            <span class="pull-left">Ver</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
	  </div>
	  <div class="col-md-4 col-xs-12">
      <div class="panel panel-red">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-ship fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge">{{ number_format($certificados) }}</div>
              <div>Certificados Emitidos</div>
            </div>
          </div>
        </div>
        <a href="/certificados">
          <div class="panel-footer">
            <span class="pull-left">Ver</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
	  </div>
  <!--</div>-->
  <div class="clearfix"></div>
  <div class="row">
  	<div class="col-md-6">
			<div class="panel panel-default">
			  <div class="panel-heading">
			      <i class="fa fa-users fa-fw"></i> Mi Empresa
			  </div>
			  <div class="panel-body">
			  	<ul class="list-group">
					  <li class="list-group-item"><strong>NIT:</strong> {{ $empresa->nit }}</dd>
					  <li class="list-group-item"><strong>Razón Social:</strong> {{ $empresa->razonsocial }}</dd>
					  <li class="list-group-item"><strong>Propietario:</strong> {{ $empresa->propietario }}</dd>
					  <li class="list-group-item"><strong>Domicilio Fiscal:</strong> {{ $empresa->domiciliofiscal }}</dd>
					  <li class="list-group-item"><strong>Domicilio Comercial:</strong> {{ $empresa->domiciliocomercial }}</dd>
					  <li class="list-group-item"><strong>Domicilio Notificaciones:</strong> {{ $empresa->direccionnotificaciones }}</dd>
					  <li class="list-group-item"><strong>Teléfono:</strong> {{ $empresa->telefono }}</dd>
					  <li class="list-group-item"><strong>FAX:</strong> {{ $empresa->fax }}</dd>
					  <li class="list-group-item"><strong>Encargado:</strong> {{ $empresa->encargadoimportaciones }}</dd>
					</ul>
			  </div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
			  <div class="panel-heading">
			      <i class="fa fa-file-text fa-fw"></i> Listado de tratados
			  </div>
			  <div class="panel-body">
			    <ul class="list-group">
			    	@foreach($tratados as $tratado)
					  	<li class="list-group-item">
					  		<a 
									href        = "#" 
									class       = "tratadolist" 
									data-toggle = "modal"
									data-target = "#myModal"
									data-tid    = "{{ Crypt::encrypt($tratado->tratadoid) }}"
									data-title  = "{{ $tratado->nombrecorto }}">
					  				{{ $tratado->nombrecorto }}
					  		</a>
					  	</li>
					  @endforeach
					</ul>
			  </div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">
	        	<div id="modaltitle"></div>
	        </h4>
	      </div>
	      <div class="modal-body">
	        <div id="modalbody"></div>
	      </div>
	    </div>
	  </div>
	</div>
	
	<script>
		$(document).ready(function(){
			$('.tratadolist').click(function(){
				var tid   = $(this).attr('data-tid');
				var title = $(this).attr('data-title');

				$('#modaltitle').html(title);

				$.get('/tratado/detalle/' + tid, function(data) {
					$('#modalbody').html(data);
				});
			})
		});
	</script>
@stop
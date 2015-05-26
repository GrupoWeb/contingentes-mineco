@extends('template/template')

@section('content')
	@if(Session::has('message'))
		<div class="alert alert-{{ Session::get('type') }} alert-dismissable">
			{{ Session::get('message') }}
		</div>
	@endif

	<div class="row">
		<div class="col-lg-4 col-md-6">
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
      </div>
	  </div>
	  <div class="col-lg-4 col-md-6">
      <div class="panel panel-green">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-file-text-o fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge">{{ $emisiones }}</div>
              <div>Solicitudes de Emisión</div>
            </div>
          </div>
        </div>
      </div>
	  </div>
	  <div class="col-lg-4 col-md-6">
      <div class="panel panel-red">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-ship fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge">{{ number_format(abs($toneladas), 3) }}</div>
              <div>Toneladas en certificados</div>
            </div>
          </div>
        </div>
      </div>
	  </div>
  </div>

  <div class="row">
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
		<div class="col-md-6">
			<div class="panel panel-default">
			  <div class="panel-heading">
			      <i class="fa fa-area-chart fa-fw"></i> Gráfica (pendiente)
			  </div>
			  <div class="panel-body">
			  	<div id="grTiempos"></div>
			  </div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
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
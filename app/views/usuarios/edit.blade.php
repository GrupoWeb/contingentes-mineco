@extends('template/template')

@section('content')
	{{Form::open(array('url'=>'usuarioempresas/'.Crypt::encrypt($usuario->usuarioid),'id'=>'frmUsuario','class'=>'form-horizontal')) }}
		{{ Form::hidden('_method', 'PUT') }}
		<div class="col-md-12">
			<h4 class="titulo">Editar usuario</h4>
		</div>
    <!-- nit -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txNIT" class="col-sm-4 control-label">1. NIT</label>
        <div class="col-sm-8">
          {{ Form::text('txNIT', $usuario->nit, array('class'=>'form-control', 
            'data-bv-notEmpty'         => 'true',
            'data-bv-notEmpty-message' => 'El NIT es requerido',
            'data-bv-nit'              => 'true',
            'autocomplete'             => 'off',
            'data-bv-remote'           => 'true',
            'data-bv-remote-url'       => '/signup/checkNIT?u='.Crypt::encrypt($usuario->usuarioid),
            'data-bv-remote-message'   => 'NIT ya existe en la base de datos',
            'data-bv-remote-type'      => 'POST'
            )) }}
        </div>
      </div>
    </div>
		<!-- razon social -->
	  <div class="col-md-12">
      <div class="form-group">
        <label for="txNombre" class="col-sm-2 control-label">2. Razón Social</label>
        <div class="col-sm-10">
          {{ Form::text('txRazonSocial', $usuario->razonsocial, array('class'=>'form-control', 
            'data-bv-notEmpty'         => 'true',
            'data-bv-notEmpty-message' => 'La razón social es requerida',
            'autocomplete'             => 'off',
            'placeholder'              => 'Nombre, denominación o razón social de la empresa'
            )) }}
        </div>
      </div>
    </div>
    <!-- representante legal  -->
		<div class="col-md-12">
      <div class="form-group">
        <label for="txNombre" class="col-sm-2 control-label">3. Rep. Legal</label>
        <div class="col-sm-10">
          {{ Form::text('txPropietario', $usuario->propietario, array('class'=>'form-control', 
            'data-bv-notEmpty'         =>'true',
            'data-bv-notEmpty-message' => 'El representante legal es requerido',
            'autocomplete'             => 'off',
            'placeholder'              => 'Nombre del propietario o representante legal'
            )) }}
        </div>
      </div>
    </div>
    <!-- email -->
    <div class="col-md-12">
      <div class="form-group">
        <label for="email" class="col-sm-2 control-label">4. Email</label>
        <div class="col-sm-10">
          {{ Form::text('email', $usuario->email, array(
            'class'                        => 'form-control',
            'data-bv-notEmpty'             => 'true',
            'data-bv-notEmpty-message'     => 'El email es requerido',
            'data-bv-emailaddress'         => 'true',
            'data-bv-emailaddress-message' => 'Email con formato incorrecto',
            'data-bv-remote'               => 'true',
            'data-bv-remote-url'           => '/signup/checkEmail?u='.Crypt::encrypt($usuario->usuarioid),
            'data-bv-remote-message'       => 'Email ya existe en la base de datos',
            'data-bv-remote-type'          => 'POST'
          )) }}
        </div>
      </div>
    </div>
    <!-- telefono -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txTelefono" class="col-sm-4 control-label">5. Teléfono</label>
        <div class="col-sm-8">
          {{ Form::text('txTelefono', $usuario->telefono, array('class'=>'form-control', 
            'data-bv-notEmpty'         => 'true',
            'data-bv-notEmpty-message' => 'El teléfono es requerido',
            'data-bv-integer'          => 'true',
            'data-bv-integer-message'  => 'Debe ser un número',
            'autocomplete'             => 'off'
            )) }}
        </div>
      </div>
    </div>   
    <!-- fax -->    
    <div class="col-md-6">
      <div class="form-group">
        <label for="txFax" class="col-sm-4 control-label">6. FAX</label>
        <div class="col-sm-8">
          {{ Form::text('txFax', $usuario->fax, array('class'=>'form-control', 
            'data-bv-integer' => 'true',
            'data-bv-integer-message' => 'Debe ser un número',
            'autocomplete'             => 'off'
            )) }}
        </div>
      </div>
    </div>    
    <!--password --> 
    <div class="col-md-6">
      <div class="form-group">
        <label for="txPassword" class="col-sm-4 control-label">7. Contrase&ntilde;a</label>
        <div class="col-sm-8">
          {{ Form::password('txPassword', array(
            'class'                        =>'form-control', 
            'placeholder'                  => 'M&iacute;nimo 6 caracteres',
            'data-bv-stringlength'         => 'true',
            'data-bv-stringlength-min'     => '6',
            'data-bv-stringlength-message' => 'La contrase&ntilde;a debe tener al menos 6 caracteres.',
            'data-bv-identical'            => 'true',
            'data-bv-identical-field'      => 'txPasswordrepeat',
            'data-bv-identical-message'    => 'Las contrase&ntilde;as no concuerdan'
          )) }}
        </div>
      </div>
    </div>
    <!--password2 -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txPasswordrepeat" class="col-sm-4 control-label">&nbsp;</label>
        <div class="col-sm-8">
          {{ Form::password('txPasswordrepeat', array(
            'class'                     => 'form-control', 
            'placeholder'               => 'Repetir contrase&ntilde;a',
            'data-bv-identical'         => 'true',
            'data-bv-identical-field'   => 'txPassword',
            'data-bv-identical-message' => 'Las contrase&ntilde;as no concuerdan'
          )) }}
        </div>
      </div>
    </div>
    <!--domicilio fiscal -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txNombre" class="col-sm-4 control-label">8. Domicilio Fiscal</label>
        <div class="col-sm-8">
          {{ Form::textarea('txDomicilioFiscal', $usuario->domiciliofiscal, array('class'=>'form-control', 
            'data-bv-notEmpty'         =>'true',
            'data-bv-notEmpty-message' => 'El domicilio fiscal es requerido',
            'autocomplete'             => 'off',
            'rows'                     => 3,
            )) }}
        </div>
      </div>
    </div>
    <!--domicilio comercial -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txNombre" class="col-sm-4 control-label">9. Domicilio Comercial</label>
        <div class="col-sm-8">
          {{ Form::textarea('txDomicilioComercial', $usuario->domiciliocomercial, array('class'=>'form-control', 
            'data-bv-notEmpty'         =>'true',
            'data-bv-notEmpty-message' => 'El domicilio comercial es requerido',
            'autocomplete'             => 'off',
            'rows'                     => 3,
            )) }}
        </div>
      </div>
    </div>
    <!-- lugar -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txDireccionNotificaciones" class="col-sm-4 control-label">10. Lugar para recibir notificaciones</label>
        <div class="col-sm-8">
          {{ Form::textarea('txDireccionNotificaciones', $usuario->direccionnotificaciones, array('class'=>'form-control', 
            'data-bv-notEmpty'         =>'true',
            'data-bv-notEmpty-message' => 'El lugar para recibir notificaciones es requerido',
            'autocomplete'             => 'off',
            'rows'                     => '3',
            )) }}
        </div>
      </div>
    </div>
    <!--encargado -->
    <div class="col-md-6">
      <div class="form-group">
        <label for="txNombre" class="col-sm-4 control-label">11. Encargado</label>
        <div class="col-sm-8">
          {{ Form::text('txEncargadoImportaciones', $usuario->encargadoimportaciones, array('class'=>'form-control', 
            'data-bv-notEmpty'         =>'true',
            'data-bv-notEmpty-message' => 'El nombre del encargado es requerido',
            'autocomplete'             => 'off',
            'placeholder'              => 'Importacion/exportacion'
            )) }}
        </div>
      </div>
    </div>
    <!--tratados -->
    <div class="clearfix"></div>
    <div class="col-md-6">
      <div class="form-group">
        <div class="col-sm-4">&nbsp;</div>
        <div class="col-sm-8">
          <div class="checkbox">
				    <label>
				      <input type="checkbox" value="1" name="activo" {{ $usuario->activo <> 0 ? 'checked' : ''}}> Activo
				    </label>
			    </div>
        </div>
      </div>
    </div><!-- activo -->
    <div class="clearfix"></div>
		<div class="col-md-6">
      <div class="form-group">
        <div class="col-sm-4">&nbsp;</div>
        <div class="col-sm-8">
          {{ Form::submit('Guardar', array('class'=>'btn btn-large btn-primary')) }}
        </div>
      </div>
    </div>
	{{Form::close()}}

	<script>
		$(document).ready(function(){
      $('#frmUsuario')
        .bootstrapValidator({
          excluded: ':disabled',
          feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
          },
      });
    });
	</script>
@stop
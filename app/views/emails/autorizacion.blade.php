<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div style="float: left; text-align:left"><img src="http://office.cs.com.gt/sitios/dace/dace.png"></div>
		<div style="float: right; text-align:right"><img src="http://office.cs.com.gt/sitios/dace/logo.jpg"></div>
		<div style="clear:both"></div>
		<hr>
		<p>Estimado {{ $nombre }},</p>
		<p>Por este medio se le informa que su solicitud, ingresada el <strong>{{ $fecha }}</strong> ha sido:</p>
		<p style="text-align: center;">
			<h3 style="text-align: center; color: {{ $estado == 'Aprobada' ? 'green' : 'red' }}">{{ $estado }}</h3>
		</p>
		<p>con las siguientes observaciones:</p>
		<p>{{ $observaciones }}</p>
		<br />
		<p>Para mayor informaci&oacute;n pued escribir a <a href="mailto:info@mineco.gob.gt">info@mineco.gob.gt</a></p>
		<hr>
		<p style="text-align:center; font-size: 12px;"><small>
			<strong>Direcci&oacute;n de Administraci&oacute;n de Comercio Exterior</strong><br/>
			Ministerio de Econom&iacute;a <br/>
			8a Avenida 10-43, zona 1<br/>
			Ciudad de Guatemala<br/>
			Apartado Postal 01001<br/>
			Teléfonos: (502)+ 2412 0200 Ext. 4200<br/>
			Fax: (502) 2232 7449
		</small></p>
	</body>
</html>









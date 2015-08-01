<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body style="font-family: sans-serif; font-size: 14px; margin: 0; color: #000001;">
		<div style="background-color: #e8eaea;">
			<div style="text-align:center; background-color: #fff">
				<img src="{{Config::get('website.url')}}/images/logo.jpg">
			</div>
			<div style="background-color: #0054a4; border-bottom: 8px solid #e8eaea; border-top: 8px solid #e8eaea; color: #fff;
	    font-family: sans-serif; font-size: 20px; margin: 0; padding-bottom: 13px; padding-top: 13px; text-align: center; text-transform: uppercase;">
	    	@yield('titulo')
	    </div>
	    <div style="background-color: #d3d7d8; margin: 0 auto 8px auto; width: 90%; max-width: 800px; padding: 18px 10px 18px 10px;">
				@yield('content')
				<br />

				<p style="font-size:12px;">
				@if(!isset($despedida))
				  Para mayor informaci&oacute;n puede escribir a <a href="mailto:{{Config::get('website.email')}}">{{Config::get('website.email')}}</a> o ingresando a la página web <a href="{{url()}}}">{{url()}}</a>
				@else
				  {{$despedida}}
				@endif
				</p>
				<p style="font-size:12px;">Todas las gestiones que realice a través de este sistema <strong>NO TIENE NINGUN COSTO</strong>
			</div>
			&nbsp;
		</div>
		<div>
			<p style="text-align:center; font-size: 12px; border: solid thin #666; padding: 5px; width: 80%; max-width: 700px; margin: 15px auto 15px auto;"><small>
					<strong>Direcci&oacute;n de Administraci&oacute;n de Comercio Exterior - DACE <br/>
					Ministerio de Econom&iacute;a </strong><br/>
					8a Avenida 10-43, zona 1<br/>
					Ciudad de Guatemala, 01001<br/>
					Teléfonos: (502) 2412 0200 Ext. 4203, 4209 o 4212<br/>
					Fax: (502) 2412 0319
				</small>
			</p>
		</div>
	</body>
</html>
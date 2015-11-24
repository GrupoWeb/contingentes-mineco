<!DOCTYPE html>
<html lang="en">
	<head>
		<title></title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="temp1/css/reset.css" type="text/css" media="all">
		<link rel="stylesheet" href="temp1/css/layout.css" type="text/css" media="all">
		<link rel="stylesheet" href="temp1/css/style.css" type="text/css" media="all">
		{{ HTML::style('https://fonts.googleapis.com/css?family=Archivo+Narrow|Lato:400,700') }}
  {{ HTML::style('packages/csgt/components/css/bootstrap.min.css'); }}
  {{ HTML::style('css/home.css'); }}
  {{ HTML::style('css/dace.css') }}

  {{ HTML::script('packages/csgt/components/js/jquery.min.js'); }}
  {{ HTML::script('packages/csgt/components/js/bootstrap.min.js'); }}
		<script type="text/javascript" src="temp1/js/jquery-1.6.js" ></script>
		<script type="text/javascript" src="temp1/js/cufon-yui.js"></script>
		<script type="text/javascript" src="temp1/js/cufon-replace.js"></script>  
		<script type="text/javascript" src="temp1/js/Vegur_300.font.js"></script>
		<script type="text/javascript" src="temp1/js/PT_Sans_700.font.js"></script>
		<script type="text/javascript" src="temp1/js/PT_Sans_400.font.js"></script>
		<script type="text/javascript" src="temp1/js/tms-0.3.js"></script>
		<script type="text/javascript" src="temp1/js/tms_presets.js"></script>
		<script type="text/javascript" src="temp1/js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="temp1/js/atooltip.jquery.js"></script>
		<!--[if lt IE 9]>
		<script type="text/javascript" src="js/html5.js"></script>
		<link rel="stylesheet" href="css/ie.css" type="text/css" media="all">
		<![endif]-->
		<!--[if lt IE 7]>
			<div style=' clear: both; text-align:center; position: relative;'>
				<a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a>
			</div>
		<![endif]-->
	</head>
	<body id="page1">
		<div class="main">
<!--header -->
			<header>
				<div class="col-md-8">
					<nav>
						<ul id="menu">
							<li class="active"><a href=""><span>Solucion</span></a></li>
							<li><a href=""><span>Acuerdos comerciales</span></a></li>
							<li><a href=""><span>manuales</span></a></li>
						</ul>
					</nav>
				</div>
				<div class="col-md-3" align="right">
					<img style="margin-top:40px; margin-left:43px" class="center-block" src="/images/logo-menu.png" alt="">
				</div>
				<div>
					<div class="col-md-6">
						<img src="images/home.jpg" alt="">
						<p style="padding-bottom: 0px;">Cualquier duda o comentario, estamos para servirle. 2412 0200 ext. 4203, 4209 o 4212 </p>
					</div>
				</div>
			</header>
<!--header end-->
<!--content -->
			<article style="margin-top:-20px" id="content"><div class="ic">More Website Templates @ TemplateMonster.com - November 14, 2011!</div>
				<div style="margin-top:-20px" class="wrapper">
					<div class="col-md-3">
						<h2 style="color:#001e54; font-weight:bold;">Tus certificados en línea sin ningún costo</h2>
						<p>La DACE tiene como objetivo administrar los acuerdos comerciales de carácter internacional vigentes para Guatemala, propiciando su óptimo aprovechamiento. Puedes consultar los tratados comerciales vigentes presionando el botón inferior.</p>
						<a href="">SOLICITUD DE INSCRIPCION</a>
					</div>
					<div class="col-md-3">
						<h2 style="color:#001e54; font-weight:bold;">Acuerdos comerciales</h2>
						<p>La DACE tiene como objetivo administrar los acuerdos comerciales de carácter internacional vigentes para Guatemala, propiciando su óptimo aprovechamiento. Puedes consultar los tratados comerciales vigentes presionando el botón inferior.</p>
						<a href="">MAS INFORMACION</a>
					</div>
					<div class="col-md-3">
						<h2 style="color:#001e54; font-weight:bold;">¿Ya tienes cuenta?</h2>
						<p>Si eres un usuario existente, puedes ingresar presionando en el link inferior. Con ello podrás solicitar tus certificados de importación o exportación en línea, consultar tu saldo o reiniciar tu contraseña.</p>
						<a href="">INICIAR SESION</a>
					</div>
					<div class="col-md-3">
						<h2 style="color:#001e54; font-weight:bold;">Manuales</h2>
						<p>Aquí podrás consultar los manuales de utilización del sistema en formato PDF. Los mismos los puedes descargar o consultar diretamente desde la página.</p>
						<a href="">VER MANUALES</a>
					</div>
				</div>
			</article>
		</div>
		<div class="bg1">
			<div class="main">
				<article id="content2">
					<div class="wrapper">
						<div class="col2 marg_right1">
						</div>
						<div class="col1">
						</div>
					</div>
				</article>
			</div>
		</div>
		<script type="text/javascript"> Cufon.now(); </script>
		<script>
			$(window).load(function(){
				$('#slider')._TMS({
					banners:true,
					waitBannerAnimation:false,
					preset:'diagonalFade',
					easing:'easeOutQuad',
					pagination:true,
					duration:400,
					slideshow:8000,
					bannerShow:function(banner){
						banner.css({marginRight:-500}).stop().animate({marginRight:0}, 600)
					},
					bannerHide:function(banner){
						banner.stop().animate({marginRight:-500}, 600)
					}
					})
			})
		</script>
	</body>
</html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
          
    <!-- ===========================
    THEME INFO
    =========================== -->
    <meta name="description" content="A free Bootstrap powerd HTML template exclusively crafted for the super lazy designers like me who designed thousand of websites till today but never got a chance to build one himself.">
    <meta name="keywords" content="Free Portfolio Template, Free Template, Free Bootstrap Template, Dribbble Portfolio Template, Free HTML5 Template">
    <meta name="author" content="EvenFly Team">
    
    <!-- DEVEOPER'S NOTE:
    This is a free Bootstrap powered HTML template from EvenFly. Feel free to download, modify and use it for yourself or your clients as long there is no money involved.
    
    Please don't try to sale it from anywhere; because I want it to be free, forever. If you sale it, That's me who deserves the money, not you :)
    -->

    <!-- ===========================
    SITE TITLE
    =========================== -->
    <title></title><!-- This is what you see on your browser tab-->
    
    <!-- ===========================
    FAVICONS
    =========================== -->
    <link rel="icon" href="img/favicon.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-ipad-retina.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-iphone-retina.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-ipad.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon-iphone.png" />
     
    <!-- ===========================
    STYLESHEETS
    =========================== -->    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="temp3/css/preloader.css">
    <link rel="stylesheet" href="temp3/css/style.css">
    <link rel="stylesheet" href="temp3/css/responsive.css">
    <link rel="stylesheet" href="temp3/css/animate.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{ HTML::style('https://fonts.googleapis.com/css?family=Archivo+Narrow|Lato:400,700') }}
    {{ HTML::style('packages/csgt/components/css/bootstrap.min.css'); }}
    {{ HTML::style('css/home.css'); }}
    {{ HTML::style('css/dace.css') }}

    {{ HTML::script('packages/csgt/components/js/jquery.min.js'); }}
    {{ HTML::script('packages/csgt/components/js/bootstrap.min.js'); }}
        
    <!-- ===========================
    ICONS: 
    =========================== -->
    <link rel="stylesheet" href="temp3/css/simple-line-icons.css">    
    
    <!-- ===========================
    GOOGLE FONTS
    =========================== -->    
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Antic|Raleway:300">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  <!-- ===========================
   GOOGLE ANALYTICS (Optional)
   =========================== -->
    
    <!--Replace this line with your analytics code-->
     
    <!-- Analytics end-->
  
   </head>
    <body data-spy="scroll">
        
      <header>               
        <!-- ===========================
        HERO AREA
        =========================== -->
        <div id="hero">           
          <div class="container herocontent">               
            <h2 class="wow fadeInUp" data-wow-duration="2s">Drifolio the Awesome</h2>                
            <h4 class="wow fadeInDown" data-wow-duration="3s">Exclusively crafted  for the super lazy designers like me who designed thousand of websites till today but never got a chance to build one himself.</h4>            
          </div>
          
          <!-- Featured image on the Hero area -->
          <img class="heroshot wow bounceInUp" data-wow-duration="4s" src="img/hero-img.png" alt="Featured Work">            
        </div><!--HERO AREA END-->        
        
        <!-- ===========================
         NAVBAR START
         =========================== -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
          <div class="container">
               
            <div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <img src="/images/logo.png" alt="">
            </div>

            <div class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-right"><!--YOUR NAVIGATION ITEMS STRAT BELOW-->
                <li><a href="#about">Solicitud de inscripcion</a></li>
                <li><a href="#services">Acuerdos comerciales</a></li>
                <li><a href="#portfolio">Manuales</a></li>
                <li><a href="#testimonials"><span class="btnicon icon-user"></span>Iniciar sesion</a></li>
              </ul>
            </div><!--.nav-collapse -->
          </div>
        </nav><!--navbar end-->        
      </header><!--header end-->      

       <div id="about" class="container">
          
          <!-- LEFT PART OF THE ABOUT SECTION -->
           <div class="col-md-4">
              <div class="row">
               <h2 style="color:#0054A4;" class="wow fadeInDown" data-wow-duration="2s">Tus certificados en línea sin ningún costo</h2>
               
               <h5 class="wow fadeInDown" data-wow-duration="3s">Haz tus solicitudes en linea, consulta tu saldo en tiempo real y obtén tus certificados fácilmente. Todas las gestiones que realice a través de este Sistema NO TIENEN NINGUN COSTO. Inscribe a tu empresa accediendo al siguiente formulario.</h5>
               
               <a class="dribbble-follow-button wow bounce" href="http://dribbble.com/srizon">Solicitud de inscripcion</a>
               </div> <!-- ABOUT INFO END -->
           </div><!-- LEFT PART OF THE ABOUT SECTION END -->
           <div class="col-md-8">
             <img class="img-responsive" src="/images/home.jpg" alt="">
             <h5 align="right">Cualquier duda o comentario, estamos para servirle. 2412 0200 ext. 4203, 4209 o 4212</h5 align="right">
           </div>
          <!--Left part end-->      
       </div><!-- ABOUT SECTION END -->
        
    <hr><!-- SECTION SEPARETOR LINE -->
        
    <!-- ===========================
    SERVICE SECTION START
    =========================== -->
    <div id="services" class="container">
         
      <!-- SERVICE ITEMS START -->
      <div class="row">
        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="3s">
           <img src="img/s1.png" alt="">
           <h4>Acuerdos comerciales</h4>
           <h5>La DACE tiene como objetivo administrar los acuerdos comerciales de carácter internacional vigentes para Guatemala, propiciando su óptimo aprovechamiento. Puedes consultar los tratados comerciales vigentes presionando el botón inferior.</h5>
           <a href="http://dribbble.com/srizon">Mas informacion</a>
        </div> <!-- ITEM END -->

        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="3s">
           <img src="img/s2.png" alt="">
           <h4>¿Ya tienes cuenta?</h4>
           <h5>Si eres un usuario existente, puedes ingresar presionando en el link inferior. Con ello podrás solicitar tus certificados de importación o exportación en línea, consultar tu saldo o reiniciar tu contraseña.</h5>
           <a href="http://dribbble.com/srizon">Iniciar sesion</a>
        </div> <!-- ITEM END -->

        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="3s">
           <img src="img/s3.png" alt="">
           <h4>Manuales</h4>
           <h5>Aquí podrás consultar los manuales de utilización del sistema en formato PDF. Los mismos los puedes descargar o consultar diretamente desde la página.</h5>
           <a href="http://dribbble.com/srizon">Ver manuales</a>
        </div> <!-- ITEM END -->
    </div><!-- SERVICE SECTION END -->
    
    <!-- ===========================
    PORTFOLIO SECTION START
    =========================== -->
    <div id="portfolio">
      <h5 align="center" style="margin-top:50px;"><a href="">Compuservice Webdesigns © 2015</a></h5>
    </div><!-- PORTFOLIO SECTION END -->  
    
    <!-- ===========================
    FOOTER START
    =========================== -->    
    <footer>
       
      <div class="footerlinks"></div><!-- FOOTER LINKS END -->
       
      <div class="footersocial wow fadeInUp" data-wow-duration="3s"></div><!-- FOOTER SOCIAL ICONS END -->
     </footer><!-- FOOTER END -->
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    
    <!--Other necessary scripts-->
    <script src="temp3/js/jquery.nicescroll.min.js"></script>
    <script src="temp3/js/jquery.jribbble-1.0.1.ugly.js"></script>
    <script src="temp3/js/drifolio.js"></script>
    <script src="temp3/js/wow.min.js"></script>
    <script>new WOW().init();</script>    
  </body>
</html>
<!DOCTYPE html>
<html lang="es">

<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <meta property="og:image" content="https://hackmx.mx/images/hackmx-facebook.png" />
      <meta property="og:url"content="https://hackmx.mx/" />
      <meta property="og:title" content="HackMx by Tec de Monterrey" />

      <title>HackMx 2</title>

      <!--Font -->
      <link rel="stylesheet" href="https://use.typekit.net/bqt1rpy.css" />

      <!-- Bootstrap -->
      <link type="text/css" rel="stylesheet" href="stylesheets/bootstrap.min.css" />

      <!-- Magnific Popup -->
      <link type="text/css" rel="stylesheet" href="stylesheets/magnific-popup.css" />

      <!-- Font Awesome Icon -->
      <link rel="stylesheet" href="stylesheets/font-awesome.min.css">

      <!-- Custom stlylesheet -->
      <link type="text/css" rel="stylesheet" href="stylesheets/style.css" />
      <link type="text/css" rel="stylesheet" href="stylesheets/styleConf.css" />

    <style>
    .file-input {
    	  display: inline-block;
    	  text-align: left;
    	  background: #fff;
    	  padding: 16px;

    	    width: 100%;
    	  position: relative;
    	  border-radius: 3px;
    	}

    	.file-input > [type='file'] {
    	  position: absolute;
    	  top: 0;
    	  left: 0;
    	  width: 100%;
    	  height: 100%;
    	  opacity: 0;
    	  z-index: 10;
    	  cursor: pointer;
    	}



    	.file-input > .label {
    	  color: #333;
    	  white-space: nowrap;
    	  opacity: .3;
    	}

    	.file-input.-chosen > .label {
    	    color: #f2cb65;
    	  opacity: 1;
    	}
    </style>

      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body>
      <!-- Header -->
      <header id="home">
            <!-- Background Image -->
            <div class="bg-img" style="background-color: #00b7dd;">
            </div>
            <!-- /Background Image -->

            <!-- Nav -->
            <nav id="nav" class="navbar nav-transparent">
                  <div class="container">

                        <div class="navbar-header">
                              <!-- Logo -->
                              <div class="navbar-brand">
                                    <a href="/">
                                          <img class="logo" src="images/logo.png" alt="logo">
                                          <img class="logo-alt" src="images/logo-alt.png" alt="logo">
                                    </a>
                              </div>
                              <!-- /Logo -->

                              <!-- Collapse nav button -->
                              <div class="nav-collapse">
                                    <span></span>
                              </div>
                              <!-- /Collapse nav button -->
                        </div>

                        <!--  Main navigation  -->
                        <ul class="main-nav nav navbar-nav navbar-right">
                              <li><a href="?inicio">Inicio</a></li>
                                <li><a href="?registro">Registro</a></li>
                                <li ><a href="?miRegistro">Mi registro</a></li>
                              <li class="active"><a href="#">Subir credencial</a></li>

                              <li><a href="//www.facebook.com/TecHackMx/"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                        </ul>
                        <!-- /Main navigation -->

                  </div>
            </nav>
            <!-- /Nav -->

            <!-- home wrapper -->
            <div class="home-wrapper">
                  <div class="container">
                        <div class="row">

                              <!-- home content -->
                              <form class="contact-form" id="contactForm">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6 col-md-offset-3 mb form-group" id="groupInputCodigo">
                                            <label for="inputName" class="control-label" style="color:#fff">Código de confirmación: </label>
                                            <input type="text" class="form-control" name="codigo" id="inputcodigo" placeholder="Ej. X32M5D3C" value="<?php if(isset($_GET["id"])){ echo $_GET["id"]; } ?>" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-xs-12 col-md-6 col-md-offset-3 mb form-group" id="groupInputCredencial">

                                            <label for="inputFileCard" class="control-label" style="color:#fff">Credencial: </label><br/>
                                             <div class='file-input'>
                                                  <input type='file' name="credencial" id="inputFileCard" accept="image/jpeg, image/png" require>
                                                  <span class='btn white-btn'>Elegir archivo</span>
                                                  <span class='label' data-js-label>No hay archivo seleccionado</span>
                                                </div>

                                      </div>
                                    </div>


                                    <button type="submit" name="contact" class="btn btn-send btn-lg">Enviar</button>
                               </form>
                        </div>
                  </div>
            </div>
            <!-- /home wrapper -->


      </header>
      <!-- /Header -->

      <!-- jQuery Plugins -->
      <script type="text/javascript" src="javascripts/jquery.min.js"></script>
      <script type="text/javascript" src="javascripts/bootstrap.min.js"></script>
      <script type="text/javascript" src="javascripts/jquery.magnific-popup.js"></script>
      <script type="text/javascript" src="javascripts/main.js"></script>
    <script>
        var inputs = document.querySelectorAll('.file-input')

for (var i = 0, len = inputs.length; i < len; i++) {
  customInput(inputs[i])
}

function customInput (el) {
  const fileInput = el.querySelector('[type="file"]')
  const label = el.querySelector('[data-js-label]')

  fileInput.onchange =
  fileInput.onmouseout = function () {
    if (!fileInput.value) return

    var value = fileInput.value.replace(/^.*[\\\/]/, '')
    el.className += ' -chosen'
    label.innerText = value
  }
}
    </script>
    </body>

</html>

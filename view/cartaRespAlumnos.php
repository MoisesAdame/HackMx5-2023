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

      </style>

      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body style="background-color: #00b7dd;">
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
                              <li class="active"><a href="#">Carta Responsabilidad</a></li>
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
                              <!-- Alerts -->
                              <div class="col-xs-12">
                                    <div class="hidden alert alert-success alert-dismissible"  id="registerAlertSuccess">
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          <strong>Registro exitoso!</strong> Revisa tu correo para completar el registro.[Checa spam :/]
                                    </div>
                                    <div class="hidden alert alert-danger alert-dismissible"  id="registerAlertFailure">
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          <p id="registerAlertFailureMessage"><strong>Rayos!</strong> Hubo un problema con nuestros servidores inténtalo más tarde.</p>
                                    </div>
                              </div>
                              <!-- /Alerts -->
                              <div class="col-xs-12">
                                    <form class="contact-form" id="contactForm">
                                          <div class="row">
                                                <div class="col-xs-12 col-md-6 col-md-offset-3 mb form-group" id="groupInputId">
                                                      <label for="inputID" class="control-label" style="color:#fff">Número de registro: </label>
                                                      <input type="text" class="form-control" name="id" id="inputID" placeholder="Ej. c4a9dc48" required>
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="col-xs-12 col-md-6 col-md-offset-3 mb form-group" id="groupInputName">
                                                      <label for="inputNombreSGM" class="control-label" style="color:#fff">Nombre de la Aseguradora de Gastos Médicos: </label>
                                                      <input type="text" class="form-control" name="nombre" id="inputNombreSGM" placeholder="Ej. Seguro de Gastos Médicos Mayores MAPFRE" required>
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="col-xs-12 col-md-6 col-md-offset-3 mb form-group" id="groupInputPoliza">
                                                      <label for="inputPolizaContrato" class="control-label" style="color:#fff">Número de Póliza de Seguro: </label>
                                                      <input type="text" class="form-control" name="poliza" id="inputPolizaContrato" placeholder="Ej. 837591024" required>
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="col-xs-12 col-md-6 col-md-offset-3 mb form-group" id="groupInputCareer">
                                                      <label for="inputCareer" class="control-label" style="color:#fff">Carrera: </label>
                                                      <input type="text" class="form-control" name="career" id="inputCareer" placeholder="Ej. Ingeniería en Sistemas Computacionales" required>
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="col-xs-12 col-md-6 col-md-offset-3 mb form-group" id="groupInputIdEstudiante">
                                                      <label for="inputIdEstudiante" class="control-label" style="color:#fff">Número estudiante/Matrícula: </label>
                                                      <input type="text" class="form-control" id="inputIdEstudiante" placeholder="Ej. A01234567" required></textarea>
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="col-xs-12 col-md-6 col-md-offset-3 mb form-group" id="groupInputContactoEmergencia">
                                                      <label for="inputContactoEmergencia" class="control-label" style="color:#fff">Contacto de Emergencia: </label>
                                                      <input type="text" class="form-control" id="inputContactoEmergencia" placeholder="Ej. Carlos Arce López." required></textarea>
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="col-xs-12 col-md-6 col-md-offset-3 mb form-group" id="groupInputNumeroEmergencia">
                                                      <label for="inputNumeroEmergencia" class="control-label" style="color:#fff">Número de Emergencia: </label>
                                                      <input type="text" class="form-control" id="inputNumeroEmergencia" placeholder="Ej. 5521293912" required></textarea>
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="col-xs-12 col-md-6 col-md-offset-3 mb form-group" id="groupInputCheckbox">
                                                      <label style="color:#fff"><input type="checkbox" name="cartaRespAlumnos" value="Aceptar" required> Acepto de manera incondicional todos y cada uno de los términos, condiciones y alcances contenidos en la “Carta de responsabilidad de los alumnos 2019”, misma que he leído y comprendido a entera satisfacción.</label><br>
                                                </div>
                                          </div>

                                          <button type="submit" name="contact" class="btn btn-send btn-lg">Enviar</button>
                                    </form>
                                    <div class="row">
                                          <div class="col-xs-6 col-md-3 col-md-offset-2 mb form-group">
                                                <a href="documents/carta_alumnos_responsabilidad_2019.docx" style="color:#fff">[Carta Responsabilidad]</a>
                                          </div>
                                          <div class="col-xs-6 col-md-3 col-md-offset-2 mb formgroup">
                                                <a href="documents/reglamento_general_estudiantes_2018.pdf" style="color:#fff">[Reglamento General de Alumnos]</a>
                                          </div>
                                    </div>
                              </div>
                              <!-- home content -->


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

</body>

</html>

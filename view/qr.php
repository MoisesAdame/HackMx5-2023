<?php
require "connect.php";

$registro = false;
$confirmacion = false;
$error = false;
$correo ="";
$nombre = "";
if(isset($_GET["id"]))
{
  $codigo = $_GET["id"];
  $query = "SELECT * FROM participantes INNER JOIN confirmacion_datos USING (idParticipante) WHERE idParticipante = ?";
  $query = $connection->prepare($query);
  $query->bind_param("s",$codigo);
  $query->execute();
  $query = $query->get_result();
  if($query->num_rows == 1)
  {
    $registro = true;
    $row = $query->fetch_assoc();
    $correo = $row["correo"];
    $nombre = $row["nombre"];
    if($row["link_carta"] == 1)
    {
      $confirmacion =  true;
    }
  }else{
    $error = true;
  }
}
?>
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
      <link type="text/css" rel="stylesheet" href="stylesheets/styleReg.css" />


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
            <div class="bg-img" style="background-color: #d97d7b;">
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
                              <li class="active"><a href="#">Registro</a></li>
                              <li><a href="?miRegistro">Confirmar Registro</a></li>


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
                              <?php
                              if(!$registro)
                              {
                              ?>
                              <div class="col-xs-12">
                                <?php
                                 if($error)
                                 {
                                   ?>
                                   <!-- Alerts -->
                                   <div class="col-xs-12">
                                         <div class="alert alert-danger alert-dismissible"  id="registerAlertFailure">
                                               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                               <p id="registerAlertFailureMessage"><strong>Rayos!</strong> No encontramos ese código</p>
                                         </div>
                                   </div>
                                   <!-- /Alerts -->
                                   <?php
                                 }
                                ?>
                                  <div class="row">
                                    <h1 style="color: #fff">Ingresa tu código de registro</h1>
                                  </div>
                                    <form method="get" action="?miBoleto">
                                          <div class="row">

                                                <div class="col-xs-12 mb form-group" id="groupInputEmail">
                                                      <label for="inputCodigo" class="control-label" style="color:#fff">Código*: </label>
                                                      <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Ej. c4a9dc48" required>
                                                </div>
                                          </div>
                                          <div class="row">
                                                <hr/>
                                                <div class="col-xs-12 text-center">
                                                      <button type="submit" id="submitBoleto" class="btn btn-lg btn-send">Enviar</button>
                                                </div>
                                          </div>
                                    </form>
                                  </div>
                                <?php
                                }
                                else if(!$confirmacion)
                                {
                                ?>
                                <div class="col-xs-12">

                                    <div class="row">
                                      <h1 style="color: #fff">¡NO HAS COMPLETADO TU REGISTRO!</h1>
                                      <h2>Completa tu registro <a style="color: #50205c" href="/?miRegistro">aquí</a></h2>
                                    </div>

                                    </div>
                                  <?php
                                  }
                                  else
                                  {
                                    ?>
                                    <div class="col-xs-12">

                                        <div class="row">
                                          <h1 style="color: #fff">Tu boleto <?php echo $nombre;?>:</h1>
                                        </div>
                                          <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $codigo;?>&choe=UTF-8" title="<?php echo $codigo;?>" />
                                          <div class="row">
                                            <h3 style="color: #fff">Correo: <?php echo $correo;?></h3>
                                          </div>
                                        </div>

                                      <?php

                                  }
                                ?>
                              </div>
                        </div>
                  </div>
                  <!-- /home wrapper -->


            </header>
            <!-- /Header -->

            <!-- jQuery Plugins -->
            <script type="text/javascript" src="javascripts/jquery.min.js"></script>
            <script type="text/javascript" src="javascripts/bootstrap.min.js"></script>
            <script type="text/javascript" src="javascripts/main.js"></script>
            <script type="text/javascript" src="javascripts/jquery.magnific-popup.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.2/moment.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
            <script type="text/javascript" src="javascripts/register.js"></script>
            <script src="javascripts/bootstrap-datepicker.es.js" charset="UTF-8"></script>
            <script type="text/javascript" src="javascripts/register.js"></script>
            <script>
            $('#submitBoleto').click(function(event){
                  event.preventDefault();
                  var registerId = $('#codigo');
                  var id = registerId.val();
                  if(id){
                        window.location.href = "./?miBoleto&id=" + id;
                  }
            });
            </script>


      </body>

      </html>

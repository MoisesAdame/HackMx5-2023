<?php
require "connect.php";

function getUserData($id){
      $query = "SELECT * FROM participantes WHERE idParticipante = '$id'";
      $query = simpleQuery($query);
      return $data = $query->fetch_assoc();
}
function getUserConfirmationData($id){
      $query = "SELECT * FROM confirmacion_datos WHERE idParticipante = '$id'";
      $query = simpleQuery($query);
      if($query->num_rows > 0){
            $confirmation_data = $query->fetch_assoc();
            return $confirmation_data;
      }
}
function getTeamData($key){
      $query = "SELECT p.idParticipante, CONCAT(p.nombre, ' ', p.apellidos) AS nombreCompleto, p.nombre, p.escuela, e.nombre_equipo
      FROM participantes AS p INNER JOIN miembros_equipo AS m ON m.idParticipante = p.idParticipante
      INNER JOIN equipos_hackmx AS e ON m.idEquipo = e.idEquipo WHERE e.idEquipo = '$key'";
      $query = simpleQuery($query);
      return $query;
}
function getTeamKey($id){
      $query = "SELECT idEquipo FROM miembros_equipo WHERE idParticipante = '$id'";
      $query = simpleQuery($query);
      $data = $query->fetch_assoc();
      return $data["idEquipo"];
}
function getTeamName($key){
      $query = "SELECT nombre_equipo FROM equipos_hackmx WHERE idEquipo = '$key'";
      $query = simpleQuery($query);
      $data = $query->fetch_assoc();
      return $data["nombre_equipo"];
}
function isRegisteredUser($id){
      $isRegistered = false;
      $query = "SELECT idParticipante FROM participantes WHERE idParticipante = '$id'";
      $query = simpleQuery($query);
      if($query->num_rows > 0){
            $isRegistered = true;
      }
      return $isRegistered;
}
function isTeamLeader($id){
      $isTeamLeader = false;
      $query = "SELECT idLider FROM equipos_hackmx WHERE idLider = '$id'";
      $query = simpleQuery($query);
      if($query->num_rows > 0){
            $isTeamLeader = true;
      }
      return $isTeamLeader;
}
function inTeam($id){
      $inTeam = false;
      $query = "SELECT idParticipante FROM miembros_equipo WHERE idParticipante = '$id'";
      $query = simpleQuery($query);
      if($query->num_rows > 0){
            $inTeam = true;
      }
      return $inTeam;
}

$isRegistered = false;
$validated = false;
if(isset($_GET["id"])){
      $validated = true;



      $id = $_GET["id"];
      $isRegistered = isRegisteredUser($id);

      if($isRegistered){
            $inTeam = false;
            $isTeamLeader = false;

            $user_data = getUserData($id);
            $confirmation_data = getUserConfirmationData($id);
            $valid_credential = $confirmation_data["link_credencial"];
            $valid_responsibility = $confirmation_data["link_carta"];
            $class_credential = "text-danger";
            $class_responsibility = "text-danger";
            $class_team = "text-danger";
            $title_team = "Inscribirse a un equipo";
            if($valid_credential) $class_credential = "text-success";
            if($valid_responsibility) $class_responsibility = "text-success";
            if($valid_credential && $valid_responsibility){
                  $inTeam = inTeam($id);
                  $isTeamLeader = isTeamLeader($id);
                  if($inTeam){
                        $team_key = getTeamKey($id);
                        $team_data = getTeamData($team_key);
                        $team_name = getTeamName($team_key);
                        $title_team = "Equipo";
                        $team_position = "Miembro";
                        if($isTeamLeader){
                              $team_position = "Lider";
                        }
                  }
                  $class_team = "accent2-color";

            }

      }else{
            echo "<script> window.location.href = './?miRegistro' </script>";
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
      <link type="text/css" rel="stylesheet" href="stylesheets/styleConf.css" />
      <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
      <style>

      .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
      }
      .autocomplete-items div {

            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
      }
      .autocomplete-items div:hover {
            /*when hovering an item:*/
            background-color: #e9e9e9;
      }
      .autocomplete-active {
            /*when navigating through the items using the arrow keys:*/
            background-color: DodgerBlue !important;
            color: #ffffff;
      }
      </style>

      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>
<body style="background: #00b7dd;">
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
                              <li class="active"><a href="#">Registro</a></li>


                              <li><a href="//www.facebook.com/TecHackMx/"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                        </ul>
                        <!-- /Main navigation -->

                  </div>
            </nav>
            <!-- /Nav -->

            <!-- home wrapper -->
            <div class="section confirmation">
                  <div class="container">
                        <div class="row">
                              <!-- Alerts -->
                              <div class="col-xs-12">
                                    <div class="hidden alert alert-success alert-dismissible"  id="registerAlertSuccess">
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          <p id="registerAlertSuccessMessage"></p>
                                    </div>
                                    <div class="hidden alert alert-danger alert-dismissible"  id="registerAlertFailure">
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          <p id="registerAlertFailureMessage"></p>
                                    </div>
                              </div>
                              <!-- /Alerts -->

                              <!-- home content -->
                              <div class="col-xs-12">
                                    <?php if($isRegistered && $validated): ?>
                                          <div class="align-left row">
                                                <h2 class="text-white no-margin"><?php echo $user_data["nombre"] . " " . $user_data["apellidos"];?></h2>
                                                <h3 class="accent2-color">Panel de confirmación de registro.</h3>
                                                <div class="text-white">
                                                      <div class="col-xs-12 col-md-4 no-padding">
                                                            <div class="confirmation-buttons">
                                                                  <button class="btn outline-btn" type="button" id="buttonDetail"><h3 class="no-margin text-white">Detalle de registro</h3></button>
                                                                  <button class="btn outline-btn" type="button" id="buttonLetter" <?php if($valid_responsibility) echo "disabled"; ?>><h3 class="no-margin <?php echo $class_responsibility;?>">Carta de Responsabilidad</h3></button>
                                                                  <button class="btn outline-btn" type="button" id="buttonCredential" <?php if($valid_credential) echo "disabled"; ?>>
                                                                        <h3 class="no-margin <?php echo $class_credential; ?>">Credencial Escolar</h3>
                                                                  </button>
                                                                  <?php if($valid_responsibility && $valid_credential): ?>
                                                                  <button class="btn outline-btn" type="button" id="buttonTeam">
                                                                        <h3 class="no-margin <?php echo $class_team; ?>"><?php echo $title_team; ?></h3>
                                                                  </button>
                                                                  <?php endif; ?>
                                                            </div>
                                                      </div>

                                                      <div class="col-xs-12 col-md-7 col-md-offset-1 mb no-padding confirmation-section">
                                                            <div id="registerConfirmationDetail">

                                                                  <?php if(!$valid_responsibility || !$valid_credential): ?>
                                                                        <h3 class="text-white">
                                                                              Para poder completar tu registro, necesitamos que:
                                                                        </h3>
                                                                  <?php else: ?>
                                                                        <h2 class="text-white">
                                                                              ¡Has completado tu registro!
                                                                        </h2>
                                                                        <h3 class="text-white">
                                                                              <?php if(!$inTeam): ?>
                                                                                    ¡Solo te falta ingresar a un equipo!
                                                                              <?php else: ?>
                                                                                    ¡Ya estás en un equipo! <br>
                                                                                    Puedes revisar los miembros en la sección de <strong class="accent2-color">equipo</strong>.
                                                                              <?php endif; ?>
                                                                        </h3>
                                                                  <?php endif; ?>

                                                                  <?php if(!$valid_responsibility): ?>
                                                                        <h3 class="text-white">
                                                                              &nbsp; 1. &nbsp; &nbsp; Firmes la <strong class="accent3-color">Carta de Responsabilidad</strong>, asimismo,
                                                                        </h3>
                                                                  <?php endif; ?>

                                                                  <?php if(!$valid_credential): ?>
                                                                        <h3 class="text-white">
                                                                              &nbsp; 2. &nbsp; &nbsp; Es necesario que adjuntes una foto de tu <strong class="accent2-color">Credencial Escolar.</strong>
                                                                        </h3>
                                                                  <?php endif; ?>

                                                                  <h3 class="text-white">Puedes ingresar a cada sección dando click sobre el botón a la izquierda.</h3>
                                                            </div>

                                                            <div id="registerConfirmationLetter">
                                                                  <form id="letterForm">
                                                                        <div class="row">
                                                                              <div class="col-xs-12 form-group" id="groupInputName">
                                                                                    <label for="inputNombreSGM" class="control-label" style="color:#fff">Nombre de la Aseguradora de Gastos Médicos: </label>
                                                                                    <input type="text" class="form-control" name="nombre" id="inputNombreSGM" placeholder="Ej. Seguro de Gastos Médicos Mayores MAPFRE" required>
                                                                              </div>
                                                                        </div>
                                                                        <div class="row">
                                                                              <div class="col-xs-12 form-group" id="groupInputPoliza">
                                                                                    <label for="inputPolizaContrato" class="control-label" style="color:#fff">Número de Póliza de Seguro: </label>
                                                                                    <input type="text" class="form-control" name="poliza" id="inputPolizaContrato" placeholder="Ej. 837591024" required>
                                                                              </div>
                                                                        </div>
                                                                        <div class="row">
                                                                              <div class="col-xs-12 form-group" id="groupInputCareer">
                                                                                    <label for="inputCareer" class="control-label" style="color:#fff">Carrera: </label>
                                                                                    <input type="text" class="form-control" name="career" id="inputCareer" placeholder="Ej. Ingeniería en Sistemas Computacionales" required>
                                                                              </div>
                                                                        </div>
                                                                        <div class="row">
                                                                              <div class="col-xs-12 form-group" id="groupInputIdEstudiante">
                                                                                    <label for="inputIdEstudiante" class="control-label" style="color:#fff">Número estudiante/Matrícula: </label>
                                                                                    <input type="text" class="form-control" name="idEstudiante" id="inputIdEstudiante" placeholder="Ej. A01234567" required></textarea>
                                                                              </div>
                                                                        </div>
                                                                        <div class="row">
                                                                              <div class="col-xs-12 form-group" id="groupInputContactoEmergencia">
                                                                                    <label for="inputContactoEmergencia" class="control-label" style="color:#fff">Contacto de Emergencia: </label>
                                                                                    <input type="text" class="form-control" name="contactoEmergencia" id="inputContactoEmergencia" placeholder="Ej. Carlos Arce López." required></textarea>
                                                                              </div>
                                                                        </div>
                                                                        <div class="row">
                                                                              <div class="col-xs-12 form-group" id="groupInputNumeroEmergencia">
                                                                                    <label for="inputNumeroEmergencia" class="control-label" style="color:#fff">Número de Emergencia: </label>
                                                                                    <input type="text" class="form-control" name="numeroEmergencia" id="inputNumeroEmergencia" placeholder="Ej. 5521293912" required></textarea>
                                                                              </div>
                                                                        </div>
                                                                        <div class="row">
                                                                              <div class="col-xs-12 form-group" id="groupInputCheckbox">
                                                                                    <label style="color:#fff"><input type="checkbox" name="cartaRespAlumnos"  id="inputCheckbox" value="Aceptar" required> Acepto de manera incondicional todos y cada uno de los términos, condiciones y alcances contenidos en la “Carta de responsabilidad de los alumnos 2019”, misma que he leído y comprendido a entera satisfacción.</label><br>
                                                                              </div>
                                                                        </div>

                                                                        <div class="row">
                                                                              <div class="col-xs-6 col-md-5 col-md-offset-1 mb form-group">
                                                                                    <a href="documents/carta_alumnos_responsabilidad_2019.docx" class="accent3-color">[Carta Responsabilidad]</a>
                                                                              </div>
                                                                              <div class="col-xs-6 col-md-5 col-md-offset-1 mb formgroup">
                                                                                    <a href="documents/reglamento_general_estudiantes_2018.pdf" class="accent3-color">[Reglamento General de Alumnos]</a>
                                                                              </div>
                                                                        </div>
                                                                        <input type="hidden" name="idRegistro" value="<?php echo $id; ?>">
                                                                        <input type="hidden" name="cartaCheck" value="1">
                                                                        <button type="submit" id="submitLetterConfirmation" class="btn btn-send btn-lg">Enviar</button>
                                                                  </form>


                                                            </div>

                                                            <div id="registerConfirmationCredential">
                                                                  <form class="" id="credentialForm"enctype="multipart/form-data">
                                                                        <div class="row">
                                                                              <div class="col-xs-12 form-group" id="groupInputCredencial">

                                                                                    <label for="inputFileCard" class="control-label" style="color:#fff">Credencial: </label><br/>
                                                                                    <div class='file-input'>
                                                                                          <input type='file' name="credencial" id="inputFileCard" accept="image/jpeg, image/png" require>
                                                                                          <span class='btn white-btn'>Elegir archivo</span>
                                                                                          <span class='label' data-js-label>No hay archivo seleccionado</span>
                                                                                    </div>

                                                                              </div>
                                                                        </div>
                                                                        <input type="hidden" name="idRegistro" id="idRegistroCredencial" value="<?php echo $id; ?>">
                                                                        <input type="hidden" name="credencialCheck" value="1">
                                                                        <button type="submit" id="submitCredentialConfirmation" class="btn btn-send btn-lg">Enviar</button>
                                                                  </form>

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
                                                            </div>

                                                            <div id="registerConfirmationTeam">
                                                                  <?php if(!$inTeam): ?>
                                                                        <h2 class="text-white">
                                                                              Equipos
                                                                        </h2>
                                                                        <div class="row">
                                                                              <input type="hidden" name="idRegistro" id="idRegistro" value="<?php echo $id; ?>">
                                                                              <div class="col-xs-12 col-md-6">
                                                                                    <h3 class="text-white">Crear un equipo</h3>
                                                                                    <div class="row">
                                                                                          <div class="col-xs-12 form-group">
                                                                                                <label class="control-label" style="color:#fff">Nombre del Equipo</label>
                                                                                                <input type="text" class="form-control" name="teamName" id="inputTeamCreate" placeholder="Ej. Los Borregotes" required>
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                          <div class="col-xs-12 form-group">
                                                                                                <button type="submit" id="submitCreateTeamConfirmation" class="btn btn-send btn-lg">Crear equipo</button>
                                                                                          </div>
                                                                                    </div>
                                                                              </div>

                                                                              <div class="col-xs-12 col-md-6 confirmation-subsection">
                                                                                    <h3 class="text-white">Unirse a un equipo</h3>
                                                                                    <div class="row">
                                                                                          <div class="col-xs-12 form-group">
                                                                                                <label class="control-label" style="color:#fff">Clave del equipo</label>
                                                                                                <input type="text" class="form-control" maxlength=8 name="teamKey" id="inputTeamJoin" placeholder="Ej. XY42AC" required>
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                          <div class="col-xs-12 form-group">
                                                                                                <button type="submit" id="submitJoinTeamConfirmation" class="btn btn-send btn-lg">Unirse a equipo</button>
                                                                                          </div>
                                                                                    </div>
                                                                              </div>
                                                                        </div>
                                                                  <?php else: ?>
                                                                        <div class="col-xs-12 confirmation-subsection">
                                                                              <h2 class="text-white">Equipo: <?=$team_name; ?> – <strong class="accent2-color"><?=$team_position; ?></strong></h2>
                                                                              <?php if($isTeamLeader): ?>
                                                                                    <h3 class="text-white">Clave de equipo: <strong class="accent1-color"><?=$team_key; ?></strong></h3>
                                                                              <?php endif; ?>
                                                                              <input type="hidden" name="idEquipo" id="idEquipo" value="<?=$team_key; ?>">
                                                                              <?php while($member = $team_data->fetch_assoc()): ?>
                                                                                    <div class="row">
                                                                                          <div class="col-xs-6 col-md-6 team-member">
                                                                                                <h3 class="text-white"><?=$member["nombreCompleto"];?></h3>
                                                                                                <strong class="accent2-color"><?=$member["escuela"];?></strong>

                                                                                          </div>
                                                                                          <div class="col-xs-6 col-md-6">
                                                                                                <?php if($isTeamLeader): ?>
                                                                                                      <?php if($member["idParticipante"] != $id): ?>
                                                                                                            <button type="button" class="team-kick text-danger kickFromTeam" value="<?=$member["idParticipante"]; ?>">Echar a <?= $member["nombre"]; ?></button>
                                                                                                      <?php else: ?>
                                                                                                            <button type="button" class="team-kick text-danger deleteTeam">Desintegrar equipo</button>
                                                                                                      <?php endif; ?>
                                                                                                <?php else: ?>
                                                                                                      <?php if($member["idParticipante"] == $id): ?>
                                                                                                            <button type="button" class="team-kick text-danger leaveTeam" value="<?=$member["idParticipante"];?>">Salir del equipo</button>
                                                                                                      <?php endif; ?>
                                                                                                <?php endif; ?>
                                                                                          </div>
                                                                                    </div>


                                                                              <?php endwhile; ?>
                                                                        </div>
                                                                  <?php endif; ?>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>

                                    <?php else: ?>
                                          <label class="control-label" style="color: #fff;">Para poder ingresar debes ingresar un <strong>Número de registro válido.<strong></label>
                                          <form id="registerConfirmationForm">
                                                <div class="row">
                                                      <div class="col-xs-12 col-md-4 col-md-offset-4 mb  form-group">
                                                            <label for="inputRegisterId" class="control-label" style="color:#fff">Número de registro*: </label>
                                                            <input type="text" class="form-control" name="id" id="registerId" placeholder="Ej. c4a9dc48" maxlength="8" required>
                                                      </div>
                                                </div>

                                                <div class="row">
                                                      <div class="col-xs-12 text-center">
                                                            <button type="submit" id="submitRegisterConfirmation" class="btn btn-lg btn-send">Enviar</button>
                                                      </div>
                                                </div>
                                          </form>

                                    <?php endif;  ?>
                              </div>
                        </div>
                  </div>
                  <!-- /home wrapper -->


            </header>
            <!-- /Header -->
            <script type="text/javascript">
                  var divDetail = $('#registerConfirmationDetail');
                  var divLetter = $('#registerConfirmationLetter');
                  var divCredential = $('#registerConfirmationCredential');
                  var divTeam = $('#registerConfirmationTeam');
                  divLetter.hide();
                  divCredential.hide();
                  divTeam.hide();

                  function hideAlert(someAlert){
                        someAlert.removeClass("hidden");
                        setTimeout( function(){
                              someAlert.fadeOut();
                              setTimeout( function(){
                                    someAlert.addClass("hidden");
                                    someAlert.fadeIn();
                              }, 1000);
                        }, 3000);
                  }
                  function invalidString(someString){
                        var format = /[!@#$%^&*()_+\=\[\]{};':"\\|,.<>\/?]+/;
                        return (format.test(someString));
                  }

                  $('#submitRegisterConfirmation').click(function(event){
                        event.preventDefault();
                        var registerId = $('#registerId');
                        var errorLabel = $('#registerAlertFailure');
                        var id = registerId.val();
                        if(!id){
                              errorLabel.html("<strong>¡Oye!</strong> Ingresa un Número de Registro para continuar.");
                              hideAlert(errorLabel);
                        }else if(id.length < 8){
                              errorLabel.html("<strong>¡Hubo un error!</strong> Todos los Números de Registro tienen 8 caracteres.");
                              hideAlert(errorLabel);
                        }else{
                              window.location.href = "./?miRegistro&id=" + id;
                        }
                  });
                  $('#submitLetterConfirmation').click(function(event){
                        event.preventDefault();
                        var errorLabel = $('#registerAlertFailure');
                        var error = false;
                        $("form#letterForm :input[type=text]").each(function(){
                              var input = $(this);
                              if(input.val() == ""){
                                    error = true;
                              }
                        });
                        if($('#inputCheckbox').is(':checked')){
                              error = false;
                        }else{
                              error = true;
                        }
                        if(error){
                              errorLabel.html("<strong>¡Alto ahí!</strong> Parece que has dejado un campo vacío.");
                              hideAlert(errorLabel);
                              window.scrollTo(0, 0);
                        }else{
                              formData = $('#letterForm').serialize();
                              $.ajax({
                                    type: 'POST',
                                    url: 'register/confirmation.php',
                                    data: formData,
                                    dataType: 'json',
                                    success:function(response){
                                          if(response.success){
                                                //location.reload();
                                          }
                                    }
                              });
                        }
                  });
                  $('#submitCredentialConfirmation').click(function(event){
                        event.preventDefault();
                        var fileInput = $('#inputFileCard');
                        var id = $('#idRegistroCredencial');
                        var errorLabel = $('#registerAlertFailure');
                        var error = false;
                        if(fileInput.get(0).files.length == 0){
                              error = true;
                        }
                        if(error){
                              errorLabel.html("<strong>¡Alto ahí!</strong> Parece que no añadiste una foto.");
                              hideAlert(errorLabel);
                              window.scrollTo(0, 0);
                        }else{
                              var fileInputImage = $('#inputFileCard')[0].files[0];

                              formData = new FormData();
                              formData.append("credencialCheck", true);
                              formData.append("idRegistro", id.val());
                              formData.append("file", fileInputImage);
                              $.ajax({
                                    type: 'POST',
                                    url: 'register/confirmation.php',
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    cache: false,
                                    dataType: 'json',
                                    success:function(response){
                                          if(response.success){
                                                //location.reload();
                                          }
                                    }
                              });
                        }
                  });
                  $('#submitCreateTeamConfirmation').click(function(event){
                        event.preventDefault();
                        var error = true;
                        var inputId = $('#idRegistro');
                        var id = inputId.val();
                        var inputTeam = $('#inputTeamCreate');
                        var errorLabel = $('#registerAlertFailure');
                        var name = inputTeam.val();
                        if(!name){
                              errorLabel.html("<strong>¡No has puesto ningún nombre!</strong>.");
                              hideAlert(errorLabel);
                        }else if(invalidString(name)){
                              errorLabel.html("<strong>¡Parece que hay un error!</strong> El nombre del equipo no debe tener caracteres espciales.");
                              hideAlert(errorLabel);
                        }else if(name.length < 4){
                              errorLabel.html("<strong>¡Alto ahí vaquero!</strong> El nombre del equipo tiene que tener una longitud mayor a 4 chars.");
                              hideAlert(errorLabel);
                        }else{
                              error = false;
                        }

                        if(!error){
                              $.ajax({
                                    method: 'POST',
                                    url: 'register/confirmation.php',
                                    data: {equipoCheck: true,  equipoCreate: true, equipoNombre: name, idRegistro: id},
                                    dataType: 'json',
                                    success:function(response){
                                          if(response.success){
                                                location.reload();
                                          }
                                    }
                              });
                        }

                  });
                  $('#submitJoinTeamConfirmation').click(function(event){
                        event.preventDefault();
                        var error = true;
                        var inputId = $('#idRegistro');
                        var id = inputId.val();
                        var inputTeam = $('#inputTeamJoin');
                        var errorLabel = $('#registerAlertFailure');
                        var key = inputTeam.val();
                        if(!key){
                              errorLabel.html("<strong>¡No has puesto ninguna clave!</strong>.");
                              hideAlert(errorLabel);
                        }else if(invalidString(key)){
                              errorLabel.html("<strong>¡Parece que hay un error!</strong> La clave de equipo no contiene caracteres espciales.");
                              hideAlert(errorLabel);
                        }else if(key.length < 8){
                              errorLabel.html("<strong>¡Todas las claves tienen 8 caracteres!</strong>.");
                              hideAlert(errorLabel);
                        }else{
                              error = false;
                        }
                        if(!error){
                              $.ajax({
                                    method: 'POST',
                                    url: 'register/confirmation.php',
                                    data: {equipoCheck: true,  equipoJoin: true, equipoClave: key, idRegistro: id},
                                    dataType: 'json',
                                    success:function(response){
                                          if(response.success){
                                                location.reload();
                                          }else{
                                                errorLabel.html(response.message);
                                                hideAlert(errorLabel);
                                          }
                                    }
                              });
                        }
                  });
                  $('.kickFromTeam').click(function(event){
                        var button = $(this);
                        var idToKick = button.val();
                        var inputTeam = $('#idEquipo');
                        var team = inputTeam.val();
                        $.ajax({
                              method: 'POST',
                              url: 'register/confirmation.php',
                              data: {equipoCheck: true,  equipoKick: true, idEquipo: team, idRegistro: idToKick},
                              dataType: 'json',
                              success:function(response){
                                    if(response.success){
                                          location.reload();
                                    }
                              }
                        });
                  });
                  $('.leaveTeam').click(function(event){
                        var button = $(this);
                        var idToKick = button.val();
                        var inputTeam = $('#idEquipo');
                        var team = inputTeam.val();
                        $.ajax({
                              method: 'POST',
                              url: 'register/confirmation.php',
                              data: {equipoCheck: true, equipoLeave: true, idEquipo: team, idRegistro: idToKick},
                              dataType: 'json',
                              success:function(response){
                                    if(response.success){
                                          location.reload();
                                    }
                              }
                        });
                  });
                  $('.deleteTeam').click(function(event){
                        var inputTeam = $('#idEquipo');
                        var team = inputTeam.val();
                        $.ajax({
                              method: 'POST',
                              url: 'register/confirmation.php',
                              data: {equipoCheck: true, equipoDelete: true, idEquipo: team},
                              dataType: 'json',
                              success:function(response){
                                    if(response.success){
                                          location.reload();
                                    }
                              }
                        });
                  });

                  $('#buttonDetail').click(function(event){
                        divDetail.show();
                        divLetter.hide();
                        divCredential.hide();
                        divTeam.hide();
                  });
                  $('#buttonLetter').click(function(event){
                        divDetail.hide();
                        divLetter.show();
                        divCredential.hide();
                        divTeam.hide();
                  });
                  $('#buttonCredential').click(function(event){
                        divDetail.hide();
                        divLetter.hide();
                        divCredential.show();
                        divTeam.hide();
                  });
                  $('#buttonTeam').click(function(event){
                        divDetail.hide();
                        divLetter.hide();
                        divCredential.hide();
                        divTeam.show();
                  });

            </script>

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
      </body>
</html>

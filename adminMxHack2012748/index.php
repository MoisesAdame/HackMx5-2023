<?php
require "../connect.php";
$error  = 0;
$ultimoRegistro = "";
if(isset($_POST["registrarCodigo"]))
{
  if(strlen($_POST["codigo"]) ==8)
  {
    $query = "SELECT * FROM participantes INNER JOIN confirmacion_datos USING(idParticipante) WHERE idParticipante = ?";
    $query = $connection->prepare($query);
    $query->bind_param("s",$_POST["codigo"]);
    $query->execute();
    $query = $query->get_result();
    if($query->num_rows == 1)
    {
      $row = $query->fetch_assoc();
      if($row["link_carta"] == 1)
      {
        $queryRegistro = "UPDATE confirmacion_datos SET ticket = 1 WHERE idParticipante = ?";
        $queryRegistro = $connection->prepare($queryRegistro);
        $queryRegistro->bind_param("s",$_POST["codigo"]);
        $queryRegistro->execute();
        $error = -1;
        $ultimoRegistro = "Nombre: ".$row["nombre"]." ".$row["apellidos"]."<br/>"."Correo: ".$row["correo"]."<br/>"."Nivel: ".$row["nivel_estudios"]."<br/>";
      }else
      {
        $error = 3;
      }
    }
    else
    {
      $error = 2;
    }
  }
  else
  {
    $error = 1;
  }
}
else if(isset($_POST["registrarCorreo"]))
{
  $query = "SELECT * FROM participantes INNER JOIN confirmacion_datos USING(idParticipante) WHERE correo = ?";
  $query = $connection->prepare($query);
  $query->bind_param("s",$_POST["correo"]);
  $query->execute();
  $query = $query->get_result();
  if($query->num_rows == 1)
  {
    $row = $query->fetch_assoc();
    if($row["link_carta"] == 1)
    {
      $queryRegistro = "UPDATE confirmacion_datos SET ticket = 1 WHERE idParticipante = ?";
      $queryRegistro = $connection->prepare($queryRegistro);
      $queryRegistro->bind_param("s",$row["idParticipante"]);
      $queryRegistro->execute();
    }else
    {
      $error = 3;
    }
  }
  else
  {
    $error = 2;
  }

}else if(isset($_POST["registroNUEVO"]))
{
        $gender = $_POST["gender"];
        $grado = $_POST["grado"];
        $localidad = $_POST["localidad"];
        $institucion = $_POST["institucion"];
        $tel = $_POST["tel"];
        $email = $_POST["email"];
        $lastName = $_POST["lastName"];
        $name = $_POST["name"];
        $queryEmail = "SELECT * FROM participantes WHERE correo = ?";
        $queryEmail = $connection->prepare($queryEmail);
        $queryEmail->bind_param("s", $email);
        $queryEmail->execute();
        $resultEmail = $queryEmail->get_result();
        if($resultEmail->num_rows == 0)
        {
          $queryCount = "SELECT COUNT(*) AS total FROM participantes";
          $queryCount = $connection->query($queryCount);
          $total = $queryCount->fetch_assoc()["total"];
          $id = substr(md5($total),0,8);
          $queryRegistro = "INSERT INTO participantes (idParticipante, nombre, apellidos, telefono, escuela, estado, nivel_estudios, sexo, correo) VALUES (?,?,?,?,?,?,?,?,?)";
          $queryRegistro = $connection->prepare($queryRegistro);
          $queryRegistro->bind_param("sssisssss",$id,$name, $lastName, $tel, $institucion,$localidad,$grado,$gender,$email);
          if($queryRegistro->execute())
          {
            if(isset($_POST["semestre"]) && isset($_POST["campus"]) && $_POST["campus"] != "" && $_POST["semestre"] !="")
            {
              $semestre = $_POST["semestre"];
              $campus = $_POST["campus"];
              $queryTec = "INSERT INTO participantes_tec (idParticipante, campus,semestre) VALUES (?,?,?)";
              $queryTec= $connection->prepare($queryTec);
              $queryTec->bind_param("sss", $id, $campus, $semestre);
              $queryTec->execute();
            }
            $queryRegistro2 =  "INSERT INTO confirmacion_datos(idParticipante,link_credencial,link_carta) VALUES (?,0,0)";
            $queryRegistro2 = $connection->prepare($queryRegistro2);
            $queryRegistro2->bind_param("s", $id);
            $queryRegistro2->execute();
          }
          $error = -2;
    }
    else
    {
      $error = 4;
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>MOTA's SOLUTION FOR EVENTBRITE</title>
    <style>
    body, input, button {font-size:15pt}
    input, label {vertical-align:middle}
    .qrcode-text {padding-right:1.7em; margin-right:0}
    .qrcode-text-btn {display:inline-block; background:url(//dab1nmslvvntp.cloudfront.net/wp-content/uploads/2017/07/1499401426qr_icon.svg) 50% 50% no-repeat; height:1em; width:1.7em; margin-left:-1.7em; cursor:pointer}
    .qrcode-text-btn > input[type=file] {position:absolute; overflow:hidden; width:1px; height:1px; opacity:0}
    </style>
  </head>
  <body>
    <div class="container">
      <br/>
      <div class="row">
        <div class="col">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="attendance-tab" data-toggle="tab" href="#inicio" role="tab" aria-controls="inicio" aria-selected="true">Registrar Asistencia</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="search-tab" data-toggle="tab" href="#buscar" role="tab" aria-controls="buscar" aria-selected="false">Buscar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="register-tab" data-toggle="tab" href="#registrar" role="tab" aria-controls="registrar" aria-selected="false">Registrar Nuevo</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="inicio" role="tabpanel" aria-labelledby="attendance-tab">
              <br/>
              <div class="row">
                <div class="col">
                  <form method="post" class="form-inline">
                    <div class="form-group mx-sm-3 mb-2">
                      <input type=text class="form-control" id="codigo" name="codigo" size=16 placeholder="Código de registro: " class=qrcode-text><label class=qrcode-text-btn><input type=file accept="image/*" capture=environment onchange="openQRCamera(this);" tabindex=-1></label>
                    </div>
                    <button type="submit" name="registrarCodigo" id ="registrarCodigo" class="btn btn-danger">Registrar</button>
                  </form>
                </div>
              </div>
              <br/>
              <div class="row">
                <div class="col">
                  <form  method="post" class="form-inline">
                    <div class="form-group mx-sm-3 mb-2">
                      <input type="mail" id="correo"  class="form-control" name="correo" placeholder="Correo: ">
                    </div>
                    <button type="submit"  name="registrarCorreo" id="registrarCorreo" class="btn btn-danger">Registrar</button>

                  </form>
                </div>
              </div>


            </div>
            <div class="tab-pane fade" id="buscar" role="tabpanel" aria-labelledby="search-tab">
              <br/>
              <form  method="post"class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                  <input type="mail" id="nombre" class="form-control" name="nombre" placeholder="Nombre sin apellidos: ">
                </div>
                <button type="submit"  name="buscarUsuario" id="buscarUsuario" class="btn btn-info">Buscar</button>
              </form>
            </div>
            <div class="tab-pane fade" id="registrar" role="tabpanel" aria-labelledby="register-tab">
              <br/>
              <div class="row">
                <div class="col-xs-12">
                      <form method="post">
                            <div class="row">
                                  <div class="col-xs-12 col-md-4 mb form-group" id="groupInputName">
                                        <label for="inputName" class="control-label"  >Nombre(s)*: </label>
                                        <input type="text" class="form-control" name="name" id="inputName" placeholder="Juan" required>
                                  </div>
                                  <div class="col-xs-12 col-md-4 mb form-group" id="groupInputLastName">
                                        <label for="inputLastName" class="control-label"  >Apellidos*: </label>
                                        <input type="text" class="form-control" name="lastName" id="inputLastName" placeholder="Perez" required>
                                  </div>
                                  <div class="col-xs-12 col-md-4 mb form-group" id="groupInputEmail">
                                        <label for="inputEmail" class="control-label"  >Correo*: </label>
                                        <input type="email" class="form-control" name="email" id="inputEmail" placeholder="example@example.com" required>
                                  </div>
                            </div>
                            <div class="row">
                                  <div class="col-xs-12 col-md-4 form-group mb" id="groupInputTel">
                                        <label for="inputTel" class="control-label"  >Teléfono*: </label>
                                        <input type="number" class="form-control" name="tel" id="inputTel" placeholder="55555555" required>
                                  </div>
                                  <div class="col-xs-12 col-md-8 form-group mb" id="groupInputInstitucion">
                                        <label for="inputInstitucion" class="control-label"  >Institución*: </label>
                                        <div class="autocomplete">
                                              <input type="text" class="form-control" name="institucion" id="inputInstitucion" placeholder="Home Schooled" required>
                                        </div>
                                  </div>
                            </div>
                            <div class="row" >

                                  <div class="col-xs-12 col-md-4 mb form-group" id="groupInputLocalidad">
                                        <label for="inputLocalidad" class="control-label"  >Localidad*: </label>
                                        <select name="localidad" class="styled-select" id="inputLocalidad" required>
                                              <option value="" disabled hidden selected>Elegir una opción...</option>
                                              <option value="Aguascalientes">Aguascalientes</option>
                                              <option value="Baja California">Baja California</option>
                                              <option value="Baja California Sur">Baja California Sur</option>
                                              <option value="Campeche">Campeche</option>
                                              <option value="Coahuila">Coahuila</option>
                                              <option value="Colima">Colima</option>
                                              <option value="Chiapas">Chiapas</option>
                                              <option value="Chihuahua">Chihuahua</option>
                                              <option value="Cd. de Mexico">Cd. de México</option>
                                              <option value="Durango">Durango</option>
                                              <option value="Guanajuato">Guanajuato</option>
                                              <option value="Guerrero">Guerrero</option>
                                              <option value="Hidalgo">Hidalgo</option>
                                              <option value="Jalisco">Jalisco</option>
                                              <option value="Edo. de Mexico">Edo. de México</option>
                                              <option value="Michoacan">Michoacán</option>
                                              <option value="Morelos">Morelos</option>
                                              <option value="Nayarit">Nayarit</option>
                                              <option value="Nuevo Leon">Nuevo León</option>
                                              <option value="Oaxaca">Oaxaca</option>
                                              <option value="Puebla">Puebla</option>
                                              <option value="Queretaro">Querétaro</option>
                                              <option value="Quintana Roo">Quintana Roo</option>
                                              <option value="San Luis Potosi">San Luis Potosí</option>
                                              <option value="Sinaloa">Sinaloa</option>
                                              <option value="Sonora">Sonora</option>
                                              <option value="Tabasco">Tabasco</option>
                                              <option value="Tamaulipas">Tamaulipas</option>
                                              <option value="Tlaxcala">Tlaxcala</option>
                                              <option value="Veracruz">Veracruz</option>
                                              <option value="Yucatan">Yucatán</option>
                                              <option value="Zacatecas">Zacatecas</option>
                                        </select>
                                  </div>

                                  <div class="col-xs-12 col-md-4 form-group mb" id="groupInputGrado">
                                        <label for="inputGrado" class="control-label"  >Grado de estudios*: </label>
                                        <select class="styled-select" id="inputGrado" name="grado" required>
                                              <option value="" disabled hidden selected>Elegir una opción...</option>
                                              <option value="Bachiller">Bachiller</option>
                                              <option value="Licenciante">Licenciante</option>
                                              <option value="Maestrante">Maestrante</option>
                                              <option value="Doctorante">Doctorante</option>
                                        </select>
                                  </div>
                                  <div class="col-xs-12 col-md-4 form-group mb" id="groupInputGender">
                                        <label for="inputSex" class="control-label"  >Sexo*: </label>
                                        <select class="styled-select" id="inputSex" name="gender" required>
                                              <option value="" disabled hidden selected>Elegir una opción...</option>
                                              <option value="m">Masculino</option>
                                              <option value="f">Femenino</option>
                                              <option value="n">Prefiero no responder</option>
                                        </select>
                                  </div>
                            </div>
                            <div class="row">
                                  <div class="col-xs-12">
                                        <p class="semi-lead text-danger">En caso de estudiar en el Tecnológico de Monterrey, completar los campos siguientes.</p>
                                  </div>
                            </div>
                            <div class="row">
                                  <div class="col-xs-12 col-md-6 form-group mb" id="groupInputCampus">
                                        <label for="inputCampus" class="control-label"  >Campus: </label>
                                        <select class="styled-select" id="inputCampus" name="campus">
                                              <option value="" disabled hidden selected>Elegir una opción...</option>
                                              <option value='Aguascalientes'>Aguascalientes</option>
                                              <option value='Central de Veracruz'>Central de Veracruz</option>
                                              <option value='Ciudad de México'>Ciudad de México</option>
                                              <option value='Ciudad Juárez'>Ciudad Juárez</option>
                                              <option value='Ciudad Obregón'>Ciudad Obregón</option>
                                              <option value='Navojoa (Preparatoria)'>Navojoa (Preparatoria)</option>
                                              <option value='Cuernavaca'>Cuernavaca</option>
                                              <option value='Chiapas'>Chiapas</option>
                                              <option value='Chihuahua'>Chihuahua</option>
                                              <option value='Estado de México'>Estado de México</option>
                                              <option value='Guadalajara'>Guadalajara</option>
                                              <option value='Hidalgo'>Hidalgo</option>
                                              <option value='Irapuato'>Irapuato</option>
                                              <option value='León'>León</option>
                                              <option value='Laguna'>Laguna</option>
                                              <option value='Monterrey'>Monterrey</option>
                                              <option value='Cumbres (Preparatoria)'>Cumbres (Preparatoria)</option>
                                              <option value='Eugenio Garza Lagüera (Preparatoria)'>Eugenio Garza Lagüera (Preparatoria)</option>
                                              <option value='Eugenio Garza Sada (Preparatoria)'>Eugenio Garza Sada (Preparatoria)</option>
                                              <option value='Santa Catarina (Preparatoria)'>Santa Catarina (Preparatoria)</option>
                                              <option value='Valle Alto (Preparatoria)'>Valle Alto (Preparatoria)</option>
                                              <option value='Morelia'>Morelia</option>
                                              <option value='Puebla'>Puebla</option>
                                              <option value='Querétaro'>Querétaro</option>
                                              <option value='Saltillo'>Saltillo</option>
                                              <option value='San Luis Potosí'>San Luis Potosí</option>
                                              <option value='Santa Fe'>Santa Fe</option>
                                              <option value='Sinaloa'>Sinaloa</option>
                                              <option value='Sonora Norte'>Sonora Norte</option>
                                              <option value='Tampico'>Tampico</option>
                                              <option value='Matamoros (Preparatoria)'>Matamoros (Preparatoria)</option>
                                              <option value='Toluca'>Toluca</option>
                                              <option value='Zacatecas'>Zacatecas</option>
                                        </select>
                                  </div>
                                  <div class="col-xs-12 col-md-6 form-group mb" id="groupInputSemestre">
                                        <label for="inputSemestre" class="control-label" >Semestre: </label>
                                        <input type="number" name="semestre" min="1">
                                  </div>
                            </div>
                            <div class="row">
                              <div class="col-xs-12 col-md-6 col-md-offset-3 mb form-group" id="groupInputCheckbox">
                                    <label><input type="checkbox" name="cartaRespAlumnos"  id="inputCheckbox" value="Aceptar" required> He leído y acepto el <a href="https://tec.mx/es/aviso-de-privacidad-para-participantes-y-expositores-congresos-y-simposiums" style="color: #50205c">Aviso de Privacidad</a>.</label><br>
                              </div>
                            </div>
                            <div class="row">
                                  <hr/>
                                  <div class="col-xs-12 text-center">
                                        <button type="submit" name="registroNUEVO" class="btn btn-lg btn-send">Enviar</button>
                                  </div>
                            </div>
                      </form></div>
              </div>

            </div>
          </div>
          <?php
          switch ($error) {
            case 1:
              ?>
              <div class="alert alert-danger" role="alert">
                Código incorrecto, deben ser 8 caracteres
              </div>
              <?php
              break;
            case 2:
              ?>
              <div class="alert alert-danger" role="alert">
                Usuario no en base de datos
              </div>
              <?php
              break;
            case 3:
              ?>
              <div class="alert alert-danger" role="alert">
                Usuario sin completar registro
              </div>
              <?php
              break;
            case 4:
              ?>
              <div class="alert alert-danger" role="alert">
                Ese correo ya está en uso
              </div>
              <?php
              break;
            case -1:
              ?>
              <div class="alert alert-success" role="alert">
                Usuario registrado
              </div>
              <?php
              break;
            case -2:
              ?>
              <div class="alert alert-success" role="alert">
                Usuario nuevo creado código: <?php echo $id; ?>
              </div>
              <?php
              break;
            default:
              break;
          }
          ?>


        </div>
      </div>
      <?php if(isset($_POST["buscarUsuario"]))
      {
        ?>
        <div class="row">
          <div class="col">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Correo</th>
                  <th>Nivel académico</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $query2 = "SELECT * FROM participantes WHERE nombre LIKE ?";
              $query2 = $connection->prepare($query2);
              $nombre = '%'.$_POST["nombre"].'%';
              $query2->bind_param("s",$nombre);
              $query2->execute();
              $query2 = $query2->get_result();
              if($query2->num_rows >0)
              {
                while($row = $query2->fetch_assoc())
                {
                  ?>
                  <tr>
                    <td><?php echo $row["idParticipante"]; ?></td>
                    <td><?php echo $row["nombre"]; ?></td>
                    <td><?php echo $row["apellidos"]; ?></td>
                    <td><?php echo $row["correo"]; ?></td>
                    <td><?php echo $row["nivel_estudios"]; ?></td>
                  </tr>
                  <?php
                }
              }
              ?>
              </tbody>
            </table>
          </div>
        </div>
        <?php

      }
      ?>

      <div class="row">
        <div class="col">
          <h1>Último registro: </h1>
          <p><?php echo $ultimoRegistro; ?></p>

        </div>
      </div>
      <div class="row">
        <div class="col">
          <h1>Registros</h1>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Nivel académico</th>
                <th>Equipo</th>
                <th>Mesa</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $query2 = "SELECT * FROM participantes INNER JOIN confirmacion_datos USING(idParticipante) WHERE ticket = 1 ORDER BY nivel_estudios ASC";
            $query2 = $connection->query($query2);
            if($query2->num_rows >0)
            {
              while($row = $query2->fetch_assoc())
              {
                $query3 = "SELECT * FROM equipos_hackmx INNER JOIN miembros_equipo USING(idEquipo) WHERE idParticipante = '".$row["idParticipante"]."'";
                $query3=$connection->query($query3);
                if($query3->num_rows == 1)
                {
                    $rowC = $query3->fetch_assoc();
                    $equipo = $rowC["nombre_equipo"];
                    if($rowC["mesa"] == -1)
                    {
                      $query4 = "SELECT MAX(mesa) AS mesa FROM equipos_hackmx";
                      $query4 = $connection->query($query4);
                      $max = $query4->fetch_assoc()["mesa"];
                      $max+=1;
                      $query4 = "UPDATE equipos_hackmx SET mesa = ".$max." WHERE idEquipo = '".$rowC["idEquipo"]."'";
                      $connection->query($query4);
                      $mesa = $max;
                    }
                    else
                    {
                        $mesa = $rowC["mesa"];
                    }

                }else
                {
                    $equipo = "SIN EQUIPO";
                    $mesa = -1;
                }

                ?>
                <tr>
                  <td><?php echo $row["idParticipante"]; ?></td>
                  <td><?php echo $row["nombre"]; ?></td>
                  <td><?php echo $row["apellidos"]; ?></td>
                  <td><?php echo $row["correo"]; ?></td>
                  <td><?php echo $row["nivel_estudios"]; ?></td>
                  <td><?php echo $equipo; ?></td>
                  <td><?php echo $mesa; ?></td>
                </tr>
                <?php
              }
            }
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://dmla.github.io/jsqrcode/src/qr_packed.js"></script>
    <script>
    function openQRCamera(node) {
      var reader = new FileReader();
      reader.onload = function() {
        node.value = "";
        qrcode.callback = function(res) {
          if(res instanceof Error) {
            alert("No se encontró el QR.");
          } else {
            node.parentNode.previousElementSibling.value = res;
          }
        };
        qrcode.decode(reader.result);
      };
      reader.readAsDataURL(node.files[0]);
    }
    </script>
  </body>
</html>

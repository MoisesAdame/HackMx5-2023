<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/PHPMailer/src/Exception.php';
require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';
require "../connect.php";
function generateToken(){
      $token = "yuiophjkltrewqhgfasdmnbvzxc1234567890";
      $token = str_shuffle($token);
      $token = substr($token, 0, 8);
      return $token;
}
function isValidTeamKey($key){
      $isValid = false;
      $query = "SELECT idEquipo FROM equipos_hackmx WHERE idEquipo = '$key'";
      $query = simpleQuery($query);
      if($query->num_rows > 0){
            $isValid = true;
      }
      return $isValid;
}
function isFullTeam($key){
      $isFull = false;
      $query = "SELECT COUNT(idEquipo) AS numeroMiembros FROM miembros_equipo WHERE idEquipo = '$key'";
      $query = simpleQuery($query);
      $query = $query->fetch_assoc();
      $numberMembers = $query["numeroMiembros"];
      if($numberMembers >= 4){
            $isFull = true;
      }
      return $isFull;
}
function insertIntoTeam($key, $id){
      $inserted = false;
      $query = "INSERT INTO miembros_equipo VALUES('$key', '$id')";
      $query = simpleQuery($query);
      if($query){
            $inserted = true;
      }
      return $inserted;
}
function removeFromTeam($key, $id){
      $removed = false;
      $query = "DELETE FROM miembros_equipo WHERE idParticipante = '$id'";
      $query = simpleQuery($query);
      if($query){
            $removed = true;
      }
      return $removed;
}
function removeTeam($key){
      $removed = false;
      $query = "DELETE FROM equipos_hackmx WHERE idEquipo = '$key'";
      $query = simpleQuery($query);
      if($query){
            $removed = true;
      }
      return $removed;
}
if(isset($_POST["cartaCheck"])){
      if($_POST["cartaCheck"]){
            $success = false;
            $validation = false;
            $id = $_POST["idRegistro"];
            $aseguradora = $_POST["nombre"];
            $poliza = $_POST["poliza"];
            $carrera = $_POST["career"];
            $matricula = $_POST["idEstudiante"];
            $emergencia = $_POST["contactoEmergencia"];
            $numeroEmergencia = $_POST["numeroEmergencia"];
            $responsibility = $_POST["cartaRespAlumnos"];
            $query = "INSERT INTO carta_responsabilidad VALUES('$id', '$aseguradora', '$poliza', '$carrera', '$emergencia', '$numeroEmergencia')";
            $queryValidation = "UPDATE confirmacion_datos SET link_carta = 1 WHERE idParticipante = '$id'";
            if($connection->query($query) === true){
                  $success = true;
                  $queryValidation = $connection->query($queryValidation);
                  if($queryValidation){
                        $validation = true;
                  }
            }
            $array = array('success' => $success, 'validation' => $validation);
      }
      echo json_encode($array);
}
if(isset($_POST["credencialCheck"])){
      if($_POST["credencialCheck"]){
            $success = false;
            $id = $_POST["idRegistro"];
            $query = "SELECT * FROM participantes WHERE idParticipante = '$id'";
            $query = $connection->query($query);
            if($query->num_rows > 0){
                  $user_data = $query->fetch_assoc();
            }
            $name = $user_data["nombre"] . " " . $user_data["apellidos"];
            $file = $_FILES["file"];
            $file_name = $_FILES["file"]["name"];
            $file_tmp = $_FILES["file"]["tmp_name"];
            $mail = new PHPMailer(true);
            try {
                  //Server settings
                  $mail->SMTPDebug = 2;                                       // Enable verbose debug output
                  //$mail->isSMTP();                                            // Set mailer to use SMTP
                  $mail->Host       = 'smtp.zoho.com';  // Specify main and backup SMTP servers
                  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                  $mail->Username   = 'info@hackmx.mx';                     // SMTP username
                  $mail->Password   = 'RTRkqvRGHQ';                               // SMTP password
                  $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                  $mail->Port       = 587;                                    // TCP port to connect to
                  $mail->CharSet = 'UTF-8';
                  $mail->Encoding = 'base64';
                  $mail->SMTPDebug = 0;
                  //Recipients
                  $mail->setFrom('info@hackmx.mx', 'Image Robot');
                  $mail->addAddress('info@hackmx.mx');     // Add a recipient
                  //$mail->addAddress('ellen@example.com');               // Name is optional
                  $mail->addReplyTo('info@hackmx.mx');
                  //$mail->addCC('info@hackmx.mx');
                  //$mail->addBCC('bcc@example.com');
                  // Attachments
                  //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                  $path = $id . "_" . $file_name;
                  $mail->addAttachment($file_tmp, $path);    // Optional name
                  // Content
                  $mail->isHTML(true);                                  // Set email format to HTML
                  $mail->Subject = $name . " acaba de mandar su credencial.";
                  $body = "Archivo adjunto.";
                  $mail->Body    = $body;
                  $mail->AltBody = "Archivo adjunto.";
                  $mail->send();
                  $success = true;
            }catch (Exception $e) {
                  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                  $success = false;
            }
            if($success){
                  $query = "UPDATE confirmacion_datos SET link_credencial = 1 WHERE idParticipante = '$id'";
                  if($connection->query($query) === true){
                        $success = true;
                  }else{
                        $success = false;
                  }
            }
            $array = array('success' => $success);
            echo json_encode($array);
      }
}
if(isset($_POST["equipoCheck"])){
      if($_POST["equipoCheck"]){
            if(isset($_POST["equipoCreate"])){
                  $success = false;
                  $teamName = $_POST["equipoNombre"];
                  $id = $_POST["idRegistro"];
                  $teamToken = generateToken();
                  $query = "INSERT INTO equipos_hackmx VALUES('$teamToken', '$teamName', '$id')";
                  $query = simpleQuery($query);
                  if($query){
                        if(insertIntoTeam($teamToken, $id)){
                              $success = true;
                        }
                  }
                  $array = array('success' => $success);
            }
            if(isset($_POST["equipoJoin"])){
                  $success = false;
                  $message = "";
                  $teamKey = $_POST["equipoClave"];
                  $id = $_POST["idRegistro"];
                  if(isValidTeamKey($teamKey)){
                        if(!isFullTeam($teamKey)){
                              if(insertIntoTeam($teamKey, $id)){
                                    $success = true;
                              }else{
                                    $message = "No se pudo ingresar al equipo.";
                              }
                        }else{
                              $message = "Ese equipo ya está lleno.";
                        }
                  }else{
                        $message = "No es una clave de equipo válida.";
                  }
                  $array = array('success' => $success, 'message' => $message);
            }
            if(isset($_POST["equipoKick"]) || isset($_POST["equipoLeave"])){
                  $success = false;
                  $id = $_POST["idRegistro"];
                  $teamKey = $_POST["idEquipo"];
                  if(removeFromTeam($teamKey, $id)){
                        $success = true;
                  }
                  $array = array('success' => $success);
            }
            if(isset($_POST["equipoDelete"])){
                  $success = false;
                  $teamKey = $_POST["idEquipo"];
                  if(removeTeam($teamKey)){
                        $success = true;
                  }
                  $array = array('success' => $success);
            }
            echo json_encode($array);
      }
    }

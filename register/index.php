<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/PHPMailer/src/Exception.php';
require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';

require "../connect.php";

if($_POST) {
    $email = $_POST["email"];
    $queryEmail = "SELECT * FROM participantes WHERE correo = ?";
    $queryEmail = $connection->prepare($queryEmail);
    $queryEmail->bind_param("s", $email);
    $queryEmail->execute();
    $resultEmail = $queryEmail->get_result();
    if($resultEmail->num_rows == 1)
    {
      $row  = $resultEmail->fetch_assoc();
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
            $mail->setFrom('info@hackmx.mx', 'Robot');
            $mail->addAddress($email);     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('info@hackmx.mx');
            //$mail->addCC('info@hackmx.mx');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = '¡HackMx 2019 te espera!';
            $body = file_get_contents('../view/registerMail.php', true);
            $body = str_replace("[NOMBRE_USUARIO]",$row["nombre"],$body);
            $body = str_replace("[ID_USUARIO]",$row["idParticipante"],$body);
            $mail->Body    = $body;
            $mail->AltBody = "\nBienvenido al Hack ".$name.", estás a unos pasos de ser parte de HackMx 2019. Por favor utiliza tu número de registro para saber los siguientes pasos en la página: http://hackmx.mx/?miRegistro \nNúmero de Registro: " .$id;

            $mail->send();
            $array= array('error' => false);
            echo json_encode($array);


      } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $array= array('error' => true, 'errorNumber' => 2);
            echo json_encode($array);

      }

    }
    else
    {
          $array= array('error' => true, 'errorNumber' => 1);
          echo json_encode($array);
    }
}else
{
    $array= array('error' => true);
    echo json_encode($array);
}
      /*$gender = $_POST["gender"];
      $grado = $_POST["grado"];
      $localidad = $_POST["localidad"];
      $birthDate = $_POST["birthDate"];
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

                  // Instantiation and passing `true` enables exceptions
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
                        $mail->setFrom('info@hackmx.mx', 'Robot');
                        $mail->addAddress($email);     // Add a recipient
                        //$mail->addAddress('ellen@example.com');               // Name is optional
                        $mail->addReplyTo('info@hackmx.mx');
                        //$mail->addCC('info@hackmx.mx');
                        //$mail->addBCC('bcc@example.com');

                        // Attachments
                        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                        // Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = '¡HackMx 2019 te espera!';
                        $body = file_get_contents('../view/registerMail.php', true);
                        $body = str_replace("[NOMBRE_USUARIO]",$name,$body);
                        $body = str_replace("[ID_USUARIO]",$id,$body);
                        $mail->Body    = $body;
                        $mail->AltBody = "\nBienvenido al Hack ".$name.", estás a unos pasos de ser parte de HackMx 2019. Por favor utiliza tu número de registro para saber los siguientes pasos en la página: http://hackmx.mx/?miRegistro \nNúmero de Registro: " .$id;

                        $mail->send();
                        $array= array('error' => false);
                        echo json_encode($array);


                  } catch (Exception $e) {
                        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        $array= array('error' => true, 'errorNumber' => 2);
                        echo json_encode($array);

                  }

            }
            else
            {
                  $array= array('error' => true);
                  echo json_encode($array);
            }
      }
      else
      {
            $array= array('error' => true, 'errorNumber' => 1);
            echo json_encode($array);
      }
}else
{
      $array= array('error' => true);
      echo json_encode($array);
}*/
?>

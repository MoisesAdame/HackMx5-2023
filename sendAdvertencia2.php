<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

require "connect.php";
$queryEmail = "SELECT * FROM participantes INNER JOIN confirmacion_datos USING(idParticipante) WHERE link_carta = 0" ;
$queryEmail = $connection->query($queryEmail);
if($queryEmail->num_rows != 0)
{
  while($row  = $queryEmail->fetch_assoc())
  {
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
          $mail->addAddress($row["correo"]);     // Add a recipient
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
          $body = file_get_contents('view/mailAdvertencia2.php', true);
          $body = str_replace("[NOMBRE_USUARIO]",$row["nombre"],$body);
          $body = str_replace("[ID_USUARIO]",$row["idParticipante"],$body);
          $mail->Body    = $body;
          $mail->AltBody = "\nHola! ".$row["nombre"].", no tenemos completo tu registro, te pido entres a terminarlo antes del miércoles 24 de abril para asegurar tu lugar: http://hackmx.mx/?miRegistro \nNúmero de Registro: " .$row["idParticipante"];
          $mail->send();
          echo "Mail enviado a ".$row["idParticipante"]."<br>";
          sleep(1);

    } catch (Exception $e) {
          //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
          echo "Error en ".$row["idParticipante"]."<br>";
    }

  }
  echo "Listo";


}

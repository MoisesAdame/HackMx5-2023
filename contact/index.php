<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/PHPMailer/src/Exception.php';
require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';

if($_POST) {
      // Instantiation and passing `true` enables exceptions
      $mail = new PHPMailer(true);
      try{
            //Server settings
            $mail->SMTPDebug = 2;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
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
            $mail->setFrom('info@hackmx.mx', 'Robot HackMx');
            $mail->addAddress('info@hackmx.mx');     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo($_POST['email']);
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $_POST['subject'];
            $body = file_get_contents('../view/contactMail.php', true);
            $body = str_replace("[NOMBRE_USUARIO]",$_POST['name'],$body);
            $body = str_replace("[MENSAJE_USUARIO]",$_POST['message'],$body);
            $mail->Body    = $body;
            $mail->AltBody = "\n\Nombre: " . $_POST['name']."\n\Correo: " .$_POST['email']."\n\Mensaje: ".$_POST['message'];

            $mail->send();
            $array = array( 'error' => false);

      } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $array = array( 'error' => true);
      }

      // Instantiation and passing `true` enables exceptions
      $mail = new PHPMailer(true);

      try {
            //Server settings
            $mail->SMTPDebug = 2;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
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
            $mail->addAddress($_POST['email']);     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('info@hackmx.mx', 'Robot');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $_POST['subject'];
            $body = file_get_contents('../view/confirmationContactMail.php', true);
            $body = str_replace("[NOMBRE_USUARIO]",$_POST['name'],$body);
            $body = str_replace("[MENSAJE_USUARIO]",$_POST['message'],$body);
            $mail->Body    = $body;
            $mail->AltBody = "Gracias " . $_POST['name']."por ponerte en contacto, en cuanto uno de nuestros bots se desocupe te responderemos.";

            $mail->send();
            $array = array( 'error' => false);

      } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $array = array( 'error' => true);
      }
      echo json_encode($array);

      $body = "\n\Nombre: " . $_POST['name']."\n\Correo: " .$_POST['email']."\n\Mensaje: ".$_POST['message'];


}else{
      $array = array( 'error' => true);
      echo json_encode($array);
}

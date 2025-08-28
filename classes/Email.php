<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        // Crear el objeto de PHPMailer
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASSWORD'];

        $mail->setFrom('alvaxG@example.com');
        $mail->addAddress($this->email);
        $mail->Subject = 'Confirma tu Cuenta';

        // Configurar el HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<head>";
        $contenido .= "<style>";
        $contenido .= "body { font-family: 'Arial', sans-serif; margin: 0; display: flex; justify-content: center; padding: 2rem; background-color: #f0f0f0; text-align: center;}";
        $contenido .= ".contenedor { background-color: #fff; padding: 2rem; border-radius: 5px; }";
        $contenido .= "h1 { margin-bottom: 2rem; }";
        $contenido .= "p { color: #333; text-align: left; }";
        $contenido .= "a {";
        $contenido .= "   display: inline-block;";
        $contenido .= "   padding: 10px 20px;";
        $contenido .= "   background-color: #3498db;";
        $contenido .= "   color: #fff !important;";
        $contenido .= "   text-decoration: none;";
        $contenido .= "   font-weight: bold;";
        $contenido .= "   border-radius: 5px;";
        $contenido .= "   margin-bottom: 1rem;";
        $contenido .= "}";
        $contenido .= "a:visited { color: #fff !important; }";
        $contenido .= ".small { font-size: 0.8rem; color: #999; text-align: center; }";
        $contenido .= "</style>";
        $contenido .= "</head>";
        $contenido .= "<body>";
        $contenido .= "<div class='contenedor'>";
        $contenido .= "<h1>¡Bienvenido!</h1>";
        $contenido .= "<p>Hola <span style='color: #3498db;'>" . $this->nombre . "</span>,</p>";
        $contenido .= "<p>Gracias por crear tu cuenta en AppSalon.</p>";
        $contenido .= "<p>Para confirmar tu cuenta, haz clic en el siguiente botón:</p>";
        $contenido .= "<a href='" . $_ENV['APP'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>";
        $contenido .= "<br>";
        $contenido .= "<hr>";
        $contenido .= "<p class='small'>Si no solicitaste esta cuenta, puedes ignorar este mensaje.</p>";
        $contenido .= "</div>";
        $contenido .= "</body>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        // Enviar el mail
        try {
            $mail->send();
        } catch (\Exception $e) {
            // Puedes registrar el error o manejarlo según tu necesidad
            error_log('Error enviando correo de confirmación: ' . $mail->ErrorInfo);
        }
    }

    public function enviarInstrucciones()
    {
        // Crear el objeto de PHPMailer
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASSWORD'];

        $mail->setFrom('alvaxG@example.com');
        $mail->addAddress($this->email);
        $mail->Subject = 'Reestablece tu password';

        // Configurar el HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<head>";
        $contenido .= "<style>";
        $contenido .= "body { font-family: 'Arial', sans-serif; margin: 0; display: flex; justify-content: center; padding: 2rem; background-color: #f0f0f0; text-align: center;}";
        $contenido .= ".contenedor { background-color: #fff; padding: 2rem; border-radius: 5px; }";
        $contenido .= "h1 { margin-bottom: 2rem; }";
        $contenido .= "p { color: #333; text-align: left; }";
        $contenido .= "a {";
        $contenido .= "   display: inline-block;";
        $contenido .= "   padding: 10px 20px;";
        $contenido .= "   background-color: #3498db;";
        $contenido .= "   color: #fff !important;";
        $contenido .= "   text-decoration: none;";
        $contenido .= "   font-weight: bold;";
        $contenido .= "   border-radius: 5px;";
        $contenido .= "   margin-bottom: 1rem;";
        $contenido .= "}";
        $contenido .= "a:visited { color: #fff !important; }";
        $contenido .= ".small { font-size: 0.8rem; color: #999; text-align: center; }";
        $contenido .= "</style>";
        $contenido .= "</head>";
        $contenido .= "<body>";
        $contenido .= "<div class='contenedor'>";
        $contenido .= "<h1>¡Recuperar mi cuenta!</h1>";
        $contenido .= "<p>Hola <span style='color: #3498db;'>" . $this->nombre . "</span>,</p>";
        $contenido .= "<p>Haz solicitado reestablecer tu password de AppSalon.</p>";
        $contenido .= "<p>Puedes hacerlo dando clic en el siguiente botón</p>";
        $contenido .= "<a href='" . $_ENV['SERVER_HOST'] . "/recuperar?token=" . $this->token . "'>Reestablecer Password</a>";
        $contenido .= "<br>";
        $contenido .= "<hr>";
        $contenido .= "<p class='small'>Si no fuiste tú, puedes ignorar este mensaje.</p>";
        // Enviar el mail
        try {
            $mail->send();
        } catch (\Exception $e) {
            // Puedes registrar el error o manejarlo según tu necesidad
            error_log('Error enviando correo de instrucciones: ' . $mail->ErrorInfo);
        }
        $mail->Body = $contenido;

        // Enviar el mail
        $mail->send();
    }
}

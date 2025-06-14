<?php
namespace utilities;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__ . '/../libraries/PHPMailer-master/src/PHPMailer.php';
include_once __DIR__ . '/../libraries/PHPMailer-master/src/Exception.php';
include_once __DIR__ . '/../libraries/PHPMailer-master/src/SMTP.php';

class MailUtility
{
    public static function sendWelcomeEmail($toEmail, $toName)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ttherdev@gmail.com';
            $mail->Password = 'mhbrykallnvvufuq';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Remitente
            $mail->setFrom('ttherdev@gmail.com', 'Moodify ');
            // Receptor
            $mail->addAddress($toEmail, $toName);

            // Contenido del email
            $mail->isHTML(true);
            $mail->Subject = '¡Bienvenido a Moodify!';
            $mail->Body = self::getWelcomeEmailTemplate($toName);

            // Enviar
            $mail->send();
            return true;

        } catch (Exception $e) {
            // Puedes loguear el error si quieres
            error_log("Error al enviar email de bienvenida: {$mail->ErrorInfo}");
            return false;
        }
    }

    private static function getWelcomeEmailTemplate($toName)
    {
        return "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>¡Bienvenido a Moodify!</title>
            <link href='https://fonts.googleapis.com/css2?family=Zain:wght@300;400;700&display=swap' rel='stylesheet'>
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }
                
                body {
                    font-family: 'Zain', Arial, sans-serif;
                    line-height: 1.6;
                    color: #241d17;
                    background-color: #f8e4c5;
                }
                
                .email-container {
                    max-width: 600px;
                    margin: 0 auto;
                    background: linear-gradient(135deg, #fef9e9 0%, #f8e4c5 100%);
                    border-radius: 20px;
                    overflow: hidden;
                    box-shadow: 0 10px 30px rgba(36, 29, 23, 0.1);
                }
                
                .header {
                    background: linear-gradient(135deg, #f9ccc8 0%, #f2bdcb 100%);
                    padding: 40px 30px;
                    text-align: center;
                    position: relative;
                }
                
                .header::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><circle cx=\"20\" cy=\"20\" r=\"2\" fill=\"%23ffffff\" opacity=\"0.1\"/><circle cx=\"80\" cy=\"30\" r=\"1.5\" fill=\"%23ffffff\" opacity=\"0.1\"/><circle cx=\"60\" cy=\"70\" r=\"1\" fill=\"%23ffffff\" opacity=\"0.1\"/><circle cx=\"30\" cy=\"80\" r=\"2.5\" fill=\"%23ffffff\" opacity=\"0.1\"/></svg>') repeat;
                }
                
                .logo {
                    font-size: 3em;
                    margin-bottom: 10px;
                    position: relative;
                    z-index: 1;
                }
                
                .brand-name {
                    font-size: 2.2em;
                    font-weight: 700;
                    color: #241d17;
                    margin-bottom: 10px;
                    position: relative;
                    z-index: 1;
                    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
                }
                
                .subtitle {
                    font-size: 1.1em;
                    color: #241d17;
                    opacity: 0.8;
                    position: relative;
                    z-index: 1;
                }
                
                .content {
                    padding: 40px 30px;
                    background-color: #fef9e9;
                }
                
                .greeting {
                    font-size: 1.8em;
                    font-weight: 700;
                    color: #241d17;
                    margin-bottom: 20px;
                    text-align: center;
                }
                
                .message {
                    font-size: 1.1em;
                    line-height: 1.8;
                    color: #241d17;
                    margin-bottom: 30px;
                    text-align: center;
                }
                
                .features {
                    background: linear-gradient(135deg, #f8e4c5 0%, #dcb18b 100%);
                    border-radius: 15px;
                    padding: 25px;
                    margin: 30px 0;
                    border: 1px solid rgba(36, 29, 23, 0.1);
                }
                
                .features-title {
                    font-size: 1.3em;
                    font-weight: 700;
                    color: #241d17;
                    margin-bottom: 15px;
                    text-align: center;
                }
                
                .feature-list {
                    list-style: none;
                    padding: 0;
                }
                
                .feature-item {
                    display: flex;
                    align-items: center;
                    margin-bottom: 12px;
                    font-size: 1em;
                    color: #241d17;
                }
                
                .feature-icon {
                    margin-right: 12px;
                    font-size: 1.2em;
                }
                
            
                
                .footer {
                    background-color: #dcb18b;
                    padding: 25px 30px;
                    text-align: center;
                    border-top: 1px solid rgba(36, 29, 23, 0.1);
                }
                
                .footer-text {
                    color: #241d17;
                    font-size: 0.9em;
                    opacity: 0.8;
                    margin-bottom: 10px;
                }
                
                .social-links {
                    margin-top: 20px;
                    font-size: 1.5em;
                }
                
                .wave {
                    height: 20px;
                    background: linear-gradient(135deg, #f9ccc8 0%, #f2bdcb 100%);
                    position: relative;
                    overflow: hidden;
                }
                
                .wave::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 200%;
                    height: 100%;
                    background: repeating-linear-gradient(
                        90deg,
                        transparent,
                        transparent 10px,
                        rgba(255,255,255,0.1) 10px,
                        rgba(255,255,255,0.1) 20px
                    );
                    animation: wave 3s linear infinite;
                }
                
                @keyframes wave {
                    0% { transform: translateX(0); }
                    100% { transform: translateX(-50%); }
                }
                
                @media (max-width: 600px) {
                    .email-container {
                        margin: 10px;
                        border-radius: 15px;
                    }
                    
                    .header {
                        padding: 30px 20px;
                    }
                    
                    .content {
                        padding: 30px 20px;
                    }
                    
                    .brand-name {
                        font-size: 1.8em;
                    }
                    
                    .greeting {
                        font-size: 1.5em;
                    }
                }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <div class='header'>
                    <div class='logo'>🎵</div>
                    <div class='brand-name'>Moodify</div>
                    <div class='subtitle'>Tu música, tus emociones</div>
                </div>
                
                <div class='wave'></div>
                
                <div class='content'>
                    <h1 class='greeting'>¡Hola, " . htmlspecialchars($toName) . "! 🎉</h1>
                    
                    <p class='message'>
                        ¡Bienvenido a <strong>Moodify</strong>! Tu cuenta ha sido creada correctamente y ya puedes comenzar a disfrutar de una experiencia musical única.
                    </p>
                    
                    <div class='features'>
                        <h3 class='features-title'>¿Qué puedes hacer en Moodify?</h3>
                        <ul class='feature-list'>
                            <li class='feature-item'>
                                <span class='feature-icon'>🎶</span>
                                Escucha música mientras anotas tu estado de ánimo
                            </li>
                            <li class='feature-item'>
                                <span class='feature-icon'>❤️</span>
                                Conecta tus emociones con melodías perfectas
                            </li>
                            <li class='feature-item'>
                                <span class='feature-icon'>🌟</span>
                                Crea entradas en el calendario cadada día con tus emociones
                            </li>
                            <li class='feature-item'>
                                <span class='feature-icon'>🎧</span>
                                Explora nuevos géneros y artistas
                            </li>
                        </ul>
                    </div>
                    
                    
                    <p class='message'>
                        ¡Disfruta de la música y no te olvides de anotar como te sientes! 🎶
                    </p>
                </div>
                
                <div class='footer'>
                    <p class='footer-text'>
                        Gracias por unirte a la comunidad Moodify
                    </p>
                    <p class='footer-text'>
                        Si tienes alguna pregunta, no dudes en contactarnos
                    </p>
                    <div class='social-links'>
                        🎵 ❤️ 🎶
                    </div>
                </div>
            </div>
        </body>
        </html>";
    }
}
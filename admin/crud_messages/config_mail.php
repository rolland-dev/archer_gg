<?php

    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'mail80.lwspanel.com'; // Définissez le serveur SMTP à utiliser pour l'envoi
    $mail->SMTPAuth   = true;               // Activez l'authentification SMTP
    $mail->Username   = 'contact@archersdeguignicourt.fr'; // Nom d'utilisateur SMTP
    $mail->Password   = '2bikjbr1dp'; // Mot de passe SMTP
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Activez le chiffrement TLS
    $mail->Port       = 587; // Port TCP à utiliser

    // Adresse de l'expéditeur et de réponse
    $mail->setFrom('contact@archersdeguignicourt.fr', 'Archers de Guignicourt');
    $mail->addReplyTo('contact@archersdeguignicourt.fr', 'Archers de Guignicourt');

    // Contenu
    $mail->isHTML(true); // Définir le format de l'email en HTML

?>
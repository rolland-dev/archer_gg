<?php
require_once "../../php/bdd/config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; // Chemin vers le fichier autoload de Composer

$lien = $editeur = $commentaire = $valide ="";
$lien_err = $editeur_err = $commentaire_err = $valide_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_editeur = trim($_POST["editeur"]);
    if(empty($input_editeur)){
        $editeur_err = "entrer un editeur";     
    } else{
        $editeur = $input_editeur;
    }

    $input_commentaire = htmlspecialchars($_POST["commentaire"]);
    if(empty($input_commentaire)){
        $commentaire_err = "entrer un commentaire";     
    } else{
        $commentaire = $input_commentaire;
    }
    $input_valide = htmlspecialchars($_POST["valide"]);
    if(empty($input_valide)){
        $valide_err = "entrer une validité";     
    } else{
        $valide = $input_valide;
    }

    if(isset($_FILES['img'])){
        $tmpName = $_FILES['img']['tmp_name'];
        $name = $_FILES['img']['name'];
        $size = $_FILES['img']['size'];
        $error = $_FILES['img']['error'];
        move_uploaded_file($tmpName, '../../img/infos/'.$name);
        if($name==''){
            $lien='';
        }else{
            $lien = '/img/infos/'.$name;
        }
        
    }

    if(empty($editeur_err) && empty($commentaire_err) ){
       
            $param_editeur = $editeur;
            $param_commentaire = $commentaire;
            $param_lien = $lien;
            $param_date = date("Y-m-d");
            $param_valide = $valide;
            
            $sql = "INSERT INTO messages (lien, date, editeur, commentaire , valide) VALUES ( '$param_lien', '$param_date', '$param_editeur', '$param_commentaire', '$param_valide')";
          
            $result = mysqli_query($link, $sql);
            if($result){

                $sql1 = "SELECT email FROM archers WHERE valide=1";
                $email1=array();
                if($result1 = mysqli_query($link,$sql1)){
                    if(mysqli_num_rows($result1)>0){
                        while($row1 = mysqli_fetch_array($result1)){
                            if($row1['email']!=""){
                                array_push($email1, $row1['email']);
                            }
                        }
                    }
                }
                
                if($valide===1){
                    foreach($email1 as $email){
                        $mail = new PHPMailer(true);

                        try {
                            //Server settings
                           include './config_mail.php';
                            
                            $mail->addAddress($email); // Ajouter un destinataire

                            // Personnaliser le message
                            $mail->Subject = 'Message Archers de Guignicourt';
                            $mail->Body    = "Bonjour, un nouveau message a été déposé le site des archers de Guignicourt, accédez https://www.archersdeguignicourt.fr .  Cordialement l'équipe des Archers de Guignicourt.";
                            $mail->AltBody = "Bonjour, un nouveau message a été déposé le site des archers de Guignicourt, accédez https://www.archersdeguignicourt.fr .  Cordialement l'équipe des Archers de Guignicourt.";

                            $mail->send();
                            $mail->clearAddresses(); // Effacer les adresses pour la prochaine itération

                            echo 'Les messages ont été envoyés';
                        } catch (Exception $e) {
                            echo "Le message n'a pas pu être envoyé. Erreur du Mailer : {$mail->ErrorInfo}";
                        }
                        // envoi de mail
                        // ini_set( 'display_errors', 1 );
                        // error_reporting( E_ALL );
                        // $from = "contact@archersdeguignicourt.fr";
                        // $to = $email;
                        // $subject = "Message Archers de Guignicourt". $email;
                        // $message = "Bonjour, un nouveau message a été déposé le site des archers de Guignicourt, accédez https://www.archersdeguignicourt.fr .  Cordialement l'équipe des Archers de Guignicourt.";
                        // $headers[] = 'MIME-Version: 1.0';
                        // $headers[] = 'Content-type: text/html; charset=utf-8';
                        // $headers[] = "De :" . $from;
                        // mail($to,$subject,$message, implode("\r\n",$headers));
                        // echo "L'email a été envoyé.";
                        // fin envoi mail
                    }
                }else{
                    foreach($email1 as $email){
                        $mail = new PHPMailer(true);

                        try {
                            //Server settings
                           include './config_mail.php';
                            
                            $mail->addAddress($email); // Ajouter un destinataire

                            // Personnaliser le message
                            $mail->Subject = 'Message Archers de Guignicourt';
                            $mail->Body    = $commentaire;
                            $mail->AltBody = $commentaire;

                            $mail->send();
                            $mail->clearAddresses(); // Effacer les adresses pour la prochaine itération

                            echo 'Les messages ont été envoyés';
                        } catch (Exception $e) {
                            echo "Le message n'a pas pu être envoyé. Erreur du Mailer : {$mail->ErrorInfo}";
                        }

                        // envoi de mail
                        // ini_set( 'display_errors', 1 );
                        // error_reporting( E_ALL );
                        // $from = "contact@archersdeguignicourt.fr";
                        // $to = $email;
                        // $subject = "Message Archers de Guignicourt". $email;
                        // $message = $commentaire;
                        // $headers[] = 'MIME-Version: 1.0';
                        // $headers[] = 'Content-type: text/html; charset=utf-8';
                        // $headers[] = "De :" . $from;
                        // mail($to,$subject,$message, implode("\r\n",$headers));
                        // echo "L'email a été envoyé.";
                        // fin envoi mail
                    }
                }
                
                mysqli_close($link);
                header("location: ../messages_admin.php");
                exit();
            } else{
                echo "Oops! erreur inattendu, rééssayez ultérieusement";
            }
        }
    
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Création d'un message</h2><br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Editeur</label>
                            <input type="text" name="editeur" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Commentaire</label>
                            <textarea name="commentaire" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Valide (si message interne, mettre 0)</label>
                            <input type="number" name="valide" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="file">Fichier</label>
                            <input type="file" name="img">
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="../messages_admin.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
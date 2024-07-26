<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_nom =trim($_POST['nom']);

    if(empty($input_nom)){
        $nom_err = "Entrez un nom";
     } else{
        $nom = $input_nom;
    }

    $input_prenom =trim($_POST['prenom']);

    if(empty($input_prenom)){
        $prenom_err = "Entrez un prenom";
     } else{
        $prenom = $input_prenom;
    }

    $input_mail =trim($_POST['mail']);

    if(empty($input_mail)){
        $mail_err = "Entrez un email";
     } else{
        $mail = $input_mail;
    }

    $input_msg =htmlspecialchars($_POST['message']);

    if(empty($input_msg)){
        $msg_err = "Entrez un message";
     } else{
        $message = $input_msg;
    }

    $date = date("Y-m-d");

     // envoi de mail
     ini_set( 'display_errors', 1 );
     error_reporting( E_ALL );
     $from = $mail;
     $to = "contact@archersdeguignicourt.fr";
     $subject = "Demande d'informations de ". $mail;
     $message_send = $message . " / Mail de contact : ". $mail;
     $headers = "De :" . $mail;
     mail($to,$subject,$message_send, $headers);
     echo "L'email a été envoyé.";
     // fin envoi mail

     header("location: ./index.php");
     exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once './php/menu/head.php' ?>
    <title>contact</title>
</head>
<body>
    <?php require_once './php/menu/menu.php'; ?>

    <h1 class="text-center">Nous contacter</h1>

    <hr>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Merci de remplir tous les champs</h2><br>
            
            <div class="offset-md-2 col-md-8">
                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">
                    <div class="form-group">
                        <label>Nom</label><br>
                        <input type="text" name="nom" class="form-controle ">
                    </div><br>
                    <div class="form-group">
                        <label>Prenom</label><br>
                        <input type="text" name="prenom" class="form-controle ">
                    </div><br>
                    <div class="form-group">
                        <label>E-Mail</label><br>
                        <input type="text" name="mail" class="form-controle ">
                    </div><br>
                    <div class="form-group">
                        <label>Message</label><br>
                        <textarea type="text" name="message" class="form-controle "></textarea>
                    </div><br>
                    <div class="info">
                        <p></p>
                    </div><br>
                    
                    <input type="submit" class="btn btn-primary" value="Envoyer">
                    <a href="./index.php" class="btn btn-secondary ml-2">Annuler</a>
                </form>
            </div>
            </div>
        </div>
    </div>
</div><br><br>

    <?php require_once './php/menu/footer.php'; ?>
</body>
</html>
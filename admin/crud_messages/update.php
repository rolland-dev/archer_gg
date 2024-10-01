<?php
require_once "../../php/bdd/config.php";

$commentaire =  "";
$commentaire_err = "";


if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];

    $input_commentaire = htmlspecialchars($_POST["commentaire"]);
    if(empty($input_commentaire)){
        $commentaire_err = "entrer un commentaire";
    } else{
        $commentaire = $input_commentaire;
    }
    
    if(empty($commentaire_err) ){

        $sql = "UPDATE messages SET commentaire=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "si", $param_commentaire, $param_id);
            
            $param_commentaire = $commentaire;
            $param_id = $_GET['id'];

            if(mysqli_stmt_execute($stmt)){
                $sql1 = "SELECT email FROM archers "; //WHERE valide=1
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
                
                foreach($email1 as $email){
                    // envoi de mail
                    ini_set( 'display_errors', 1 );
                    error_reporting( E_ALL );
                    $from = "contact@archersdeguignicourt.fr";
                    $to = $email;
                    $subject = "Message Archers de Guignicourt". $email;
                    $message = "Bonjour, un nouveau message a été déposé le site des archers de Guignicourt, accédez https://www.archersdeguignicourt.fr .  Cordialement l'équipe des Archers de Guignicourt.";
                    $headers[] = 'MIME-Version: 1.0';
                    $headers[] = 'Content-type: text/html; charset=utf-8';
                    $headers[] = "De :" . $from;
                    mail($to,$subject,$message, implode("\r\n",$headers));
                    echo "L'email a été envoyé.";
                    // fin envoi mail
                }
                header("location: ../messages_admin.php");
                exit();
            } else{
                echo "Oops! erreur inattendu, rééssayez ultérieusement";
            }
        }
        
    }
    
    mysqli_close($link);
} else{
    
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id =  trim($_GET["id"]);
        
        $sql = "SELECT * FROM messages WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $editeur = $row["editeur"];
                    $commentaire = $row["commentaire"];
                    $id = $row["id"];
                    
                } else{
                    header("location: error.php");
                    exit();
                }
            } else{
                echo "Oops! erreur inattendu, rééssayez ultérieusement";
            }
        }       
    }  else{
        header("location: error.php");
        exit();
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
    .wrapper {
        width: 600px;
        margin: 0 auto;
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Mise a jour du commentaire de : <?= $editeur ?></h2>
                    <p>Changez les valeurs et validez !!!</p>
                    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">
                        <div class="form-group">
                            <label>Commentaire</label>
                            <textarea name="commentaire"
                                class="form-control <?php echo (!empty($commentaire_err)) ? 'is-invalid' : ''; ?>"><?php echo $commentaire; ?></textarea>
                        </div>
                       
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="../archers_admin.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
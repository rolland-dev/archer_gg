<?php
require_once "../../php/bdd/config.php";

$lien = $editeur = $commentaire = "";
$lien_err = $editeur_err = $commentaire_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_editeur = trim($_POST["editeur"]);
    if(empty($input_editeur)){
        $editeur_err = "entrer un editeur";     
    } else{
        $editeur = $input_editeur;
    }

    $input_commentaire = trim($_POST["commentaire"]);
    if(empty($input_commentaire)){
        $commentaire_err = "entrer un commentaire";     
    } else{
        $commentaire = $input_commentaire;
    }

    if(isset($_FILES['img'])){
        $tmpName = $_FILES['img']['tmp_name'];
        $name = $_FILES['img']['name'];
        $size = $_FILES['img']['size'];
        $error = $_FILES['img']['error'];
        move_uploaded_file($tmpName, '../../img/infos/'.$name);
        $lien = '/img/infos/'.$name;
    }

    if(empty($editeur_err) && empty($commentaire_err) ){
       
            $param_editeur = $editeur;
            $param_commentaire = $commentaire;
            $param_lien = $lien;
            $param_date = date("Y-m-d");
            $param_valide = true;
            
            $sql = "INSERT INTO messages (lien, date, editeur, commentaire , valide) VALUES ( '$param_lien', '$param_date', '$param_editeur', '$param_commentaire', '$param_valide')";
          
            $result = mysqli_query($link, $sql);
            if($result){
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
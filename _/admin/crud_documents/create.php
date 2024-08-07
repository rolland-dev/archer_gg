<?php
require_once "../../php/bdd/config.php";

$image = $date = $titre = "";
$image_err = $date_err = $titre_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $input_date = trim($_POST["date"]);
    if(empty($input_date)){
        $date_err = "entrer une date";     
    } else{
        $date = $input_date;
    }

    $input_titre = trim($_POST["titre"]);
    if(empty($input_titre)){
        $titre_err = "entrer un titre";
    } else{
        $titre = $input_titre;
    }

    if(isset($_FILES['img'])){
        $tmpName = $_FILES['img']['tmp_name'];
        $name = $_FILES['img']['name'];
        $size = $_FILES['img']['size'];
        $error = $_FILES['img']['error'];

        move_uploaded_file($tmpName, '../../fichiers/'.$name);
        $img = './fichiers/'.$name;
    }

    if(empty($date_err) && empty($titre_err)){
       
            $param_lien = $img;
            $param_date = $date;
            $param_titre = $titre;
            
            $sql = "INSERT INTO documents (date,titre, lien) VALUES ( '$param_date', '$param_titre', '$param_lien')";
    
            $result = mysqli_query($link, $sql);
            if($result){
                mysqli_close($link);
                header("location: ../documents_admin.php");
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
                    <h2 class="mt-5">Création d'une image</h2><br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control">
                        </div>
                          <div class="form-group">
                            <label>Titre</label>
                            <input type="text" name="titre" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="file">Fichier</label>
                            <input type="file" name="img">
                        </div>
                       
                        <input type="submit" name="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="../documents_admin.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
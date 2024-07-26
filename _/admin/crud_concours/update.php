<?php
require_once "../../php/bdd/config.php";

$points = $classement= "";
$points_err = $classement_err = "";


if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];
    
    $input_points = trim($_POST["points"]);
    if(empty($input_points)){
        $points_err = "entrer points";
    } else{
        $points = $input_points;
    }
    
    $input_classe = trim($_POST["classement"]);
    if(empty($input_classe)){
        $classement_err = "entrer un classement";     
    } else{
        $classement = $input_classe;
    }   

    if(empty($points_err) ){

        $sql = "UPDATE inscriptions SET points=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ii", $param_points, $param_id);
            
            $param_points = $points;
            $param_id = $_GET['id'];
            
            if(mysqli_stmt_execute($stmt)){
                header("location: ../concours_admin.php");
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
        
        $sql = "SELECT * FROM inscriptions WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $nom = $row["nom"];
                    $prenom = $row["prenom"];
                    $points = $row["points"];
                    $classement = $row["classement"];
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
                    <h2 class="mt-5">Mise a jour de l'archer : <?= $nom ?></h2>
                    <p>Changez les valeurs et validez !!!</p>
                    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="nom" class="form-control" value="<?php echo $nom; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Prénom</label>
                            <input type="text" name="prenom" class="form-control" value="<?php echo $prenom; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Points total</label>
                            <input type="number" name="points" class="form-control" value="<?php echo $points; ?>">
                        </div>
                        <div class="form-group">
                            <label>Classement</label>
                            <input type="number" name="classement" class="form-control" value="<?php echo $classement; ?>">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="../concours_admin.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
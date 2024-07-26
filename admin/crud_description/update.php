<?php
require_once "../../php/bdd/config.php";

$distance = $points = $nbvolees = $nbfleches = $blason = $nbpassage = "";
$distance_err = $points_err = $nbvolees_err = $nbfleches_err = $blason_err = $nbpassage_err = "";


if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];

    $input_distance = trim($_POST["distance"]);
    if(empty($input_distance)){
        $distance_err = "entrer une distance";
    } else{
        $distance = $input_distance;
    }
    
    $input_points = trim($_POST["points"]);
    if(empty($input_points)){
        $points_err = "entrer un nombre de points";     
    } else{
        $points = $input_points;
    }
    
    $input_nbvolees = trim($_POST["nbvolees"]);
    if(empty($input_nbvolees)){
        $nbvolees_err = "entrer un nombre de volées";
    } else{
        $nbvolees = $input_nbvolees;
    }
    
    $input_nbfleches = trim($_POST["nbfleches"]);
    if(empty($input_nbfleches)){
        $nbfleches_err = "entrer un nombre de flêches";     
    } else{
        $nbfleches = $input_nbfleches;
    }
   
    $input_blason = trim($_POST["blason"]);
    if(empty($input_blason)){
        $bason_err = "entrer une taille de blason";     
    } else{
        $blason = $input_blason;
    }

    $input_nbpassage = trim($_POST["nbpassage"]);
    if(empty($input_nbpassage)){
        $nbpassage_err = "entrer un nombre de passage";     
    } else{
        $nbpassage = $input_nbpassage;
    }

    if(empty($distance_err) && empty($points_err) && empty($blason_err) && empty($nbvolees_err) && empty($nbfleches_err) && empty($nbpassage_err)){

        $sql = "UPDATE progression SET distance=?, points=?, blason=?, nbvolees=?, nbfleches=?, nbpassage=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "iiiiiii", $param_distance, $param_points, $param_blason,$param_nbvolees,$param_nbfleches, $param_nbpassage, $param_id);
            
            $param_distance = $distance;
            $param_points = $points;
            $param_blason = $blason;
            $param_nbvolees = $nbvolees;
            $param_nbfleches = $nbfleches;
            $param_nbpassage = $nbpassage;
            $param_id = $_GET['id'];

            if(mysqli_stmt_execute($stmt)){
                header("location: ../description_admin.php");
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
        
        $sql = "SELECT * FROM progression WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $distance = $row["distance"];
                    $points = $row["points"];
                    $nbvolees = $row['nbvolees'];
                    $nbfleches = $row['nbfleches'];
                    $blason = $row['blason'];
                    $nbpassage = $row['nbpassage'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  

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
                    <h2 class="mt-5">Mise a jour des plumes ou flêche </h2>
                    <p>Changez les valeurs et validez !!!</p><br><br>
                    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Distance</label>
                            <input type="number" name="distance" class="form-control" value="<?php echo $distance; ?>">
                        </div>
                        <div class="form-group">
                            <label>Blason</label>
                            <input type="number" name="blason" class="form-control" value="<?php echo $blason; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nb volées</label>
                            <input type="number" name="nbvolees" class="form-control" value="<?php echo $nbvolees; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nb flêches</label>
                            <input type="number" name="nbfleches" class="form-control" value="<?php echo $nbfleches; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nb passages</label>
                            <input type="number" name="nbpassage" class="form-control" value="<?php echo $nbpassage; ?>">
                        </div>
                        <div class="form-group">
                            <label>Points</label>
                            <input type="number" name="points" class="form-control" value="<?php echo $points; ?>">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="../description_admin.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
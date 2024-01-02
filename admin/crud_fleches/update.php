<?php
require_once "../../php/bdd/config.php";

$couleur = $point = $valideur = $date = "";
$couleur_err = $point_err = $valideur_err = $date_err = "";


if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];

    $input_couleur = trim($_POST["couleur"]);
    if(empty($input_couleur)){
        $couleur_err = "entrer un couleur";
    } else{
        $couleur = $input_couleur;
    }
    
    $input_point = trim($_POST["point"]);
    if(empty($input_point)){
        $point_err = "entrer un nombre de points";     
    } else{
        $point = $input_point;
    }
    
    $input_valideur = trim($_POST["valideur"]);
    if(empty($input_valideur)){
        $valideur_err = "entrer un valideur";
    } else{
        $valideur = $input_valideur;
    }
    
    $input_date = trim($_POST["date"]);
    if(empty($input_date)){
        $date_err = "entrer une date de validation";     
    } else{
        $date = $input_date;
    }
   

    if(empty($couleur_err) && empty($point_err) && empty($valideur_err) && empty($date_err)){

        $sql = "UPDATE fleches SET couleur=?, point=?, validateur=?, date=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sissi", $param_couleur, $param_point, $param_valideur,$param_date, $param_id);
            
            $param_couleur = $couleur;
            $param_point = $point;
            $param_valideur = $valideur;
            $param_date = $date;
            $param_id = $_GET['id'];

            if(mysqli_stmt_execute($stmt)){
                header("location: ../archers_admin.php");
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
        
        $sql = "SELECT * FROM fleches WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $couleur = $row["couleur"];
                    $point = $row["point"];
                    $valideur = $row['validateur'];
                    $date = $row['date'];
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
                    <h2 class="mt-5">Mise a jour d'une flêche archer </h2>
                    <p>Changez les valeurs et validez !!!</p><br><br>
                    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Couleur plume <i class="fa-solid fa-right-long"></i> <?php echo $couleur; ?> <br> changer <i class="fa-solid fa-right-long"></i></label>
                            <select name="couleur" id="couleur">
                                <option value="blanche">Blanche</option>
                                <option value="noire">Noire</option>
                                <option value="bleue">Bleue</option>
                                <option value="rouge">Rouge</option>
                                <option value="jaune">Jaune</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Points</label>
                            <input type="number" name="point" class="form-control" value="<?php echo $point; ?>">
                        </div>
                          <div class="form-group">
                            <label>Validateur</label>
                            <input type="text" name="valideur" class="form-control" value="<?php echo $valideur; ?>">
                        </div>
                        <div class="form-group">
                            <label>Date d'obtention</label>
                            <input type="date" name="date" class="form-control" value="<?php echo $date; ?>">
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
<?php
require_once "../../php/bdd/config.php";

$nom = $prenom = $sexe = $daten = $gs = $numsecu = $nummut = $nommut = $valide= "";
$nom_err = $prenom_err = $sexe_err = $daten_err = $gs_err = $numsecu_err = "";


if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];

    $input_nom = trim($_POST["nom"]);
    if(empty($input_nom)){
        $nom_err = "entrer un nom";
    } else{
        $nom = $input_nom;
    }
    
    $input_prenom = trim($_POST["prenom"]);
    if(empty($input_prenom)){
        $prenom_err = "entrer un prénom";     
    } else{
        $prenom = $input_prenom;
    }
    
    $input_sexe = trim($_POST["sexe"]);
    if(empty($input_sexe)){
        $sexe_err = "entrer un genre";
    } else{
        $sexe = $input_sexe;
    }
    
    $input_daten = trim($_POST["daten"]);
    if(empty($input_daten)){
        $daten_err = "entrer une date de naissance";     
    } else{
        $daten = $input_daten;
    }

    $input_gs = trim($_POST["gs"]);
    if(empty($input_gs)){
        $gs_err = "entrer le groupe sanguin";     
    } else{
        $gs = $input_gs;
    }

    $input_numsecu = trim($_POST["numsecu"]);
    if(empty($input_numsecu)){
        $numsecu_err = "entrer le numéro de sécu";     
    } else{
        $numsecu = $input_numsecu;
    }

    $nummut = trim($_POST['nummut']);
    $nommut = trim($_POST['nommut']);
    $valide = trim($_POST['valide']);
   

    if(empty($nom_err) && empty($prenom_err) && empty($sexe_err) && empty($daten_err) && empty($gs_err) && empty($numsecu_err)){

        $sql = "UPDATE patient SET nom=?, prenom=?, sexe=?, date_n=?, gs=?, num_secu=?, num_mutuel=?, nom_mutuel=? ,valide=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssssiisii", $param_titre, $param_entete, $param_type, $param_heure, $param_objectifs, $param_img, $param_tarif_g, $param_tarif_p, $param_public, $param_details, $param_id);
            
            $param_nom = $nom;
            $param_prenom = $prenom;
            $param_sexe = $sexe;
            $param_daten = $daten;
            $param_gs = $gs;
            $param_numsecu = $numsecu;
            $param_nummut = $nummut;
            $param_nommut = $nommut;
            $param_valide = $valide;
            $param_id = $_GET['id'];

            if(mysqli_stmt_execute($stmt)){
                header("location: ../patient_admin.php");
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
        
        $sql = "SELECT * FROM patient WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $nom = $row["nom"];
                    $prenom = $row["prenom"];
                    $sexe = $row['sexe'];
                    $daten = $row['date_n'];
                    $gs = $row['gs'];
                    $numsecu = $row['num_secu'];
                    $nummut = $row['num_mutuel'];
                    $nommut = $row['nom_mutuel'];
                    $valide = $row['valide'];
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
                    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="nom" class="form-control" value="<?php echo $nom; ?>">
                        </div>
                        <div class="form-group">
                            <label>Prénom</label>
                            <input type="text" name="prenom" class="form-control" value="<?php echo $prenom; ?>">
                        </div>
                          <div class="form-group">
                            <label>Genre</label>
                            <input type="text" name="sexe" class="form-control" value="<?php echo $sexe; ?>">
                        </div>
                        <div class="form-group">
                            <label>Date de naissance</label>
                            <input type="date" name="daten" class="form-control" value="<?php echo $daten; ?>">
                        </div>
                        <div class="form-group">
                            <label>Groupe sanguin</label>
                            <input type="text" name="gs" class="form-control" value="<?php echo $gs; ?>">
                        </div>
                        <div class="form-group">
                            <label>Numéro sécu</label>
                            <input type="int" name="numsecu" class="form-control" value="<?php echo $numsecu; ?>">
                        </div>
                        <div class="form-group">
                            <label>Numéro mutuelle</label>
                            <input type="int" name="nummut" class="form-control" value="<?php echo $nummut; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nom mutuelle</label>
                            <input type="text" name="nommut" class="form-control" value="<?php echo $nommut; ?>">
                        </div>
                        <div class="form-group">
                            <label>Valide</label>
                            <input type="bool" name="valide" class="form-control" value="<?php echo $valide; ?>">
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
<?php
require_once "../../php/bdd/config.php";

$nom = $prenom = $sexe = $daten = $email = $tel = $mobile = $pere = $mere = $numlicence = $licence = $certif = $valide= "";
$nom_err = $prenom_err = $sexe_err = $daten_err = $email_err = "";


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


    $email = trim($_POST['email']);
    $tel = trim($_POST['tel']);
    $mobile = trim($_POST['mobile']);
    $pere = trim($_POST['pere']);
    $mere = trim($_POST['mere']);
    $numlicence = trim($_POST['numlicence']);
    $licence = trim($_POST['licence']);
    $certif = trim($_POST['certif']);
    $valide = trim($_POST['valide']);
   

    if(empty($nom_err) && empty($prenom_err) && empty($sexe_err) && empty($daten_err) ){

        $sql = "UPDATE archers SET nom=?, prenom=?, sexe=?, date_n=?, email=?, tel=?, mobile=?, pere=? , mere=?, numlicence=?, licence=?, certif=? ,valide=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssssssssssiii", $param_nom, $param_prenom, $param_sexe, $param_daten, $param_email, $param_tel, $param_mobile, $param_pere, $param_mere,$param_numlicence, $param_licence, $param_certif, $param_valide, $param_id);
            
            $param_nom = $nom;
            $param_prenom = $prenom;
            $param_sexe = $sexe;
            $param_daten = $daten;
            $param_email = $email;
            $param_tel = $tel;
            $param_mobile = $mobile;
            $param_pere = $pere;
            $param_mere = $mere;
            $param_numlicence = $numlicence;
            $param_licence = $licence;
            $param_certif = $certif;
            $param_valide = $valide;
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
        
        $sql = "SELECT * FROM archers WHERE id = ?";
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
                    $email = $row['email'];
                    $tel = $row['tel'];
                    $mobile = $row['mobile'];
                    $pere = $row['pere'];
                    $mere = $row['mere'];
                    $numlicence = $row['numlicence'];
                    $licence = $row['licence'];
                    $certif = $row['certif'];
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
                    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="nom" class="form-control" value="<?php echo $nom; ?>">
                        </div>
                        <div class="form-group">
                            <label>Prénom</label>
                            <input type="text" name="prenom" class="form-control" value="<?php echo $prenom; ?>">
                        </div>
                          <div class="form-group">
                            <label>Genre (M / F / NSP)</label>
                            <input type="text" name="sexe" class="form-control" value="<?php echo $sexe; ?>">
                        </div>
                        <div class="form-group">
                            <label>Date de naissance</label>
                            <input type="date" name="daten" class="form-control" value="<?php echo $daten; ?>">
                        </div>
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group">
                            <label>Numéro téléphone</label>
                            <input type="text" name="tel" class="form-control" value="<?php echo $tel; ?>">
                        </div>
                        <div class="form-group">
                            <label>Numéro mobile</label>
                            <input type="text" name="mobile" class="form-control" value="<?php echo $mobile; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nom du père</label>
                            <input type="text" name="pere" class="form-control" value="<?php echo $pere; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nom de la mère</label>
                            <input type="text" name="mere" class="form-control" value="<?php echo $mere; ?>">
                        </div>
                        <div class="form-group">
                            <label>Numéro de licence</label>
                            <input type="text" name="numlicence" class="form-control" value="<?php echo $numlicence; ?>">
                        </div>
                        <div class="form-group">
                            <label>Type de licence</label>
                            <input type="text" name="licence" class="form-control" value="<?php echo $licence; ?>">
                        </div>
                        <div class="form-group">
                            <label>Certificat médical (valide=1 sinon 0)</label>
                            <input type="bool" name="certif" class="form-control" value="<?php echo $certif; ?>">
                        </div>
                        <div class="form-group">
                            <label>Compte Valide (valide=1 sinon 0)</label>
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
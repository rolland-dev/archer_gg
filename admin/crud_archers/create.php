<?php
require_once "../../php/bdd/config.php";

$nom = $prenom = $sexe = $daten = $email = $tel = $mobile = $pere = $mere = $numlicence = $license = $certif = "";
$nom_err = $prenom_err = $sexe_err = $daten_err = $email_err = $license = $certif = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

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

    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "entrer un email";     
    } else{
        $email = $input_email;
    }

    $tel = trim($_POST['tel']);
    $mobile = trim($_POST['mobile']);
    $pere = trim($_POST['pere']);
    $mere = trim($_POST['mere']);
    $numlicense = trim($_POST['numlicence']);
    $license = trim($_POST['licence']);
    $certif = trim($_POST['certif']);
    $valide = trim($_POST['valide']);

    if(empty($nom_err) && empty($prenom_err) && empty($sexe_err) && empty($daten_err) && empty($email_err) ){
       
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
            $param_licence = $license;
            $param_certif = $certif;
            $param_valide = $valide;
            
            $sql = "INSERT INTO archers (nom, prenom, sexe, date_n , email,tel,mobile,pere,mere,numlicence,licence,certif, valide) VALUES ( '$param_nom', '$param_prenom', '$param_sexe', '$param_daten', '$param_email', '$param_tel', '$param_mobile','$param_pere', '$param_mere', '$param_numlicence', '$param_licence', '$param_certif', '$param_valide')";
          
            $result = mysqli_query($link, $sql);
            if($result){
                mysqli_close($link);
                header("location: ../archers_admin.php");
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
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Création d'un archer</h2><br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="nom" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Prénom</label>
                            <input type="text" name="prenom" class="form-control">
                        </div>
                          <div class="form-group">
                            <label>Genre (M / F / NSP)</label>
                            <input type="text" name="sexe" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Date de naissance</label>
                            <input type="date" name="daten" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Téléphone</label>
                            <input type="text" name="tel" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" name="mobile" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nom et prénom père</label>
                            <input type="text" name="pere" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nom et prénom mère</label>
                            <input type="text" name="mere" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Numéro licence</label>
                            <input type="text" name="numlicence" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Type licence</label>
                            <input type="text" name="licence" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Certification médical (valide=1 sinon 0)</label>
                            <input type="number" name="certif" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Archer inscrit (valide=1 sinon 0)</label>
                            <input type="number" name="valide" class="form-control">
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="../archers_admin.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
<?php
require_once "../../php/bdd/config.php";

$categorie = $num = "";
$categorie_err = $num_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_categorie = trim($_POST["categorie"]);
    if(empty($input_categorie)){
        $categorie_err = "entrer une categorie";
    } else{
        $categorie = $input_categorie;
    }

    $input_num = trim($_POST["num"]);
    if(empty($input_num)){
        $num_err = "entrer un numéro";
    } else{
        $num = $input_num;
    }

    if(empty($categorie_err) && empty($num_err)){
       
            $param_categorie =strtolower($categorie);
            $param_num = $num;
            
            $sql = "INSERT INTO categories (categorie,num) VALUES ( '$param_categorie', '$param_num')";
    
            $result = mysqli_query($link, $sql);
            if($result){
                mysqli_close($link);
                header("location: ../categorie_admin.php");
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
                    <h2 class="mt-5">Création d'une categorie</h2><br>
                    <div class="text-center">
                        <h3>1 : Eq Arc - 2 : Eq Archers - 3 : Ciblerie</h3><br>
                        <h4>Les catégories sont a écrire en minuscule et au singulier</h4><br>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label>Catégorie</label>
                            <input type="text" name="categorie" class="form-control">
                            <label>Numéro</label>
                            <input type="number" name="num" class="form-control">
                        </div>
                       
                        <input type="submit" name="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="../categorie_admin.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
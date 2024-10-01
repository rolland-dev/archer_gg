<?php
require_once "../../php/bdd/config.php";

$categorie ="";
$categorie_err = "";

if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];
    
    $input_categorie = trim($_POST["categorie"]);
    if(empty($input_categorie)){
        $categorie_err = "entrer une catégorie";     
    } else{
        $categorie = $input_categorie;
    }
    $input_num = trim($_POST["num"]);
    if(empty($input_num)){
        $num_err = "entrer un numéro";
    } else{
        $num = $input_num;
    }

    if(empty($categorie_err)){
        $sql = "UPDATE categories SET categorie=?, num=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sii",$param_categorie,$param_num, $param_id);
            
            $param_categorie = strtolower($categorie);
            $param_num = $num;
            $param_id = $_GET['id'];

            if(mysqli_stmt_execute($stmt)){
                header("location: ../categorie_admin.php");
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
        
        $sql = "SELECT * FROM categories WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $categorie = $row['categorie'];
                    $num = $row['num'];
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
                    <h2 class="mt-5">Mise a jour d'une catégorie</h2>
                    <p>Changez les valeurs et validez !!!</p>
                    <div class="text-center">
                        <h3>1 : Eq Arc - 2 : Eq Archers - 3 : Ciblerie</h3><br>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Catégorie</label>
                            <input type="text" name="categorie" class="form-control " value="<?php echo $categorie; ?>">
                            <label>Numéro</label>
                            <input type="number" name="num" class="form-control " value="<?php echo $num; ?>">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="../categorie_admin.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
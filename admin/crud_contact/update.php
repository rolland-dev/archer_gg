<?php
require_once "../../php/bdd/config.php";

$lien = $valide ="";

if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];

    $lien = trim($_POST["lien"]);   
    $valide = trim($_POST["valide"]);
    
        $sql = "UPDATE contact SET lien=?, valide=? WHERE id=?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sii", $param_lien, $param_valide, $param_id);
            
            $param_lien = $lien;
            $param_valide = $valide;
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                header("location: ../secours_admin.php");
                exit();
            } else{
                echo "Oops! erreur inattendu, rééssayez ultérieusement";
            }
        }
    
    mysqli_close($link);
} else{
    
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id = mysqli_real_escape_string($link,$_GET["id"]) ;
     
        $sql = "SELECT * FROM contact WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $lien = $row["lien"];
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
                    <h2 class="mt-5">Mise a jour du contact de secours </h2> <br> 
                    
                    <p class="mt-5">Changez les valeurs et validez !!!</p>
                    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">
                        <div class="form-group">
                            <label>Lien</label>
                            <input type="text" name="lien" class="form-control" value="<?php echo $lien; ?>">
                        </div>
                        <div class="form-group">
                            <label>Valide</label>
                            <input type="number" name="valide" class="form-control" value="<?php echo $valide; ?>">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="../secours_admin.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
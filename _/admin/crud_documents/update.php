<?php
require_once "../../php/bdd/config.php";

$image = $date = $titre ="";
$image_err = $date_err = $titre_err = "";

if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];

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
        if($_FILES['img']['name']!=''){
            $tmpName = $_FILES['img']['tmp_name'];
            $name = $_FILES['img']['name'];
            $size = $_FILES['img']['size'];
            $error = $_FILES['img']['error'];
            move_uploaded_file($tmpName, '../../img/blog/'.$name);
            $img = 'img/blog/'.$name;
        }else{
            $img = $_POST['imgbase'];
        }
       
    }

    if(empty($date_err) && empty($lieu_err)){
        $sql = "UPDATE documents SET lien=?, date=?, titre=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssi",$param_img, $param_date, $param_titre, $param_id);
            
            $param_date = $date;
            $param_titre = $titre;
            $param_img = $img;
            $param_id = $_GET['id'];

            if(mysqli_stmt_execute($stmt)){
                header("location: ../documents_admin.php");
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
        
        $sql = "SELECT * FROM documents WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $img = $row['lien'];
                    $date = $row['date'];
                    $titre = $row['titre'];
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
                    <h2 class="mt-5">Mise a jour de document</h2>
                    <p>Changez les valeurs et validez !!!</p>
                    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <img src="../../<?php echo $img ?>" width="20%" />
                            <input type="file" name="img" class="form-control">
                            <input type="text" name="imgbase" class="form-control " value="<?php echo $img; ?>">
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control " value="<?php echo $date; ?>">
                        </div>
                        <div class="form-group">
                            <label>Titre</label>
                            <input type="text" name="titre" class="form-control " value="<?php echo $titre; ?>">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="../documents_admin.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
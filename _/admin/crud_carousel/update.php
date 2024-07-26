<?php
require_once "../../php/bdd/config.php";

$image ="";
$image_err = "";

if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];

    if(isset($_FILES['img'])){
        if($_FILES['img']['name']!=''){
            $tmpName = $_FILES['img']['tmp_name'];
            $name = $_FILES['img']['name'];
            $size = $_FILES['img']['size'];
            $error = $_FILES['img']['error'];
            move_uploaded_file($tmpName, '../../img/'.$name);
            $img = 'img/'.$name;
        }else{
            $img = $_POST['imgbase'];
        }
       
    }

    if(empty($date_err) && empty($lieu_err)){
        $sql = "UPDATE carousel SET lien=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "si",$param_img, $param_id);
            
            $param_img = $img;
            $param_id = $_GET['id'];

            if(mysqli_stmt_execute($stmt)){
                header("location: ../carousel_admin.php");
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
        
        $sql = "SELECT * FROM carousel WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $img = $row['lien'];
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
                    <h2 class="mt-5">Mise de l'image du carousel</h2>
                    <p>Changez les valeurs et validez !!!</p>
                    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <img src="../../<?php echo $img ?>" width="20%" />
                            <input type="file" name="img" class="form-control">
                            <input type="text" name="imgbase" class="form-control " value="<?php echo $img; ?>">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="../carousel_admin.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
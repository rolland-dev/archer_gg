<?php
require_once "../../php/bdd/config.php";

$image = $date = $lieu = "";
$image_err = $date_err = $lieu_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $input_date = trim($_POST["date"]);
    if(empty($input_date)){
        $date_err = "entrer une date";     
    } else{
        $date = $input_date;
    }

    $input_lieu = trim($_POST["lieu"]);
    if(empty($input_lieu)){
        $lieu_err = "entrer un lieu";
    } else{
        $lieu = $input_lieu;
    }

    if(isset($_FILES['img'])){
        

        $imagename = $_FILES['img']['name'];
        $source = $_FILES['img']['tmp_name'];
        $imagepath = $imagename;
        //Ceci est le nouveau fichier que vous enregistrez
        $save = "../../img/tmp/" . $imagepath; 
        //sauvegarde de l'image dans dossier temporaire
        move_uploaded_file($source, '../../img/tmp/'.$imagename);
        //chemin final de l'image redimensionnée
        $chemin = "../../img/blog/" . $imagepath; 
        
        $info = getimagesize($save);
        $mime = $info['mime'];
        
        switch ($mime) {
            case 'image/jpeg':
                $image_create_func = 'imagecreatefromjpeg';
                $image_save_func = 'imagejpeg';
                break;
            case 'image/png':
                $image_create_func = 'imagecreatefrompng';
                $image_save_func = 'imagepng';
                break;
            case 'image/gif':
                $image_create_func = 'imagecreatefromgif';
                $image_save_func = 'imagegif';
                break;
            default: 
                throw new Exception('Unknown image type.');
        }
          
        list($width, $height) = getimagesize($save);
        $modwidth = 500;  //target width
        $diff = $width / $modwidth;
        $modheight = $height / $diff;
        $tn = imagecreatetruecolor($modwidth, round($modheight,0)) ;
        $image = $image_create_func($save) ;
        imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, round($modheight,0), $width, $height) ;
        $image_save_func($tn, $chemin) ;

        $img = "./img/blog/".$imagename;
    }

    if(empty($date_err) && empty($lieu_err)){
       
            $param_img = $img;
            $param_date = $date;
            $param_lieu = $lieu;
            
            $sql = "INSERT INTO images (lien, date, commentaire) VALUES ( '$param_img', '$param_date', '$param_lieu')";
    
            $result = mysqli_query($link, $sql);
            if($result){
                mysqli_close($link);
                header("location: ../images_admin.php");
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
                    <h2 class="mt-5">Création d'une image</h2><br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control">
                        </div>
                          <div class="form-group">
                            <label>Lieu</label>
                            <input type="text" name="lieu" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="file">Fichier</label>
                            <input type="file" name="img">
                        </div>
                       
                        <input type="submit" name="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="../images_admin.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
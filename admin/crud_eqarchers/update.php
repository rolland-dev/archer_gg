<?php
session_start();
require_once "../../php/bdd/config.php";

$categorie ="";
$categorie_err = "";
// $_SESSION['categorie']="";

if(isset($_POST["id"]) && !empty($_POST["id"])){
    $json = file_get_contents("../tableaux/archers.json");
    $contenu = json_decode($json,true);
    $title=array();
    $content=array();
    $champs= $valeurs= $champ3 ="";
    
    $id = $_POST["id"];
    
    foreach($contenu as $k => $v){
        if($k == $_SESSION['categorie']){
            foreach($v as $titre => $champs){
                array_push($title, $champs);             
                array_push($content,trim($_POST[$champs]));
            } 
        }                                    
    }
    if(empty($categorie_err)){
        $champs= $valeurs="";
        $_SESSION['erreur']="";

        for($i=0; $i < count($title); $i++){
            if($i < (count($title)-1)){
                if($content[$i]!=""){
                    $champs .= $title[$i]."='" . $content[$i]."',";
                }
            }else{
                if($content[$i]!=""){
                    $champs .= $title[$i]."='" . $content[$i]."'";
                }
            } 
            $title[$i]=$content[$i];            
        }            

        (substr($champs, -1))==',' ? $champ3=rtrim($champs,',') : $champ3 = $champs;
        
        $param_id = $_GET['id'];
        $sql = "UPDATE eqarchers SET $champ3 WHERE id=$param_id";
        
        $result = mysqli_query($link, $sql);
            if($result){   
                header("location: ../eqarchers_admin.php");
                exit();
            } else{
                echo "Oops! erreur inattendu, rééssayez ultérieusement";
            }        
    }
    
    mysqli_close($link);
} else{
    
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id =  trim($_GET["id"]);

        $sql = "SELECT * FROM eqarchers WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $_SESSION['categorie'] = $row['categorie'];
                    
                    $json = file_get_contents("../tableaux/archers.json");
                    $contenu = json_decode($json,true);
                    $title=array();
                    $content=array();
                    $champs= $valeurs="";

                    foreach($contenu as $k => $v){
                        if($k == $_SESSION['categorie']){
                            foreach($v as $titre => $champ){
                                array_push($title, $titre);             
                                array_push($content,$champ);
                            } 
                        }                                    
                    }
                       
                    for($i=0; $i < count($title); $i++){
                        $title[$i]= $row[$content[$i]]; 
                    } 
                           
                    
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
                    <h2 class="mt-5">Mise a jour d'un équipement archer</h2>
                    <p>Changez les valeurs et validez !!!</p>
                    
                    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post"
                        enctype="multipart/form-data">
                    <div class="text-center">
                        <?php
                         $json = file_get_contents("../tableaux/archers.json");
                         $contenu = json_decode($json,true);    
                        ?>
                    </div>
                        <div class="form-group">
                            <?php
                                $json = file_get_contents("../tableaux/archers.json");
                                $contenu = json_decode($json,true);    
                                foreach($contenu as $k => $v){
                                    if($k == $_SESSION['categorie']){
                                        for($i=0; $i < count($title); $i++){         
                                            echo '<label>'.$content[$i].'</label>';
                                            echo '<input type="text" name="'.$content[$i].'" class="form-control" value="'.$title[$i].'">';
                                        }
                                    }                                    
                                }
                            ?>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="../eqarchers_admin.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
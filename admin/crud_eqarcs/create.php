<?php
session_start();
require_once "../../php/bdd/config.php";

$categorie =  "";
$categorie_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $type = $_SESSION['type'];
    $_SESSION['erreur']="";
    
    $input_categorie = trim($_POST["categories"]);
    if($input_categorie == "--- Choisir une catégorie ---"){
        $categorie_err = "entrer une categorie";
        $_SESSION['erreur']="Erreur dans le formulaire !!!";
        header("Location: ./create.php?type=$type");
    } else{
        $categorie = $input_categorie;
        $_SESSION['erreur']="";
    }
    
    $json = file_get_contents("../tableaux/arcs.json");
    $contenu = json_decode($json,true);
    $title=array();
    $content=array();

    foreach($contenu as $k => $v){
        if($k == $_POST['categories']){
            foreach($v as $titre => $champ){
                array_push($title, $champ);             
                array_push($content,trim($_POST[$champ]));
            } 
        }                                    
    }

    if(empty($categorie_err)){
        $champs= $valeurs="";
        $_SESSION['erreur']="";

        for($i=0; $i < count($title); $i++){
            if($i < (count($title)-1)){
                $champs .= $title[$i].",";
                $valeurs .= "'".$content[$i]."',";
            }else{
                $champs .= $title[$i];
                $valeurs .= "'".$content[$i]."'";
            } 
            $title[$i]=$content[$i];            
        }
       
            $param_categorie = $categorie;
            
            $sql = "INSERT INTO eqarcs
            (categorie,$champs)
            VALUES
            ( '$param_categorie', $valeurs )";

            $result = mysqli_query($link, $sql);
            if($result){
                mysqli_close($link);
                header("location: ../arcs_admin.php");
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
    <title>create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<?php $_SESSION['type']= $_GET['type'] ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Création <?php echo $_GET['type'] ?></h2><br>
                    <h3><?php echo $_SESSION['erreur'] ?></h3>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post" enctype="multipart/form-data">
                    <div class="text-center">
                        <?php
                         $json = file_get_contents("../tableaux/arcs.json");
                         $contenu = json_decode($json,true);    
                         echo '<select name="categories" id="categories">';
                         echo '<option>--- Choisir une catégorie ---</option>';
                         foreach($contenu as $k => $v){                            
                            echo '<option value="'. $k .'">'.$k .'</option>';
                         }
                         echo '</select> ';
                        ?>
                    </div>
                        <div class="form-group">
                            <?php
                                $json = file_get_contents("../tableaux/arcs.json");
                                $contenu = json_decode($json,true);    
                                foreach($contenu as $k => $v){
                                    if($k == $_GET['type']){
                                        foreach($v as $titre => $champ){                      
                                        echo '<label>'.$titre.'</label>';
                                        echo '<input type="text" name="'.$champ.'" class="form-control">';
                                    } 
                                    }                                    
                                }
                            ?>
                        </div>
                       
                        <input type="submit" name="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="../arcs_admin.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
<?php
session_start();

if(isset($_SESSION['role'])){
    $role = $_SESSION['role'];
}else{
    $role = '';
}
if(isset($_SESSION['archer_id'])){
    $archer_id = $_SESSION['archer_id'];
}else{
    $archer_id = '';
}
if(isset($_SESSION['nom'])){
    $nom = $_SESSION['nom'];
}else{
    $nom = '';
}

if($role == ''){
    header("Location: ./index.php");
}

session_abort();
require_once "./php/bdd/config.php";

if(isset($_POST["submit"])) {
    // Attempt select query execution
    $sql = "SELECT * FROM entrainements where archers_id='$archer_id'";
    $entrainement=array();
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                array_push($entrainement, $row['num_entrainement']);
            }
        }
    }
    if($entrainement != NULL){
        $nb = max($entrainement);
    }else{
        $nb =0;
    }

    $blason = trim($_POST["blason"]);
    $distance = trim($_POST["distance"]);
    $volee = trim($_POST["volee"]);
    $nb_fleche = trim($_POST["nb_fleche"]);
    $type = trim($_POST["type"]);

    $param_date = date("Y-m-d");
    $param_valide = true;
    $param_id = $archer_id;
    $param_blason=$blason;
    $param_distance=$distance;
    $param_volee=$volee;
    $param_nb_fleche=$nb_fleche;
    $param_type=$type;
    $param_point = 0;
    $param_entrainement = $nb+1;

    for ($i=0; $i < $volee ; $i++) { 
        $sql = "INSERT INTO entrainements (archers_id, date, volee, distance ,blason,nb_fleche,type,valide,fleche1,fleche2, fleche3,fleche4,fleche5, fleche6, num_entrainement)
        VALUES
        ( '$param_id', '$param_date', '$param_volee','$param_distance' ,'$param_blason','$param_nb_fleche','$param_type','$param_valide','$param_point','$param_point','$param_point', '$param_point','$param_point', '$param_point','$param_entrainement')";
            
        $result = mysqli_query($link, $sql);
        if($result){
            
            
        } else{
            echo "Oops! erreur inattendu, rééssayez ultérieusement";
        }
    }
   
    mysqli_close($link);
    header("location: ./entrainement.php");
    exit();
  
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
    <?php require_once './php/menu/head.php' ?>
    <title>entrainement</title>
     <style>
      .wrapper{
            width: 90%;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
        #submit{
            width: 20% !important;
        }
    </style>
</head>

<body>
<?php require_once './php/menu/menu.php'; ?>
    <h1 class="text-center"> Mes entrainements : <?php  echo $nom ?></h1>
    <br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h3>Création d'un entrainement</h3>    
    <div class="d-flex justify-content-around">
            <div class="form-group m-2">
            <select name="blason" id="blason">
                    <option value="default">--- Choisir un blason ---</option>
                    <option value="100">1 m</option>
                    <option value="80">80 cm</option> 
                    <option value="60">60 cm</option>                          
                    <option value="40">40 cm</option>
                    <option value="3">Trispot</option>  
                </select>
            </div>
            <div class="form-group m-2">
                <select name="distance" id="distance">
                    <option value="default">--- Choisir une distance ---</option>
                    <option value="10">10 m</option>
                    <option value="12">12 m</option>  
                    <option value="15">15 m</option>    
                    <option value="18">18 m</option>
                    <option value="20">20 m</option>
                    <option value="25">25 m</option>
                    <option value="30">30 m</option>                    
                </select>
            </div>
            <div class="form-group m-2">
            <select name="volee" id="volee">
                    <option value="default">--- Choisir nombre volées ---</option>
                    <option value="1">1 volée</option>
                    <option value="2">2 volées</option>
                    <option value="3">3 volées</option>
                    <option value="4">4 volées</option>
                    <option value="5">5 volées</option>
                    <option value="6">6 volées</option>
                    <option value="7">7 volées</option>
                    <option value="8">8 volées</option>
                    <option value="9">9 volées</option>
                    <option value="10">10 volées</option> 
                    <option value="11">11 volées</option>
                    <option value="12">12 volées</option>                       
                </select>
            </div>
            <div class="form-group m-2">
                <select name="nb_fleche" id="nb-fleche">
                    <option value="default">--- Choisir nombre flèches ---</option>
                    <option value="3">3 flèches</option>
                    <option value="6">6 flèches</option>                          
                </select>
            </div>
        </div>
        <input type="submit" name="submit" id="submit" class="btn btn-success w-4" value="Créer">
    </form>
    <br><br>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "./php/bdd//config.php";
                    $num_fait=1;
                    $num = 1;
                    $total=0;
                    $final=0;

                    // Attempt select query execution
                    $sql = "SELECT * FROM entrainements where archers_id='$archer_id' && valide=true ORDER BY num_entrainement ASC";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped text-center">';
                            if($num == $num_fait){
                                while($row = mysqli_fetch_array($result)){
                                    $num=(int)$row['num_entrainement'];
                                    if($num==$num_fait){
                                        echo "<tr>";
                                            echo "<th>" . date('d-m-Y', strtotime($row['date'])) . "</th>";
                                            echo "<th>entrainement : " . $row['num_entrainement'] . "</th>";
                                            echo "<th>" . $row['nb_fleche'] . " flèches</th>";
                                            echo "<th>" . $row['volee'] . " volées</th>";
                                            echo "<th>" . $row['distance'] . " m</th>";
                                            echo "<th>" . $row['blason'] . "</th>";
                                        echo "</tr>";
                                        echo '<tr>';
                                            echo "<th colspan='6'>Points par flèches</th>";
                                        echo "</tr>";
                                    }
                                    $final=0;
                                        if($num == $num_fait){
                                            $sql1 = "SELECT * FROM entrainements where num_entrainement='$num'";
                                            
                                            if($result1 = mysqli_query($link, $sql1)){
                                                if(mysqli_num_rows($result1) > 0){
                                                    while($row1 = mysqli_fetch_array($result1)){
                                                        $nb=$row1['nb_fleche'];
                                                        echo "<tr>";
                                                        for ($i=1; $i <= $nb; $i++) { 
                                                                $fleche = 'fleche'.$i;
                                                                echo "<td>" . $row1[$fleche] . "</td>";
                                                                // $total+=(int)$row1[$fleche];
                                                        }
                                                            echo "<th>= ". $row1['total'] . "</th>";
                                                            $final=$final+$row1['total'];
                                                            echo "<td class='d-flex justify-content-around w-100'>";
                                                            echo '<a href="./crud_entrainement/update.php?id='. $row1['id'] .'" class="mr-3" title="mise a jour archer" data-toggle="tooltip"><span class="fas fa-pencil-alt p-2"></span></a>';
                                                            echo "</td>";
                                                        echo "</tr>";
                                                    }$num_fait++;
                                                    echo "<td><th colspan='6'>entrainement : " . $row['num_entrainement'] . " avec un Total de : ". $final  . "</th></td>";
                                                }
                                            }
                                            }     
                                        }                          
                                }
                                // echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>Aucune informations trouvées ou compte invalide.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    ?>
                </div>
            </div>        
        </div>
    </div>
    <br>
    
</body>
</html>
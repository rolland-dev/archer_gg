<?php
session_start();
if(isset($_SESSION['login'])){
    $connect=$_SESSION['login'];
  }else{
    $connect='';
  }

  if(isset($_SESSION['role'])){
    $role=$_SESSION['role'];
    if(($role=="USER")) header("Location: ../index.php");
  }else{
    $role='';
    header("Location: ../index.php");
  }
  
  if(isset($_SESSION['erreur'])){
    $erreur=$_SESSION['erreur'];
  }else{
    $erreur='';
  }

  if(isset($_SESSION['total'])){
    $total=$_SESSION['total'];
  }else{
    $total='';
  }

  session_abort();

require_once "../php/bdd/config.php";

$id = $_GET['id'];

if(isset($_GET['nom']) && isset($_GET['prenom'])){
    $archer = strtoupper($_GET['nom']).' ' .ucwords($_GET['prenom']);
}
if(isset($_GET['archer'])){
    $archer = $_GET['archer'];
}

if(isset($_GET['choix'])){
    $choix = $_GET['choix'];
}else{
    $choix="";
}

$couleur = $point = $valide= $date= "";
$couleur_err = $point_err = $date_err ="";


if (isset($_POST['submit'])) {

    $id = $_GET["id"];

    $input_couleur = trim($_POST["couleur"]);
    if(empty($input_couleur)){
        $couleur_err = "entrer une couleur";
    } else{
        $couleur = $input_couleur;
    }
    
    $input_point = trim($_POST["point"]);
    if(empty($input_point)){
        $point_err = "entrer un score";     
    } else{
        $point = $input_point;
    }

    $input_date = trim($_POST["date"]);
    if(empty($input_date)){
        $date_err = "entrer une date";     
    } else{
        $date = $input_date;
    }
    $validateur = trim($_POST['validateur']);
    $archers_id = $id;

    if(empty($couleur_err) && empty($point_err) && empty($date_err) ){
       
      $param_couleur = $couleur;
      $param_point = $point;
      $param_date = $date;
      $param_archers_id = $archers_id;
      $param_validateur = $validateur;
      $param_valide = $valide;
      
      $sql = "INSERT INTO plumes (couleur, point, date, archers_id ,validateur, valide) VALUES ( '$param_couleur', '$param_point', '$param_date', '$param_archers_id','$param_validateur', '$param_valide')";
    
      $result = mysqli_query($link, $sql);
      if($result){
          mysqli_close($link);
          header("location: ./archers_admin.php");
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
    <?php require_once '../php/menu/head.php' ?>
    <title>Archers</title>

    <style>
        .wrapper {
            width: 90%;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 120px;
        }
    </style>
</head>

<body>
    <?php require_once './menu/menu_admin.php'; ?>

    <h1>Ajout Plumes Archers</h1>
    <h2><?php echo $archer  ?></h2>
    <br><br>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 ">
                    <h2 class="mt-5">Obtention d'une <?= $choix ?></h2><br>
                    <form method="post" enctype="multipart/form-data">
                        <div class="d-flex justify-content-center">
                            <div class="form-group ">
                                <label>Couleur plume</label><br>
                                <select name="couleur" id="couleur">
                                    <option value="blanche">Blanche</option>
                                    <option value="noire">Noire</option>
                                    <option value="bleue">Bleue</option>
                                    <option value="rouge">Rouge</option>
                                    <option value="jaune">Jaune</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nombre points</label>
                                <input type="number" name="point" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Date passage </label>
                                <input type="date" name="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Le validateur</label>
                                <input type="text" name="validateur" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Valide</label>
                                <input type="number" name="valide" class="form-control">
                            </div><br>
                        </div><br>
                        <input type="submit" name="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="./archers_admin.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
<br>
    <h2>Plumes archer</h2>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "../php/bdd//config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM plumes where archers_id='$id'";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr class='text-center'>";
                                        echo "<th>plumes</th>";
                                        echo "<th>Date obtention</th>";
                                        echo "<th>points</th>";
                                        echo "<th>Le validateur</th>";
                                        echo "<th>Actions</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr class='text-center'>";
                                        echo "<td>" . $row['couleur'] . "</td>";
                                        echo "<td>" . date('d-m-Y', strtotime($row['date'])) . "</td>";
                                        echo "<td>" . $row['point'] . "</td>";
                                        echo "<td>" . $row['validateur'] . "</td>";
                                        echo "<td class='class='d-flex justify-content-around w-100'>";
                                                echo '<a href="./crud_plumes/update.php?id='. $row['id'] .'" class="p-2" title="mise a jour plume" data-toggle="tooltip"><span class=" fas fa-pencil-alt"></span></a>';
                                                echo '<a href="./crud_plumes/delete.php?id='. $row['id'] .'" class="p-2" title="supprimer plume" data-toggle="tooltip"><span class=" fa fa-trash"></span></a>';
                                            echo "</td>";
                                    echo "</tr>";
                                    
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>

    <footer>
        <?php require_once './menu/footer_admin.php' ?>
    </footer>
    
    </body>

</html>
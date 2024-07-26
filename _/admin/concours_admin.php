<?php
session_start();
if(isset($_SESSION['login'])){
    $connect=$_SESSION['login'];
  }else{
    $connect='';
  }

  if(isset($_SESSION['role'])){
    $role=$_SESSION['role'];
    if($role!="ADMIN") header("Location: ../index.php");
  }else{
    $role='';
    if($role!="ADMIN") header("Location: ../index.php");
  }
  
  if(isset($_SESSION['erreur'])){
    $erreur=$_SESSION['erreur'];
  }else{
    $erreur='';
  }

  session_abort();

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once "../php/bdd/config.php";
   
    $tableau=array();
    $sql2 = "SELECT DENSE_RANK() OVER(PARTITION BY groupe,date ORDER BY points DESC) as classement , points,date, id, groupe FROM `inscriptions`";
    if($result2=mysqli_query($link, $sql2)){
        if(mysqli_num_rows($result2) > 0){
            while($row2 = mysqli_fetch_array($result2)){

                $sql = "UPDATE inscriptions SET classement=? WHERE id=?";

                if($stmt = mysqli_prepare($link, $sql)){
                    mysqli_stmt_bind_param($stmt, "ii", $param_classement, $param_id);
                    
                    $param_classement = $row2['classement'];
                    $param_id = $row2['id'];
                    mysqli_stmt_execute($stmt);
                    
                }
            }
        }
    }
    
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../php/menu/head.php' ?>
    <title>Résultats concours</title>
</head>
<style>
        .wrapper{
            width: 90%;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
<body>

    <?php require_once './menu/menu_admin.php'; ?>
    <h1 class="text-center">Résultats concours interne</h1>
    <div class="text-center">
        <?php
        echo '<a href="./crud_concours/create.php" class="mr-3 " title="create archer" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Creation archer pour concours</button></a>';
        ?>
    </div><br>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php
                // Include config file
                require_once "../php/bdd/config.php";
                $sql1 = "SELECT DISTINCT date FROM inscriptions";
                $date=array();
                if($result1 = mysqli_query($link, $sql1)){
                    if(mysqli_num_rows($result1) > 0){
                        while($row1 = mysqli_fetch_array($result1)){
                            array_push($date, $row1['date']);
                        }
                    }
                }
                foreach($date as $dateunique){
                // Attempt select query execution
                $sql = "SELECT * FROM inscriptions where date='$dateunique' ORDER BY date DESC, groupe ASC,points DESC";
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo date('d-m-Y', strtotime($dateunique));
                        echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Nom</th>";
                                    echo "<th>Prénom</th>";
                                    echo "<th>Catégorie</th>";
                                    echo "<th>Date</th>";
                                    echo "<th>Groupe</th>";
                                    echo "<th>Points</th>";
                                    echo "<th>Classement</th>";
                                    echo "<th>Outils</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            $compteur=0;
                            $groupe=1;

                            while($row = mysqli_fetch_array($result)){
                                $groupe1=$row['groupe'];
                                if($groupe!=$groupe1){
                                    echo "<tr>";
                                    echo "<td colspan='8' class='text-center'>Groupe ". $row['groupe'] ."</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                        echo "<td>" . strtoupper($row['nom']) . "</td>";
                                        echo "<td>" . ucfirst($row['prenom']) . "</td>";
                                        echo "<td>" . $row['categorie'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>" . $row['groupe'] . "</td>";
                                        echo "<td>" . $row['points'] . " points</td>";
                                        echo "<td>" . $row['classement'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="./crud_concours/update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fas fa-pencil-alt p-2"></span></a>';
                                            echo '<a href="./crud_concours/delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash p-2"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                    $groupe+=1;
                                }else{
                                    echo "<tr>";
                                        echo "<td>" . strtoupper($row['nom']) . "</td>";
                                        echo "<td>" . ucfirst($row['prenom']) . "</td>";
                                        echo "<td>" . $row['categorie'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>" . $row['groupe'] . "</td>";
                                        echo "<td>" . $row['points'] . " points</td>";
                                        echo "<td>" . $row['classement'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="./crud_concours/update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fas fa-pencil-alt p-2"></span></a>';
                                            echo '<a href="./crud_concours/delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash p-2"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                   
                                }
                                
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
            }
                // Close connection
                mysqli_close($link);
                ?>
            </div>
        </div>        
    </div>
</div>

<form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">
    <input type="submit" class="btn btn-primary" value="Classement AUTO">
</form>
    <footer>
        <?php require_once '../php/menu/footer.php' ?>
    </footer>

</head>
</body>

</html>
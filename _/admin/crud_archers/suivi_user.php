<?php

$id = $_GET['id'];
$archer = strtoupper($_GET['nom']).' ' .ucwords($_GET['prenom']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <title>Suivi archer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      .wrapper{
            width: 90%;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
</head>

<body>

    <h1 class="text-center"> Suivi archer : <?php  echo $archer ?></h1>
    <div class="text-center">
        <a href="../archers_admin.php" class="btn btn-primary">Retour</a>
    </div>
    <br>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "../../php/bdd//config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM archers where id='$id'";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr class=''>";
                                        echo "<th>id</th>";
                                        echo "<th>Nom</th>";
                                        echo "<th>Prenom</th>";
                                        echo "<th>Genre (M / F / NSP)</th>";
                                        echo "<th>Date naissance</th>";
                                        echo "<th>E-mail</th>";
                                        echo "<th>Téléphone</th>";
                                        echo "<th>Mobile</th>";
                                        echo "<th>Père</th>";
                                        echo "<th>Mère</th>";
                                        echo "<th>Licence</th>";
                                        echo "<th>Droit Image</th>";
                                        echo "<th>Certificat médical (valide=1 sinon 0)</th>";
                                        echo "<th>Compte Valide (valide=1 sinon 0)</th>";
                                        echo "<th>Création user</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr class='text-center'>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['nom'] . "</td>";
                                        echo "<td>" . $row['prenom'] . "</td>";
                                        echo "<td>" . $row['sexe'] . "</td>";
                                        echo "<td>" . date('d-m-Y', strtotime($row['date_n'])) . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['tel'] . "</td>";
                                        echo "<td>" . $row['mobile'] . "</td>";
                                        echo "<td>" . $row['pere'] . "</td>";
                                        echo "<td>" . $row['mere'] . "</td>";
                                        echo "<td>" . $row['licence'] . "</td>";
                                        echo "<td>" . $row['certif'] . "</td>";
                                        echo "<td>" . $row['droitimg'] . "</td>";
                                        echo "<td>" . $row['valide'] . "</td>";
                                        echo "<td>" . $row['create_user'] . "</td>";
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
 
                    ?>
                </div>
            </div>        
        </div>
    </div>
    <br>

    <h2 class="text-center">Plumes archer</h2>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "../../php/bdd//config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM plumes where archers_id='$id'";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr class='text-center'>";
                                        echo "<th>plumes</th>";
                                        echo "<th>Date obtention</th>";
                                        echo "<th>N° tir</th>";
                                        echo "<th>points</th>";
                                        echo "<th>Le validateur</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr class='text-center'>";
                                        echo "<td>" . $row['couleur'] . "</td>";
                                        echo "<td>" . date('d-m-Y', strtotime($row['date'])) . "</td>";
                                        echo "<td>" . $row['valide'] . "</td>";
                                        echo "<td>" . $row['point'] . "</td>";
                                        echo "<td>" . $row['validateur'] . "</td>";
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
 
                    ?>
                </div>
            </div>        
        </div>
    </div>

    <h2 class="text-center">Flèches archer</h2>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "../../php/bdd//config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM fleches where archers_id='$id'";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr class='text-center'>";
                                        echo "<th>Flèches</th>";
                                        echo "<th>Date obtention</th>";
                                        echo "<th>points</th>";
                                        echo "<th>Le validateur</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr class='text-center'>";
                                        echo "<td>" . $row['couleur'] . "</td>";
                                        echo "<td>" . date('d-m-Y', strtotime($row['date'])). "</td>";
                                        echo "<td>" . $row['point'] . "</td>";
                                        echo "<td>" . $row['validateur'] . "</td>";
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
    
</body>

</html>
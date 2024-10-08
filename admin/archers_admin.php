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

  session_abort();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../php/menu/head.php' ?>
    <title>archers</title>
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
    <h1 class="text-center">Listes des Archers</h1>
    <div class="text-center">
        <?php
        echo '<a href="./crud_archers/create.php" class="mr-3 " title="create patient" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter un archer</button></a>';
        ?>
    </div><br>
    <div class="text-center">
        <?php
        echo '<a href="./crud_archers/active.php" class="mr-3 " title="desactiver archers" data-toggle="tooltip"><button class="" style="text-aligne: center;background-color:red; padding:5px; border: none; border-radius:5px;"> Desactiver les archers</button></a>';
        ?>
    </div><br>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "../php/bdd//config.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM archers ORDER BY nom,prenom DESC";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr class='text-center'>";
                                        echo "<th>Id</th>";
                                        echo "<th>Nom</th>";
                                        echo "<th>Prénom</th>";
                                        echo "<th>Genre</th>";
                                        echo "<th>Date naissance</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Numéro tél</th>";
                                        echo "<th>Numéro mobile</th>";
                                        echo "<th>Le père</th>";
                                        echo "<th>La mère</th>";
                                        echo "<th>Numéro licence</th>";
                                        echo "<th>Type licence</th>";
                                        echo "<th>Certificat</th>";
                                        echo "<th>Droit image</th>";
                                        echo "<th>Valide</th>";
                                        echo "<th>user créé</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr class='text-center'>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . strtoupper($row['nom']) . "</td>";
                                        echo "<td>" . ucfirst($row['prenom']) . "</td>";
                                        echo "<td>" . $row['sexe'] . "</td>";
                                        echo "<td>" . date('d-m-Y', strtotime($row['date_n'])) . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['tel'] . "</td>";
                                        echo "<td>" . $row['mobile'] . "</td>";
                                        echo "<td>" . $row['pere'] . "</td>";
                                        echo "<td>" . $row['mere'] . "</td>";
                                        echo "<td>" . $row['numlicence'] . "</td>";
                                        echo "<td>" . $row['licence'] . "</td>";
                                        echo "<td>" . $row['certif'] . "</td>";
                                        echo "<td>" . $row['droitimg'] . "</td>";
                                        echo "<td>" . $row['valide'] . "</td>";
                                        echo "<td>" . $row['create_user'] . "</td>";
                                        echo "<td class='d-flex justify-content-around w-100'>";
                                                echo '<a href="./crud_archers/update.php?id='. $row['id'] .'" class="mr-3" title="mise a jour archer" data-toggle="tooltip"><span style="color:green" class="fas fa-pencil-alt p-2"></span></a>';
                                                echo '<a href="./crud_archers/delete.php?id='. $row['id'] .'" title="supprimer archer" data-toggle="tooltip"><span style="color:red" class="fa fa-trash p-2"></span></a>';
                                                if($row['create_user']==0):
                                                    echo '<a href="./crud_archers/create_user.php?nom='. $row['nom']  . '&prenom=' . $row['prenom'] .'&email=' . $row['email'].'&id=' . $row['id']. '" title="creer utilisateur" data-toggle="tooltip"><span class="fa fa-user p-2"></span></a>';
                                                endif;
                                                echo '<a href="./crud_archers/suivi_user.php?id='. $row['id'] .'&nom='. $row['nom']  . '&prenom=' . $row['prenom'] .'" title="suivi archer" data-toggle="tooltip"><span class="fa fa-sheet-plastic p-2"></span></a>';
                                                echo '<a href="./plumes_admin.php?id='. $row['id'] . '&nom='. $row['nom']  . '&prenom=' . $row['prenom'] .'" title="validation plumes" data-toggle="tooltip"><span class="fa-solid fa-feather p-2"></span></a>';
                                                echo '<a href="./fleches_admin.php?id='. $row['id'] . '&nom='. $row['nom']  . '&prenom=' . $row['prenom'] .'" title="validation fleches" data-toggle="tooltip"><span class="fa fa-location-arrow p-2"></span></a>';
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

</head>
</body>

</html>
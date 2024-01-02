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
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <title>Suivi archer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
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

    <h1 class="text-center"> Mon compte Archer : <?php  echo $nom ?></h1>

    <br>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "./php/bdd//config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM archers where id='$archer_id'";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr class=''>";
                                        
                                        echo "<th>Nom</th>";
                                        echo "<th>Prenom</th>";
                                        echo "<th>Genre</th>";
                                        echo "<th>Date naissance</th>";
                                        echo "<th>E-mail</th>";
                                        echo "<th>Téléphone</th>";
                                        echo "<th>Mobile</th>";
                                        echo "<th>Père</th>";
                                        echo "<th>Mère</th>";
                                        echo "<th>Licence</th>";
                                        echo "<th>Certificat</th>";
                                        echo "<th>Action</th>";
                                        
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr class='text-center'>";
                                        
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
                                        echo "<td class='d-flex justify-content-around w-100'>";
                                        echo '<a href="./php/archers/update.php?id='. $row['id'] .'" class="mr-3" title="mise a jour archer" data-toggle="tooltip"><span class="fas fa-pencil-alt p-2"></span></a>';
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
                    require_once "./php/bdd//config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM plumes where archers_id='$archer_id'";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr class='text-center'>";
                                        echo "<th>plumes</th>";
                                        echo "<th>Date obtention</th>";
                                        echo "<th>points</th>";
                                        echo "<th>Le validateur</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr class='text-center'>";
                                        echo "<td>" . $row['couleur'] . "</td>";
                                        echo "<td>" . date('d-m-Y', strtotime($row['date'])) . "</td>";
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
                    require_once "./php/bdd//config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM fleches where archers_id='$archer_id'";
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

    <div class="text-center">
        <a href="./index.php" class="btn btn-secondary">Retour</a>
    </div>
    
</body>
</html>
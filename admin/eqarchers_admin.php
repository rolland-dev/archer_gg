<?php
session_start();

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    $role = '';
}
if (isset($_SESSION['nom'])) {
    $nom = $_SESSION['nom'];
} else {
    $nom = '';
}

if ($role == '') {
    header("Location: ../index.php");
}

session_abort();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../php/menu/head.php' ?>
    <title>equipements archers</title>

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
    <?php require_once './menu/menu_admin.php';

    $json = file_get_contents("./tableaux/archers.json");
    $contenu = json_decode($json,true);    
    
    ?>
    <h1 class="text-center">Administrateur : <?= $nom ?></h1>
    <div class="text-center">
        <?php
        echo '<div class="p-3"><a href="./crud_eqarchers/create.php?type=palette" class="m-3 " title="create palette" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter palette</button></a>';
        echo '<a href="./crud_eqarchers/create.php?type=gant" class="m-3 " title="create gant" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter gant</button></a>';
        echo '<a href="./crud_eqarchers/create.php?type=protection" class="m-3 " title="create protection" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter protection</button></a></div>';
        echo '<div class="p-3"><a href="./crud_eqarchers/create.php?type=carquoi" class="m-3 " title="create carquoi" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter carquoi</button></a>';
        echo '<a href="./crud_eqarchers/create.php?type=reposearc" class="m-3 " title="create reposearc" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter repose arc</button></a></div>';

        
        ?>
    </div><br>
    
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "../php/bdd/config.php";
                    
                    foreach($contenu as $k => $v){
                        
                        // Attempt select query execution
                        $sql = "SELECT * FROM eqarchers where categorie='$k'";
                        ?>
                        <div class="text-center">
                            <h3><?= $k."s" ?></h3>
                        </div>
                        <?php
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                        if ($k=='palette'){
                                            foreach($v as $t => $w){
                                                echo "<th>". ucfirst($t) ."</th>";
                                            }
                                        }
                                        if ($k=='gant'){
                                            foreach($v as $t => $w){
                                                echo "<th>". ucfirst($t) ."</th>";
                                            }
                                        }
                                        if ($k=='protection'){
                                            foreach($v as $t => $w){
                                                echo "<th>". ucfirst($t) ."</th>";
                                            }
                                        }
                                        if ($k=='carquoi'){
                                            foreach($v as $t => $w){
                                                echo "<th>". ucfirst($t) ."</th>";
                                            }
                                        }
                                        if ($k=='reposearc'){
                                            foreach($v as $t => $w){
                                                echo "<th>". ucfirst($t) ."</th>";
                                            }
                                        }
                                        echo "<th>Action</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";

                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                            if ($k=='palette'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            if ($k=='gant'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            if ($k=='protection'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            if ($k=='carquoi'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            if ($k=='reposearc'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            echo "<td>";
                                                    echo '<a href="./crud_eqarchers/update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fas fa-pencil-alt p-2"></span></a>';
                                                    echo '<a href="./crud_eqarchers/delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span style="color:red" class="fa fa-trash p-2"></span></a>';
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
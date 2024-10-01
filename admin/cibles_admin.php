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
    <title>ciblerie</title>

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

    $json = file_get_contents("./tableaux/cibles.json");
    $contenu = json_decode($json,true);    
    
    ?>
    <h1 class="text-center">Administrateur : <?= $nom ?></h1>
    <div class="text-center">
        <?php
        echo '<div class="p-3"><a href="./crud_cibles/create.php?type=blason" class="m-3 " title="create blason" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter blason</button></a>';
        echo '<a href="./crud_cibles/create.php?type=2d" class="m-3 " title="create 2D" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter 2D</button></a>';
        echo '<a href="./crud_cibles/create.php?type=cible" class="m-3 " title="create cible" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter cible</button></a></div>';
        echo '<div class="p-3"><a href="./crud_cibles/create.php?type=chevalet" class="m-3 " title="create chevalet" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter chevalet</button></a>';
        echo '<a href="./crud_cibles/create.php?type=bete" class="m-3 " title="create bete" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter bête</button></a>';
        echo '<a href="./crud_cibles/create.php?type=filet" class="m-3 " title="create filet" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter filet</button></a></div>';
        echo '<div class="p-3"><a href="./crud_cibles/create.php?type=accessoire" class="m-3 " title="create accessoire" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter accessoire</button></a></div>';
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
                        $sql = "SELECT * FROM cibles where categorie='$k'";
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
                                        if ($k=='blason'){
                                            foreach($v as $t => $w){
                                                echo "<th>". ucfirst($t) ."</th>";
                                            }
                                        }
                                        if ($k=='2d'){
                                            foreach($v as $t => $w){
                                                echo "<th>". ucfirst($t) ."</th>";
                                            }
                                        }
                                        if ($k=='cible'){
                                            foreach($v as $t => $w){
                                                echo "<th>". ucfirst($t) ."</th>";
                                            }
                                        }
                                        if ($k=='chevalet'){
                                            foreach($v as $t => $w){
                                                echo "<th>". ucfirst($t) ."</th>";
                                            }
                                        }
                                        if ($k=='bete'){
                                            foreach($v as $t => $w){
                                                echo "<th>". ucfirst($t) ."</th>";
                                            }
                                        }
                                        if ($k=='filet'){
                                            foreach($v as $t => $w){
                                                echo "<th>". ucfirst($t) ."</th>";
                                            }
                                        }
                                        if ($k=='accessoire'){
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
                                            if ($k=='blason'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            if ($k=='2d'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            if ($k=='cible'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            if ($k=='chevalet'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            if ($k=='bete'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            if ($k=='filet'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            if ($k=='accessoire'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            echo "<td>";
                                                    echo '<a href="./crud_cibles/update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fas fa-pencil-alt p-2"></span></a>';
                                                    echo '<a href="./crud_cibles/delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span style="color:red" class="fa fa-trash p-2"></span></a>';
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
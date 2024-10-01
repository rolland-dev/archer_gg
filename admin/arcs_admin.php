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
    <title>categories</title>

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

    $json = file_get_contents("./tableaux/arcs.json");
    $contenu = json_decode($json,true);    
    
    ?>
    <h1 class="text-center">Administrateur : <?= $nom ?></h1>
    <div class="text-center">
        <?php
        echo '<div class="p-3"><a href="./crud_eqarcs/create.php?type=arc" class="m-3 " title="create arc" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter arc</button></a>';
        echo '<a href="./crud_eqarcs/create.php?type=poignee" class="m-3 " title="create poignee" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter poignée</button></a>';
        echo '<a href="./crud_eqarcs/create.php?type=branche" class="m-3 " title="create branche" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter branche</button></a></div>';
        echo '<div class="p-3"><a href="./crud_eqarcs/create.php?type=fleche" class="m-3 " title="create arc" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter flèche</button></a>';
        echo '<a href="./crud_eqarcs/create.php?type=corde" class="m-3 " title="create poignee" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter corde</button></a>';
        echo '<a href="./crud_eqarcs/create.php?type=plume" class="m-3 " title="create branche" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter plume</button></a></div>';
        echo '<div class="p-3"><a href="./crud_eqarcs/create.php?type=pointe" class="m-3 " title="create branche" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;"> Ajouter pointe</button></a></div>';

        
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
                        $sql = "SELECT * FROM eqarcs where categorie='$k'";
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
                                        if ($k=='arc'){
                                            foreach($v as $t => $w){
                                                echo "<th>". ucfirst($t) ."</th>";
                                            }
                                        }
                                        if ($k=='poignee'){
                                            foreach($v as $t => $w){
                                                echo "<th>". ucfirst($t) ."</th>";
                                            }
                                        }
                                        if ($k=='branche'){
                                            foreach($v as $t => $w){
                                                echo "<th>". ucfirst($t) ."</th>";
                                            }
                                        }
                                        if ($k=='fleche'){
                                            foreach($v as $t => $w){
                                                echo "<th>". ucfirst($t) ."</th>";
                                            }
                                        }
                                        if ($k=='corde'){
                                            foreach($v as $t => $w){
                                                echo "<th>". ucfirst($t) ."</th>";
                                            }
                                        }
                                        if ($k=='plume'){
                                            foreach($v as $t => $w){
                                                echo "<th>". ucfirst($t) ."</th>";
                                            }
                                        }
                                        if ($k=='pointe'){
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
                                            if ($k=='arc'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            if ($k=='poignee'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            if ($k=='branche'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            if ($k=='fleche'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            if ($k=='corde'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            if ($k=='plume'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            if ($k=='pointe'){
                                                foreach($v as $t => $w){
                                                    echo "<td>" . $row[$w] . "</td>";
                                                }
                                            }
                                            echo "<td>";
                                                    echo '<a href="./crud_eqarcs/update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fas fa-pencil-alt p-2"></span></a>';
                                                    echo '<a href="./crud_eqarcs/delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span style="color:red" class="fa fa-trash p-2"></span></a>';
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
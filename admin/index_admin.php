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

    <h1 class="text-center">Administrateur : <?= $nom ?></h1>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "../php/bdd/config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM users";
                    if($result = mysqli_query($link, $sql)){
                        $nb_user = mysqli_num_rows($result);
                        echo '<div class="text-center">Nombres d\'archers inscrits : '.$nb_user.' </div>';
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Id</th>";
                                        echo "<th>Login</th>";
                                        echo "<th>E-mail</th>";
                                        echo "<th>Archer</th>";
                                        echo "<th>Rôles</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['login'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['archer_id'] . "</td>";
                                        if($row['role']=="ARCHER")
                                            echo "<td>" . $row['role'] . "</td>";
                                        if($row['role']=="ADMIN")
                                            echo "<td style='color:red'>" . $row['role'] . "</td>";
                                        if($row['role']=='SUPERADMIN')
                                             echo "<td style='color:red;background-color:yellow'>" . $row['role'] . "</td>";
                                        if($row['role']!='SUPERADMIN'){
                                            echo "<td>";
                                                echo '<a href="./crud_users/update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fas fa-pencil-alt p-2"></span></a>';
                                                echo '<a href="./crud_users/delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span style="color:red" class="fa fa-trash p-2"></span></a>';
                                            echo "</td>";
                                        }else{
                                            echo "<td>";
                                                echo 'Accés Interdit';
                                            echo "</td>";
                                        }
                                       
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
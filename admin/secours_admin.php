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
    <title>contact secours</title>

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
                    $sql = "SELECT * FROM contact";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Id</th>";
                                        echo "<th>Lien</th>";
                                        echo "<th>Valide</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['lien'] . "</td>";
                                        echo "<td>" . $row['valide'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="./crud_contact/update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fas fa-pencil-alt p-2"></span></a>';
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
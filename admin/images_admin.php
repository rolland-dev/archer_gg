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

require_once "../php/bdd/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!--<link rel="stylesheet" href="../css/menu.css">-->
    <link rel="stylesheet" href="../css/style.css">
</head>
<style>
    .wrapper {
        width: 90%;
        margin: 0 auto;
    }

    table tr td:last-child {
        width: 120px;
    }
</style>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<body>

    <?php include './menu/menu_admin.php' ?>
    <h1 class="text-center">Images formations</h1><br><br>
    <div class="text-center">
        <?php
        echo '<a href="./crud_images/create.php" class="mr-3 " title="create images" data-toggle="tooltip"><button class="fas fa-plus" style="text-aligne: center; padding:5px; border: none; border-radius:5px;">Ajout Images</button></a>';
        ?>
    </div><br>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    // require_once "../php/config.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM images";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Id</th>";
                            echo "<th>image</th>";
                            echo "<th>Date</th>";
                            echo "<th>lieu</th>";
                            echo "<th>Action</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo '<td><img src="../' . $row['lien'] . '" width="20%"/></td>';
                                echo "<td>" . $row['date'] . "</td>";
                                echo "<td>" . $row['commentaire'] . "</td>";
                                echo "<td>";
                                echo '<a href="./crud_images/update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fas fa-pencil-alt"></span></a>';
                                echo '<a href="./crud_images/delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else {
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
        <?php require_once '../php/menu/footer.php' ?>
    </footer>
</body>

</html>
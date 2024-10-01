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

require_once "../php/bdd/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../php/menu/head.php' ?>
    <title>Document</title>
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
                    $sql1 = "SELECT DISTINCT date FROM images ORDER BY date DESC";
                    $date=array();
                    if($result1 = mysqli_query($link, $sql1)){
                        if(mysqli_num_rows($result1) > 0){
                            while($row1 = mysqli_fetch_array($result1)){
                                array_push($date, $row1['date']);
                            }
                        }
                    }
                    // Include config file
                    // require_once "../php/config.php";
                    foreach($date as $dateunique){
                    // Attempt select query execution
                    $sql = "SELECT * FROM images where date='$dateunique'";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo date('d-m-Y', strtotime($dateunique));
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
                                echo "<td>" . date('d-m-Y', strtotime($row['date'])) . "</td>";
                                echo "<td>" . $row['commentaire'] . "</td>";
                                echo "<td>";
                                echo '<a href="./crud_images/update.php?id=' . $row['id'] . '" class="mr-3 p-3" title="Update Record" data-toggle="tooltip"><span class="fas fa-pencil-alt"></span></a>';
                                echo '<a href="./crud_images/delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span style="color:red" class="fa fa-trash"></span></a>';
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
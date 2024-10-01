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
    <title>Carousel</title>
</head>
<style>
    .wrapper {
        width: 90%;
        margin: 0 auto;
    }

    table tr td:last-child {
        width: 80px;
    }
    th{
        width: 10%;
    }
    .dim{
        width: 50%;
        text-align: center;
    }
</style>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<body>

    <?php include './menu/menu_admin.php' ?>
    <h1 class="text-center">Images carousel</h1><br><br>
   
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php                    
                    $sql = "SELECT * FROM carousel ";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Id</th>";
                            echo "<th class='dim'>Images</th>";
                            echo "<th>Outils</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo '<td class="text-center"><img src="../' . $row['lien'] . '" width="30%"/></td>';
                                echo "<td>";
                                echo '<a href="./crud_carousel/update.php?id=' . $row['id'] . '" class="mr-3 p-3" title="Update Record" data-toggle="tooltip"><span class="fas fa-pencil-alt"></span></a>';
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
        <?php require_once './menu/footer_admin.php' ?>
    </footer>
</body>

</html>
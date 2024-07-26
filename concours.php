<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './php/menu/head.php' ?>
    <title>concours</title>

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
    <?php require_once './php/menu/menu.php'; ?>

    <h1>Concours interne</h1>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "./php/bdd/config.php";
                    
                    $sql1 = "SELECT DISTINCT date FROM inscriptions";
                    $date=array();
                    if($result1 = mysqli_query($link, $sql1)){
                        if(mysqli_num_rows($result1) > 0){
                            while($row1 = mysqli_fetch_array($result1)){
                                array_push($date, $row1['date']);
                            }
                        }
                    }
            
                    // Attempt select query execution
                    foreach($date as $dateunique){
                    $sql = "SELECT * FROM inscriptions where date='$dateunique' ORDER BY  groupe ASC, points DESC ";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            
                                echo "<h2 class='text-center'>". date('d-m-Y', strtotime($dateunique)) ."</h2>";
                                echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>Nom</th>";
                                            echo "<th>Prénom</th>";
                                            echo "<th class='mobile1'>Catégorie</th>";
                                            echo "<th class='mobile1'>Date</th>";
                                            echo "<th class='mobile1'>Groupe</th>";
                                            echo "<th>Points</th>";
                                            echo "<th>Place</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";

                                    $compteur=0;
                                    $groupe=1;

                                    while($row = mysqli_fetch_array($result)){
                                        $groupe1=$row['groupe'];
                                        if($groupe!=$groupe1){
                                            echo "<tr>";
                                            echo "<td colspan='8' class='text-center'>Groupe ". $row['groupe'] ."</td>";
                                            echo "</tr>";
                                            echo "<tr>";
                                            echo "<tr>";
                                                echo "<td>" . strtoupper($row['nom']) . "</td>";
                                                echo "<td>" . ucfirst($row['prenom']) . "</td>";
                                                echo "<td class='mobile1'>" . $row['categorie'] . "</td>";
                                                echo "<td class='mobile1'>" . date('d-m-Y', strtotime($row['date'])) . "</td>";
                                                echo "<td class='mobile1'>" . $row['groupe'] . "</td>";
                                                echo "<td>" . $row['points'] . "<span class='mobile'> points </span></td>";
                                                echo "<td>" . $row['classement'] . "</td>";
                                            echo "</tr>";
                                            $groupe+=1;
                                        }else{
                                            echo "<tr>";
                                                echo "<td>" . strtoupper($row['nom']) . "</td>";
                                                echo "<td>" . ucfirst($row['prenom']) . "</td>";
                                                echo "<td class='mobile1'>" . $row['categorie'] . "</td>";
                                                echo "<td class='mobile1'>" . $row['date'] . "</td>";
                                                echo "<td class='mobile1'>" . $row['groupe'] . "</td>";
                                                echo "<td>" . $row['points'] . " points</td>";
                                                echo "<td>" . $row['classement'] . "</td>";
                                            echo "</tr>";
                                        }
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
        <?php require_once './php/menu/footer.php' ?>
    </footer>

</body>

</html>
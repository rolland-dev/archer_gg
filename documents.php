<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './php/menu/head.php' ?>
    <title>documents</title>

</head>

<body>
    <?php require_once './php/menu/menu.php'; ?>

    <h1>Documents utiles</h1>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "./php/bdd/config.php";
                    
                    $sql1 = "SELECT DISTINCT date FROM documents ORDER BY date DESC";
                    $date=array();
                    if($result1 = mysqli_query($link, $sql1)){
                        if(mysqli_num_rows($result1) > 0){
                            while($row1 = mysqli_fetch_array($result1)){
                                array_push($date, $row1['date']);
                            }
                        }
                    }
                    ?>
                    
                    <div>
                    
                    <?php
                    // Attempt select query execution
                    foreach($date as $dateunique){
                    $sql = "SELECT * FROM documents where date='$dateunique'";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            
                                echo "<h2 class='text-center'>". date('d-m-Y', strtotime($dateunique)) ."</h2>";
                                echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th class=''>Date</th>";
                                            echo "<th class=''>Titre</th>";
                                            echo "<th class=''>Documents</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";

                                    $compteur=0;
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                            
                                            echo "<td class=''>" . date('d-m-Y', strtotime($row['date'])) . "</td>";
                                            echo "<td class=''>" . $row['titre'] . "</td>";
                                            echo "<td class=''><a href='".$row['lien']."' target='_blank'>". $row['lien']. "</a></td>";
                                           
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
                ?>
                </div>
                <?php
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
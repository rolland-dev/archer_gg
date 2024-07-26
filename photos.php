
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once './php/menu/head.php' ?>
    <title>photos</title>
</head>
<body>
    <?php require_once './php/menu/menu.php'; ?>

    <h1 class="text-center">Les photos du club</h1>
    
    <div class="wrapper">
            
                    <?php
                    
                    // Include config file
                    require_once "./php/bdd/config.php"; 
                    $sql1 = "SELECT DISTINCT date FROM images ORDER BY date DESC";
                    $date=array();
                    if($result1 = mysqli_query($link, $sql1)){
                        if(mysqli_num_rows($result1) > 0){
                            while($row1 = mysqli_fetch_array($result1)){
                                array_push($date, $row1['date']);
                            }
                        }
                    }
                    
                    foreach($date as $dateunique){
                    // Attempt select query execution
                    
                    echo '<hr>';
                    echo '<h2 class="text-center">' .date('d-m-Y', strtotime($dateunique))."</h2>";;
                    echo '<div class="ecran">';
                        $sql = "SELECT * FROM images where date='$dateunique'";
                    
                        if ($result = mysqli_query($link, $sql)) {
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    
                                    echo '<div class="photos">';
                                        $id_img = $row['id'];
                                        echo '<img src="./' . $row['lien'] . '"/>';
                                        echo "<p class='text-center'>Le " . date('d-m-Y', strtotime($row['date'])) ."<br>". $row['commentaire'] . "</p>";
                                    echo "</div>";
                                }
                                // Free result set
                                mysqli_free_result($result);
                            } else {
                                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                            }
                        } else {
                        echo "Oops! Something went wrong. Please try again later.";
                        }
                    echo '</div>';
                }
                echo '<br>';
                    // Close connection
                    mysqli_close($link);
                    ?>
                
            
    </div>

    <?php require_once './php/menu/footer.php'; ?>
</body>
</html>
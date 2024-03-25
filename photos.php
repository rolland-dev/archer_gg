
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
            <div class="row w-100 col-md-12 flex-row justify-content-around">
                    <?php
                    // Include config file
                    require_once "./php/bdd/config.php"; 

                    // Attempt select query execution
                    $sql = "SELECT * FROM images";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<div class="d-flex flex-row w-25">';
                                    $id_img = $row['id'];
                                    echo '<div class="text-center flex-column w-100">';
                                        echo '<img src="./' . $row['lien'] . '" width="100%"/>';
                                        echo "<div>Le " . date('d-m-Y', strtotime($row['date'])) ."<br> à ". $row['commentaire'] . "</div>";
                                    echo "</div >";
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

                    // Close connection
                    mysqli_close($link);
                    ?>
                
            </div>
    </div>

    <?php require_once './php/menu/footer.php'; ?>
</body>
</html>
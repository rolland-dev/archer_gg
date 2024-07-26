<?php
session_start();

require_once('../../php/bdd/config.php');

// Process delete operation after confirmation
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Prepare a delete statement
    $sql = "UPDATE archers SET valide=?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $reset);
        $reset = null;
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: ../archers_admin.php ");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement 
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Désactivation de tous les archers</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <p>ATTENTION !!! Etes vous sûre de vouloir désactiver tous les archers ?</p>
                            <p>
                                <input type="submit" value="oui" class="btn btn-danger">
                                <a href="../archers_admin.php" class="btn btn-secondary">Non</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>

</body>
</html>
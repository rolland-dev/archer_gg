<?php
session_start();

require_once('../../php/bdd//config.php');

$id = $_GET['id'];

// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
        
    // Prepare a delete statement
    $sql = "DELETE FROM plumes WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
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
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
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
                    <h2 class="mt-5 mb-3">Suppression d'une plume</h2>
                    <h3><?= $_SESSION['nom']?></h3>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Etes vous sûre de vouloir supprimer cette plume ?</p>
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
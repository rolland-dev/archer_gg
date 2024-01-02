<?php
require_once "../../php/bdd/config.php";

$pseudo = $role = $email ="";
$pseudo_err = $role_err = $email_err = "";

if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];

    $input_pseudo = trim($_POST["login"]);
    if(empty($input_pseudo)){
        $pseudo_err = "entrer un login";
    } else{
        $pseudo = $input_pseudo;
    }
    
    $input_role = trim($_POST["role"]);
    if(empty($input_role)){
        $role_err = "entrer un role";     
    } else{
        $role = $input_role;
    }
   
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "entrer un email";     
    } else{
        $email = $input_email;
    }
    if(empty($pseudo_err) && empty($role_err) && empty($email_err)){
        $sql = "UPDATE users SET login=?, role=?, email=? WHERE id=?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssi", $para_pseudo, $para_role, $param_email, $param_id);
            
            $para_pseudo = $pseudo;
            $para_role = strtoupper($role);
            $param_email = $email;
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                header("location: ../index_admin.php");
                exit();
            } else{
                echo "Oops! erreur inattendu, rééssayez ultérieusement";
            }
        }
    }
    
    mysqli_close($link);
} else{
    
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id = mysqli_real_escape_string($link,$_GET["id"]) ;
     
        $sql = "SELECT * FROM users WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $pseudo = $row["login"];
                    $email = $row['email'];
                    $role = $row["role"];
                    $id = $row["id"];
                } else{
                    header("location: error.php");
                    exit();
                }
            } else{
                echo "Oops! erreur inattendu, rééssayez ultérieusement";
            }
        }       
    }  else{
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                    <h2 class="mt-5">Mise a jour de l'utilisateur </h2> <br> 
                    <h3> <?php echo $pseudo; ?></h3>
                    <p class="mt-5">Changez les valeurs et validez !!!</p>
                    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">
                        <div class="form-group">
                            <label>login (nom.prenom)</label>
                            <input type="text" name="login" class="form-control <?php echo (!empty($pseudo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $pseudo; ?>">
                            <span class="invalid-feedback"><?php echo $pseudo_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>email</label>
                            <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <textarea name="role" class="form-control <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>"><?php echo $role; ?></textarea>
                            <span class="invalid-feedback"><?php echo $role_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="../index_admin.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
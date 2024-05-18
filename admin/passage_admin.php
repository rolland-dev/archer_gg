<?php
session_start();

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    $role = '';
}
if (isset($_SESSION['nom'])) {
    $nom = $_SESSION['nom'];
} else {
    $nom = '';
}

if ($role == '') {
    header("Location: ../index.php");
}

if(isset($_POST["submit"])) {
    $archer = trim($_POST["archers"]);
    $plume = trim($_POST["plumes"]);
    $fleche = trim($_POST["fleches"]);

    if(empty($archer)) {
        $archer_err = "selectionner un archer";
    } else {
        $nom_archer = $archer;
        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
        } else {
            $id = '';
        }
        $_SESSION['archer'] = $archer;

        if($plume !='default'){
            $_SESSION['plume'] = $plume;
        }else{
            $_SESSION['plume'] = '';
        }

        if($fleche !='default'){
            $_SESSION['fleche'] = $fleche;
        }else{
            $_SESSION['fleche'] = '';
        }
        
        $plume == 'default' ? $choix=$_SESSION['fleche'] : $choix=$_SESSION['plume'];
        
        header("Location: ./fiche_passage.php?choix=$choix&archer=$archer");
    }
    
}

session_abort();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../php/menu/head.php' ?>
    <title>Archers</title>

    <style>
        .wrapper {
            width: 90%;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 120px;
        }
        button{
            padding:5px;
            border-radius:5px;
            border:1px solid rgba(13,110,253,1);
            background: rgba(13,110,253,1)!important;
            color: blanchedalmond;
        }
        button:hover{
            background: rgb(13,200,253)!important;
            color: black;
        }
    </style>
</head>

<body>
    <?php require_once './menu/menu_admin.php'; ?>

    <h1 class="text-center">Valideur : <?= $nom ?></h1>

    <h2 class="text-center">Passage flèches/plumes</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        // Include config file
                        require_once "../php/bdd/config.php";

                        // Attempt select query execution
                        $sql = "SELECT * FROM archers";
                        if($result = mysqli_query($link, $sql)) {
                            if(mysqli_num_rows($result) > 0) {
                                echo '<table class="table table-bordered table-striped">';
                                echo '<label for="archers">Liste des archers</label><br>';
                                echo '<select name="archers" id="archers">';
                                echo '<option>--- Choisir archer ---</option>';
                                while($row = mysqli_fetch_array($result)) {
                                    echo '<option value="'. $row['id']. ' ' .$row['nom']. ' ' . $row['prenom'] .'">'.$row['nom']. ' ' . $row['prenom'] .'</option>';
                                }
                                echo '</select> ';
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
        <br>Choisissez une plume ou une flèche<br><br>
        <div id="plumes">
            <label for="plumes">Liste des plumes</label><br>
            <select name="plumes" id="plumes">
                <option value="default">--- Choisir une plume ---</option>
                <option value="Plume blanche">Blanche</option>
                <option value="Plume noire">Noire</option>
                <option value="Plume bleu">Bleu</option>
                <option value="Plume rouge">Rouge</option>
                <option value="Plume jaune">Jaune</option>                             
            </select>
        </div>
        <br> OU <br><br>
        <div id="fleches">
            <label for="fleches">Liste des flèches</label><br>
            <select name="fleches" id="fleches">
                <option value="default">--- Choisir une flèche ---</option>
                <option value="Flèche blanche">Blanche</option>
                <option value="Flèche noire">Noire</option>
                <option value="Flèche bleu">Bleu</option>
                <option value="Flèche rouge">Rouge</option>
                <option value="Flèche jaune">Jaune</option>                             
            </select>
        </div>
        <br>
        <div>
            <button type="submit" name="submit">C'est partie !!!</button>
        </div>
    </form>

    <footer>
        <?php require_once '../php/menu/footer.php' ?>
    </footer>
</body>

</html>
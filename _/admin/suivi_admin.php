<?php
session_start();
if(isset($_SESSION['login'])) {
    $connect = $_SESSION['login'];
} else {
    $connect = '';
}

if(isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if($role != "ADMIN") {
        header("Location: ../index.php");
    }
} else {
    $role = '';
    if($role != "ADMIN") {
        header("Location: ../index.php");
    }
}

if(isset($_SESSION['erreur'])) {
    $erreur = $_SESSION['erreur'];
} else {
    $erreur = '';
}

session_abort();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../php/menu/head.php' ?>
    <title>suivi archers</title>
</head>
<style>
        .wrapper{
            width: 90%;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
<body>

    <?php require_once './menu/menu_admin.php'; ?>
    <h1 class="text-center">Suivi des Archers</h1>
    <br>
   
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "../php/bdd/config.php";

// Attempt select query execution
$sql = "SELECT * FROM archers ORDER BY nom, prenom DESC";

if($result = mysqli_query($link, $sql)) {
    if(mysqli_num_rows($result) > 0) {
        echo '<table class="table table-bordered ">';
        echo "<thead>";
            echo "<tr>";
                echo "<th>Voir</th>";
                echo "<th>Nom</th>";
                echo "<th>Prenom</th>";
                echo "<th style='background-color:white !important'><span class='fa-solid fa-feather p-2'></span>Blanc</th>";
                echo "<th style='background-color:black !important; color:white'><span class='fa-solid fa-feather p-2'></span>Noire</th>";
                echo "<th style='background-color:blue !important'><span class='fa-solid fa-feather p-2'></span>Bleu</th>";
                echo "<th style='background-color:red !important'><span class='fa-solid fa-feather p-2'></span>Rouge</th>";
                echo "<th style='background-color:yellow !important'><span class='fa-solid fa-feather p-2'></span>Jaune</th>";
                echo "<th style='background-color:white !important;border-left: 2px solid black'><span class='fa fa-location-arrow p-2'></span>Blanc</th>";
                echo "<th style='background-color:black !important; color: white'><span class='fa fa-location-arrow p-2'></span>Noire</th>";
                echo "<th style='background-color:blue !important'><span class='fa fa-location-arrow p-2'></span>Bleu</th>";
                echo "<th style='background-color:red !important'><span class='fa fa-location-arrow p-2'></span>Rouge</th>";
                echo "<th style='background-color:yellow !important'><span class='fa fa-location-arrow p-2'></span>Jaune</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<thead>";
            echo "<tr class='text-center'>";
                echo "<th></th>";
                echo "<th style='font-size:small; vertical-align: center !important;'>Blason</th>";
                echo "<th style='font-size:small'>80 cm</th>";
                echo "<th style='background-color:white !important; font-size:small'>3x6 flèches<br>100 pts</th>";
                echo "<th style='background-color:black !important; color:white; font-size:small'>3x6 flèches<br>110 pts x 2</th>";
                echo "<th style='background-color:blue !important; font-size:small'>3x6 flèches<br>120 pts x 3</th>";
                echo "<th style='background-color:red !important; font-size:small'>3x6 flèches<br>130 pts x 4</th>";
                echo "<th style='background-color:yellow !important; font-size:small'>3x6 flèches<br>140 pts x 5</th>";
                echo "<th style='background-color:white !important; font-size:small; border-left: 2px solid black'>6x6 flèches<br>280 pts - 10m</th>";
                echo "<th style='background-color:black !important; color: white; font-size:small'>6x6 flèches<br>280 pts - 15m</th>";
                echo "<th style='background-color:blue !important; font-size:small'>6x6 flèches<br>280 pts - 20m</th>";
                echo "<th style='background-color:red !important; font-size:small'>6x6 flèches<br>280 pts - 25 m</th>";
                echo "<th style='background-color:yellow !important; font-size:small'>6x6 flèches<br>280 pts - 30m</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while($row = mysqli_fetch_array($result)) {
            echo "<tr class='text-center'>";
            echo "<td>";
                echo '<a href="./crud_archers/suivi_user.php?id='. $row['id'] .'&nom='. $row['nom'] . '&prenom=' . $row['prenom'] .'" class="mr-3" title="fiche archer" data-toggle="tooltip"><span class="fa fa-sheet-plastic p-2"></span></a>';
            echo "</td>";
            echo "<td>" . strtoupper($row['nom']) . "</td>";
            echo "<td>" . ucfirst($row['prenom']) . "</td>";
            $id = $row['id'];
            $plume = "SELECT * FROM plumes where archers_id='$id'";
            $resultp = mysqli_query($link, $plume);
            $blanche = $noire = $bleu = $rouge = $jaune = 0;
            while($rowp = mysqli_fetch_array($resultp)) {
                $fleche = "SELECT * FROM fleches where archers_id='$id'";
                if($rowp['couleur'] == "blanche") $blanche = $rowp['point'];
                if($rowp['couleur'] == "noire") $noire = $rowp['point'];
                if($rowp['couleur'] == "bleue") $bleu = $rowp['point'];
                if($rowp['couleur'] == "rouge") $rouge = $rowp['point'];
                if($rowp['couleur'] == "jaune") $jaune = $rowp['point'] ;
            }
            
            echo $blanche==0 ? "<td>" . $blanche . "</td>" : "<td style='background-color:white !important'>" . $blanche . "</td>";
            echo $noire==0 ? "<td>" . $noire . "</td>" : "<td style='background-color:black !important; color:white'>" . $noire. "</td>";
            echo $bleu==0 ? "<td>" . $bleu . "</td>" : "<td style='background-color:blue !important'>" . $bleu . "</td>";
            echo $rouge==0 ? "<td>" . $rouge . "</td>" : "<td style='background-color:red !important'>" . $rouge. "</td>";
            echo $jaune==0 ? "<td>" . $jaune . "</td>" : "<td style='background-color:yellow !important'>" . $jaune . "</td>";

            $fleche = "SELECT * FROM fleches where archers_id='$id'";
            $resultf = mysqli_query($link, $fleche);
            $blanche = $noire = $bleu = $rouge = $jaune = 0;
            while($rowf = mysqli_fetch_array($resultf)) {
                if($rowf['couleur'] == "blanche") $blanche = $rowf['point'];
                if($rowf['couleur'] == "noire") $noire = $rowf['point'];
                if($rowf['couleur'] == "bleue") $bleu = $rowf['point'];
                if($rowf['couleur'] == "rouge") $rouge = $rowf['point'];
                if($rowf['couleur'] == "jaune") $jaune = $rowf['point'] ;
            }
        
            echo $blanche==0 ? "<td style='border-left: 2px solid black'>" . $blanche . "</td>" : "<td style='background-color:white !important;border-left: 2px solid black'>" . $blanche . "</td>";
            echo $noire==0 ? "<td>" . $noire . "</td>" : "<td style='background-color:black !important; color:white'>" . $noire. "</td>";
            echo $bleu==0 ? "<td>" . $bleu . "</td>" : "<td style='background-color:blue !important'>" . $bleu . "</td>";
            echo $rouge==0 ? "<td>" . $rouge . "</td>" : "<td style='background-color:red !important'>" . $rouge. "</td>";
            echo $jaune==0 ? "<td>" . $jaune . "</td>" : "<td style='background-color:yellow !important'>" . $jaune . "</td>";
        }
        echo "</tbody>";
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
        mysqli_free_result($resultp);
        mysqli_free_result($resultf);

    } else {
        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
    }
} else {
    echo "Oops! Something went wrong. Please try again later.";
}

?>
                </div>
            </div>        
        </div>
    </div>
    <br>

    <footer>
        <?php require_once '../php/menu/footer.php' ?>
    </footer>           
    
</body>

</html>
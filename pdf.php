<?php
session_start();

if(isset($_SESSION['archer_id'])){
    $archer_id = $_SESSION['archer_id'];
}else{
    $archer_id = '';
}
if(isset($_SESSION['nom'])){
    $nom = $_SESSION['nom'];
}else{
    $nom = '';
}


session_abort();

require __DIR__.'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

ob_start();

?>

<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <div>
        <img src="./img/logo.png" alt="logo archer guignicourt" style="float:left;width:25%;">
        <img src="./img/logoffta.jpg" alt="logo ffta" style="float:right;width:20%;">
    </div>
    <br>
    <h1 style="text-align:center;">La Compagnie des Archers de Guignicourt</h1>
    <br>
    <h2 style="text-align:center;"> Mon compte Archer : <?php  echo $nom ?></h2>
    <h2 style="text-align:center;">Plumes archer</h2>
    <div style=" width: 90%; margin: 0 auto;">
                    <?php
                    // Include config file
                    require_once "./php/bdd//config.php";
                    // Attempt select query execution
                    $sql = "SELECT * FROM plumes where archers_id = '$archer_id' ";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table style="margin:auto;">';
                                echo "<thead>";
                                    echo "<tr style='text-align;'>";
                                        echo "<th style='text-align;center;padding:2px 5px;border:1px solid black'>plumes</th>";
                                        echo "<th style='text-align;center;padding:2px 5px;border:1px solid black'>Date obtention</th>";
                                        echo "<th style='text-align;center;padding:2px 5px;border:1px solid black'>points</th>";
                                        echo "<th style='text-align;center;padding:2px 5px;border:1px solid black'>Le validateur</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr style='text-align:center;'>";
                                        if($row['couleur']=='blanche'){
                                            echo "<td style='text-align:center;padding:2px 5px;border:1px solid black'>" . $row['couleur'] . "</td>";
                                        }
                                        if($row['couleur']=='noire'){
                                            echo "<td style='text-align:center;padding:2px 5px;border:1px solid black; background-color:black; color:white;'>" . $row['couleur'] . "</td>";
                                        }
                                        if($row['couleur']=='bleue'){
                                            echo "<td style='text-align:center;padding:2px 5px;border:1px solid black; background-color:blue; color:white;'>" . $row['couleur'] . "</td>";
                                        }
                                        if($row['couleur']=='rouge'){
                                            echo "<td style='text-align:center;padding:2px 5px;border:1px solid black; background-color:red; color:white;'>" . $row['couleur'] . "</td>";
                                        }
                                        if($row['couleur']=='jaune'){
                                            echo "<td style='text-align:center;padding:2px 5px;border:1px solid black; background-color:yellow; color:black;'>" . $row['couleur'] . "</td>";
                                        }
                                            echo "<td style='text-align;center;padding:2px 5px;border:1px solid black'>" . date('d-m-Y', strtotime($row['date'])) . "</td>";
                                            echo "<td style='text-align;center;padding:2px 5px;border:1px solid black'>" . $row['point'] . "</td>";
                                            echo "<td style='text-align;center;padding:2px 5px;border:1px solid black'>" . $row['validateur'] . "</td>";
                                    echo "</tr>";
                                    
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div style="text-align:center;"><em>Aucune informations trouvées ou compte invalide.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    ?>
    </div>
    <h2 style="text-align:center;">Flèches archer</h2>
    <div style=" width: 90%; margin: 0 auto;">
                    <?php
                    // Include config file
                    require_once "./php/bdd//config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM fleches where archers_id='$archer_id'";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table style="margin:auto;border:1px black solid;" class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr style='text-align:center;'>";
                                        echo "<th style='text-align;center;padding:2px 5px;border:1px solid black'>Flèches</th>";
                                        echo "<th style='text-align;center;padding:2px 5px;border:1px solid black'>Date obtention</th>";
                                        echo "<th style='text-align;center;padding:2px 5px;border:1px solid black'>points</th>";
                                        echo "<th style='text-align;center;padding:2px 5px;border:1px solid black'>Le validateur</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr style='text-align:center;'>";
                                    if($row['couleur']=='blanche'){
                                        echo "<td style='text-align;center;padding:2px 5px;border:1px solid black'>" . $row['couleur'] . "</td>";
                                    }
                                    if($row['couleur']=='noire'){
                                        echo "<td style='text-align;center;padding:2px 5px;border:1px solid black; background-color:black; color:white;'>" . $row['couleur'] . "</td>";
                                    }
                                    if($row['couleur']=='bleue'){
                                        echo "<td style='text-align;center;padding:2px 5px;border:1px solid black; background-color:blue; color:white;'>" . $row['couleur'] . "</td>";
                                    }
                                    if($row['couleur']=='rouge'){
                                        echo "<td style='text-align;center;padding:2px 5px;border:1px solid black; background-color:red; color:white;'>" . $row['couleur'] . "</td>";
                                    }
                                    if($row['couleur']=='jaune'){
                                        echo "<td style='text-align;center;padding:2px 5px;border:1px solid black; background-color:yellow; color:black;'>" . $row['couleur'] . "</td>";
                                    }                                        echo "<td style='text-align;center;padding:2px 5px;border:1px solid black'>" . date('d-m-Y', strtotime($row['date'])). "</td>";
                                        echo "<td style='text-align;center;padding:2px 5px;border:1px solid black'>" . $row['point'] . "</td>";
                                        echo "<td style='text-align;center;padding:2px 5px;border:1px solid black'>" . $row['validateur'] . "</td>";
                                    echo "</tr>";
                                    
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div style="text-align:center;"><em>Aucune informations trouvées ou compte invalide.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
    </div>
</page>

<?php

$htmlContent = ob_get_clean();

$html2pdf = new Html2Pdf('P','A4','fr', true, 'UTF-8');
$html2pdf->writeHTML($htmlContent);
$html2pdf->output($nom .".pdf");
$html2pdf->clean();
?> 
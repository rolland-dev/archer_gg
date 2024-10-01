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
    header("Location: ./admin/index.php");
}

session_abort();

require __DIR__.'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

ob_start();

?>

<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <div>
        <img src="./img/logo.png" alt="logo archer guignicourt" style="float:left;width:15%;">
        <img src="./img/logoffta.jpg" alt="logo ffta" style="float:right;width:10%;">
    </div>
    <br>
    <div style=" width: 90%; margin: 0 auto;">
        
                    <?php
                    // Include config file
                    require_once "./php/bdd/config.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM archers ORDER BY nom, prenom DESC";

                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table style="margin:auto;width:100%;">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th style='border:1px solid black;padding:5px'>Nom</th>";
                                        echo "<th style='border:1px solid black;padding:5px'>Prenom</th>";
                                        echo "<th style='background-color:white;border:1px solid black'><span class='fa-solid fa-feather p-2'></span>Blanc</th>";
                                        echo "<th style='background-color:black; color:white;border:1px solid black'><span class='fa-solid fa-feather p-2'></span>Noire</th>";
                                        echo "<th style='background-color:blue;border:1px solid black;color:white'><span class='fa-solid fa-feather p-2'></span>Bleu</th>";
                                        echo "<th style='background-color:red;border:1px solid black'><span class='fa-solid fa-feather p-2'></span>Rouge</th>";
                                        echo "<th style='background-color:yellow;border:1px solid black'><span class='fa-solid fa-feather p-2'></span>Jaune</th>";
                                        echo "<th style='background-color:white;border-left: 2px solid black;border:1px solid black'><span class='fa fa-location-arrow p-2'></span>Blanc</th>";
                                        echo "<th style='background-color:black; color: white;border:1px solid black'><span class='fa fa-location-arrow p-2'></span>Noire</th>";
                                        echo "<th style='background-color:blue;border:1px solid black;color:white'><span class='fa fa-location-arrow p-2'></span>Bleu</th>";
                                        echo "<th style='background-color:red ;border:1px solid black'><span class='fa fa-location-arrow p-2'></span>Rouge</th>";
                                        echo "<th style='background-color:yellow;border:1px solid black'><span class='fa fa-location-arrow p-2'></span>Jaune</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<thead>";
                                    echo "<tr class='text-center'>";
                                        echo "<th style='font-size:small; vertical-align: center;border:1px solid black'>Blason</th>";
                                        echo "<th style='font-size:small;border:1px solid black'>80 cm</th>";
                                        echo "<th style='background-color:white; font-size:small;border:1px solid black'>3x6 flèches<br>100 pts</th>";
                                        echo "<th style='background-color:black; color:white; font-size:small;border:1px solid black'>3x6 flèches<br>110 pts x 2</th>";
                                        echo "<th style='background-color:blue; font-size:small;border:1px solid black;color:white'>3x6 flèches<br>120 pts x 3</th>";
                                        echo "<th style='background-color:red; font-size:small;border:1px solid black'>3x6 flèches<br>130 pts x 4</th>";
                                        echo "<th style='background-color:yellow; font-size:small;border:1px solid black'>3x6 flèches<br>140 pts x 5</th>";
                                        echo "<th style='background-color:white; font-size:small; border-left: 2px solid black;border:1px solid black'>6x6 flèches<br>280 pts - 10m</th>";
                                        echo "<th style='background-color:black; color: white; font-size:small;border:1px solid black'>6x6 flèches<br>280 pts - 15m</th>";
                                        echo "<th style='background-color:blue; font-size:small;border:1px solid black;color:white'>6x6 flèches<br>280 pts - 20m</th>";
                                        echo "<th style='background-color:red; font-size:small;border:1px solid black'>6x6 flèches<br>280 pts - 25 m</th>";
                                        echo "<th style='background-color:yellow; font-size:small;border:1px solid black'>6x6 flèches<br>280 pts - 30m</th>";
                                    echo "</tr>";
                                echo "</thead>";
                            
                                echo "<tbody>";

                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr class='text-center'>";
                                            echo "<td style='border:1px solid black'>" . strtoupper($row['nom']) . "</td>";
                                            echo "<td style='border:1px solid black'>" . ucfirst($row['prenom']) . "</td>";

                                            $id = $row['id'];
                                            $plume = "SELECT * FROM plumes where archers_id='$id'";
                                            $resultp = mysqli_query($link, $plume);
                                            $blanche = $noire = $bleu = $rouge = $jaune = 0;
                                            while ($rowp = mysqli_fetch_array($resultp)) {
                                                $fleche = "SELECT * FROM fleches where archers_id='$id'";
                                                if ($rowp['couleur'] == "blanche") {
                                                    $blanche = $rowp['point'];
                                                }
                                                if ($rowp['couleur'] == "noire") {
                                                    $noire = $rowp['point'];
                                                }
                                                if ($rowp['couleur'] == "bleue") {
                                                    $bleu = $rowp['point'];
                                                }
                                                if ($rowp['couleur'] == "rouge") {
                                                    $rouge = $rowp['point'];
                                                }
                                                if ($rowp['couleur'] == "jaune") {
                                                    $jaune = $rowp['point'] ;
                                                }
                                            }

                                            echo $blanche == 0 ? "<td style='border:1px solid black'></td>" : "<td style='background-color:white;border:1px solid black'>" . $blanche . "</td>";
                                            echo $noire == 0 ? "<td style='border:1px solid black' ></td>" : "<td style='background-color:black; color:white;border:1px solid black'>" . $noire. "</td>";
                                            echo $bleu == 0 ? "<td style='border:1px solid black'></td>" : "<td style='background-color:blue;border:1px solid black;color:white'>" . $bleu . "</td>";
                                            echo $rouge == 0 ? "<td style='border:1px solid black'></td>" : "<td style='background-color:red;border:1px solid black'>" . $rouge. "</td>";
                                            echo $jaune == 0 ? "<td style='border:1px solid black'></td>" : "<td style='background-color:yellow;border:1px solid black'>" . $jaune . "</td>";

                                            $fleche = "SELECT * FROM fleches where archers_id='$id'";
                                            $resultf = mysqli_query($link, $fleche);
                                            $blanche = $noire = $bleu = $rouge = $jaune = 0;
                                            while ($rowf = mysqli_fetch_array($resultf)) {
                                                if ($rowf['couleur'] == "blanche") {
                                                    $blanche = $rowf['point'];
                                                }
                                                if ($rowf['couleur'] == "noire") {
                                                    $noire = $rowf['point'];
                                                }
                                                if ($rowf['couleur'] == "bleue") {
                                                    $bleu = $rowf['point'];
                                                }
                                                if ($rowf['couleur'] == "rouge") {
                                                    $rouge = $rowf['point'];
                                                }
                                                if ($rowf['couleur'] == "jaune") {
                                                    $jaune = $rowf['point'] ;
                                                }
                                            }

                                            echo $blanche == 0 ? "<td style='border:1px solid black'></td>" : "<td style='background-color:white ;border-left: 2px solid black;border:1px solid black'>" . $blanche . "</td>";
                                            echo $noire == 0 ? "<td style='border:1px solid black'></td>" : "<td style='background-color:black; color:white;border:1px solid black'>" . $noire. "</td>";
                                            echo $bleu == 0 ? "<td style='border:1px solid black'></td>" : "<td style='background-color:blue;border:1px solid black;color:white'>" . $bleu . "</td>";
                                            echo $rouge == 0 ? "<td style='border:1px solid black'></td>" : "<td style='background-color:red;border:1px solid black'>" . $rouge. "</td>";
                                            echo $jaune == 0 ? "<td style='border:1px solid black'></td>" : "<td style='background-color:yellow;border:1px solid black'>" . $jaune . "</td>";
                                        echo "</tr>";
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
    
</page>

<?php

$htmlContent = ob_get_clean();

$html2pdf = new Html2Pdf('L', 'A4', 'fr', true, 'UTF-8');
$html2pdf->writeHTML($htmlContent);
$html2pdf->output($nom .".pdf");
$html2pdf->clean();
?> 
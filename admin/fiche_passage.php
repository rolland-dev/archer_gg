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

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else {
    $id = '';
}

if ($role == '') {
    header("Location: ../index.php");
}

if(isset($_POST["return"])) {
    $_SESSION['plume']='';
    $_SESSION['fleche']='';
    header("Location: ./passage_admin.php");
}
$choix = $_GET['choix'];
$archer_c = $_GET['archer'];
$id2 = $archer_c[0];
$archer=substr($archer_c, 1);

$_SESSION['choix']=$choix;

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

    <h2 class="text-center">Fiche de passage de <?= $archer?></h2>
    <h2 class="text-center">Passage de la <?= $choix ?></h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        // Include config file
                        require_once "../php/bdd/config.php";

                        // Attempt select query execution
                        $sql = "SELECT * FROM passage where id_archer='$id2' and couleur='$choix'";
                        if($result = mysqli_query($link, $sql)) {
                            if(mysqli_num_rows($result) > 0) {
                                if($choix=="Flèche blanche" || $choix=="Flèche noire" || $choix=="Flèche bleu" || $choix=="Flèche rouge" || $choix=="Flèche jaune"){
                                    $fleche=1;
                                }else{
                                    $fleche=0;
                                }
                                echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Num tir</th>";
                                        echo "<th>Date</th>";
                                        echo "<th>volée 1</th>";
                                        echo "<th>volée 2</th>";
                                        echo "<th>volée 3</th>";
                                        if($fleche==1){
                                           echo "<th>volée 4</th>";
                                            echo "<th>volée 5</th>";
                                            echo "<th>volée 6</th>"; 
                                        }
                                        
                                        echo "<th>Total</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                $sql1 = "SELECT * FROM progression where type='$choix'";
                                if($result1 = mysqli_query($link, $sql1)) {
                                if(mysqli_num_rows($result1) > 0) {
                                    while($row1 = mysqli_fetch_array($result1)){
                                        $nb_passage = $row1['nbpassage'];
                                        $reste = $nb_passage;
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td> passage ". ($reste+1)-$nb_passage ."</td>";
                                        echo "<td>" . date('d-m-Y', strtotime($row['Created_at'])) . "</td>";
                                        echo "<td>" . $row['col1'] . "</td>";
                                        echo "<td>" . $row['col2']. "</td>";
                                        echo "<td>" . $row['col3'] . "</td>";
                                        if($fleche==1){
                                            echo "<td>" . $row['col4'] . "</td>";
                                            echo "<td>" . $row['col5']. "</td>";
                                            echo "<td>" . $row['col6'] . "</td>";
                                            echo "<td>". $row['col1']+$row['col2']+$row['col3']+$row['col4']+$row['col5']+$row['col6'] ."</td>";
                                            $total =$row['col1']+$row['col2']+$row['col3']+$row['col4']+$row['col5']+$row['col6'] ;
                                        }else{
                                            echo "<td>". $row['col1']+$row['col2']+$row['col3'] ."</td>";
                                            $total =$row['col1']+$row['col2']+$row['col3'] ;
                                        }
                                        
                                        
                                        echo "<td>";
                                            if($total!=0){
                                            }else{
                                                echo '<a href="./crud_passage/update.php?id='.$row['id'].'&nbtir='.($reste+1)-$nb_passage.'&archer='.$archer.'&choix=' . $choix .'" target="_blank" class="mr-3" title="'.$archer.'" data-toggle="tooltip"><span class="fas fa-pencil-alt p-2"></span></a>';
                                            }
                                            echo "</td>";
                                    echo "</tr>";
                                    $reste++;
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                        }
                    }
                }
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
       
        <br>
        <div>
        <a href="./crud_passage/create.php?choix=<?=$choix?>&id=<?= $id2 ?>" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fas fa-pencil-alt p-2"></span></a>
        </div> 
        <div>
            <button type="submit" name="return">Retour</button>
        </div>
    </form>

    <footer>
        <?php require_once './menu/footer_admin.php' ?>
    </footer>
</body>

</html>
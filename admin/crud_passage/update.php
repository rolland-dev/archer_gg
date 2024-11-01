<?php
session_start();

require_once "../../php/bdd/config.php";

$tir1 = $tir2 = $tir3 = $tir4 = $tir5 = $tir6 =$date = "";
$tir1_err = $tir2_err = $tir3_err = $date_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $id = $_POST['id'];
    $nbtir= $_POST['nbtir'];

    if (isset($_POST['total1'])) {
        $tir1 = trim($_POST['total1']);
    } else {
        $tir1 = 0;
    }
    if (isset($_POST['total2'])) {
        $tir2 = trim($_POST['total2']);
    } else {
        $tir2 = 0;
    }
    if (isset($_POST['total3'])) {
        $tir3 = trim($_POST['total3']);
    } else {
        $tir3 = 0;
    }
    if (isset($_POST['total4'])) {
        $tir4 = trim($_POST['total4']);
    } else {
        $tir4 = 0;
    }
    if (isset($_POST['total5'])) {
        $tir5 = trim($_POST['total5']);
    } else {
        $tir5 = 0;
    }
    if (isset($_POST['total6'])) {
        $tir6 = trim($_POST['total6']);
    } else {
        $tir6 = 0;
    }
   
    $choix=$_SESSION['choix'];
    
    $sql1 = "SELECT id FROM passage WHERE (id_archer='$id' AND nbtir='$nbtir' AND couleur='$choix')";
    if($result1 = mysqli_query($link, $sql1)){
        if(mysqli_num_rows($result1) > 0){
            while($row1 = mysqli_fetch_array($result1)){
                $id_place = $row1['id'];
            }
            
        }
    }

        $sql = "UPDATE passage SET col1=?, col2=?, col3=?,col4=?, col5=?, col6=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssiiii", $param_col1, $param_col2, $param_col3, $param_col4, $param_col5, $param_col6, $param_id);
            
            $param_col1 = $tir1;
            $param_col2 = $tir2;
            $param_col3 = $tir3;
            $param_col4 = $tir4;
            $param_col5 = $tir5;
            $param_col6 = $tir6;
            $param_id = $id_place;
//var_dump($param_col1, $param_col2, $param_col3, $param_col4, $param_col5, $param_col6,$param_nbtir,$param_choix, $param_id,mysqli_stmt_execute($stmt));die;
            if(mysqli_stmt_execute($stmt)){    
                
                header("Location: ../passage_admin.php"); 
                exit();
            } else{
                echo "Oops! erreur inattendu, rééssayez ultérieusement";
            }
        }
        
    
        setcookie("total", 0, time()-1,"/");
    mysqli_close($link);
} else{
    
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id =  trim($_GET["id"]);
        $nbtir =  trim($_GET["nbtir"]);
        $archer = trim($_GET['archer']);
        $_SESSION['archer']=$archer;
        $choix = trim($_GET['choix']);
        $_SESSION['choix']=$choix;
       
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $archer ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
    
    <style>
    .wrapper {
        width: 700px;
        margin: 0 auto;
        text-align: center;
    }
    input#volee1.form-control{
        background-color: #0d6EFD !important;
        color : blanchedalmond !important;
        padding: 0;
        text-align: center;
    }
    #volee1.form-control, .ecrire.form-control{
        width: 150% !important;
        text-align: center;
    }
    .form-control, .form-group{
        width: 90%;
        text-align: center;
    }

    
    .taille{
        padding: 16px !important;
        font-size: 2rem !important;
    }
    #cible{
        position: relative;
    }
    svg{
        position:absolue;
        top:-5px;
        left: -10px;
    }
    /* div{
        position: relative;
        top:0;
        left: 0;
        z-index: 0;
    } */
   
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid" style="width:130%">
            <div class="row">
                <div class="col-12">
                    <h2 class="mt-5">Archer : <?php echo $archer; ?> </h2>
                    <h2 class="mt-5">Passage de la <?php echo $choix; ?> </h2>
                    <h2 class="mt-5">Tir numéro : <?php echo $nbtir; ?></h2>
                    <h4 class="mt-3"><?php echo date('d-m-Y', strtotime(date('d-m-Y'))); ?></h4>
                    <br>
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                        enctype="multipart/form-data">
                        <?php
                         switch ($choix) {
                            case "Plume blanche":
                                $score=100;
                                $volee=3;
                                $passage=1;
                                $type="p";
                                break;
                            case "Plume noire":
                                $score=110;
                                $volee=3;
                                $passage=2;
                                $type="p";
                                break;
                            case "Plume bleu":
                                $score=120;
                                $volee=3;
                                $passage=3;
                                $type="p";
                                break;
                            case "Plume rouge":
                                $score=130;
                                $volee=3;
                                $passage=4;
                                $type="p";
                                break;
                            case "Plume jaune":
                                $score=140;
                                $volee=3;
                                $passage=5;
                                $type="p";
                                break;
                            case "Fleche blanche" || "Fleche noire" || "Fleche bleu" || "Fleche rouge" || "Fleche jaune":
                                $score=280;
                                $volee=6;
                                $passage=1;
                                $type="f";
                                break;
                        }
                        for ($i=1; $i < $volee+1; $i++): ?>
                            <div class="volee1 d-flex" >
                                <div class="form-group">
                                    <label></label>
                                    <input type="text" id="volee" class="form-control" value="Volée <?= $i ?>" width="">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="number" id="<?= $i ?>1" class="form-control disabled" value="" min="0" max="10" disabled>
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="number" id="<?= $i ?>2" class="form-control" value="" min="0" max="10" disabled>
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="number" id="<?= $i ?>3" class="form-control" value="" min="0" max="10" disabled>
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="number" id="<?= $i ?>4" class="form-control" value="" min="0" max="10" disabled>
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="number" id="<?= $i ?>5" class="form-control" value="" min="0" max="10" disabled>
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="number" id="<?= $i ?>6" class="form-control" value="" min="0" max="10" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Total
                                    <input type="number" id="total<?= $i ?>" class="form-control" name="total<?= $i ?>" value="0" readonly /></label>
                                </div>
                                
                                <div class="form-group">
                                    <label>Actions
                                    <div class="btn btn-secondary ecrire" id="<?=$i?>7" onclick="ecrit(this.id);">ecrire</div></label>
                                    <div class="btn btn-secondary modif " id="<?= $i ?>" onclick="modif(this.id);"><span class="fas fa-pencil-alt p-2"></span></div>
                                    <input type="hidden" id="test<?= $i ?>" value="0" /></label>
                                </div>
                                
                                
                            </div>
                        <?php endfor; ?>
                        <div class="form-group">
                            <label>Total final
                            <input type="number" id="totalf" class="form-control" value="0" disabled></label>
                            <label>sur
                            <input type="text" id="score" class="form-control" value="<?= $score ?>" disabled></label>
                        </div>
                        <div class="form-group">   
                            <label>Résultat
                            <input type="text" id="resultat" class="form-control" value="Non Validé" disabled></label>
                        </div>

                        <div id="validation" style="visibility:hidden">
                        <?php 
                            if($passage == $nbtir){
                                if(isset($_COOKIE['total'])){
                                    $total= $_COOKIE['total'];
                                }else{
                                    $total= 0;
                                }
                                // var_dump($total);
                            if($type=="p"){
                                echo '<a href="../plumes_admin.php?id='. $id .'&archer='. $archer .'&choix='. $choix.'&total='. $_COOKIE['total'].'" class="mr-3" title="validation" data-toggle="tooltip" target="_blank"><span class="fa fa-sheet-plastic p-2">Validation Finale</span></a>';
                            }else{
                                var_dump($total);
                                echo '<a href="../fleches_admin.php?id='. $id .'&archer='. $archer .'&choix='. $choix. '&total='. $total.'" class="mr-3" title="validation" data-toggle="tooltip" target="_blank"><span class="fa fa-sheet-plastic p-2">Validation Finale</span></a>';
                            }
                        } 
                        ?> 
                        </div>
                       
                        
                        <div id="points" style="visibility:hidden">
                            <div class="btn btn-primary taille" id="10" onclick="ajout(this.id,<?= $volee?>);">10</div>
                            <div class="btn btn-primary taille" id="9" onclick="ajout(this.id,<?= $volee?>);">9</div>
                            <div class="btn btn-primary taille" id="8" onclick="ajout(this.id,<?= $volee?>);">8</div>
                            <div class="btn btn-primary taille" id="7" onclick="ajout(this.id,<?= $volee?>);">7</div>
                            <div class="btn btn-primary taille" id="6" onclick="ajout(this.id,<?= $volee?>);">6</div>
                            <div class="btn btn-primary taille" id="5" onclick="ajout(this.id,<?= $volee?>);">5</div>
                            <div class="btn btn-primary taille" id="4" onclick="ajout(this.id,<?= $volee?>);">4</div>
                            <div class="btn btn-primary taille" id="3" onclick="ajout(this.id,<?= $volee?>);">3</div>
                            <div class="btn btn-primary taille" id="2" onclick="ajout(this.id,<?= $volee?>);">2</div>
                            <div class="btn btn-primary taille" id="1" onclick="ajout(this.id,<?= $volee?>);">1</div>
                            <div class="btn btn-primary taille" id="0" onclick="ajout(this.id,<?= $volee?>);">0</div>
                        </div><br>
                        <div id="cible" style="visibility:hidden">
                            <svg
                                id="svg"
                                width="480"
                                height="480"
                                version="1.1"
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                
                                <rect id="0" onclick="choix(this.id);" x="10" y="10" width="480" height="480" stroke="transparent" fill="transparent"/>
                                <circle id="1" onclick="choix(this.id);" cx="250" cy="250" r="210" stroke="black" fill="white" />
                                <circle id="2" onclick="choix(this.id);" cx="250" cy="250" r="185" stroke="black" fill="white" />
                                <circle id="3" onclick="choix(this.id);" cx="250" cy="250" r="165" stroke="white" fill="black" />
                                <circle id="4" onclick="choix(this.id);" cx="250" cy="250" r="140" stroke="white" fill="black" />
                                <circle id="5" onclick="choix(this.id);" cx="250" cy="250" r="120" stroke="black" fill="blue" />
                                <circle id="6" onclick="choix(this.id);" cx="250" cy="250" r="95" stroke="black" fill="blue" />
                                <circle id="7" onclick="choix(this.id);" cx="250" cy="250" r="75" stroke="black" fill="red" />
                                <circle id="8" onclick="choix(this.id);" cx="250" cy="250" r="50" stroke="black" fill="red" />
                                <circle id="9" onclick="choix(this.id);" cx="250" cy="250" r="30" stroke="black" fill="yellow" />
                                <circle id="10" onclick="choix(this.id);" cx="250" cy="250" r="15" stroke="black" fill="yellow" />
                                <circle id="120" cx="0" cy="0"  r="3" stroke="black" fill="white"></circle>
                                <circle id="130" cx="0" cy="0"  r="3" stroke="black" fill="white"></circle>
                                <circle id="140" cx="0" cy="0"  r="3" stroke="black" fill="white"></circle>
                                <circle id="150" cx="0" cy="0"  r="3" stroke="black" fill="white"></circle>
                                <circle id="160" cx="0" cy="0"  r="3" stroke="black" fill="white"></circle>
                                <circle id="170" cx="0" cy="0"  r="3" stroke="black" fill="white"></circle>
                            </svg>
                        </div>
                        <!--<input type="" id="totalG"  />-->
                        <input type="hidden" id="ligne" value="0" />
                        <input type="hidden" id="place" value="0" />
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="hidden" name="nbtir" value="<?php echo $nbtir; ?>" />

                        <input type="submit" name="submit" id="submit" class="btn btn-primary " style="visibility:hidden" value="Enregistrer">
                        <a href="javascript:close_tab();" class="btn btn-secondary ml-2">Fermer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        let compteur =110;
        let idRecup;
        let elementDiv=document.getElementById('svg');
        let coord = elementDiv.getBoundingClientRect();
        console.log(coord.x , coord.y);

        function choix(id){
            idRecup = id;
            window.addEventListener('click', mousemove);
        }
        function mousemove(event) {  
            if(compteur>=170){
                compteur =110;
            }
            compteur=compteur+10;
            document.getElementById(compteur).setAttribute("cx", (event.clientX-coord.x)+"px");
            document.getElementById(compteur).setAttribute("cy", (event.clientY-coord.y)+"px");
            console.log(document.getElementById(compteur));
            ajout(idRecup,<?= $volee?>);
             
        }

        function close_tab(){
            if (confirm('Attention toutes les données seront perdues !!! \nVoulez vous fermer cette onglet ?')) {
                window.close();
            }
        }

        function modif(id){
            console.log(document.getElementById("test"+id).value);
            if(document.getElementById("test"+id).value == "0")
            {
                document.getElementById(id).innerHTML = "<i class='fa-solid fa-lock-open'></i>";
                document.getElementById("test"+id).value = "1";
                $val = Math.trunc(((document.getElementById("ligne").value)/10));
                for($i=1;$i<=6;$i++){
                    $cpt=$val*10+$i;
                    document.getElementById($cpt).disabled=false;
                }
            }else{
                let Somme=0;
                document.getElementById(id).innerHTML = "<span class='fas fa-pencil-alt p-2'>";
                document.getElementById("test"+id).value = "0";
                $val = Math.trunc(((document.getElementById("ligne").value)/10));
                for($i=1;$i<=6;$i++){
                    $cpt=$val*10+$i;
                    document.getElementById($cpt).disabled=true;
                    if(document.getElementById($cpt).value!=""){
                        Somme+=parseInt(document.getElementById($cpt).value);
                    }
                }
                document.getElementById("total"+$val).value=Somme;
                document.getElementById("totalf").value=Somme;
            }
        }
            
        

        function ajout(id,volee){
            point = parseInt(id);
            volees = parseInt(volee);
            result = document.getElementById("place").value;
            place = parseInt(result.substring(5,7));
            total = `total`+result.substring(5,6);
            
            if(document.getElementById("ligne").value ==0){
                cases = place-6;
                document.getElementById("ligne").value = parseInt(cases);
            }
            else{
                cases = parseInt(document.getElementById("ligne").value);
            }

            if(volee===3){
                if(place < 20) reste=10;
                if(place >= 20 && place < 30) reste=20;
                if(place >= 30 ) reste=30;
            }
            else{
                if(place < 20) reste=10;
                if(place >= 20 && place < 30) reste=20;
                if(place >= 30 && place < 40) reste=30;
                if(place >= 40 && place < 50) reste=40;
                if(place >= 50 && place < 60) reste=50;
                if(place >= 60 ) reste=60;
            }
            

            valeur = parseInt(document.getElementById("totalf").value);
         
            if((cases-reste)<7){
                document.getElementById(cases).value = point;
                document.getElementById("ligne").value = cases+1;

                point_ant = parseInt(document.getElementById(total).value);
                document.getElementById(total).value = point_ant+point;
                
                document.getElementsByClassName(total).value = point_ant+point;
              
                document.getElementById("totalf").value = parseInt(valeur+point);
                
                if((reste-cases)==-6){
                    $val = Math.trunc(((document.getElementById("ligne").value)/10));
                    document.getElementById($val).style.visibility = "hidden";
                    document.getElementById(place).style.visibility = "hidden";
                    document.getElementById("points").style.visibility = "hidden";
                    document.getElementById("cible").style.visibility = "hidden";
                    document.getElementById("ligne").value = 0;
                    for (let index = 120; index <= 170; index+=10) {
                        document.getElementById(index).setAttribute("cx", 0);
                        document.getElementById(index).setAttribute("cy", 0);      
                    }
                    compteur=110;
                    score = '<?php echo $score; ?>';
                    if(volee===3 && reste==30){
                        if(parseInt(document.getElementById("totalf").value) >= parseInt(score)){
                            document.cookie = "total = " + parseInt(document.getElementById("totalf").value);
                            document.getElementById("resultat").value ="Plume validée";
                            document.getElementById("resultat").style.backgroundColor="#FFC300";
                            document.getElementById("resultat").style.color="white";
                            document.getElementById("submit").style.visibility = "visible";
                            document.getElementById("validation").style.visibility = "visible";
                        }
                    }
                    if(volee===6 && reste==60){
                        if(parseInt(document.getElementById("totalf").value) >= parseInt(score)){
                            document.cookie = "total = " + parseInt(document.getElementById("totalf").value);
                            document.getElementById("resultat").value ="Flêche validée";
                            document.getElementById("resultat").style.backgroundColor="#FFC300";
                            document.getElementById("resultat").style.color="white";
                            document.getElementById("submit").style.visibility = "visible";
                            document.getElementById("validation").style.visibility = "visible";
                        }
                    }
                }
            }
           
        }
        function ecrit(id){
            ligne = `ligne` + id;
            document.getElementById("points").style.visibility = "visible";
            document.getElementById("cible").style.visibility = "visible";
            document.getElementById("place").value = ligne;
            document.getElementById(id).textContent = "en cours";
        }


    </script>
   
</body>

</html>
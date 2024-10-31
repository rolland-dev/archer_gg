<?php
session_start();

if(isset($_SESSION['role'])){
    $role = $_SESSION['role'];
}else{
    $role = '';
}
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

if($role == ''){
    header("Location: ./index.php");
}

// session_abort();

require_once "../php/bdd/config.php";

$tir1 = $tir2 = $tir3 = $tir4 = $tir5 = $tir6 = "";
$tir1_err = $tir2_err = $tir3_err = $tir4_err =$tir5_err =$tir6_err ="";


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $id = $_POST['id'];

    if (isset($_COOKIE['case11'])) {
        $tir1 = trim($_COOKIE['case11']);
    } else {
        $tir1 = 0;
    }
    if (isset($_COOKIE['case21'])) {
        $tir2 = trim($_COOKIE['case21']);
    } else {
        $tir2 = 0;
    }
    if (isset($_COOKIE['case31'])) {
        $tir3 = trim($_COOKIE['case31']);
    } else {
        $tir3 = 0;
    }
    if (isset($_COOKIE['case41'])) {
        $tir4 = trim($_COOKIE['case41']);
    } else {
        $tir4 = 0;
    }
    if (isset($_COOKIE['case51'])) {
        $tir5 = trim($_COOKIE['case51']);
    } else {
        $tir5 = 0;
    }
    if (isset($_COOKIE['case61'])) {
        $tir6 = trim($_COOKIE['case61']);
    } else {
        $tir6 = 0;
    }
    if (isset($_POST['total'])) {
        $total = trim($_POST['total']);
    } else {
        $total = 0;
    }

    // $sql1 = "SELECT * FROM entrainements WHERE (id='$id')";
    // if($result1 = mysqli_query($link, $sql1)){
    //     if(mysqli_num_rows($result1) > 0){
    //         while($row1 = mysqli_fetch_array($result1)){
    //             $nb_f = $row1['nb_fleche'];
    //             $volees = $row1['volee'];
    //         }
            
    //     }
    // }

        $sql = "UPDATE entrainements SET fleche1=?, fleche2=?, fleche3=?,fleche4=?, fleche5=?, fleche6=?, total=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "iiiiiiii", $param_col1, $param_col2, $param_col3, $param_col4, $param_col5, $param_col6,$param_total, $param_id);
            
            $param_col1 = $tir1;
            $param_col2 = $tir2;
            $param_col3 = $tir3;
            $param_col4 = $tir4;
            $param_col5 = $tir5;
            $param_col6 = $tir6;
            $param_total = $total;
            $param_id = $id;

            if(mysqli_stmt_execute($stmt)){    
                
                header("Location: ../entrainement.php"); 
                exit();
            } else{
                echo "Oops! erreur inattendu, rééssayez ultérieusement";
            }
        }
        
    
        setcookie("total", 0, time()-1,"/");
    mysqli_close($link);
} else{
    
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id=trim($_GET['id']);
        $sql1 = "SELECT * FROM entrainements WHERE (id='$id')";
        if($result1 = mysqli_query($link, $sql1)){
            if(mysqli_num_rows($result1) > 0){
                while($row1 = mysqli_fetch_array($result1)){
                    $nb_f = $row1['nb_fleche'];
                }
            }
        }   
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $archer_id ?></title>
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
   
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid" style="width:130%">
            <div class="row">
                <div class="col-12">
                    <h2 class="mt-5">Archer : <?php echo $nom; ?> </h2>
                   
                    <h4 class="mt-3"><?php echo date('d-m-Y', strtotime(date('d-m-Y'))); ?></h4>
                    <br>
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                        enctype="multipart/form-data">
                        
                            <div class="volee1 d-flex" >
                                <div class="form-group">
                                    <label>Volée</label>
                                    <input type="text" id="volee" class="form-control" value="1" width="">
                                </div>
                                <?php
                                    for ($j=1; $j < $nb_f+1; $j++):
                                ?>
                                    <div class="form-group">
                                        <label><?= $j ?></label>
                                        <input type="number" id="<?= $j ?>1" name="<?= $j ?>1" class="form-control disabled" value="" min="0" max="10" disabled>
                                    </div>
                                <?php endfor; ?>

                                <div class="form-group">
                                    <label>Total
                                    <input type="number" id="total" class="form-control" name="total" value="0" readonly /></label>
                                </div>
                                
                                <div class="form-group">
                                    <label>Actions
                                    <div class="btn btn-secondary ecrire" id="17" onclick="ecrit(this.id, <?= $nb_f ?>);">ecrire</div></label>
                                    <div class="btn btn-secondary modif " id="18" onclick="modif(this.id);"><span class="fas fa-pencil-alt p-2"></span></div>
                                    <input type="hidden" id="test" value="0" /></label>
                                </div>
                                
                            </div>                      
                        
                        <div id="points" style="visibility:hidden">
                            <div class="btn btn-primary taille" id="10" onclick="ajout(this.id);">10</div>
                            <div class="btn btn-primary taille" id="9" onclick="ajout(this.id);">9</div>
                            <div class="btn btn-primary taille" id="8" onclick="ajout(this.id);">8</div>
                            <div class="btn btn-primary taille" id="7" onclick="ajout(this.id);">7</div>
                            <div class="btn btn-primary taille" id="6" onclick="ajout(this.id);">6</div>
                            <div class="btn btn-primary taille" id="5" onclick="ajout(this.id);">5</div>
                            <div class="btn btn-primary taille" id="4" onclick="ajout(this.id);">4</div>
                            <div class="btn btn-primary taille" id="3" onclick="ajout(this.id);">3</div>
                            <div class="btn btn-primary taille" id="2" onclick="ajout(this.id);">2</div>
                            <div class="btn btn-primary taille" id="1" onclick="ajout(this.id);">1</div>
                            <div class="btn btn-primary taille" id="0" onclick="ajout(this.id);">0</div>
                        </div><br>
                        <!--<div id="cible" style="visibility:hidden">
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
                        </div>-->
                     
                        <input type="hidden" name="id" value="<?php echo $id; ?>" >

                        <input type="submit" name="submit" id="submit" class="btn btn-primary " style="visibility:hidden" value="Enregistrer">
                        <a href="javascript:close_tab();" class="btn btn-secondary ml-2">Fermer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

let nbF;
let cases = 1;
        // let compteur = 110;
        // let idRecup;
        // let elementDiv=document.getElementById('svg');
        //let coord = elementDiv.getBoundingClientRect();
        //console.log(coord.x , coord.y);

        // function choix(id){
        //     idRecup = id;
        //     window.addEventListener('click', mousemove);
        // }
        // function mousemove(event) {  
        //     if(compteur>=170){
        //         compteur =110;
        //     }
        //     compteur=compteur+10;
        //     document.getElementById(compteur).setAttribute("cx", (event.clientX-coord.x)+"px");
        //     document.getElementById(compteur).setAttribute("cy", (event.clientY-coord.y)+"px");
        //     console.log(document.getElementById(compteur));
        //     ajout(idRecup,1);
             
        // }

        function close_tab(){
            if (confirm('Attention toutes les données seront perdues !!! \nVoulez vous fermer cette onglet ?')) {
                window.close();
            }
        }

        function modif(id){
            if(document.getElementById("test"+id).value == "0")
            {
                document.getElementById(id).innerHTML = "<i class='fa-solid fa-lock-open'></i>";
                document.getElementById("test"+id).value = "1";
                $val = Math.trunc(((document.getElementById("ligne").value)/10));
                for(i=1;i<=6;i++){
                    cpt=val*10+i;
                    document.getElementById(cpt).disabled=false;
                }
            }else{
                let Somme=0;
                document.getElementById(id).innerHTML = "<span class='fas fa-pencil-alt p-2'>";
                document.getElementById("test"+id).value = "0";
                val = Math.trunc(((document.getElementById("ligne").value)/10));
                for(i=1;i<=6;i++){
                    cpt=val*10+i;
                    document.getElementById(cpt).disabled=true;
                    if(document.getElementById(cpt).value!=""){
                        Somme+=parseInt(document.getElementById(cpt).value);
                    }
                }
                document.getElementById("total"+val).value=Somme;
                document.getElementById("totalf").value=Somme;
            }
        }
            
        

        function ajout(id){
            
            point = parseInt(id);

            // 11 - 21 - 31 - 41 - 51 - 61

            cases = (cases + 10);
            
            document.getElementById(cases).value = point;
            console.log(cases + parseInt(document.getElementById("total").value));
            document.cookie = "case"+cases+"= " + parseInt(document.getElementById(cases).value);
            point_ant = parseInt(document.getElementById("total").value);
            
            document.getElementById("total").value = point_ant+point;               
                
                // if(nbF==6){
                //     val = Math.trunc(((document.getElementById("ligne").value)/10));
                //     document.getElementById($val).style.visibility = "hidden";
                //     document.getElementById(place).style.visibility = "hidden";
                //     document.getElementById("points").style.visibility = "hidden";
                //     document.getElementById("cible").style.visibility = "hidden";
                //     document.getElementById("ligne").value = 0;
                //     for (let index = 120; index <= 170; index+=10) {
                //         document.getElementById(index).setAttribute("cx", 0);
                //         document.getElementById(index).setAttribute("cy", 0);      
                //     }
                    
                    if(cases==31){
                            document.cookie = "total = " + parseInt(document.getElementById("total").value);
                            document.getElementById("submit").style.visibility = "visible";
                    }
                    if(cases==61){
                            document.cookie = "total = " + parseInt(document.getElementById("total").value);
                            document.getElementById("submit").style.visibility = "visible";                        
                    }
                }
            
           
        
        function ecrit(id,nbfleches){
            nbF =nbfleches;
            document.getElementById("points").style.visibility = "visible";
            //document.getElementById("cible").style.visibility = "visible";
            //document.getElementById("place").value = ligne;
            document.getElementById(id).textContent = "en cours";
        }


    </script>
   
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './php/menu/head.php' ?>
    <title>Accueil</title>
</head>

<body>
    <?php require_once './php/menu/menu.php'; ?>

    <!-- carousel -->
    <div class="slider">
        <div class="slide-track">
            <div class="slide">
                <img src="./img/img1.jpg" height="500" width="750" alt="" />
            </div>
            <div class="slide">
                <img src="./img/img3.jpg" height="500" width="750" alt="" />
            </div>
            <div class="slide">
                <img src="./img/img7.jpeg" height="500" width="750" alt="" />
            </div>
            <div class="slide">
                <img src="./img/img6.jpeg" height="500" width="750" alt="" />
            </div>
            <div class="slide">
                <img src="./img/img8.jpeg" height="500" width="750" alt="" />
            </div>
            <div class="slide">
                <img src="./img/img1.jpg" height="500" width="750" alt="" />
            </div>
            <div class="slide">
                <img src="./img/img3.jpg" height="500" width="750" alt="" />
            </div>
            <div class="slide">
                <img src="./img/img7.jpeg" height="500" width="750" alt="" />
            </div>
            <div class="slide">
                <img src="./img/img6.jpeg" height="500" width="750" alt="" />
            </div>
            <div class="slide">
                <img src="./img/img8.jpeg" height="500" width="750" alt="" />
            </div>
        </div>
    </div>

    <!-- infos générales -->
<br>
    <h1>Informations diverses</h1> 
    <!-- horaires, situation et contact  -->
    <div class="horaire w-100">
        <div class="card text-white bg-primary mb-3 text-center" style="max-width: 40rem;">
            <div class="card-header"><h1>Horaires</h1></div>
            <div class="card-body">
                <h4 class="card-title">Le mercredi (encadré)</h4>
                <p class="card-text">De 14h à 15h30</p>
                <h4 class="card-title">Le samedi (encadré)</h4>
                <p class="card-text">De 10h à 11h30</p>
                <h4 class="card-title">Le dimanche (non encadré)</h4>
                <p class="card-text">De 10h à 12h</p><br><br>
                <h5 class="card-text border p-3 rounded">Le mercredi et le samedi, un encadrrement est présent.
                Concernant le dimanche, aucun encadrement n'est présent donc les archers qui seront présents seront sous leurs propre responsabilité.</h5>
            </div>
        </div>
        <div class="card text-white bg-primary mb-3 text-center" style="max-width: 40rem;">
            <div class="card-header"><h1>Plan</h1></div>
            <div class="card-body">
                <h4 class="card-title">5 rue Louis Bertaux<br>02190 Villeneuve sur Aisne</h4>
                <p class="card-text"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2594.508046045567!2d3.9575495927122533!3d49.4371140861131!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e9a378acba4329%3A0xdf2a1287eee1a429!2sLa%20petite%20Gare!5e0!3m2!1sfr!2sfr!4v1702562057750!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></p>
            </div>
        </div>
    </div>

    <?php require_once './php/menu/footer.php'; ?>
</body>

</html>
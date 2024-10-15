<?php
session_start();

if (isset($_SESSION['login'])) {
    $connect = $_SESSION['login'];
} else {
    $connect = '';
}
if (isset($_SESSION['erreur'])) {
    $erreur = $_SESSION['erreur'];
} else {
    $erreur = '';
}
if (isset($_SESSION['nom'])) {
    $nom = $_SESSION['nom'];
} else {
    $nom = '';
}

if (isset($_SESSION['role'])) {
    $ROLE = $_SESSION['role'];
} else {
    $ROLE = '';
}
?>


<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php"><img src="../img/logo.png" alt=""> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Accueil</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="./index_admin.php">Connexions</a>
                        <a class="dropdown-item" href="./secours_admin.php">Contact secours</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./carousel_admin.php">Carousel
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Archers</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="./archers_admin.php">Liste Archers</a>
                        <a class="dropdown-item" href="./suivi_admin.php">Suivi archers</a>
                        <a class="dropdown-item" href="./passage_admin.php">Passage flèche/plumes</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">option</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./messages_admin.php">Messages
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./images_admin.php">En images
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./concours_admin.php">Concours
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./documents_admin.php">Documents
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./description_admin.php">flèche/plumes
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Inventaires</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="./categorie_admin.php">Catégories</a>
                        <a class="dropdown-item" href="./arcs_admin.php">Equipements Arcs</a>
                        <a class="dropdown-item" href="./eqarchers_admin.php">Equipements Archers</a>
                        <a class="dropdown-item" href="./cibles_admin.php">Cibleries</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">options</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./aide.php">Aides</a>
                </li>
            </ul>
            <ul class="navbar-nav login">
                <!-- Si connexion et en fonction du role -->
                <?php if ($connect == "yes") : ?>
                    <li class="nav-item ">
                        <a class="nav-link" href="../logout.php">Déconnexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
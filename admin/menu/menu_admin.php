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
                <li class="nav-item">
                    <a class="nav-link" href="./index_admin.php">Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./archers_admin.php">Archers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./messages_admin.php">Messages
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./suivi_admin.php">Suivi archers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./images_admin.php">En images
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav login">
                <!-- Si connexion et en fonction du role -->
                <?php if ($connect == "yes") : ?>
                    <li class="nav-item ">
                        <a class="nav-link" href="./logout.php">Déconnexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
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
    </style>
</head>

<body>
    <?php require_once './menu/menu_admin.php'; ?>

    <div class="m-3 text-center">

        <h1>Aide sur l'utilisation ''Admin''</h1> 

        <h3 class="text-center p-5">
            Ce guide va permettre de savoir utiliser la partie Admin du site.
            Cette partie va en autre permettre de gérer les arches et utilisateurs, le carousel, messqages, images,concours interne, documents et la listes des flèches et plumes.
        </h3>

        <img src="../img/aide/Capture0.png" alt="menu admin" width=80% />
        <br><hr>

        <div class="text-center" id="retour">
            <h4>Menu principal</h4>
            <a href="#infos">Informations générales</a><br>
            <a href="#Accueil">Accueil</a><br>
            <a href="#Carousel">Carousel</a><br>
            <a href="#Archers">Archers</a><br>
            <a href="#Messages">Messages</a><br>
            <a href="#Enimages">En Images</a><br>
            <a href="#Concours">Concours</a><br>
            <a href="#Documents">Documents</a><br>
            <a href="#Fleches">Fléches/Plumes</a><br>
            <a href="#Inventaire">Inventaire</a><br>
            <a href="#Contact">Contacts</a>    
        </div>
        <br><hr>

        <h4 id="infos">Informations générales</h4>
        <p><span class="fas fa-pencil-alt p-2"></span> Permet la modification des informations de la ligne</p>
        <p><span class="fa fa-trash p-2"></span> Permet de supprimer l'archer de la ligne concernée</p>
        <p><span class="fa fa-user p-2"></span> Permet de créer l'utilisateur pour qu'il puisse accéder à son compte</p>
        <p><span class="fa fa-sheet-plastic p-2"></span> Permet d'afficher les informations générales de l'archer</p>
        <p><span class="fa-solid fa-feather p-2"></span> Permet d'enregistrer la validation d'une plume à l'archer</p>
        <p><span class="fa fa-location-arrow p-2"></span> Permet d'enregistrer la validation d'une fléche à l'archer</p>
        <a href="#retour">Menu</a>   
        <br><hr>

        <h4 id="Accueil">Accueil</h4>
        <img src="../img/aide/Capture1.png" alt="menu admin" width=80% /><br><br>
        <p>
            Cette partie recense tous les utilisateurs ayant eu le droit de connexion lors de l'inscription, <br>
            sauf si ce droit n'a pas été donné par la personne qui aura fait l'inscription (Voir partie Archers). <br>
            Le nom d'utilisateur est défini à l'inscription, le rôle sera par défaut 'ARCHER'. <br>
            Par la suite le rôle peut être changé <span style="color:red;font-weight:bold">mais attention</span> , seul les personnes faisant parties du bureau pourront avoir le rôle de 'ADMIN'. <br>

        </p>
        <a href="#retour">Menu</a> 
        <br><hr>

        <h4 id="Carousel">Carousel</h4>
        <img src="../img/aide/Capture2.png" alt="menu admin" width=80% /><br><br>
        <p>
           Permet de modifier les images qui défilent dans l'accueil du site
        </p>
        <a href="#retour">Menu</a> 
        <br><hr>

        <h4 id="Archers">Archers</h4>
        <img src="../img/aide/Capture3.png" alt="menu admin" width=80% /><br><br>
        <p>
           Dans la partie archers, on pourra retrouver toute la gestion des archers. <br>
           Dans le sous menu <span style="color:red;font-weight:bold">'liste des archers'</span>, on pourra créer un nouvel archer, mais aussi faire d'autre actions sur chaque archer. <br>
        </p>
        <p>
            Le bouton <span style="color:red;font-weight:bold">'Ajouter un archer'</span> permet de créer un archer avec des champs obligatoire précisés par des étoiles.
        </p>
        <p>
            Le bouton <span style="color:red;font-weight:bold">'Désactiver les archers'</span> permet de désactiver l'accés des archers (sauf ADMIN) à toutes leurs données durant la période de fermeture du club pendant les grandes vacances. <br>
            <span style="color:red;font-weight:bold">La réactivation se ferra à la réouverture du club seulement si l'archer se réinscrit.</span>
        </p>
        <p>
            Dans la colonne action, le descriptif de chaque icone a été expliqué dans la partie <a href="#infos">Informations générales</a> <br>
            Seul l'icone <span class="fa fa-user p-2"></span> a pour but de créer le nom d'utilisateur, l'email est celui donné par l'archer, le rôle a mettre par défaut sera 'ARCHER' (en majuscule). <br>
            Un email sera envoyé à l'archer avec la procédure pour qu'il puisse s'incrire, créer son mot de passe et avoir accés à son compte. <br>
            <span style="color:red;font-weight:bold">ATTENTION, aucun mot de passe ne sera créé ou modifié par les membres du club (respect de la RGPD)</span>
        </p>
        <img src="../img/aide/Capture4.png" alt="menu admin" width=80% /><br><br>
        <p>
           Dans le sous menu <span style="color:red;font-weight:bold">'Suivi des archers'</span>, on aura la liste des archers avec le suivi des plumes et fléches <br>
        </p>
        <p>
            Nous avons aussi l'icone <span class="fa fa-sheet-plastic p-2"></span> pour accéder à la fiche de l'archer.
        </p>
       <br>
        <p>
            Nous allons aborder la partie pour le passage de fléches ou plumes.
        </p>
        <img src="../img/aide/Capture5.png" alt="menu admin" width=80% /><br><br>
        <p>
            Concernant le valideur, se sera l'administrateur connecté au moment de la création d'un passage <br>
            A la validation final, le nom du valideur sera enregistré automatique avec le passage de l'archer <br><br>
           Dans cette partie, on va créer un passage pour un archer de la façon suivante : <br>

           Choisir un archer dans la liste <br>
           Choisir la couleur de plume ou fléche (PAS LES 2) <br>
           Cliquez sur 'c'est parti' et nous arrivons sur une autre fenêtre comme çi dessous <br>
        </p> <br>
        <img src="../img/aide/Capture6.png" alt="menu admin" width=80% /><br><br>

        <br>
        <p>
            On retrouve le nom du valideur <br>
            On retrouve le nom et prénom de l'archer <br>
            Puis la couleur et le type 'fléche' ou 'plume' <br><br>
            Maintenant pour créer ce passage, cliquez sur <span class="fas fa-pencil-alt p-2"></span><br><br>
            De ce faite nous revenons sur la page précédente <br><br>
            Sélectionnez de nouveau l'archer et le type de plume ou fléche qu'il doit passer et la vous arrivez sur la fiche de passage <br>
        </p><br>
        <img src="../img/aide/Capture7.png" alt="menu admin" width=80% /><br><br>

        <p>
            Sur cette nouvelle fenêtre nous retrouvons les infos du valideur, de l'archer (nom-prénom) et fléche ou plume avec la couleur <br><br>
            Le tableau de passage et en fonction du type plume ou fléche en fonction de la demande de la FFTA <br><br>
            Pour pouvoir entrer les points, il suffit de sélectionner le numéro de passage en cliquant sur <span class="fas fa-pencil-alt p-2"></span><br>
            (Respectez l'ordre de passage ex: passage 1, passage 2, ...) <br><br>
            Maintenant nous arrivons sur la fiche pour les points <br><br>
            <img src="../img/aide/Capture8.png" alt="menu admin" width=80% /><br><br>
            On y retrouve encore une foois toutes les infos (archer, plume ou fléche, couleur, date, numéro de passage) <br>
            cela évite les erreurs d'archer ou autre, de plus on peut ouvrir plusieurs fichier de point avec différents archers, <br>
            pour cela, chaque onglet à le nom et prénom de l'archer (voir capture). <br><br>
            Pour commencer a entrer les points, il suffit de cliquez sur le bouton 'écrire' qui passe à 'En cours' <br>
            Les points apparaissent en bas et seront entrés les uns à la suite des autres et calculés automatiquement (total volée et général) <br>
            En cas d'erreur de point sur la volée encours, il suffira de cliquer sur <span class="fas fa-pencil-alt p-2"></span> pour modifier l'erreur <br><br>
            <img src="../img/aide/Capture9.png" alt="menu admin" width=80% /><br><br>
            Une fois que toutes les volée ont été entrées, soit c'est validé, un bouton 'Enregistrer' apparait et un message qui affichera si réussit, sinon passage non validé <br><br>

            <img src="../img/aide/Capture10.png" alt="menu admin" width=80% /><br><br>
            Quand tout les passages sont finis, on aura la possibilité de faire la validation finale via un lien en bas de la fiche de marque : 'VALIDATION FINALE' <br><br>
            <img src="../img/aide/Capture11.png" alt="menu admin" width=80% /><br><br>
            De ce fait, non arrivons directement sur la fiche de l'archer avec toujours le nom prénom de l'archer et la plume ou fléche passée <br><br>
            <img src="../img/aide/Capture12.png" alt="menu admin" width=80% /><br><br>
        </p>

        <a href="#retour">Menu</a> 
        <br><hr>
        <h4 id="Contact">Auteurs & contacts</h4> 
        <p>
            Didier ROLLAND <br>
            RLDéveloppement (https://www.rolland-dev.fr) <br>
            06.26.84.27.97 <br>
            didier@rolland-dev.fr
        </p>
        <a href="#retour">Menu</a> 


    </div>

</body>

</html>
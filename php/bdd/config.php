<?php
/* config de la BDD */

/* config sur serveur */
// define('DB_SERVER', '185.98.131.176');
// define('DB_USERNAME', 'arche2389791');
// define('DB_PASSWORD', '2bikjbr1dp');
// define('DB_NAME','arche2389791');

/* config en local */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME','archergg');
/* lancer la connexion a la BDD */

$link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

/* gestion des erreurs de connexion */

if($link === false){
    die("ERROR : connexion impossible". mysqli_connect_error());
}



?>
<?php

require ('./config.php');

// creation table users procédurale
$sql = "create table if not exists users(
    id int(6) unsigned auto_increment primary key,
    login varchar(50) not null unique,
    mdp varchar(150) not null,
    email varchar(150) null,
    archer_id int(10) null,
    role varchar(15) not null,
    reset-psw text null)";

if(!mysqli_query($link,$sql)){
    echo "Erreur de création";
}

//creation table archers procédurale
$sql = "create table if not exists archers(
    id int(6) unsigned auto_increment primary key,
    nom varchar(150) not null,
    prenom varchar(150) not null,
    sexe varchar(20) not null,
    date_n date not null,
    email varchar(20) not null,
    tel varchar(10) null,
    mobile varchar(10) null,
    pere varchar(100) null,
    mere varchar(100) null,
    numlicence varchar(40) not null,
    licence varchar(50) not null,
    certif int(1) not null,
    valide int(1) not null,
    create_user varchar(100) null)";

if(!mysqli_query($link,$sql)){
    echo "Erreur de création";
}

//creation table plumes procédurale
$sql = "create table if not exists plumes(
    id int(6) unsigned auto_increment primary key,
    couleur varchar(50) not null,
    point int(20) not null,
    archers_id int(10) not null,
    date date not null,
    validateur varchar(50) not null,
    valide int(1) not null)";

if(!mysqli_query($link,$sql)){
    echo "Erreur de création";
}

// creation table fleches procédurale
$sql = "create table if not exists fleches(
        id int(6) unsigned auto_increment primary key,
        couleur varchar(50) not null,
        point int(20) not null,
        archers_id int(10) not null,
        date date not null,
        validateur varchar(50) not null,
        valide int(1) not null)";

if(!mysqli_query($link,$sql)){
    echo "Erreur de création";
}

// creation table images procédurale
$sql = "create table if not exists images(
    id int(6) unsigned auto_increment primary key,
    date date not null,
    lien text not null,
    commentaire text null)";

if(!mysqli_query($link,$sql)){
    echo "Erreur de création";
}

// creation table messages procédurale
$sql = "create table if not exists messages(
    id int(6) unsigned auto_increment primary key,
    lien text null,
    date date not null,
    editeur varchar(100) not null,
    commentaire text not null,
    valide int(1) not null)";

if(!mysqli_query($link,$sql)){
    echo "Erreur de création";
}

// creation table categories procédurale
$sql = "create table if not exists categories(
    id int(6) unsigned auto_increment primary key,
    categorie text not null)";

if(!mysqli_query($link,$sql)){
    echo "Erreur de création";
}

// creation table equipement arc procédurale
$sql = "create table if not exists eqarcs(
    id int(6) unsigned auto_increment primary key,
    categorie text null,
    lgpoignee int null,
    lgarc int null,
    branches text null,
    puissance int null,
    lateral varchar(20) null,
    numero int null,
    archers text null,
    lgfleche int null,
    spin int null,
    diametre float null,
    lgcorde int null,
    nombre int null,
    nbbrins int null,
    typecorde text null,
    nockset text null,
    grains float null,
    tailleplume float null,
    couleurplume varchar(20) null,
    divers text null)";

if(!mysqli_query($link,$sql)){
    echo "Erreur de création";
}

// creation table equipement archers procédurale
$sql = "create table if not exists eqarchers(
    id int(6) unsigned auto_increment primary key,
    categorie text null,
    laterale varchar(20) null,
    numero int null,
    archers text null,
    taille varchar(10) null,
    nombre int null,
    divers text null)";

if(!mysqli_query($link,$sql)){
    echo "Erreur de création";
}

// creation table equipement archers procédurale
$sql = "create table if not exists cibles(
    id int(6) unsigned auto_increment primary key,
    categorie text null,
    taille varchar(10) null,
    nombre int null,
    divers text null)";

if(!mysqli_query($link,$sql)){
    echo "Erreur de création";
}

// creation table equipement archers procédurale
$sql = "create table if not exists contact(
    id int(6) unsigned auto_increment primary key,
    lien text not null,
    valide int not null)";

if(!mysqli_query($link,$sql)){
    echo "Erreur de création";
}

// creation table entrainement archers procédurale
$sql = "create table if not exists entrainements(
    id int(6) unsigned auto_increment primary key,
    archers_id int(10) not null,
    date date not null,
    nb_fleche int(10) not null,
    volee int(6) not null,
    fleche1 int(10) not null,
    fleche2 int(10) not null,
    fleche3 int(10) not null,
    fleche4 int(10) not null,
    fleche5 int(10) not null,
    fleche6 int(10) not null,
    total int(10) null,
    distance int(10) not null,
    blason int(10) not null,
    type text not null,
    valide int(1) not null,
    num_entrainement int not null)";


if(!mysqli_query($link,$sql)){
    echo "Erreur de création";
}
$link -> close();

?>
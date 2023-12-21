<?php

require ('./config.php');

// creation table users procédurale
$sql = "create table if not exists users(
    id int(6) unsigned auto_increment primary key,
    login varchar(50) not null unique,
    mdp varchar(150) not null,
    email varchar(150) null,
    role varchar(15) not null)";

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
    licence varchar(50) not null,
    certif int(1) not null,
    valide int(1) not null)";

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
// $sql = "create table if not exists images(
//     id int(6) unsigned auto_increment primary key,
//     date date not null,
//     lien text not null,
//     commentaire text null)";

// if(!mysqli_query($link,$sql)){
//     echo "Erreur de création";
// }

// creation table messages procédurale
// $sql = "create table if not exists messages(
//     id int(6) unsigned auto_increment primary key,
//     archers_id int(5) not null,
//     date date not not,
//     commentaire text not null)";

// if(!mysqli_query($link,$sql)){
//     echo "Erreur de création";
// }




$link -> close();

?>
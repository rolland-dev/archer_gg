<?php

require ('./config.php');

// creation table users procédurale
$sql = "create table if not exists users(
    id int(6) unsigned auto_increment primary key,
    login varchar(50) not null unique,
    mdp varchar(150) not null,
    email varchar(150) null,
    archer_id int(10) null,
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




$link -> close();

?>
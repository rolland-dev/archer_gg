<?php

require ('./config.php');

// creation table users procédurale
$sql = "create table if not exists users(
    id int(6) unsigned auto_increment primary key,
    login varchar(50) not null,
    mdp varchar(150) not null,
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

// creation table urgence procédurale
// $sql = "create table if not exists urgence(
//     id int(6) unsigned auto_increment primary key,
//     nom varchar(150) not null,
//     prenom varchar(150) not null,
//     parents varchar(20) not null,
//     num_tel varchar(20) null,
//     num_port int(30) null,
//     patient_id int(10) not null,
//     valide int(1) not null)";

// if(!mysqli_query($link,$sql)){
//     echo "Erreur de création";
// }

// creation table traitements procédurale
// $sql = "create table if not exists traitements(
//     id int(6) unsigned auto_increment primary key,
//     patient_id int(10) not null,
//     date date not null,
//     description text not null,
//     valide int(1) not null)";

// if(!mysqli_query($link,$sql)){
//     echo "Erreur de création";
// }

// creation table traitements procédurale
// $sql = "create table if not exists messages(
//     id int(6) unsigned auto_increment primary key,
//     patient_id int(10) not null,
//     date date not null,
//     description text not null,
//     expediteur varchar(50) not null,
//     destinataire text null)";

// if(!mysqli_query($link,$sql)){
//     echo "Erreur de création";
// }

// creation table scenario procédurale
// $sql = "create table if not exists scenario(
//     id int(6) unsigned auto_increment primary key,
//     numero int(5) not null,
//     lien text not null)";

// if(!mysqli_query($link,$sql)){
//     echo "Erreur de création";
// }

// creation table traitements procédurale
// $sql = "create table if not exists messagesad(
//     id int(6) unsigned auto_increment primary key,
//     patient_id int(10) not null,
//     date date not null,
//     description text not null,
//     expediteur varchar(50) not null,
//     destinataire text null,
//     lu int(3) null)";

// if(!mysqli_query($link,$sql)){
//     echo "Erreur de création";
// }


$link -> close();

?>
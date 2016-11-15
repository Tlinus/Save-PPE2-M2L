<?php
session_start();
include('../function.php');
$bdd=bdd();
$label=$_POST['text'];
$query=$bdd->query('INSERT INTO `categorie`(`categorie_id`, `label`) VALUES (NULL,"'.$label.'")');
if($query){
    echo 'Ajout catégorie: La catégorie :'.$label.' a bien été crée';
}
else{
    echo 'Ajout catégorie : La catégorie :'.$label.' n\' a pas pu être crée';
}
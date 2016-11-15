<?php
session_start();
include('../function.php');
$bdd=bdd();
$id=$_POST['id'];
$query=$bdd->query('DELETE FROM produit WHERE produit_id='.$_POST['id'].'');
if($query){
    echo'Suppression produit: Le produit a été supprimée.';
}
else{
    echo'Suppression catégorie: Le produit n\'a pas pu être supprimée.';
}
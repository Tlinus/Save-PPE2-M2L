<?php
session_start();
include('../function.php');
$bdd=bdd();
$query=$bdd->prepare('UPDATE `produit` SET `designation`=:designation,`description`=:description,`prix_unitaire`=:prix,`tva_id`=:tva,`date_parution`=NOW(),`categorie_id`=:cat WHERE produit_id=:id');
$result=$query->execute(array('designation'=>$_POST['nom'],'description'=>$_POST['description'],'prix'=>$_POST['prix'],'tva'=>$_POST['tva'],'cat'=>$_POST['category'],'id'=>$_POST['articleID']));
$query2=$bdd->prepare('UPDATE `photo`SET `photo_id`=:url WHERE id_produit =:id');
$result2=$query2->execute(array('url'=>$_POST['image'],'id'=>$_POST['articleID']));
if($result && $result2){
    echo 'Produit modifié.';
}
else{
    echo 'Le produit n\'a pas été modifié. Une erreur est arrivée.';
}
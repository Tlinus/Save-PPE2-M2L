<?php
session_start();
include('../function.php');
$bdd=bdd();
$query=$bdd->prepare('INSERT INTO `produit`(`produit_id`, `designation`, `description`, `prix_unitaire`, `tva_id`, `date_parution`, `categorie_id`) VALUES (NULL,:designation,:description,:prix,:tva,NOW(),:cat)');
$result=$query->execute(array('designation'=>$_POST['nom'],'description'=>$_POST['description'],'prix'=>$_POST['prix'],'tva'=>$_POST['tva'],'cat'=>$_POST['category']));
$id=$bdd->lastInsertId();
$query2=$bdd->prepare('INSERT INTO `photo`(`photo_id`, `url`, `id_produit`) VALUES (NULL,:url,:id)');
$result2=$query2->execute(array('url'=>$_POST['image'],'id'=>$id));
if($result && $result2){
    echo 'Ajout réussi';
}
else{
    echo 'L\'édition a échoué';
}
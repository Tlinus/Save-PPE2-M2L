<?php
session_start();
include('../function.php');
$bdd=bdd();
$id=$_POST['id'];
$query=$bdd->prepare('INSERT INTO `article`(`id`, `img_url`, `extrait`, `contenu`, `titre`, `auteur_id`, `date`) VALUES (NULL,:image,:description,:contenu,:titre,:auteur,NOW())');
$result=$query->execute(array('image'=>$_POST['image'],'description'=>utf8_decode($_POST['description']),'contenu'=>utf8_decode($_POST['contenu']),'titre'=>$_POST['titre'],'auteur'=>$_SESSION['id']));
if($result){
    echo 'Edition réussie';
}
else{
    echo 'L\'édition a échoué';
}
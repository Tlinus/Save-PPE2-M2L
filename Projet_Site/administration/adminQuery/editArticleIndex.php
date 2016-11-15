<?php
session_start();
include('../function.php');
$bdd=bdd();
$id=$_POST['id'];
$query=$bdd->prepare('UPDATE `article` SET `img_url`=:image,`extrait`=:description,`contenu`=:contenu,`titre`=:titre,`date`= NOW() WHERE id=:id');
$result=$query->execute(array('image'=>$_POST['image'],'description'=>utf8_decode($_POST['description']),'contenu'=>utf8_decode($_POST['contenu']),'titre'=>$_POST['titre'],'id'=>$_POST['id']));
if($result){
    echo 'Edition réussie';
}
else{
    echo 'L\'édition a échoué';
}
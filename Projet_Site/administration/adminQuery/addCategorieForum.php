<?php
session_start();
include('../function.php');
$bdd=bdd();
$query=$bdd->prepare('INSERT INTO `forum`(`forum_id`, `titre`, `description`) VALUES (NULL,:titre,:description)');
$result=$query->execute(array('titre'=>$_POST['titre'],'description'=>$_POST['description']));
if($result){
    echo'Suppression catégorie: La catégorie a été ajoutée.';
}
else{
    echo'Suppression catégorie: La catégorie n\'a pas pu être ajoutée.';
}
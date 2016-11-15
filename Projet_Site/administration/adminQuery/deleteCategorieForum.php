<?php
session_start();
include('../function.php');
$bdd=bdd();
$id=$_POST['id'];
$query=$bdd->query('DELETE FROM forum WHERE forum_id='.$_POST['id'].'');
if($query){
    echo'Suppression catégorie: La catégorie a été supprimée.';
}
else{
    echo'Suppression catégorie: La catégorie n\'a pas pu être supprimée.';
}
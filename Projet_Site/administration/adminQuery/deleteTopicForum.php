<?php
session_start();
include('../function.php');
$bdd=bdd();
$id=$_POST['id'];
$query=$bdd->query('DELETE FROM topic WHERE topic_id='.$_POST['id'].'');
if($query){
    echo'Suppression topic: Le topic a été supprimée.';
}
else{
    echo'Suppression topic: Le topic n\'a pas pu être supprimée.';
}